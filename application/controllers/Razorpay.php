<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Razorpay extends CI_Controller {

    public function __construct()
      {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model('Model','m');
    
      }

    public function index() {
        $this->checkout();
    }

    public function checkout() {
        $data['title']              = 'Checkout payment | Gig Duniya';  
        $data['callback_url']       = base_url().'razorpay/callback';
        $data['surl']               = base_url().'razorpay/success';;
        $data['furl']               = base_url().'razorpay/failed';;
        $data['currency_code']      = 'INR';
        $this->load->view('web/checkout', $data);
    }

    // initialized cURL Request
    private function curl_handler($payment_id, $amount)  {
       
        $url            = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        $key_id         = RAZOR_KEY_ID;//
        $key_secret     = RAZOR_KEY_SECRET;//
        $fields_string  = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        return $ch;
    }   
        
    // callback method
    public function callback() { 
 //   echo "<pre>";  
 // print_r($this->input->post());      die;
                       $user_id= $this->input->post('user_id');
                       //print_r($user_id);die;
         $data = array(          
                      'user_id' =>$this->input->post('user_id'),
                      'transaction_id' =>$this->input->post('razorpay_payment_id'),
                      'amount' =>$this->input->post('merchant_amount'),
                      // 'status'=>1,
                     );
         //print_r($data);die;
                   $res = $this->m->insert_data('user_wallet',$data);  
                 //echo $this->db->last_query();die;
        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $merchant_order_id = $this->input->post('merchant_order_id');
           // print_r($merchant_order_id);die;
            
            $this->session->set_flashdata('razorpay_payment_id', $this->input->post('razorpay_payment_id'));
            $this->session->set_flashdata('merchant_order_id', $this->input->post('merchant_order_id'));
            $currency_code = 'INR';
            $amount = $this->input->post('merchant_total');
           // print_r($amount);die;
            $success = false;
            $error = '';
            try {                
                $ch = $this->curl_handler($razorpay_payment_id, $amount);
                $result = curl_exec($ch);
                // echo "<pre>";
                // print_r($result);die;

                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    print_r($success);die;
                    $error = 'Curl error: '.curl_error($ch);
                // print_r($error);die;
                } else {
                    $response_array = json_decode($result, true);
                        //Check success response
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;
                        } else {
                            $success = false;
                            if (!empty($response_array['error']['code'])) {
                                $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                        }
                }
                //close curl connection
                curl_close($ch);

            } catch (Exception $e) {
                $success = false;
                $error = 'Request to Razorpay Failed';
            }
            
            if ($success === true) {
                if(!empty($this->session->userdata('ci_subscription_keys'))) {
                    $this->session->unset_userdata('ci_subscription_keys');
                }
                if (isset($order_info['order_status_id']) && !$order_info['order_status_id']) {
                    redirect($this->input->post('merchant_surl_id'));
                } else {
                    redirect($this->input->post('merchant_surl_id'));
                }

            } else {
                redirect($this->input->post('merchant_furl_id'));
            }
        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
    } 
    public function success() 
    {
        $data['title'] = 'Razorpay Success | Taudubrothers';
        
        
     $this->session->set_flashdata('success_msg', 'Your transaction is successful');
         return redirect($_SERVER['HTTP_REFERER']);
        
    }  
    public function failed() {
        $data['title'] = 'Razorpay Failed | Taudubrothers';  
        echo "<h4>Your transaction got Failed</h4>";            
        echo "<br/>";
        echo "Transaction ID: ".$this->session->flashdata('razorpay_payment_id');
        echo "<br/>";
        echo "Order ID: ".$this->session->flashdata('merchant_order_id');
    }

}