<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_controller extends MY_Controller {
public function __construct()
   {
    parent::__construct(); 
    $this->load->model('User_Model');
    $this->load->model('Web_Model');
    $this->load->library("form_validation");
    $this->load->library('email');
    $this->load->library('common'); 
    $this->load->helper('text');
    $this->load->helper('url');
    $this->load->model('Admin_Model','am');
    $this->load->helper('auth_helper');
    $this->load->library('user_agent');
 }      
  
             public function login()
          {
                $this->load->library('user_agent');
               $this->session->set_userdata('redirect_back', $this->agent->referrer());
               $this->render('login');
          }
          
          public function register()
          {
                $this->render('register');
          }
          
          public function varyfy(){
              $data['value']=$this->db->get('user_registeration');
              $this->load->view('web/verify',$data);
          }
          
       public function generate_otp() {
		$OTP 	=	rand(1,9);
		$OTP 	.=	rand(0,9);
		$OTP 	.=	rand(0,9);
		$OTP 	.=	rand(0,9);
		$OTP 	.=	rand(0,9);
		$OTP 	.=	rand(0,9);
		return $OTP;
	}          
  

        public function login_check() {
		$mobile		= $_POST['mobile_no'];
		if(empty($mobile))
		{
		     $this->session->set_flashdata('error','Please Enter Mobile Number.');
			
			redirect('login');
			
		    
		}
		else{
		 $this->form_validation->set_rules('mobile_no', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
		 
		  $mobile		= $_POST['mobile_no'];
		
		       $this->db->where('mobile_no', $mobile);
		       $q = $this->db->get('user_registeration');
		

		
		$user = $this->User_Model->check_mobile($mobile);

		if ($q->num_rows()>0){

			// Generate OTP
			$otp = $this->generate_otp();
			//$otp = '1234';

			$data = [
				'otp'	=> $otp,
			];

			$this->User_Model->update_otp($mobile, $data);

			$message = $otp." is your one time password (OTP) for phone verification. It will expire with in 10 minutes. Don't share this code with anyone. Taudu Brothers";

			$this->send_sms($mobile, $message);

			$data['mobile'] = $mobile;
			
			$this->session->set_userdata('mobile',$mobile);
			
		    $this->session->set_flashdata('success','OTP has been successfully sent to your phone number.');
		    
			
			redirect('verify');	

		} 
	
		else {
		    
		    
		$data= 
		array(
		 
		    'mobile_no'=>$this->input->post('mobile_no'),
		);
		
		$this->db->insert('user_registeration',$data);
		    
		 
		/*	$this->session->set_flashdata('error','You are not registered with us. Please sign up.');
			
			redirect('login');*/
			redirect('login');
			
		}
	
		
		}   
		
	}
  
  
  public function resend_otp($mobile)
  {
    
		 $this->form_validation->set_rules('mobile_no', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
		 
		       //$mobile= $this->input->post('mobile_no');
		       $this->db->where('mobile_no', $mobile);
		       $q = $this->db->get('user_registeration');
		

		
		$user = $this->User_Model->check_mobile($mobile);

		if ($q->num_rows()>0){

			// Generate OTP
			$otp = $this->generate_otp();
			//$otp = '1234';

			$data = [
				'otp'	=> $otp,
			];

			$this->User_Model->update_otp($mobile, $data);

			$message = $otp." is your one time password (OTP) for phone verification. It will expire with in 10 minutes. Don't share this code with anyone. Taudu Brothers";

			$this->send_sms($mobile, $message);

			$data['mobile'] = $mobile;
			
			$this->session->set_userdata('mobile',$mobile);
			
		    $this->session->set_flashdata('success','OTP has been successfully sent to your phone number.');
		    
			
			redirect('verify');	

		} 
	
// 		else {
		    
		    
// 		$data= 
// 		array(
		 
// 		    'mobile_no'=>$this->input->post('mobile_no'),
// 		);
		
// 		$this->db->insert('user_registeration',$data);
		    
		 
// 		/*	$this->session->set_flashdata('error','You are not registered with us. Please sign up.');
			
// 			redirect('login');*/
// 			redirect('verify');
			
// 		}
	
		
		  
		
	
	
  }
    
       public function user_signup()
   {
       
      $upload="";
  $config = array('upload_path' =>'./uploads/', 
        'allowed_types' => "gif|jpg|png|jpeg",
          'overwrite' => TRUE    
        );
$this->load->library('upload',$config);
if($this->upload->do_upload('image'))
{
$banner=$this->upload->data();
$upload= base_url('/uploads/').$banner['file_name'];              
  //echo "file upload success";
}
else
{
$data['imageError']= $this->upload->display_errors();  
}

      $mobile=$this->input->post('mobile_no');
	  $data = array(		
			 		//'name' => $this->input->post('name'),
			 		//'email' => $this->input->post('email'),
			 		'mobile_no'=>$this->input->post('mobile_no'),
			 		'profile_status'=>'1',
				 	//'image' =>$upload,
                    );
                
            $this->User_Model->regiter_model($data,$mobile);  
           
                $this->session->set_flashdata('success','Registered Successfully.');
                redirect('login');
    	
   }    
  
  
  
  
  
  
     public function verify() {
		$data['mobile'] = $this->session->userdata('mobile');
		$this->render('verify',$data);	
	  }
  
   public function verification() {
	 	$mobile		= $this->input->post('mobile_no');
		  $otp		= $this->input->post('otp');
        
        
		$user = $this->User_Model->verify($mobile, $otp);
		if($user) {
			$this->session->set_userdata($user);
			 
	
			
		redirect($this->session->userdata('redirect_back'));
		
		} else {
		$this->session->set_flashdata('error','Invalid Otp');
		redirect('verify');		
		
		}
	}
  
  public function send_sms($phone, $body) {

		
	$curl=curl_init();
    $campaign_name="OTP"; //My First Campaign
    $authKey="6ea5ecd5edb60410a9db2e5c5aa7a842";  //Valid Authentication Key
    $mobileNumber="$phone"; //Receivers 
    $sender="TAUDUS"; //Sender Approved from Dlt 
    $message="$body";  //Content Approved from Dlt
    $route="TR";  //TR for tranactional,PR for promotional 
    $template_id="1207165969989408428"; //Template Id Approved from Dlt 
    $scheduleTime="60"; //if required fill parameter in given formate 07-05-2022 12:00:00 dd-mm-yyyy hh:mm:ss 
    $coding="1"; //If english $coding = "1" otherwise if required other language $coding = "2" 
    $postData = array(
    "campaign_name" => $campaign_name, 
    "auth_key" => $authKey, 
    "receivers"  => $mobileNumber, 
    "sender"  => $sender, 
    "route"  => $route, 
    "message" => ['msgdata' => $message,'Template_ID' => $template_id,'coding' => $coding,], 
    "scheduleTime" => $scheduleTime, 
    );
    curl_setopt_array($curl, array(
    CURLOPT_URL  => 'http://sms.bulksmsserviceproviders.com/api/send/sms',
    CURLOPT_RETURNTRANSFER  => true,
    CURLOPT_ENCODING  => '',
    CURLOPT_MAXREDIRS  => 10,
    CURLOPT_TIMEOUT  => 0,
    CURLOPT_FOLLOWLOCATION  => true,
    CURLOPT_HTTP_VERSION  => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST  => 'POST',
    CURLOPT_POSTFIELDS  => json_encode($postData),
    CURLOPT_HTTPHEADER  => array(
      'Content-Type: application/json'
    ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
     //echo $response;      
    
	}
	// Pushpa
	
	
	public function dashboard_overview(){
	   auth_checker();
	   $user_id = $this->session->userdata('user_id');
	   $data['user']= $this->User_Model->selectrow('user_registeration', array('id'=>$user_id));
	   $this->render('dashboard_overview',$data);
	   
	    
	}
	
	public function view_product(){
       $user_id = $this->session->userdata('user_id');
       $data['viewproduct']= $this->web->selectres('seller_product', array('user_id'=>$user_id));
       $data['user']= $this->User_Model->selectrow('user_registeration', array('id'=>$user_id));
      
      
       $this->render('view_product', $data);
   }
   
	
	   public function delete_product($id)
   {
       $user_id = $this->session->userdata('user_id');
       $product_id=$id;
       $res= $this->db->delete('seller_product', array('id'=>$product_id, 'user_id'=>$user_id));
       if(!empty($res)){
           
           $this->session->set_flashdata('success','Product Deleted Successfully !');
       }
       else{
           $this->session->set_flashdata('error', 'Some thing went wrong');
       }
       redirect('view_product');
       
   }
   
	public function user_profile(){
	   auth_checker();
	   $user_id = $this->session->userdata('user_id');
	   $data['user']= $this->User_Model->selectrow('user_registeration', array('id'=>$user_id));
	   
	   
	 /* $data['user'] = $this->db->select('seller_registeration.*,user_registeration.id as seller_id, user_registeration.name as name, user_registeration.email as email, user_registeration.image as image,user_registeration.mobile_no as mobile_no')->where(array('user_registeration.kyc_status'=>1,'user_registeration.id'=>$user_id ))->join('seller_registeration','seller_registeration.user_id=user_registeration.id')->get('user_registeration')->row();*/
	    
	   //print_r($data['user']);
	    $this->render('dashboard_my_profile',$data);
	    
	   
	}
	
	public function logout(){
	   auth_checker();
	   
	   $this->session->sess_destroy();
	   
	   redirect();
	    
	}
	
	public function kyc_vendor(){
	   auth_checker();
	   $user_id = $this->session->userdata('user_id');
	    $data['user']= $this->User_Model->selectrow('user_registeration', array('id'=>$user_id));
	   $this->render('kyc_vendor', $data);
	    
	}
	public function add_kyc_details(){
	   
	   $user_id = $this->session->userdata('user_id');
	   $shop_name= $this->input->post('shop_name');
          $shop_area = $this->input->post('shop_area');
          $shop_town = $this->input->post('shop_town');
          $shop_distric = $this->input->post('shop_distric');
          $shop_state = $this->input->post('shop_state');
     
          $area_pincode = $this->input->post('area_pincode');
          $address="$shop_area .','.$shop_distric.','.$shop_state,','.$area_pincode";
        //   $address="$shop_name";
         $geo_location=$this->geoLocate($address);
         
	$profile_image="";
      $profile_image=$this->input->post('profile_image');
	  	 $img=base64_decode($profile_image);
	  	
	  $config = array('upload_path' => './uploads/',
    'allowed_types' => 'gif|jpg|jpeg|png',
    'overwrite' =>TRUE
    );
    
    $this->load->library('upload', $config);
    if($this->upload->do_upload('profile_image')) {
        $image=$this->upload->data();
        $profile_image="uploads/".$image['file_name'];  
        //echo "file upload"; die;
    }
    else 
    {
        $data['imageError']= $this->upload->display_errors(); 
        //echo "not upload"; die;
    }
    
    $pan_image="";
      $pan_image=$this->input->post('pan_image');
	  	 $img=base64_decode($pan_image);
	  	
	  $config = array('upload_path' => './uploads/',
    'allowed_types' => 'gif|jpg|jpeg|png',
    'overwrite' =>TRUE
    );
    
    $this->load->library('upload', $config);
    if($this->upload->do_upload('pan_image')) {
        $image1=$this->upload->data();
        $pan_image="uploads/".$image1['file_name'];  
        //echo "file upload"; die;
    }
    else 
    {
        $data['imageError']= $this->upload->display_errors(); 
        //echo "not upload"; die;
    }
    
    $adhar_image="";
      $adhar_image=$this->input->post('adhar_image');
	  	 $img=base64_decode($adhar_image);
	  $config = array('upload_path' => './uploads/',
    'allowed_types' => 'gif|jpg|jpeg|png',
    'overwrite' =>TRUE
    );
    
    $this->load->library('upload', $config);
    if($this->upload->do_upload('adhar_image')) {
        $image=$this->upload->data();
        $adhar_image="uploads/".$image['file_name'];  
        //echo "file upload"; die;
    }
    else 
    {
        $data['imageError']= $this->upload->display_errors(); 
        //echo "not upload"; die;
    }
	   
	   
    
    $gst_image="";
      $gst_image=$this->input->post('gst_image');
	  	 $img=base64_decode($gst_image);
	  $config = array('upload_path' => './uploads/',
    'allowed_types' => 'gif|jpg|jpeg|png',
    'overwrite' =>TRUE
    );
    
    $this->load->library('upload', $config);
    if($this->upload->do_upload('gst_image')) {
        $image=$this->upload->data();
        $gst_image="uploads/".$image['file_name'];  
        //echo "file upload"; die;
    }
    else 
    {
        $data['imageError']= $this->upload->display_errors(); 
        //echo "not upload"; die;
    }
	   
	   $landmark_image="";
      $landmark_image=$this->input->post('landmark_image');
	  	 $img=base64_decode($landmark_image);
	  $config = array('upload_path' => './uploads/',
    'allowed_types' => 'gif|jpg|jpeg|png',
    'overwrite' =>TRUE
    );
    
    $this->load->library('upload', $config);
    if($this->upload->do_upload('landmark_image')) {
        $image=$this->upload->data();
        $landmark_image="uploads/".$image['file_name'];  
        //echo "file upload"; die;
    }
    else 
    {
        $data['imageError']= $this->upload->display_errors(); 
        //echo "not upload"; die;
    }
	   
	   $data = array(
	       
	       'user_id'=>$user_id,
	       'name'=> $this->input->post('name'),
	       'pan_no'=>$this->input->post('pan_number'),
	       'adhar_no' =>$this->input->post('adhar_no'),
	       'gst_no'=>$this->input->post('gst_no'),
	       'shop_name' =>$this->input->post('shop_name'),
	       'shop_area' =>$this->input->post('shop_area'),
	       'shop_town' =>$this->input->post('shop_town'),
	       'shop_distric' => $this->input->post('shop_dis'),
	       'shop_state' => $this->input->post('shop_state'),
	       'area_pincode' =>$this->input->post('pincode'),
	       'landmark' =>$this->input->post('landmark'),
	       'description' =>$this->input->post('description'),
	       'profile_image' =>$profile_image,
	       'pan_image' =>$pan_image,
	       'adhar_image' =>$adhar_image,
	       'gst_image'=>$gst_image,
	       'landmark_image' =>$landmark_image,
	       'kyc_type'=>$this->input->post('kyc_type')?$this->input->post('kyc_type'):'0',
	       'lat'=>$geo_location['lat'],
           'long'=>$geo_location['long'],
	     
	       );
	       $member= $this->db->insert('seller_registeration', $data);
	       $last_id = $this->db->insert_id();
	       $update= $this->db->where(array('id'=>$user_id))->update('user_registeration', array('kyc_status'=>1, 'kyc_type'=>$this->input->post('kyc_type')?$this->input->post('kyc_type'):'0','delivery_type'=>$this->input->post('d_type')?$this->input->post('d_type'):'0','lat'=>$geo_location['lat'],
          'long'=>$geo_location['long']));
	   
	   if($member)
	   {
	       $this->session->set_flashdata('success', 'KYC Done Successfully!');
	       
	   }
	   else{
	       $this->session->set_flashdata('error', 'Some thing went wrong!');
	   }
	  redirect('add_product');
	}
	
	
	public function add_address(){
	    auth_checker();
	     $user_id = $this->session->userdata('user_id');
	     $data['address']= $this->Web_Model->selectres('address', array('user_id'=>$user_id));
	     $data['user']= $this->User_Model->selectrow('user_registeration', array('id'=>$user_id));
	     
	    $this->render('add_address',$data);
	}
	
	public function add_address_user(){
	    auth_checker();
	       $user_id=$this->session->userdata('user_id');
	    
	     
  	    $data = array(
  	        
  	        'user_id' => $user_id,

  	        'name' => $this->input->post('name')? $this->input->post('name'):'0',
  	        'area_street' => $this->input->post('area_street')? $this->input->post('area_street'):'0',
  	        'town_village' =>$this->input->post('town_village')? $this->input->post('town_village'):'0',
  	        'city' => $this->input->post('city')? $this->input->post('city'):'0',
  	        'state' =>$this->input->post('state')? $this->input->post('state'):'0',
  	        'mobile_no' =>$this->input->post('mobile_no')? $this->input->post('mobile_no'):'0',
  	        'email' =>$this->input->post('email')? $this->input->post('email'):'0',
  	        'pin_code' =>$this->input->post('pin_code')? $this->input->post('pin_code'):'0',
  	        'landmark' =>$this->input->post('landmark')? $this->input->post('landmark'):'0',
  	        'address_type'=>$this->input->post('address_type')? $this->input->post('address_type'):'0',
  	        
  	        );
  	       
  	     $member = $this->db->insert('address',$data);
  	     
  	  if($member){
  	      $this->session->set_flashdata('success','Address add successfully');
  	  }else{
  	        $this->session->set_flashdata('error','Something went wrong');
  	  }
		redirect($this->agent->referrer());	
		
  	     
  	         
	    
	}
	
	public function delete_address($id)
  	{
  	    $b=array();
  	    $user_id=$this->session->userdata('user_id');
  	    $address_id=$id;
  	   // $res = $this->am->selectrow('address',array("address_id"=>$address_id,"user_id"=>$user_id));
  	    $res1 = $this->db->delete('address',array("address_id"=>$address_id,"user_id"=>$user_id));
  	    if(!empty($res1))
  	    {
  	       $this->session->set_flashdata('success','Address delete successfully');
 
  	    }
  	     else 
      {
            $this->session->set_flashdata('error','Something went wrong');
      } 
  	    
  	    	redirect('checkout');
  	    
  	}
	
	
	public function add_product(){
	    
	   auth_checker();
	   $user_id=$this->session->userdata('user_id');
	   $kyc= $this->db->where(array('id'=>$user_id))->get('user_registeration')->row_array('kyc_type');
	   
	   $data['brand2']= $this->db->where(array('type'=>$kyc['kyc_type']))->get('brand')->result();
	   $data['category']= $this->db->where(array('type'=>$kyc['kyc_type']))->get('category')->result();
	   $data['countries']= $this->Web_Model->selectres('countries');
	   $data['user']= $this->User_Model->selectrow('user_registeration', array('id'=>$user_id));
	    $this->render('add_product', $data);
	   
	}
	
	   
	   public function add_seller_product()
	   {
	       
	  auth_checker();
	   $user_id=$this->session->userdata('user_id');
	    
	   $upload_video="";
          $config = array('upload_path' =>'./uploads/',
                'allowed_types' => "gif|jpg|png|jpeg|mp4",
                  'overwrite' => TRUE,
                  'encrypt_name' => TRUE
                );
      $this->load->library('upload',$config);
      $this->upload->initialize($config);
      if($this->upload->do_upload('video'))
      {
        $banner=$this->upload->data();
          $upload_video="uploads/".$banner['file_name'];              
         
      }
      else
      {
        $data['imageError']= $this->upload->display_errors(); 
        
    
      }
      $upload="";
      $upload=$this->input->post('image')?$this->input->post('image'):'';
	  	 $img=base64_decode($upload);
	  	
      //$upload = base64_decode($_POST['image']);
	  $config = array('upload_path' => './uploads/',
    'allowed_types' => 'gif|jpg|jpeg|png',
    'overwrite' =>TRUE,
    'encrypt_name' => TRUE
    );
    
    $this->load->library('upload', $config);
    if($this->upload->do_upload('image')) {
        $image=$this->upload->data();
        $upload="uploads/".$image['file_name'];  
        //echo "file upload"; die;
    }
    else 
    {
        $data['imageError']= $this->upload->display_errors(); 
        //echo "not upload"; die;
    }
    
    $upload1="";
      $upload1=$this->input->post('image1')?$this->input->post('image1'):'';
	  	 $img=base64_decode($upload1);
	  	
      //$upload = base64_decode($_POST['image']);
	  $config = array('upload_path' => './uploads/',
    'allowed_types' => 'gif|jpg|jpeg|png',
    'overwrite' =>TRUE,
    'encrypt_name' => TRUE
    );
    
    $this->load->library('upload', $config);
    if($this->upload->do_upload('image1')) {
        $image1=$this->upload->data();
        $upload1="uploads/".$image1['file_name'];  
        //echo "file upload"; die;
    }
    else 
    {
        $data['imageError']= $this->upload->display_errors(); 
        //echo "not upload"; die;
    }
    
    $upload2="";
      $upload2=$this->input->post('image2')?$this->input->post('image2'):'';
	  	 $img=base64_decode($upload2);
	  	
      //$upload = base64_decode($_POST['image']);
	  $config = array('upload_path' => './uploads/',
    'allowed_types' => 'gif|jpg|jpeg|png',
    'overwrite' =>TRUE,
    'encrypt_name' => TRUE
    );
    
    $this->load->library('upload', $config);
    if($this->upload->do_upload('image2')) {
        $image=$this->upload->data();
        $upload2="uploads/".$image['file_name'];  
        //echo "file upload"; die;
    }
    else 
    {
        $data['imageError']= $this->upload->display_errors(); 
        //echo "not upload"; die;
    }
  
	   $data= array(
	       
	       'user_id' => $user_id,
	       'product_name' => $this->input->post('product_name'),
	       'price' => $this->input->post('price'),
	       'discount' => $this->input->post('discount')? $this->input->post('discount'):'0',
	       'other_offer' => $this->input->post('other_offer')? $this->input->post('other_offer'):'0',
	       'speciality' => $this->input->post('specialisation')?$this->input->post('specialisation'):'',
	       'color' => $this->input->post('color')?$this->input->post('color'):'',
	       'category' => $this->input->post('category'),
	       'brand_name' => $this->input->post('brand')?$this->input->post('brand'):'1',
	       'country' => $this->input->post('country')?$this->input->post('country'):'1',
	       'height' => $this->input->post('height')?$this->input->post('height'):'',
	       'width' => $this->input->post('width')?$this->input->post('width'):'',
	       'length' => $this->input->post('length')?$this->input->post('length'):'',
	       'weight' => $this->input->post('weight')?$this->input->post('weight'):'',
	       'size' => $this->input->post('size')?$this->input->post('size'):'',
	       'other_varient' => $this->input->post('other_varient')?$this->input->post('other_varient'):'',
	       'description' => $this->input->post('description'),
	       'image' =>$upload,
	       'image1' => $upload1,
	       'image2' => $upload2,
	       'video'=>$upload_video,
	       'type'=>2,
	       
	       );
	        
      
	        $member = $this->db->insert('seller_product',$data);
	         $last_id = $this->db->insert_id();
	         $slug = url_title(convert_accented_characters(strtolower(strip_tags(preg_replace ('/[0-9]+$/','-',$this->input->post('product_name'))))), 'dash', true);
           $slugs=$slug.'-'.$last_id;
           $this->db->where('id',$last_id)->update('seller_product', array('slug'=>$slugs));
	       
	       if($member)
	       {
	           $this->session->set_flashdata('success', 'Product Add Successfully!');
	           
	       }
	       else
	       {
	           $this->session->set_flashdata('error', 'Some thing went wrong!');
	       }
	
	   redirect('add_product');
	     
	    
	}
	
	
	
	public function edit_seller_product($id)
	{
	    auth_checker();
	   $user_id=$this->session->userdata('user_id');
	   
	   if(!empty($_POST))
      {   
	    $upload_video="";
          $config = array('upload_path' =>'./uploads/',
                'allowed_types' => "gif|jpg|png|jpeg|mp4",
                  'overwrite' => TRUE,
                  'encrypt_name' => TRUE
                );
      $this->load->library('upload',$config);
      $this->upload->initialize($config);
      if($this->upload->do_upload('video'))
      {
        $banner=$this->upload->data();
          $upload_video="uploads/".$banner['file_name'];              
         
      }
      else
      {
        $data['imageError']= $this->upload->display_errors(); 
        
    
      }
      $upload="";
      $upload=$this->input->post('image')?$this->input->post('image'):'';
	  	 $img=base64_decode($upload);
	  	
      //$upload = base64_decode($_POST['image']);
	  $config = array('upload_path' => './uploads/',
    'allowed_types' => 'gif|jpg|jpeg|png',
    'overwrite' =>TRUE,
    'encrypt_name' => TRUE
    );
    
    $this->load->library('upload', $config);
    if($this->upload->do_upload('image')) {
        $image=$this->upload->data();
        $upload="uploads/".$image['file_name'];  
        //echo "file upload"; die;
    }
    else 
    {
        $data['imageError']= $this->upload->display_errors(); 
        //echo "not upload"; die;
    }
    
    $upload1="";
      $upload1=$this->input->post('image1')?$this->input->post('image1'):'';
	  	 $img=base64_decode($upload1);
	  	
      //$upload = base64_decode($_POST['image']);
	  $config = array('upload_path' => './uploads/',
    'allowed_types' => 'gif|jpg|jpeg|png',
    'overwrite' =>TRUE,
    'encrypt_name' => TRUE
    );
    
    $this->load->library('upload', $config);
    if($this->upload->do_upload('image1')) {
        $image1=$this->upload->data();
        $upload1="uploads/".$image1['file_name'];  
        //echo "file upload"; die;
    }
    else 
    {
        $data['imageError']= $this->upload->display_errors(); 
        //echo "not upload"; die;
    }
    
    $upload2="";
      $upload2=$this->input->post('image2')?$this->input->post('image2'):'';
	  	 $img=base64_decode($upload2);
	  	
      //$upload = base64_decode($_POST['image']);
	  $config = array('upload_path' => './uploads/',
    'allowed_types' => 'gif|jpg|jpeg|png',
    'overwrite' =>TRUE,
    'encrypt_name' => TRUE
    );
    
    $this->load->library('upload', $config);
    if($this->upload->do_upload('image2')) {
        $image=$this->upload->data();
        $upload2="uploads/".$image['file_name'];  
        //echo "file upload"; die;
    }
    else 
    {
        $data['imageError']= $this->upload->display_errors(); 
        //echo "not upload"; die;
    }
  
	   $data= array(
	       
	       'user_id' => $user_id,
	       'product_name' => $this->input->post('product_name'),
	       'price' => $this->input->post('price'),
	       'discount' => $this->input->post('discount')? $this->input->post('discount'):'0',
	       'other_offer' => $this->input->post('other_offer')? $this->input->post('other_offer'):'0',
	       'speciality' => $this->input->post('specialisation')?$this->input->post('specialisation'):'',
	       'color' => $this->input->post('color')?$this->input->post('color'):'',
	       'category' => $this->input->post('category'),
	       'brand_name' => $this->input->post('brand')?$this->input->post('brand'):'1',
	       'country' => $this->input->post('country')?$this->input->post('country'):'1',
	       'height' => $this->input->post('height')?$this->input->post('height'):'',
	       'width' => $this->input->post('width')?$this->input->post('width'):'',
	       'length' => $this->input->post('length')?$this->input->post('length'):'',
	       'weight' => $this->input->post('weight')?$this->input->post('weight'):'',
	       'size' => $this->input->post('size')?$this->input->post('size'):'',
	       'other_varient' => $this->input->post('other_varient')?$this->input->post('other_varient'):'',
	       'description' => $this->input->post('description'),
	       'type'=>2,
	       
	       );
	       
	        if(!empty($upload) OR!empty($upload1) OR!empty($upload2) OR!empty($upload3) OR!empty($upload_video))
            {
                $data['image']=$upload;            
                $data['image1']=$upload1;            
                $data['image2']=$upload2;            
                $data['video']=$upload_video;            
                
            }
            
	       
	        $this->db->where('id',$id);
            $this->db->update('seller_product',$data);
	        $this->session->set_flashdata('success', 'Product Update Successfully..');
	        
	        redirect('view_product');
	   
      }else{  
	   $data['category'] = $this->am->selectres('category');
	   $data['brand'] = $this->am->selectres('brand');
	   $data['countries'] = $this->am->selectres('countries');
	   $data['data'] = $this->db->select('seller_product.*, category.name as category, brand.brand_name as brand_name,countries.country_name ')->where(array('seller_product.id'=>$id))
	 ->join('category','category.id= seller_product.category')
	 ->join('brand', 'brand.id=seller_product.brand_name')
	 ->join('countries', 'countries.id=seller_product.country')->get('seller_product')->row();
	 
	
	  $data['user']= $this->User_Model->selectrow('user_registeration', array('id'=>$user_id));
	 
	 
	    $this->render('edit_product', $data);  
	    
      }
	}
	
	
	

	
	
	 public function wishlist_list ()
   {
       $user_id = $this->session->userdata('user_id');
       $data['wishlist'] = $this->db->select('seller_product.*,tbl_wishlish.id as wishlist_id')->where(array('tbl_wishlish.user_id'=>$user_id))->join('seller_product','seller_product.id=tbl_wishlish.product_id','left')->get('tbl_wishlish')->result();
       //print_r($data['wishlist']); die;
       $data['user']= $this->User_Model->selectrow('user_registeration', array('id'=>$user_id));
       $this->render('wishlist',$data);
   }
   
   
	
	 public function delete_wishlist_web($id)
   {
       $b=array();
  	   $user_id=$this->session->userdata('user_id');
       $wishlist_id= $id;
       $res = $this->db->delete('tbl_wishlish', array('id'=>$wishlist_id, 'user_id'=>$user_id));
       if(!empty($res))
       {
       $this->session->set_flashdata('success', 'Wishlist Deleted Successfully!');
       
        
       }else{
           $this->session->set_flashdata('error', 'Some thing went wrong');
       }
       redirect('wishlist');
   }
   
	
	function geoLocate($address='')
{
    try {
        $lat = 0;
        $lng = 0;
       $GOOGLE_API_KEY_HERE ="AIzaSyBLCl-JK5usUBFwjG7Y0s9Ef3fSoPV0QTk";
          $data_location = "https://maps.google.com/maps/api/geocode/json?key=".$GOOGLE_API_KEY_HERE."&address=".str_replace(" ", "+", $address)."&sensor=false";
        $data = file_get_contents($data_location);
        usleep(200000);
        // turn this on to see if we are being blocked
        // echo $data;
        $data = json_decode($data);
        // print_r($data);
      
        if ($data->status=="OK") {
            $lat = $data->results[0]->geometry->location->lat;
            $lng = $data->results[0]->geometry->location->lng;

            if($lat && $lng) {
            return  $array=    array(
                    'status' => true,
                    'lat' => $lat, 
                    'long' => $lng, 
                    'google_place_id' => $data->results[0]->place_id
                );
            }
        }
        if($data->status == 'OVER_QUERY_LIMIT') {
              $array=array(
                'status' => "fail", 
                'msg' => 'Google Amp API OVER_QUERY_LIMIT, Please update your google map api key or try tomorrow'
            );
            
            echo json_encode($array);
            exit();
        }
        if($data->status == 'ZERO_RESULTS') {
              $array=array(
                'status' => "fail", 
                'msg' => 'Please fill Correct location'
            );
            
            echo json_encode($array);
            exit();
        }

    } catch (Exception $e) {

    }
    
    // print_r($array);
    
}

public function checkout(){
         auth_checker();
	     $user_id = $this->session->userdata('user_id');
	     $data['address']= $this->Web_Model->selectres('address', array('user_id'=>$user_id));
	     $data['user']= $this->User_Model->selectrow('user_registeration', array('id'=>$user_id));
	     
	 $data['cart'] = $this->db->select('seller_product.*,cart.id as cart_id, cart.quantity as cart_quantity')->where(array('cart.user_id'=>$user_id))->join('seller_product','seller_product.id=cart.product_id','left')->get('cart')->result();
	   
	   $total_price=0;
	   $delivery_charge=0;
	
	foreach($data['cart'] as $row)
{
	    
     $offer=$row->discount;
     $product_price=($row->price*$offer)/100;
     $offer1=$row->delivery_charge;
     $offer2=$row->price;
     $comision_price=$offer2-$product_price; 
       
   $val=round($comision_price);
   
 if ($val >'0' && $val <= '500')
{
    $value= $val*0/100;
    //echo $value;
}

elseif ($val >='501' && $val <= '799') 
{
    $value= $val*5/100;
    //echo $value;
 }
 
 elseif ($val >='800' && $val <= '999') 
 {
    $value= $val*6/100;
    //echo $value;
 }
 elseif ($val >='1000' && $val <= '1499') 
 {
    $value= $val*8/100;
    //echo $value;
 }
 elseif ($val >='1500' && $val <= '1999') 
 {
    $value= $val*10/100;
    //echo $value;
 }
 elseif ($val >='2000' && $val <= '2499') 
 {
    $value= $val*15/100;
    //echo $value;
 }
 elseif ($val >='2500' && $val <= '2999') 
 {
    $value= $val*20/100;
    //echo $value;
 }
 elseif ($val >='3000' && $val <= '3400') 
 {
    $value= $val*25/100;
    //echo $value;
 }
 else 
 {
     $value= $val*30/100;
     //echo $value;
     
 }

 
	   //$offer=$row->discount;
    //   $product_price=$row->price*$offer/100;
    //   $offer=$row->price;
       $total_price += $row->cart_quantity*($offer-$product_price+$value);
       $row->price= round(($offer-$product_price+$value),2);

	    }
	   //print_r($total_price); die;
	   
	   $data['total_price']=$total_price;
	     
	    $this->render('checkout',$data);
    }


public function my_order(){
    
    auth_checker();
	$user_id = $this->session->userdata('user_id');
	          
    // $res = $this->am->selectres('user_payment_details',array('user_id'=>$user_id,'order_confirm !='=>'0'));
         
         
       $res = $this->db->select('user_payment_details.*,check_out.*,user_payment_details.status status, seller_product.slug')->where(array('user_payment_details.user_id'=>$user_id,'user_payment_details.order_confirm'=>1))
       ->join('user_payment_details','user_payment_details.order_id=check_out.order_id')
       ->join('seller_product','seller_product.id=check_out.product_id')
       ->order_by("check_out.order_id", "desc")->get('check_out')->result();   
         
   $b=array();
    if(!empty($res))
    {
    foreach ($res as $row)               
    {            
        $order_id=$row->order_id;
        $result['id']=$row->id;
        $result['user_id']=$row->user_id;
        $result['order_id']=$row->order_id;
        $result['full_name']=$row->full_name;
        $result['mobile_no']=$row->mobile_no;
        $result['quentity']=$row->quentity;
        $result['order_delivered_date']=$row->order_delivered_date;
        $result['transaction_id']=$row->transaction_id;
        $result['order_date']=$row->created_at;
        $result['delivery_charge']='50';
        $result['slug']=$row->slug;
         if($row->status==1)
            {
                $result['status']="Pending";
            }
            
            elseif ($row->status==2)
            {
                $result['status']="Shipped";
            }
             elseif ($row->status==3)
            {
                $result['status']="Out of Delivery";
            }
            elseif ($row->status==4)
            {
                $result['status']="Delivered";
            }
            else
            {
                $result['status']="Cancelled";
            }
        $result['inovice_pdf']='';
        $result['order_status']=$row->status;
        $total_amount=0;
        
      $product_row = $this->am->selectrow('check_out',array('user_id'=>$row->user_id,'order_id'=>$order_id));
      $result['product_name']=ucfirst($product_row->product_name);
      $product_detail = $this->am->selectrow('seller_product',array('id'=>$product_row->product_id,));
      if($product_detail){
      $result['product_image']=$product_detail->image?base_url().$product_detail->image:'';
      }else{
           $result['product_image']='';
      }
      
     $offer=$row->discount;
     $product_price=($row->price*$offer)/100;
     $offer1='50';
     $offer2=$row->price;
     $comision_price=$offer2-$product_price; 
     $val=round($comision_price);
 if ($val >'0' && $val <= '500')
{
    $value= $val*0/100;
    //echo $value;
}

elseif ($val >='501' && $val <= '799') {
    $value= $val*5/100;
    //echo $value;
 }
 
 elseif ($val >='800' && $val <= '999') {
    $value= $val*6/100;
    //echo $value;
 }
 elseif ($val >='1000' && $val <= '1499') {
    $value= $val*8/100;
    //echo $value;
 }
 elseif ($val >='1500' && $val <= '1999') {
    $value= $val*10/100;
    //echo $value;
 }
 elseif ($val >='2000' && $val <= '2499') {
    $value= $val*15/100;
    //echo $value;
 }
 elseif ($val >='2500' && $val <= '2999') {
    $value= $val*20/100;
    //echo $value;
 }
 elseif ($val >='3000' && $val <= '3400') {
    $value= $val*25/100;
    //echo $value;
 }
 else {
     $value= $val*30/100;
     //echo $value;
     
 }
      $offer=$row->discount;
      $product_price=($row->price*$offer)/100;
      
       $offer=$row->price;
    //   $offer1=$result['delivery_charge'];
    
       
       $total_price=$offer-$product_price+$value;
  
      //$result['discount']=$row->discount;
      $result['product_price']="$total_price";
      
      
      
      
      $product_res = $this->am->selectres('check_out',array('user_id'=>$row->user_id,'order_id'=>$order_id));
      $count=0;
      foreach($product_res as $pro_res){
          $total_amount +=$pro_res->product_price;
          $count++;
      }
    //   $result['product_id']=$row->product_id;
    
    
    $result['total_amount_product']=round($total_price);
    $result['product_count']="$count";
      
        array_push($b,$result);
    }
    
      }
      
       $data['my_order']=($b);
       $data['user']= $this->User_Model->selectrow('user_registeration', array('id'=>$user_id));
     
    $this->render('dashboard_my_orders', $data);
    
}

	//End Pushpa
	
    public function checkout_new()
   {
       if($this->input->post('checkout_type')=='online_payment'){
           
        $data['amount']=$this->input->post('amount');
        //print_r($this->input->post('amount'));
        //die;
        
        
        
        $payment_type=$this->input->post('payment_type')??1;
        $user_id=$this->input->post('user_id');
       $address_id=$this->input->post('address_id');
       $shipping_charge_amount=$this->input->post('shipping_charge_amount')?$this->input->post('shipping_charge_amount'):'50';

        $data['title']              = 'Checkout payment | Gig Duniya';  
        $data['callback_url']       = base_url().'razorpay/callback';
        $data['surl']               = base_url().'razorpay/success';;
        $data['furl']               = base_url().'razorpay/failed';;
        $data['currency_code']      = 'INR';
    
        $this->load->view('razorpay/checkout',$data);
           
       }else{
       $amount=$this->input->post('amount');
       $checkout_type=$this->input->post('checkout_type')??'cart';
       $payment_type=$this->input->post('payment_type')??2;
       $user_id=$this->input->post('user_id');
       $token=$this->input->post('token');
       $address_id=$this->input->post('address_id');
       $coupan_code=$this->input->post('coupan_code')?$this->input->post('coupan_code'):'';
       $coupn_amount=$this->input->post('coupn_amount')?$this->input->post('coupn_amount'):'';
       $shipping_charge_amount=$this->input->post('shipping_charge_amount')?$this->input->post('shipping_charge_amount'):'50';
      
       $coupon_data=$this->db->where(array('code'=>$coupan_code))->get('coupon')->row_array();
     
    
      if(($checkout_type=='cart')){
       $cart_details=$this->db->where(array('user_id'=>$user_id))->get('cart')->result();
       if($payment_type==2){
           $order_confirm=1;
       }else{
           $order_confirm=0;
       }

       $unique_id=Uniqid ();
       
       
       if(!empty($cart_details)){
           foreach($cart_details as $res){ 
       $address_details=$this->db->where(array('user_id'=>$user_id,'address_id'=>$address_id))->get('address')->row_array();
        $q = $this->db->query('SELECT MAX(order_id) as order_id FROM user_payment_details');
        $rr = $q->row_array();
        if ($rr['order_id'] == 0) 
        {
            $rr['order_id'] = 5000;
        }
       
        $order_id = $rr['order_id'] + 1;
        $data = array(		
			 		'user_id' => $this->input->post('user_id'),
			 		'transaction_id' => $this->input->post('transaction_id')??rand('10000','99999999999'),
				 	'checkout_type' =>$checkout_type,
				 	'order_id'=>$order_id,
				 	'date'=>date('d-m-Y'),
				 	'status'=>'1',
				 	'payment_status'=>$payment_type,
				 	'order_confirm'=>$order_confirm,
				 	'coupan_code' =>$this->input->post('coupan_code')?$this->input->post('coupan_code'):'',
				 	'coupn_amount' =>$this->input->post('coupn_amount')?$this->input->post('coupn_amount'):'',
				 	'shipping_charge_amount' =>$this->input->post('shipping_charge_amount')?$this->input->post('shipping_charge_amount'):50,
				 	'payment_type' =>$this->input->post('payment_type')??2,
				 	'full_name'=>$address_details['name'],
				 	'mobile_no'=>$address_details['mobile_no'],
				 	'email'=>$address_details['email'],
				 	'house_no'=>$address_details['area_street'],
				 	'colony'=>$address_details['town_village'],
				 	'landmark'=>$address_details['landmark'],
				 	'city'=>$address_details['city'],
				 	'state'=>$address_details['state'],
				 	'address_type'=>$address_details['address_type'],
				 	'full_address'=>$address_details['address'],
				 	
                   );
         $this->db->insert('user_payment_details',$data);
         $last_id=$this->db->insert_id();
        $arr=array();
        
        $total_product_price=0;
      
         $product_details=$this->db->where(array('id'=>$res->product_id))->get('seller_product')->row_array();
          $sale_offe=$product_details['discount'];
          
               
//$val=$product_details['price'] ;

     $offer=$product_details['discount'];
     $product_price=($product_details['price']*$offer)/100;
     $offer1=$product_details['delivery_charge'];
     $offer2=$product_details['price'];
     $comision_price=$offer2-$product_price; 
     $val=round($comision_price);
     
 if ($val >'0' && $val <= '500')
{
    $value= $val*0/100;
    //echo $value;
}

elseif ($val >='501' && $val <= '799') {
    $value= $val*5/100;
    //echo $value;
 }
 
 elseif ($val >='800' && $val <= '999') {
    $value= $val*6/100;
    //echo $value;
 }
 elseif ($val >='1000' && $val <= '1499') {
    $value= $val*8/100;
    //echo $value;
 }
 elseif ($val >='1500' && $val <= '1999') {
    $value= $val*10/100;
    //echo $value;
 }
 elseif ($val >='2000' && $val <= '2499') {
    $value= $val*15/100;
    //echo $value;
 }
 elseif ($val >='2500' && $val <= '2999') {
    $value= $val*20/100;
    //echo $value;
 }
 elseif ($val >='3000' && $val <= '3400') {
    $value= $val*25/100;
    //echo $value;
 }
 else {
     $value= $val*30/100;
     //echo $value;
     
 }
    //   $offer=$product_details['discount'];
    //   $product_price=($product_details['price']*$offer)/100;
      
    //   $offer=$product_details['price'];
    //   $offer1=$product_details['delivery_charge'];
    //   $comision_price=$offer2-$product_price;
     $total_price=$offer2-$product_price+$value+$offer1;
  
      //$result['discount']=$row->discount;
       
        //   $product_price=$product_details['price']*$sale_offe/100;
          
        //   $sale_offe=$product_details['price'];
           
        //   $total_price=$sale_offe-$product_price;
          
          $product_price=$total_price;
          
          
          $total_product_price +=$total_price;
         $array=array(
               
              'user_id' => $this->input->post('user_id'),
              'vendor_id' => $product_details['user_id'],
              'product_id'=>$product_details['id'],
              'product_name'=>$product_details['product_name'],
              'price'=>$product_details['price'],
              'discount'=>$product_details['discount'],
              'product_price'=>$product_price,
              'quentity'=>$res->quantity,
              'other'=>$res->color?$res->color:'',
              'order_id'=>$order_id,
              
             );
             
             $this->db->insert('check_out',$array);
            //  array_push($arr,$array);
         


      }

       
        if(!empty($coupon_data)){
              $coupon_per_amount=$coupon_data['amount'];
           $total_coupan_discount=round(($total_product_price*$coupon_data['amount'])/100);
          }else{
              $total_coupan_discount=0;
              $coupon_per_amount=0;
          }
          
            $array=array('coupan_code'=>$coupan_code,
               'coupn_amount'=>$total_coupan_discount,
               'coupon_per_amount'=>$coupon_per_amount,
               'shipping_charge_amount'=>$shipping_charge_amount
               );
        $this->db->where(array('id'=>$last_id))->update('user_payment_details',$array);
       if($payment_type==2){
            $this->db->where(array('user_id'=>$user_id))->delete('cart');
       }
       $row1 = $this->am->selectrow('user_registeration',array('id'=>$user_id));
       $row2 = $this->am->selectrow('user_payment_details',array('order_id'=>$order_id));
        
      $device_id=$row1->device_id;
      $title='Order completed successfully';
      $body='Thank you for shopping with us, We are prepping your order as soon as possible.';
      $type=1;
    //   $this->check_notification($device_id,$title,$body,$type,$user_id);
    //   $this->db->where(array('token'=>$token))->delete('cart');
    
     $this->send_mail_admin($row2->email,$order_id);
     //$message = $order_id." Thank you for shopping with us, We are prepping your order as soon as possible";
     $this->send_mail_user($row2->email,$order_id);
    
         json_encode(array('status'=>'success','message'=>'Order created successfully','data'=>$data));
        $this->session->set_flashdata('success','Order Placed Successfully');
          redirect('checkout');
       
       }else{
               json_encode(array('status'=>'fail','message'=>'Some thing went wrong'));
             
          $this->session->set_flashdata('error','Something went wrong');
          redirect('checkout');
             
       }
       
       }
          
      else{
           
           $product_id= $this->input->post('product_id');
           $size= $this->input->post('size');
           $cart_details=$this->db->where(array('token'=>$token))->get('cart')->result();
       $address_details=$this->db->where(array('user_id'=>$user_id,'id'=>$address_id))->get('address')->row_array();
        $q = $this->db->query('SELECT MAX(order_id) as order_id FROM user_payment_details');
        $rr = $q->row_array();
        if ($rr['order_id'] == 0) {
            $rr['order_id'] = 5000;
        }
        $order_id = $rr['order_id'] + 1;
        
        $arr=array();
  
         $product_details=$this->db->where(array('id'=>$product_id))->get('product')->row_array();
          $sale_offe=$product_details['discount'];
          $product_price=$product_details['price']*$sale_offe/100;
          
           $sale_offe=$product_details['price'];
           
           $total_price=$sale_offe-$product_price;
          
          $product_price=$total_price;
          if(!empty($coupon_data)){
              $coupon_per_amount=$coupon_data['amount'];
           $total_coupan_discount=round(($product_price*$coupon_data['amount'])/100);
          }else{
              $total_coupan_discount=0;
              $coupon_per_amount=0;
          }
       
        $data = array(		
			 		'user_id' => $this->input->post('user_id'),
			 		'transaction_id' => $this->input->post('transaction_id')? $this->input->post('transaction_id'):'',
				 	'checkout_type' =>$this->input->post('checkout_type'),
				 	'order_id'=>$order_id,
				 	'date'=>date('d-m-Y'),
				 	'status'=>'1',
				 	'payment_status'=>'0',
				 	'payment_type' =>$this->input->post('payment_type'),
				 	'full_name'=>$address_details['full_name'],
				 	'mobile_no'=>$address_details['mobile_no'],
				 	'email'=>$address_details['email'],
				 	'house_no'=>$address_details['house_no'],
				 	'colony'=>$address_details['colony'],
				 	'landmark'=>$address_details['landmark'],
				 	'city'=>$address_details['city'],
				 	'state'=>$address_details['state'],
				 	'address_type'=>$address_details['address_type'],
				 	
				 	'coupan_code'=>$coupan_code,
                   'coupn_amount'=>$total_coupan_discount,
                   'coupon_per_amount'=>$coupon_per_amount,
                   'shipping_charge_amount'=>$shipping_charge_amount
                   );
         $this->db->insert('user_payment_details',$data);
         
       
         $array=array(
              'size'=>$size?$size:'',
              	'user_id' => $this->input->post('user_id'),
              'product_id'=>$product_details['id'],
              'product_name'=>$product_details['product_name'],
              'price'=>$product_details['price'],
              'discount'=>$product_details['discount'],
              'product_price'=>$product_price,
              'transaction_id'=>$this->input->post('transaction_id')?$this->input->post('transaction_id'):'',
              'order_id'=>$order_id,
               'quentity'=>1,
               
             );
             
             $this->db->insert('check_out',$array);
            //  array_push($arr,$array);

       
       echo json_encode(array('status'=>'success','message'=>'Order created successfully','data'=>$data));
       
       }
       
       
       }
       
     }	
	


public function send_mail_admin($from_email,$order_id)
    {
        // print_r($from_email);
        // die;
        $tex ='<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Taudo Brothers</title>
	<style>
	 

		.logo{
			text-align: center;
			margin-top: 20px;
		}
		.head{
			text-align: center;
			font-family: arial;
			font-size: 16px;
			margin-top: 20px;
		}

		.text{
			text-align: center;
			font-family: arial;
			font-size: 16px;
			margin-top: 20px;
		}

		.thankyou{
			background-color: #cc0000;
			color: white;
			padding: 10px;
		}
	</style>
</head>
<body>

<section>
	<div class="container">
		<div class="logo">
			<img src="'.base_url().'uploads/taudulogo.png">
		</div>
		<div class="head">
			Hi Team,
		</div>
		<div class="text">
			<span>You have received a order from</span><span><a href="mail:to'.$from_email.'"> '.$from_email.'</a> </span><span> Order id is</span><span> <a href=""> #'.$order_id.'</a></span>
			<p>Kindly work on the next process and deliver to the customer as soon as possible.</p><br>
			<p class="thankyou">Thank you <br> <span>Taudu Brothers Team</span> </p>
		</div>
	
	</div>
</section>


</body>
</html>';
        $this->load->library('email');
        $this->email
        ->from($from_email)
        ->to('info@taudubrothers.com')
        ->subject('Order Booking')
        ->message($tex)
        ->set_mailtype('html');
        if($this->email->send()){
            
        }
    }
	
	
	
	public function send_mail_user($from_email,$order_id)
    {
        
        // print_r($order_id);
        // die;
        $row1 = $this->am->selectrow('user_payment_details',array('order_id'=>$order_id));
         $name=$row1->full_name;
        $tex ='<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Taudo Brothers</title>
	<style>
	 

		.logo{
			text-align: center;
			margin-top: 20px;
		}
		.head{
			text-align: center;
			font-family: arial;
			font-size: 16px;
			margin-top: 20px;
		}

		.text{
			text-align: center;
			font-family: arial;
			font-size: 16px;
			margin-top: 20px;
		}

		.thankyou{
			background-color: #cc0000;
			color: white;
			padding: 10px;
		}
	</style>
</head>
<body>

<section>
	<div class="container">
	 <div class="head">
	   <p> Welcome to <span> Taudu Brothers</span>.</p>
	   </div>
		<div class="logo">
			<img src="'.base_url().'uploads/taudulogo.png">
		</div>
		<div class="head">
			<span> Hi,</span><span> '.$name.',</span>
		</div>
		<div class="text">
			<p>Thank you for purchasing from <span> Taudu Brothers</span>.  Your order has<br> been confirmed. Your order id <span> #'.$order_id.'</span>. We will notify you when it has been sent.</p>
		    <p><span> <b>Order summary</b></span></p>
		<table id="customers" style="font-family: Arial, Helvetica, sans-serif; border-collapse: collapse;
				width: 100%;">
					<tr>
					
					  <th style=" border: 1px solid #ddd;  padding: 8px; padding-top: 12px;  padding-bottom: 12px;
  text-align: left;  background-color: #cc0000;  color: white;">Product Name</th>
					  <th style=" border: 1px solid #ddd;  padding: 8px; padding-top: 12px;  padding-bottom: 12px;
  text-align: left;  background-color: #cc0000;  color: white;">Product Price</th>
					  
					  <th style=" border: 1px solid #ddd;  padding: 8px; padding-top: 12px;  padding-bottom: 12px;
  text-align: left;  background-color: #cc0000;  color: white;">Product Discout</th>
  <th style=" border: 1px solid #ddd;  padding: 8px; padding-top: 12px;  padding-bottom: 12px;
  text-align: left;  background-color: #cc0000;  color: white;">Product Quantity</th>
					  <th style=" border: 1px solid #ddd;  padding: 8px; padding-top: 12px;  padding-bottom: 12px;
  text-align: left;  background-color: #cc0000;  color: white;">Total</th>
					
					</tr>';
		$row2 = $this->db->where(array('order_id'=>$order_id))->get('check_out')->result();
                         if(!empty($row2))
	  {
		foreach ($row2 as $row)		           
		{		           
		
		
       
 
					$tex.='<tr class="">
				
						<td style=" border: 1px solid #ddd;  padding: 8px; text-align: left;">'.$row->product_name.'</td>
						<td style=" border: 1px solid #ddd;  padding: 8px; text-align: left;">'.$row->product_price.'</td>
						<td style=" border: 1px solid #ddd;  padding: 8px; text-align: left;">'.$row->discount.'%</td>
						<td style=" border: 1px solid #ddd;  padding: 8px; text-align: left;">'.$row->quentity.'</td>
					
						<td style=" border: 1px solid #ddd;  padding: 8px; text-align: left;">'.$row->quentity*$row->product_price.'</td>
						<!-- <td>400</td> -->
					  </tr>
					 
					  ';
					   
		
		}
      }
        $order_details = $this->am->selectrow('user_payment_details',array('order_id'=>$order_id));
						 
						//$discount=$row->product_price/100*$row->discount; 
					    $total=$row->quentity*$row->product_price;	
					    $shipping_charge=$order_details->shipping_charge_amount;	
					    $coupan_amount=$order_details->coupn_amount;
					    $grand_total=(($total+$shipping_charge)-$coupan_amount);
					 
						 $tex.='<tr><td colspan="3"></td> 
						<td><b> Total Amount</b></td>
						<td><b>Rs. '.$total.'</b></td>
					  </tr>
					  <tr><td colspan="3"></td> 
						<td><b> Shipping Charge</b></td>
						<td><b>Rs. '.$shipping_charge.'</b></td>
					  </tr>
					  <tr><td colspan="3"></td> 
						<td><b> Discount Amount</b></td>
						<td><b>Rs. '.$coupan_amount.'</b></td>
					  </tr>
					  <tr><td colspan="3"></td> 
						<td><b> Grand Amount</b></td>
						<td><b>Rs. '.$grand_total.'</b></td>
					  </tr>
				</table>

				<!-- <p>Payment method</p> -->
				<p>If you have any questions, reply to this mail or contact us at <a href="mailto:info@taudubrothers.com">info@taudubrothers.com</a></p>
			
			</div>
			<p class="thankyou" style="color: #000; padding: 10px; font-weight: 600; font-size: 18px;
			text-align: center;
			font-family: sans-serif;">Thank you <br> <span>Taudu Brothers Team</span> </p>
		</div>
		
	</section>


</body>
</html>';
        $this->load->library('email');
        $this->email
        ->from('info@taudubrothers.com')
        ->to($from_email)
        ->subject('Thanks For Your Order')
        ->message($tex)
        ->set_mailtype('html');
        if($this->email->send()){
            
        }
    }
    
    
	public function send_mail_user2($from_email,$order_id)
        
     {
          $user_id = $this->input->post('user_id');
          $order_id = $this->input->post('order_id');
         $row1 = $this->am->selectrow('user_payment_details',array('id'=>$user_id));
         $name=$row1->full_name;
         
        
     $b=array();
	   //$product_name=$row2->product_name;


         
         $txt1 = '
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Taudo Brothers</title>

</head>

<body>

	<section>
		<div class="container" style="min-width: 1200px;margin:0 70px;">
			<div class="logo" style="	text-align: center;">
				<img src="'.base_url().'home/new-logo.png">
			</div>
			<div class="head" style=" text-align: center;font-family: arial;font-size: 18px;margin-top: 20px;
			font-weight: 500;">
				<span> Hi,</span><span> '.$name.',</span>
			</div>
			<div class="text" style="text-align: center; font-family: arial; font-size: 14px; margin-top: 20px;">
				<p>Thank you for purchasing from <span> Taudo Brothers</span>. Welcome to <span> Taudo Brothers</span> club.  Your order has<br> been confirmed. Your order id <span> #'.$order_id.'</span>. We will notify you when it has been sent.</p>

				<p>Please note if you have purchased multiple products, you may receive multiple shipment as we ship <br> from multiple warehouses across India.</p>

			
				<p><span> <b>Order summary</b></span></p>
			
				<table id="customers" style="font-family: Arial, Helvetica, sans-serif; border-collapse: collapse;
				width: 100%;">
					<tr>
					
					  <th style=" border: 1px solid #ddd;  padding: 8px; padding-top: 12px;  padding-bottom: 12px;
  text-align: left;  background-color: #cc0000;  color: white;">Product Name</th>
					  <th style=" border: 1px solid #ddd;  padding: 8px; padding-top: 12px;  padding-bottom: 12px;
  text-align: left;  background-color: #cc0000;  color: white;">Product Price</th>
					  
					  <th style=" border: 1px solid #ddd;  padding: 8px; padding-top: 12px;  padding-bottom: 12px;
  text-align: left;  background-color: #cc0000;  color: white;">Product Discout</th>
  <th style=" border: 1px solid #ddd;  padding: 8px; padding-top: 12px;  padding-bottom: 12px;
  text-align: left;  background-color: #cc0000;  color: white;">Product Quantity</th>
					  <th style=" border: 1px solid #ddd;  padding: 8px; padding-top: 12px;  padding-bottom: 12px;
  text-align: left;  background-color: #cc0000;  color: white;">Total</th>
					
					</tr>';
		$row2 = $this->db->where(array('order_id'=>$order_id))->get('check_out')->result();
                         if(!empty($row2))
	  {
		foreach ($row2 as $row)		           
		{		           
		
		
       
 
					$txt1.='<tr class="">
				
						<td style=" border: 1px solid #ddd;  padding: 8px; text-align: left;">'.$row->product_name.'</td>
						<td style=" border: 1px solid #ddd;  padding: 8px; text-align: left;">'.$row->price.'</td>
						<td style=" border: 1px solid #ddd;  padding: 8px; text-align: left;">'.$row->discount.'%</td>
						<td style=" border: 1px solid #ddd;  padding: 8px; text-align: left;">'.$row->quentity.'</td>
					
						<td style=" border: 1px solid #ddd;  padding: 8px; text-align: left;">'.$row->quentity*$row->product_price.'</td>
						<!-- <td>400</td> -->
					  </tr>
					 
					  ';
					   
		
		}
      }
        $order_details = $this->am->selectrow('user_payment_details',array('order_id'=>$order_id));
						 
						//$discount=$row->product_price/100*$row->discount; 
					    $total=$row->quentity*$row->product_price;	
					    $shipping_charge=$order_details->shipping_charge_amount;	
					    $coupan_amount=$order_details->coupn_amount;
					    $grand_total=(($total+$shipping_charge)-$coupan_amount);
					 
						 $txt1.='<tr><td colspan="3"></td> 
						<td><b> Total Amount</b></td>
						<td><b>Rs. '.$total.'</b></td>
					  </tr>
					  <tr><td colspan="3"></td> 
						<td><b> Shipping Charge</b></td>
						<td><b>Rs. '.$shipping_charge.'</b></td>
					  </tr>
					  <tr><td colspan="3"></td> 
						<td><b> Discount Amount</b></td>
						<td><b>Rs. '.$coupan_amount.'</b></td>
					  </tr>
					  <tr><td colspan="3"></td> 
						<td><b> Grand Amount</b></td>
						<td><b>Rs. '.$grand_total.'</b></td>
					  </tr>
				</table>

				<!-- <p>Payment method</p> -->
				<p>If you have any questions, reply to this mail or contact us at <a href="mailto:orders@why-shy.com">orders@why-shy.com</a></p>
			
			</div>
			<p class="thankyou" style="color: #000; padding: 10px; font-weight: 600; font-size: 18px;
			text-align: center;
			font-family: sans-serif;">Thank you <br> <span>Taudo Brothers Team</span> </p>
		</div>
		
	</section>


</body>

</html>';
 

// load email library
$this->load->library('email');

// prepare email
$this->email
    ->from('info@taudubrothers.com')
    ->to($from_email)
    ->subject('Thanks For Your Order')
    ->message($txt1)
    ->set_mailtype('html');
   
    

// send email
if(!$this->email->send()){
}

}



    
public function seller_order(){
    
    auth_checker();
	$user_id = $this->session->userdata('user_id');
	          
        
       $res = $this->db->select('user_payment_details.*,check_out.*,user_payment_details.status status')->where(array('check_out.vendor_id'=>$user_id,'user_payment_details.order_confirm'=>1))->join('user_payment_details','user_payment_details.order_id=check_out.order_id')->get('check_out')->result();   
         
        
   $b=array();
    if(!empty($res))
    {
    foreach ($res as $row)               
    {            
        $order_id=$row->order_id;
        $result['id']=$row->id;
        $result['user_id']=$row->user_id;
        $result['vendor_id']=$row->vendor_id;
        $result['order_id']=$row->order_id;
        $result['full_name']=$row->full_name;
        $result['mobile_no']=$row->mobile_no;
        $result['quentity']=$row->quentity;
        $result['order_delivered_date']=$row->order_delivered_date;
        $result['transaction_id']=$row->transaction_id;
        $result['order_date']=$row->created_at;
        $result['delivery_charge']='50';
         if($row->status==1)
            {
                $result['status']="Pending";
            }
            
            elseif ($row->status==2)
            {
                $result['status']="Shipped";
            }
             elseif ($row->status==3)
            {
                $result['status']="Out of Delivery";
            }
            elseif ($row->status==4)
            {
                $result['status']="Delivered";
            }
            else
            {
                $result['status']="Cancelled";
            }
        $result['inovice_pdf']='';
        $result['order_status']=$row->status;
        $total_amount=0;
        
      $product_row = $this->am->selectrow('check_out',array('vendor_id'=>$row->vendor_id,'order_id'=>$order_id));
      $result['product_name']=ucfirst($product_row->product_name);
      $product_detail = $this->am->selectrow('seller_product',array('id'=>$product_row->product_id,));
      if($product_detail){
      $result['product_image']=$product_detail->image?base_url().$product_detail->image:'';
      }else{
           $result['product_image']='';
      }
      $val=$row->price ;
 if ($val >'0' && $val <= '500')
{
    $value= $val*0/100;
    //echo $value;
}

elseif ($val >='501' && $val <= '799') {
    $value= $val*5/100;
    //echo $value;
 }
 
 elseif ($val >='800' && $val <= '999') {
    $value= $val*6/100;
    //echo $value;
 }
 elseif ($val >='1000' && $val <= '1499') {
    $value= $val*8/100;
    //echo $value;
 }
 elseif ($val >='1500' && $val <= '1999') {
    $value= $val*10/100;
    //echo $value;
 }
 elseif ($val >='2000' && $val <= '2499') {
    $value= $val*15/100;
    //echo $value;
 }
 elseif ($val >='2500' && $val <= '2999') {
    $value= $val*20/100;
    //echo $value;
 }
 elseif ($val >='3000' && $val <= '3400') {
    $value= $val*25/100;
    //echo $value;
 }
 else {
     $value= $val*30/100;
     //echo $value;
     
 }
      $offer=$row->discount;
      $product_price=($row->price*$offer)/100;
      
       $offer=$row->price;
    //   $offer1=$result['delivery_charge'];
    
       
       $total_price=$offer-$product_price+$value;
  
      //$result['discount']=$row->discount;
      $result['product_price']="$total_price";
      
      
      
      
      $product_res = $this->am->selectres('check_out',array('vendor_id'=>$row->vendor_id,'order_id'=>$order_id));
      $count=0;
      foreach($product_res as $pro_res){
          $total_amount +=$pro_res->product_price;
          $count++;
      }
    //   $result['product_id']=$row->product_id;
    
    
    $result['total_amount_product']="$total_amount";
    $result['product_count']="$count";
      
        array_push($b,$result);
    }
    
      }
      
       $data['seller_order']=($b);
       $data['user']= $this->User_Model->selectrow('user_registeration', array('id'=>$user_id));
       //print_r($data['seller_order']);
     
    $this->render('seller_order', $data);
    
}





public function checkout_new_online()
   {
       
    //   print_r($this->input->post());
    //   die();
       $amount=$this->input->post('amount');
       $checkout_type=$this->input->post('checkout_type')??'online_payment';
        $payment_type=$this->input->post('payment_type')??1;
       $user_id=$this->input->post('user_id');
       $token=$this->input->post('token');
       $address_id=$this->input->post('address_id');
       $coupan_code=$this->input->post('coupan_code')?$this->input->post('coupan_code'):'';
       $coupn_amount=$this->input->post('coupn_amount')?$this->input->post('coupn_amount'):'';
       $shipping_charge_amount=$this->input->post('shipping_charge_amount')?$this->input->post('shipping_charge_amount'):'50';
      
       $coupon_data=$this->db->where(array('code'=>$coupan_code))->get('coupon')->row_array();
     
    
      if(($checkout_type=='cart')){
       $cart_details=$this->db->where(array('user_id'=>$user_id))->get('cart')->result();
       if($payment_type==2){
           $order_confirm=1;
       }else{
           $order_confirm=0;
       }

       $unique_id=Uniqid ();
       
       
       if(!empty($cart_details)){
           foreach($cart_details as $res){ 
       $address_details=$this->db->where(array('user_id'=>$user_id,'address_id'=>$address_id))->get('address')->row_array();
        $q = $this->db->query('SELECT MAX(order_id) as order_id FROM user_payment_details');
        $rr = $q->row_array();
        if ($rr['order_id'] == 0) {
            $rr['order_id'] = 5000;
        }
       
        $order_id = $rr['order_id'] + 1;
        
        
        $data = array(		
			 		'user_id' => $this->input->post('user_id'),
			 		'transaction_id' => $this->input->post('transaction_id')??rand('10000','99999999999'),
				 	'checkout_type' =>$checkout_type,
				 	'order_id'=>$order_id,
				 	'date'=>date('d-m-Y'),
				 	'status'=>'1',
				 	'payment_status'=>$payment_type,
				 	'order_confirm'=>$order_confirm,
				 	'coupan_code' =>$this->input->post('coupan_code')?$this->input->post('coupan_code'):'',
				 	'coupn_amount' =>$this->input->post('coupn_amount')?$this->input->post('coupn_amount'):'',
				 	'shipping_charge_amount' =>$this->input->post('shipping_charge_amount')?$this->input->post('shipping_charge_amount'):50,
				 	'payment_type' =>$this->input->post('payment_type')??2,
				 	
				 	'full_name'=>$address_details['name'],
				 	'mobile_no'=>$address_details['mobile_no'],
				 	'email'=>$address_details['email'],
				 	'house_no'=>$address_details['area_street'],
				 	'colony'=>$address_details['town_village'],
				 	'landmark'=>$address_details['landmark'],
				 	'city'=>$address_details['city'],
				 	'state'=>$address_details['state'],
				 	'address_type'=>$address_details['address_type'],
				 	'full_address'=>$address_details['address'],
				 	
                   );
         $this->db->insert('user_payment_details',$data);
         $last_id=$this->db->insert_id();
        $arr=array();
        
        $total_product_price=0;
      
         $product_details=$this->db->where(array('id'=>$res->product_id))->get('seller_product')->row_array();
          $sale_offe=$product_details['discount'];
          
               
          	$val=$product_details['price'] ;
 if ($val >'0' && $val <= '500')
{
    $value= $val*0/100;
    //echo $value;
}

elseif ($val >='501' && $val <= '799') {
    $value= $val*5/100;
    //echo $value;
 }
 
 elseif ($val >='800' && $val <= '999') {
    $value= $val*6/100;
    //echo $value;
 }
 elseif ($val >='1000' && $val <= '1499') {
    $value= $val*8/100;
    //echo $value;
 }
 elseif ($val >='1500' && $val <= '1999') {
    $value= $val*10/100;
    //echo $value;
 }
 elseif ($val >='2000' && $val <= '2499') {
    $value= $val*15/100;
    //echo $value;
 }
 elseif ($val >='2500' && $val <= '2999') {
    $value= $val*20/100;
    //echo $value;
 }
 elseif ($val >='3000' && $val <= '3400') {
    $value= $val*25/100;
    //echo $value;
 }
 else {
     $value= $val*30/100;
     //echo $value;
     
 }
      $offer=$product_details['discount'];
      $product_price=($product_details['price']*$offer)/100;
      
       $offer=$product_details['price'];
       $offer1=$product_details['delivery_charge'];
       
       $total_price=$offer-$product_price+$value+$offer1;
  
      //$result['discount']=$row->discount;
       
        //   $product_price=$product_details['price']*$sale_offe/100;
          
        //   $sale_offe=$product_details['price'];
           
        //   $total_price=$sale_offe-$product_price;
          
          $product_price=$total_price;
          $total_product_price +=$total_price;
         $array=array(
               
              'user_id' => $this->input->post('user_id'),
              'vendor_id' => $product_details['user_id'],
              'product_id'=>$product_details['id'],
              'product_name'=>$product_details['product_name'],
              'price'=>$product_details['price'],
              'discount'=>$product_details['discount'],
              'product_price'=>$product_price,
              'quentity'=>$res->quantity,
              'other'=>$res->color?$res->color:'',
              'order_id'=>$order_id,
              
             );
             
             $this->db->insert('check_out',$array);
            //  array_push($arr,$array);
         


      }

       
        if(!empty($coupon_data)){
              $coupon_per_amount=$coupon_data['amount'];
           $total_coupan_discount=round(($total_product_price*$coupon_data['amount'])/100);
          }else{
              $total_coupan_discount=0;
              $coupon_per_amount=0;
          }
          
            $array=array('coupan_code'=>$coupan_code,
               'coupn_amount'=>$total_coupan_discount,
               'coupon_per_amount'=>$coupon_per_amount,
               'shipping_charge_amount'=>$shipping_charge_amount
               );
        $this->db->where(array('id'=>$last_id))->update('user_payment_details',$array);
       if($payment_type==2){
            $this->db->where(array('user_id'=>$user_id))->delete('cart');
       }
       $row1 = $this->am->selectrow('user_registeration',array('id'=>$user_id));
       $row2 = $this->am->selectrow('user_payment_details',array('order_id'=>$order_id));      
      $device_id=$row1->device_id;
      $title='Order completed successfully';
      $body='Thank you for shopping with us, We are prepping your order as soon as possible.';
      $type=1;
    //   $this->check_notification($device_id,$title,$body,$type,$user_id);
    //   $this->db->where(array('token'=>$token))->delete('cart');
    
     $this->send_mail_admin($row2->email,$order_id);
     //$message = $order_id." Thank you for shopping with us, We are prepping your order as soon as possible";
     $this->send_mail_user($row2->email,$order_id);
    
         json_encode(array('status'=>'success','message'=>'Order created successfully','data'=>$data));
        $this->session->set_flashdata('success','Order Placed Successfully');
          redirect('checkout');
       
       }else{
               json_encode(array('status'=>'fail','message'=>'Some thing went wrong'));
             
          $this->session->set_flashdata('error','Something went wrong');
          redirect('checkout');
             
       }
       
       }
          
      else{
           
           $product_id= $this->input->post('product_id');
           $size= $this->input->post('size');
           $cart_details=$this->db->where(array('token'=>$token))->get('cart')->result();
       $address_details=$this->db->where(array('user_id'=>$user_id,'id'=>$address_id))->get('address')->row_array();
        $q = $this->db->query('SELECT MAX(order_id) as order_id FROM user_payment_details');
        $rr = $q->row_array();
        if ($rr['order_id'] == 0) {
            $rr['order_id'] = 5000;
        }
        $order_id = $rr['order_id'] + 1;
        
        $arr=array();
  
         $product_details=$this->db->where(array('id'=>$product_id))->get('product')->row_array();
          $sale_offe=$product_details['discount'];
          $product_price=$product_details['price']*$sale_offe/100;
          
           $sale_offe=$product_details['price'];
           
           $total_price=$sale_offe-$product_price;
          
          $product_price=$total_price;
          if(!empty($coupon_data)){
              $coupon_per_amount=$coupon_data['amount'];
           $total_coupan_discount=round(($product_price*$coupon_data['amount'])/100);
          }else{
              $total_coupan_discount=0;
              $coupon_per_amount=0;
          }
       
        $data = array(		
			 		'user_id' => $this->input->post('user_id'),
			 		'transaction_id' => $this->input->post('transaction_id')? $this->input->post('transaction_id'):'',
				 	'checkout_type' =>$this->input->post('checkout_type'),
				 	'order_id'=>$order_id,
				 	'date'=>date('d-m-Y'),
				 	'status'=>'1',
				 	'payment_status'=>'0',
				 	'payment_type' =>$this->input->post('payment_type'),
				 	'full_name'=>$address_details['full_name'],
				 	'mobile_no'=>$address_details['mobile_no'],
				 	'email'=>$address_details['email'],
				 	'house_no'=>$address_details['house_no'],
				 	'colony'=>$address_details['colony'],
				 	'landmark'=>$address_details['landmark'],
				 	'city'=>$address_details['city'],
				 	'state'=>$address_details['state'],
				 	'address_type'=>$address_details['address_type'],
				 	
				 	'coupan_code'=>$coupan_code,
                   'coupn_amount'=>$total_coupan_discount,
                   'coupon_per_amount'=>$coupon_per_amount,
                   'shipping_charge_amount'=>$shipping_charge_amount
                   );
         $this->db->insert('user_payment_details',$data);
         
       
         $array=array(
              'size'=>$size?$size:'',
              'user_id' => $this->input->post('user_id'),
              'product_id'=>$product_details['id'],
              'product_name'=>$product_details['product_name'],
              'price'=>$product_details['price'],
              'discount'=>$product_details['discount'],
              'product_price'=>$product_price,
              'transaction_id'=>$this->input->post('transaction_id')?$this->input->post('transaction_id'):'',
              'order_id'=>$order_id,
               'quentity'=>1,
               
             );
             
             $this->db->insert('check_out',$array);
            //  array_push($arr,$array);

       
       echo json_encode(array('status'=>'success','message'=>'Order created successfully','data'=>$data));
       
       }
       
     }
     
    public function update_profile()
    {
        
        $user_id = $this->input->post('user_id');
        $upload="";
        $config = array(
        'upload_path' =>'./uploads/', 
        'allowed_types' => "gif|jpg|png|jpeg",
        'overwrite' => TRUE
         
        );
$this->load->library('upload',$config);
if($this->upload->do_upload('image'))
{
$banner=$this->upload->data();
$upload= base_url('uploads/').$banner['file_name'];              
//   echo "file upload success";
//   die;
}
else
{
 
 
  
$data['imageError']= $this->upload->display_errors(); 
  
}
        
        $data = array(
            
            'name'=> $this->input->post('name'),
            'email' => $this->input->post('email'),
            'image' => $upload,
            
            
            );
            
            $this->db->where('id',$user_id);
            $this->db->update('user_registeration',$data);
            $this->session->set_flashdata('success', 'Profile Update Successfully!');
            redirect('user_profile');
        
    }

	
// 	public function send_sms_user($phone, $msg) {

		
// 	$curl=curl_init();
//     $campaign_name="Order Created Successfully!"; //My First Campaign
//     $authKey="6ea5ecd5edb60410a9db2e5c5aa7a842";  //Valid Authentication Key
//     $mobileNumber="$phone"; //Receivers 
//     $sender="TAUDUS"; //Sender Approved from Dlt 
//     $message="$msg";  //Content Approved from Dlt
//     $route="TR";  //TR for tranactional,PR for promotional 
//     $template_id="1207165969989408428"; //Template Id Approved from Dlt 
//     $scheduleTime="60"; //if required fill parameter in given formate 07-05-2022 12:00:00 dd-mm-yyyy hh:mm:ss 
//     $coding="1"; //If english $coding = "1" otherwise if required other language $coding = "2" 
//     $postData = array(
//     "campaign_name" => $campaign_name, 
//     "auth_key" => $authKey, 
//     "receivers"  => $mobileNumber, 
//     "sender"  => $sender, 
//     "route"  => $route, 
//     "message" => ['msgdata' => $message,'Template_ID' => $template_id,'coding' => $coding,], 
//     "scheduleTime" => $scheduleTime, 
//     );
//     curl_setopt_array($curl, array(
//     CURLOPT_URL  => 'http://sms.bulksmsserviceproviders.com/api/send/sms',
//     CURLOPT_RETURNTRANSFER  => true,
//     CURLOPT_ENCODING  => '',
//     CURLOPT_MAXREDIRS  => 10,
//     CURLOPT_TIMEOUT  => 0,
//     CURLOPT_FOLLOWLOCATION  => true,
//     CURLOPT_HTTP_VERSION  => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST  => 'POST',
//     CURLOPT_POSTFIELDS  => json_encode($postData),
//     CURLOPT_HTTPHEADER  => array(
//       'Content-Type: application/json'
//     ),
//     ));
//     $response = curl_exec($curl);
//     curl_close($curl);
//      //print_r($response);      
    
// 	}
	
	
	   public function cancel_order()
   {
       auth_checker();
	 $user_id = $this->session->userdata('user_id');
     $order_id = $this->input->post('order_id');
     $updatedata = array(
         'status'=>5,
         );
     $this->db->where('order_id',$order_id);
     $this->db->update('user_payment_details',$updatedata);
     $this->session->set_flashdata('success', 'Order has been cancelled');
     
     $url = $_SERVER['HTTP_REFERER'];
     redirect($url);
     
   }
	
	
}
?>
