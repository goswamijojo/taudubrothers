<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EmailController extends CI_Controller {

    public function __construct() {
        parent:: __construct();

        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('send_mail/contact');
    }



    public function send() {
    
        
        $to = $this->input->post('to');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        
        

$ch = curl_init();

$sender= array(
    "name" => 'From name', 
    
    "email"  => 'pushpa@planetwebit.com',
    
    );



$postData = array(
    "campaign_name" => 'SendEmail', 
    
    "sender"  => $sender, 
 
    "message" => ['msgdata' => $message], 
    
    );
    
    //print_r($postData); die;

curl_setopt($ch, CURLOPT_URL, "https://api.sendinblue.com/v3/smtp/email");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
curl_setopt($ch, CURLOPT_POST, 1);

$headers = array();
$headers[] = "Api-Key: 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";
$headers[] = "Content-Type: application/x-www-form-urlencoded";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

echo $result;
        
        
        
    }
    
    
    
}