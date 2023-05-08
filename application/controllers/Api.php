<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller  
{
    
    	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Admin_Model','am');
        $this->load->library('common'); 
        $this->load->helper('text');
        $this->load->helper('url');
        Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
    }
    
    

       public function user_signup()
       {
       $user_id=$this->input->post('user_id');
     if($this->input->post('image')){
	  	 $upload=$this->input->post('image');
	  	 $img=base64_decode($upload);
	  	 $imgname=$this->input->post('name');
	  	 $upload_url=base_url()."uploads/".$imgname.".jpg";
	  	 $upload_ur="./uploads/".$imgname.".jpg";
        file_put_contents($upload_ur,$img);
     }else{
         $upload_url='';
     }
	  $data = array(		
	 		'name' => $this->input->post('name'),
	 		'email' => $this->input->post('email'),
	 		'profile_status'=>'1',
		 	'image' =>$upload_url,
            );
              // print_r($data);die;
         	 $this->db->where('id',$user_id);
            $this->db->update('user_registeration',$data);
           // echo $this->db->last_query();die;
 	    $query = $this->db->get_where('user_registeration', array('id'=>$user_id));
		if($query->num_rows())
		 {
			$row=$query->row(); 
		    $result['status']="success";
			$result['user_id']=$row->id;
			$result['name']=$row->name;
			$result['email']=$row->email;
	    	$result['image']=$upload_url;
	    	$result['device_id']=$row->device_id;
        //	$result['image']=$row->image;
			$result['msg']="register save successfully";
		    echo json_encode($result);
         }else{
              $result['status']="false";                          
                $result['msg']="Profile not updated!";
                echo json_encode($result);
         }
   
   }
    
       public function user_login()
       {
      $mobile_no=$this->input->post('mobile_no');
      $device_id=$this->input->post('device_id');    
      $otp = rand(1000,9999);
        //$otp=1234;
        $this->db->update("user_registeration", array("otp"=>$otp),array("mobile_no"=>$mobile_no));
        $q=$this->db->get_where("user_registeration",array("mobile_no"=>$this->input->post('mobile_no')));
        
        
        $this->send_sms($mobile_no,$otp);
        
        $arrNotification["body"] ="Your Otp $otp";
        $arrNotification["title"] = 'Otp verification';
        $arrNotification["sound"] = "default";
        $arrNotification["type"] = 'OTP';
        
        $this->send_notification($device_id, $arrNotification,'Android');
         $get_address_lat_lng= $this->get_address_lat_lng();
        $lat= $get_address_lat_lng["lat"];
        $lng= $get_address_lat_lng["lng"];
        $address= $get_address_lat_lng["address"];
        if($q->num_rows())
        {
            
            $row=$q->row();
              $address_details=$this->db->where(array('user_id'=>$row->id))->get('address')->num_rows();
              if($address_details){
                $this->db->where(array('user_id'=>$row->id))->update('address',array('address'=>$address,'lat'=>$lat,'lng'=>$lng,'name'=>$row->name,'mobile_no'=>$row->mobile_no,'email'=>$row->email));
              }else{
                    $this->db->insert('address',array('user_id'=>$row->id,'address'=>$address,'lat'=>$lat,'lng'=>$lng,'name'=>$row->name,'mobile_no'=>$row->mobile_no,'email'=>$row->email));
              }
            
            
            $result['status']="success";
            $result['user_id']=$row->id;
            $result['otp']=$row->otp;
            $result['mobile_no']=$row->mobile_no;
            $result['device_id']=$row->device_id;
            if(!empty($row->name)){
            $result['user_type']="old";
            }else{
                $result['user_type']="new";
            }
            $result['kyc_status']="$row->kyc_status";
            $result['kyc_type']="$row->kyc_type";
            $result['lat']="$lat";
            $result['lng']="$lng";
            $result['msg']="OTP Send Successfully";
            echo json_encode($result);
        }
        else
        {
            $data = array('mobile_no' =>$this->input->post('mobile_no'),
                          'device_id' =>$this->input->post('device_id')?$this->input->post('device_id'):'',
                          'otp' =>$otp,
                    );
            $member = $this->am->insert('user_registeration',$data);
            $last_id = $this->db->insert_id();
            $query = $this->db->get_where('user_registeration', array('id'=>$last_id));
            if($query->num_rows()){
                
             
                $row=$query->row(); 
                $address_details=$this->db->where(array('user_id'=>$last_id))->get('address')->num_rows();
              if($address_details){
                $this->db->where(array('user_id'=>$last_id))->update('address',array('address'=>$address,'lat'=>$lat,'lng'=>$lng,'name'=>$row->name,'mobile_no'=>$row->mobile_no,'email'=>$row->email));
              }else{
                    $this->db->insert('address',array('user_id'=>$row->id,'address'=>$address,'lat'=>$lat,'lng'=>$lng,'name'=>$row->name,'mobile_no'=>$row->mobile_no,'email'=>$row->email));
              } 
                $result['status']="success";
                $result['user_id']=$row->id;
                $result['contact_no']=$row->mobile_no;
                $result['otp']=$row->otp;
                $result['device_id']=$row->device_id;
                $result['user_type']="new";
                 $result['kyc_status']="0";
                 $result['lat']="$lat";
               $result['lng']="$lng";
                $result['msg']="OTP Send Successfully";
                echo json_encode($result);
              }else
              {
                $result['status']="false";                          
                $result['msg']="OTP Not Send";
                echo json_encode($result);
            }
        }
    }
    
    
    
    public function send_sms($mobile_no,$otp) {

		
	$curl=curl_init();
    $campaign_name="OTP"; //My First Campaign
    $authKey="6ea5ecd5edb60410a9db2e5c5aa7a842";  //Valid Authentication Key
    $mobileNumber="$mobile_no"; //Receivers 
    $sender="TAUDUS"; //Sender Approved from Dlt 
    $message= $otp." is your one time password (OTP) for phone verification. It will expire with in 10 minutes. Don't share this code with anyone. Taudu Brothers";  //Content Approved from Dlt
    $route="TR";  //TR for tranactional,PR for promotional 
    $template_id="1207165969989408428"; //Template Id Approved from Dlt 
    $scheduleTime=""; //if required fill parameter in given formate 07-05-2022 12:00:00 dd-mm-yyyy hh:mm:ss 
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
    CURLOPT_URL  => 'http:/sms.bulksmsserviceproviders.com/api/send/sms',
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
    // echo $response;      
    
	}
        public function seller_register()
       {
           $user_id=$this->input->post('user_id');
           
           $shop_name= $this->input->post('shop_name');
              $shop_area = $this->input->post('shop_area');
              $shop_town = $this->input->post('shop_town');
              $shop_distric = $this->input->post('shop_distric');
              $shop_state = $this->input->post('shop_state');
              //'shop_pincode' => $this->input->post('shop_pincode'),
              $area_pincode = $this->input->post('area_pincode');
              $address="$shop_area .','.$shop_distric.','.$shop_state,','.$area_pincode";
            //   $address="$shop_name";
             $geo_location=$this->geoLocate($address);
        //   print_r($geo_location);
           
        //   echo json_encode(array('status'=>"fail",'msg'=>"$geo_location"));
        // //   print_r($geo_location);
        //   die();
           
        if(!empty($user_id)){
            
            if($this->input->post('profile_image')){
    	  	 $upload=$this->input->post('profile_image');
    	  	 $img=base64_decode($upload);
    	  	 $imgname=rand('1000','9999999');
    	  	 $upload_url="uploads/".$imgname.".jpg";
    	  	 $upload_ur="./uploads/".$imgname.".jpg";
            file_put_contents($upload_ur,$img);
          }else{
              $upload_url='';
          }
          if($this->input->post('pan_image')){
    	  	 $upload=$this->input->post('pan_image');
    	  	 $img=base64_decode($upload);
    	  	 $imgname=rand('1000','9999999');
    	  	 $upload_url1="uploads/".$imgname.".jpg";
    	  	 $upload_ur="./uploads/".$imgname.".jpg";
            file_put_contents($upload_ur,$img);
          }else{
              $upload_url1='';
          }
            
             
           if($this->input->post('adhar_image')){
    	  	 $upload=$this->input->post('adhar_image');
    	  	 $img=base64_decode($upload);
    	  	 $imgname=rand('1000','9999999');
    	  	 $upload_url2="uploads/".$imgname.".jpg";
    	  	 $upload_ur="./uploads/".$imgname.".jpg";
            file_put_contents($upload_ur,$img);
          }else{
              $upload_url2='';
          }
            
              
           if($this->input->post('gst_image')){
    	  	 $upload=$this->input->post('gst_image');
    	  	 $img=base64_decode($upload);
    	  	 $imgname=rand('1000','9999999');
    	  	 $upload_url3="uploads/".$imgname.".jpg";
    	  	 $upload_ur="./uploads/".$imgname.".jpg";
            file_put_contents($upload_ur,$img);
          }else{
              $upload_url3='';
          }
           if($this->input->post('landmark_image')){
    	  	 $upload=$this->input->post('landmark_image');
    	  	 $img=base64_decode($upload);
    	  	 $imgname=rand('1000','9999999');
    	  	 $upload_url4="uploads/".$imgname.".jpg";
    	  	 $upload_ur="./uploads/".$imgname.".jpg";
            file_put_contents($upload_ur,$img);
          }else{
              $upload_url4='';
          }
         
             
         $data = array(   
              'name' => $this->input->post('name')?$this->input->post('name'):'',
              'user_id' => $this->input->post('user_id'),
              'shop_name' => $this->input->post('shop_name')?$this->input->post('shop_name'):'',
              'shop_area' => $this->input->post('shop_area')?$this->input->post('shop_area'):'',
              'shop_town' => $this->input->post('shop_town')?$this->input->post('shop_town'):'',
              'shop_distric' => $this->input->post('shop_distric')?$this->input->post('shop_distric'):'',
              'shop_state' => $this->input->post('shop_state')?$this->input->post('shop_state'):'',
              //'shop_pincode' => $this->input->post('shop_pincode'),
              'area_pincode' => $this->input->post('area_pincode')?$this->input->post('area_pincode'):'',
              'pan_no' => $this->input->post('pan_no')?$this->input->post('pan_no'):'',
              'adhar_no' => $this->input->post('adhar_no')?$this->input->post('adhar_no'):'',
              'gst_no' => $this->input->post('gst_no')?$this->input->post('gst_no'):'',
              'landmark' => $this->input->post('landmark')?$this->input->post('landmark'):'',
              'description' => $this->input->post('description')?$this->input->post('description'):'',
              'profile_image' =>$upload_url,
              'pan_image' =>$upload_url1,
              'adhar_image' =>$upload_url2,
              'gst_image' =>$upload_url3,
              'landmark_image' =>$upload_url4,
              'lat'=>$geo_location['lat'],
              'long'=>$geo_location['long'],
              'kyc_type'=>$this->input->post('kyc_type')?$this->input->post('kyc_type'):'0',
              
                        );
                      // print_r($data);die;
              $member = $this->am->insert('seller_registeration',$data);
               $last_id = $this->db->insert_id();
             $update = $this->db->where(array('id'=>$user_id))->update('user_registeration',array('kyc_status'=>1,'lat'=>$geo_location['lat'],
              'long'=>$geo_location['long'],
              'kyc_type'=>$this->input->post('kyc_type')?$this->input->post('kyc_type'):'0',
               'delivery_type'=>$this->input->post('delivery_type')?$this->input->post('delivery_type'):'0'
              
              ));
            //   echo $this->db->last_query();die;
              
              $row1 = $this->am->selectrow('user_registeration',array('id'=>$user_id));
               $device_id=$row1->device_id;
               $title='KYC';
              $body='KYC Registration done';
              $type=2;
              $this->check_notification($device_id,$title,$body,$type,$user_id);
              
              
      $query = $this->db->get_where('seller_registeration', array('id'=>$last_id));
        if($query->num_rows())
         {
          $row=$query->row(); 
            $result['status']="success";
          $result['user_id']=$row->user_id;
          $result['name']=$row->name;
          $result['shop_name']=$row->shop_name;
          $result['shop_area']=$row->shop_area;
          $result['shop_town']=$row->shop_town;
          $result['shop_distric']=$row->shop_distric;
          $result['shop_state']=$row->shop_state;
          //$result['shop_pincode']=$row->shop_pincode;
          $result['area_pincode']=$row->area_pincode;
          $result['pan_no']=$row->pan_no;
          $result['adhar_no']=$row->adhar_no;
          $result['gst_no']=$row->gst_no;
          $result['landmark']=$row->landmark;
          $result['description']=$row->description;
          $result['profile_image']=$upload_url;
          $result['pan_image']=$upload_url1;
          $result['adhar_image']=$upload_url2;
          $result['gst_image']=$upload_url3;
          $result['landmark_image']=$upload_url4;
          $result['kyc_status']='1';
          $result['kyc_type']=$row1->kyc_type;
          $result['msg']="register save successfully";
            echo json_encode($result);
           
           }
           else
                  {
                    $result['status']="false";                          
                    $result['msg']="Some thing went wrong";
                    echo json_encode($result);
                }
           
        }else{
               $result['status']="false";                          
                    $result['msg']="User is required";
                    echo json_encode($result); 
        }
            
       }
       
       public function get_seller_profile()
       
       {
             $vendor_id=$this->input->post('vendor_id');
             $user_id=$this->input->post('user_id');
           $res = $this->db->select('seller_registeration.*,user_registeration.name as user_name')->where(array('user_registeration.id'=>$vendor_id))->join('seller_registeration','user_registeration.id=seller_registeration.user_id')->get('user_registeration')->result();
           
           
           
           $num_rows=$this->db->where(array('vendor_id'=>$vendor_id,'user_id'=>$user_id))->get('tbl_follower')->num_rows();
           if($num_rows){
               $follow_status="1";
           }else{
                $follow_status="0";
           }
           $b=array();
           if(!empty($res))
           {
               foreach($res as $row)
               {
                   $result['status']="success";
                   $result['user_id']=$row->user_id;
                   $result['seller_name']=$row->name;
                   $result['shop_name']=$row->shop_name;
                   $result['description']=$row->description;
                    $result['follow_status']=$follow_status;
                   if(!empty($row->profile_image))
                   {
                     $result['profile_image']=base_url().$row->profile_image;
                   }
                   else{
                     $result['profile_image']='';
                   }
                   $result['msg']="record found";
                   array_push($b,$result);
               }
           }
           if(!empty($res))
           {
               echo json_encode($result);
               
           }
           else{
               $val=array("status"=>"fail","message"=>"record not found");
               $data = json_encode($val);
               echo $data;
           }
       }
   
            public function get_address_lat_lng(){
             $lat=$this->input->post('lat')?$this->input->post('lat'):'28.535517';
              $long=$this->input->post('lng')?$this->input->post('lng'):'77.391029';
            	$GOOGLE_API_KEY_HERE ="AIzaSyBLCl-JK5usUBFwjG7Y0s9Ef3fSoPV0QTk";
              $url  = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$long."&sensor=false&key=$GOOGLE_API_KEY_HERE";
              $json = @file_get_contents($url);
              $data = json_decode($json);
            //   print_r( $data);
              $status = $data->status;
              $address = '';
              if($status == "OK")
              {
            	return $array=array('address'=>$data->results[0]->formatted_address,'lat'=>$lat,'lng'=>$long,'status'=>1);
            // 	$address = $data->results[0]->formatted_address;
              }
              else
              {
                return	 $array=array('address'=>'No found address','lat'=>$lat,'lng'=>$long,'status'=>'0');
              }
        }
        
        
         public function change_address(){
             	$GOOGLE_API_KEY_HERE ="AIzaSyBLCl-JK5usUBFwjG7Y0s9Ef3fSoPV0QTk";
             if(empty($this->input->post('pincode'))){
             $lat=$this->input->post('lat')?$this->input->post('lat'):'28.535517';
              $long=$this->input->post('lng')?$this->input->post('lng'):'77.391029';
            
              $url  = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$long."&sensor=false&key=$GOOGLE_API_KEY_HERE";
              $json = @file_get_contents($url);
              $data = json_decode($json);
            //   print_r( $data);
              $status = $data->status;
              $address = '';
              if($status == "OK")
              {
            	 $array=array('address'=>$data->results[0]->formatted_address,'lat'=>"$lat",'lng'=>"$long",'status'=>1);
            // 	$address = $data->results[0]->formatted_address;
              }
              else
              {
                	 $array=array('address'=>'No found address','lat'=>"$lat",'lng'=>"$long",'status'=>1);
              }
             }else{
                  $zipcode=$this->input->post('pincode');
                $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$zipcode."&sensor=true&key=$GOOGLE_API_KEY_HERE";
                $details=file_get_contents($url);
                $result = json_decode($details,true);
            //   print_r($result);
              if($result['status']=="OK"){
                $lat=$result['results'][0]['geometry']['location']['lat'];
            
                $lng=$result['results'][0]['geometry']['location']['lng'];
                 $address = $result['results'][0]['formatted_address'];
            
                 	 $array=array('address'=>$address,'lat'=>"$lat",'lng'=>$lng,'status'=>1);
                 
              }else{
                  $array=array('address'=>'No found address','lat'=>"$lat",'lng'=>"$long",'status'=>1);
                  
              }
              
             }
              
               $q=$this->db->get_where("user_registeration",array("id"=>$this->input->post('user_id')));

               $row=$q->row();
              $address_details=$this->db->where(array('user_id'=>$row->id))->get('address')->num_rows();
              if($address_details){
                $this->db->where(array('user_id'=>$row->id))->update('address',array('address'=>$address,'lat'=>$array['lat'],'lng'=>$array['lng'],'name'=>$row->name,'mobile_no'=>$row->mobile_no,'email'=>$row->email));
              }else{
                    $this->db->insert('address',array('user_id'=>$row->id,'address'=>$address,'lat'=>$array['lat'],'lng'=>$array['lng'],'name'=>$row->name,'mobile_no'=>$row->mobile_no,'email'=>$row->email));
              }
            
            echo json_encode(array('status'=>"success",'msg'=>"Address Change Successfully",'data'=>$array));
              
              
             
              
              
              
        }
        
     public function get_seller_profile_personal()
   
   {
         
         $user_id=$this->input->post('user_id');
        $res = $this->db->select('seller_registeration.*,user_registeration.name as user_name, kyc_status')->where(array('user_registeration.id'=>$user_id))->join('seller_registeration','user_registeration.id=seller_registeration.user_id')->get('user_registeration')->result();
       
      //print_r($res);
       $b=array();
       if(!empty($res))
       {
           foreach($res as $row)
           {
               $result['user_id']=$row->id;
               $result['vendor_id']=$row->id;
               $result['seller_name']=$row->name;
               $result['shop_name']=$row->shop_name;
               $result['shop_area']=$row->shop_area;
               $result['shop_town']=$row->shop_town;
               $result['shop_distric']=$row->shop_distric;
               $result['shop_state']=$row->shop_town;
               $result['shop_pincode']=$row->shop_pincode;
               $result['pan_no']=$row->pan_no;
               //$result['pan_image']=base_url('uploads/').$row->pan_image;
               if(!empty($row->pan_image))
               {
                 $result['pan_image']=base_url().$row->pan_image;
               }
               else{
                 $result['pan_image']="";
               }
               $result['adhar_no']=$row->adhar_no;
               //$result['adhar_image']=base_url('uploads/').$row->adhar_image;
               if(!empty($row->adhar_image))
               {
                 $result['adhar_image']=base_url().$row->adhar_image;
               }
               else{
                 $result['adhar_image']="";
               }
               $result['gst_no']=$row->gst_no;
               //$result['gst_image']=base_url('uploads/').$row->gst_image;
               if(!empty($row->gst_image))
               {
                 $result['gst_image']=base_url().$row->gst_image;
               }
               else{
                 $result['gst_image']="";
               }
               $result['landmark']=$row->landmark;
               //$result['landmark_image']=base_url('uploads/').$row->landmark_image;
               if(!empty($row->landmark_image))
               {
                 $result['landmark_image']=base_url().$row->landmark_image;
               }
               else{
                 $result['landmark_image']="";
               }
              // $result['profile_image']=base_url('uploads/').$row->profile_image;
              
              if(!empty($row->profile_image))
               {
                 $result['profile_image']=base_url().$row->profile_image;
               }
               else{
                 $result['profile_image']=base_url();
               }
               $result['description']=$row->description;
               $result['kyc_status']=$row->kyc_status;
               $result['status']=$row->status;
               $result['created_at']=$row->created_at;
               $result['user_name']=$row->user_name;
               $result['msg']="record found";
               $result['status']="success";
               array_push($b,$result);
           }
       }
       
       if(!empty($res))
       {
           $array=array('status'=>'success','msg'=>'success','data'=>$b);
           echo json_encode($result);
       }
       else{
           $val=array("status"=>"fail","message"=>"record not found");
           $data = json_encode($val);
           echo $data;
       }
       
   }
    

public function transparent_background($filename='uploads/6657147.jpg') 
{
  
$percent = 2;
 
// Get new dimensions
list($width, $height) = getimagesize($filename);
  $new_width = 700;
 $new_height = 700;
// Resample
  $image_p = imagecreatetruecolor($new_width, $new_height);
  $image = imagecreatefromjpeg($filename);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

// Output
  imagejpeg($image_p, $_SERVER['DOCUMENT_ROOT'].'/'.$filename, 100);
   
   
}
 
   
    
     public function add_seller_product()
   {
       $user_id=$this->input->post('user_id');
    
         
      
      if($this->input->post('image')){
	  	 $upload=$this->input->post('image');
	  	 $img=base64_decode($upload);
	  	 $imgname=rand('1000','9999999');
	  	 $upload_url="uploads/".$imgname.".jpg";
	  	 $upload_ur="./uploads/".$imgname.".jpg";
        file_put_contents($upload_ur,$img);
        $this->transparent_background($upload_url);
      }else{
          $upload_url='';
      }
      if($this->input->post('image1')){
	  	 $upload=$this->input->post('image1');
	  	 $img=base64_decode($upload);
	  	 $imgname=rand('9900','9999999');
	  	 $upload_url1="uploads/".$imgname.".jpg";
	  	 $upload_ur="./uploads/".$imgname.".jpg";
        file_put_contents($upload_ur,$img);
         $this->transparent_background($upload_url1);
      }else{
          $upload_url1='';
      }
      
       if($this->input->post('image2')){
	  	 $upload=$this->input->post('image2');
	  	 $img=base64_decode($upload);
	  	 $imgname=rand('9900','9999999');
	  	 $upload_url2="uploads/".$imgname.".jpg";
	  	 $upload_ur="./uploads/".$imgname.".jpg";
        file_put_contents($upload_ur,$img);
         $this->transparent_background($upload_url2);
       
        
      }else{
          $upload_url2='';
      }
      
    
      $upload_video="";
          $config = array('upload_path' =>'./uploads/',
                'allowed_types' => "gif|mp4",
                  'overwrite' => TRUE,
                  'encrypt_name' => TRUE
                );
      $this->load->library('upload',$config);
      $this->upload->initialize($config);
      if($this->upload->do_upload('video'))
      {
        $banner=$this->upload->data();
          $upload_video="uploads/".$banner['file_name'];              
         /*echo "file upload success"; die;
          die();*/
      }
      else
      {
        $data['imageError']= $this->upload->display_errors(); 
        
         $val=array("status"=>"fail","message"=>$data['imageError']);
           $data = json_encode($val);
           echo $data;
        exit();
       $upload_video='';
      }
       
     $data = array(   
          'user_id'=>$this->input->post('user_id'),
          'product_name' => $this->input->post('product_name'),
          'category' => $this->input->post('category')?$this->input->post('category'):'',  
          //'quantity' => $this->input->post('quantity'),
          'height' => $this->input->post('height')?$this->input->post('height'):'',
          'width' => $this->input->post('width')?$this->input->post('width'):'',
          'length' => $this->input->post('length')?$this->input->post('length'):'',
          'weight' => $this->input->post('weight')?$this->input->post('weight'):'',
          'description' => $this->input->post('description')?$this->input->post('description'):'',
          'color' => $this->input->post('color')? $this->input->post('color'):'',
          'discount' => $this->input->post('discount')? $this->input->post('discount'):'0',
          'price' => $this->input->post('price')? $this->input->post('price'):0,
          'other_offer' => $this->input->post('other_offer')?$this->input->post('other_offer'):0,
          'speciality' => $this->input->post('speciality')?$this->input->post('speciality'):'',
          'brand_name' => $this->input->post('brand_name')?$this->input->post('brand_name'):0,
          'country' => $this->input->post('country')?$this->input->post('country'):'',
          'image' =>$upload_url,
          'image1' =>$upload_url1,
          'image2' =>$upload_url2,
          'video' =>$upload_video,
          'other_varient' =>$this->input->post('other_varient')?$this->input->post('other_varient'):'',
          'type' =>2,
          'kyc_type'=>$this->input->post('type'),
     
        );
                    //echo"<pre>";
                   //print_r($data);die;
          $member = $this->am->insert('seller_product',$data);
          // echo $this->db->last_query();die;
           $last_id = $this->db->insert_id();
           
           $slug = url_title(convert_accented_characters(strtolower(strip_tags(preg_replace ('/[0-9]+$/','-',$this->input->post('product_name'))))), 'dash', true);
           $slugs=$slug.'-'.$last_id;
  
   $this->db->where('id',$last_id)->update('seller_product', array('slug'=>$slugs));
  $query = $this->db->get_where('seller_product', array('id'=>$last_id));
    if($query->num_rows())
     {
      $row=$query->row(); 
        $result['status']="success";
      //$result['user_id']=$row->id;
      $result['user_id']=$row->user_id;
      $result['product_name']=$row->product_name;
      $result['category']=$row->category;
      $result['brand_name']=$row->brand_name;
      $result['country']=$row->country;
      //$result['quantity']=$row->quantity;
      $result['height']=$row->height;
      $result['weight']=$row->weight;
      $result['length']=$row->length;
      $result['width']=$row->width;
      $result['color']=$row->color;
      $val=$row->price;
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
      $product_price=$row->price*$offer/100;
      
       $offer=$row->price;
       
       $total_price=$offer-$product_price+$value;
     
      //$result['price']=$row->price;
      //$result['charger_price']=$value;
      $result['discount']=$row->discount;
      $result['price']="$total_price";
      $result['other_offer']=$row->other_offer;
      $result['speciality']=$row->speciality;
      $result['description']=$row->description;
      $result['other_varient']=$row->other_varient;
      $result['type']=$row->kyc_type;
      $result['image']=$upload_url;
      $result['image1']=$upload_url1;
      $result['image2']=$upload_url2;
      $result['video']=$upload_video;
      $result['msg']="Product Add Successfully";
        echo json_encode($result);
       
     }
          
      }

    
     public function notifactions(){
      $load = array();
     $username = "test5";
    $load['title'] = "demo";  
    $load['body'] = "This is a test msg from".$username; 
    $query=$this->db->select('*')->get("user_registeration");
     if($query->num_rows())
        { 
            $rec=$query->result(); 
            foreach($rec as $res){
                if(!empty($res->device_id)){
                    $token[]=$res->device_id;
                }
            }
        }
        if(!empty($token)){
            $key="0";
            $ress= $this->common->android_push($token, $load, $key); 
            if(!empty($ress)){
              $res1['status']="success";
        	  echo json_encode($ress);
            }
        }
    }
    public function notifaction(){
    $user_id=$this->input->post('user_id');
    $this->db->select('notifaction.*,message.*');
    $this->db->from('notifaction');
    $this->db->join('message', 'notifaction.id = message.notifaction_id');
    $this->db->where('message.user_id',$user_id);
     $this->db->order_by("message.id", "desc");
    // $this->db->limit(0, 9);
   
       $this->db->limit(9);
    $query = $this->db->get();
    $result= $query->result();
   if(!empty($result)){
      $res1['status']="success";
      $res1['message']="record found";
      $i=0;
      foreach($result as $res){
      $res1['data'][$i]['title']=$res->title;
      $res1['data'][$i]['description']=$res->description;
      $res1['data'][$i]['image']=base_url()."uploads/5.jpg";
      $date=date("d-m-Y",strtotime($res->created_at));
      $res1['data'][$i]['date']=$date;
      $i++;
      }
      }else{
           $res1['status']="failure";
         $res1['message']="record not found";
      }
    
	  echo json_encode($res1);
    }
    
    public function count()
    {
    $user_id=$this->input->post('user_id');
    $this->db->select('*');
    $this->db->from('message');
    $this->db->where(array('status'=>'0','user_id'=>$user_id));
    $query = $this->db->get();
     $num=$query->num_rows();
      $res1['status']="success";
      $res1['count']="$num";
      //$res1['count']="2";
	  echo json_encode($res1);
    }
    
   
   
    public function status_change()
    {
    $user_id=$this->input->post('user_id');
    $data = array(		
			 		'status' => '1'
                    );
                  // print_r($data);die;
         	 $this->db->where('user_id',$user_id);
	$num = $this->db->update('message',$data );
	  if(!empty($num)){
      $res1['status']="success";
	  echo json_encode($res1);
    }
    }
    
    
    public function matchotp()
    {
        $b=array();
        $user_id=$this->input->post('user_id');
        $otp=$this->input->post('otp');
    //   $query = $this->am->select_l('users',array('id'=>$user_id));
      $query=$this->db->select('*')->where("id",$user_id)->get("user_registeration");
         if($query->num_rows())
        { 
	        $row=$query->row(); 
	        $user_otp = $row->otp;
	      	if($user_otp == $otp)
	      	{
		    $result['status']="success";
		    $result['user_id']=$row->id;
            $result['mobile_no']=$row->mobile_no;
            $result['name']=$row->name;
            $result['otp']=$row->otp;
            $result['device_id']=$row->device_id;
            $result['msg']="OTP is match Successfully";
		    echo json_encode($result);
	      	}
		    else		       
		    {
		        $result['status']="false";
		        $result['user_id']=$row->id;
		        $result['msg']="OTP is Invalid";
		        echo json_encode($result);
		    }
        }
    }
    
    public function loginotp ()
    {
        $b=array();
        $user_id=$this->input->post('user_id');
        $otp=$this->input->post('otp');
      $query=$this->db->select('*')->where("id",$user_id)->get("user_registeration");
         if($query->num_rows())
        { 
	        $row=$query->row(); 
	        $user_otp = $row->otp;
	      	if($user_otp == $otp)
	      	{
		    $result['status']="success";
		     $result['msg']="Login Successfully";
		    $result['user_id']=$row->id;
            $result['mobile_no']=$row->mobile_no;
		    echo json_encode($result);
	      	}
		    else		       
		    {
		        $result['status']="false";
		        $result['user_id']=$row->id;
		        $result['msg']="OTP is Invalid";
		        echo json_encode($result);
		    }
        }
    }
    
    public function image_testing()
   {
       if($this->input->post('name')){
	  	 $upload=$this->input->post('image');
	  	 $img=base64_decode($upload);
	  	 $imgname=$this->input->post('name');
	  	 $upload_url=base_url()."uploads/".$imgname.".jpg";
	  	 $upload_ur="./uploads/".$imgname.".jpg";
        file_put_contents($upload_ur,$img);
	  $data = array(		
			 		'name' => $this->input->post('name'),
				 	'image' =>$upload_url,
                   );
                  // print_r($data);die;
 	$member = $this->am->insert('user_registeration',$data);
        
 	$result['status']="true";
		        $result['msg']="Successfuly Added";
		        $result['url']=$upload_url;
		        echo json_encode($result);
       }else{
           	$result['status']="false";
		        $result['msg']="Data has not saved";
		        
		        echo json_encode($result);
       }
   }
   
   
    public function user_register()
   {
       $user_id=$this->input->post('user_id');
        if($this->input->post('name')){
	  	 $upload=$this->input->post('image');
	  	 $img=base64_decode($upload);
	  	 $imgname=$this->input->post('name');
	  	 $upload_url=base_url()."uploads/".$imgname.".jpg";
	  	 $upload_ur="./uploads/".$imgname.".jpg";
        file_put_contents($upload_ur,$img);
	  $data = array(		
			 		'name' => $this->input->post('name'),
			 		'shope_name' => $this->input->post('shope_name'),
			 		'city' => $this->input->post('city'),
			 		'profile_status'=>'1',
				 	'image' =>$upload_url,
                    );
                  // print_r($data);die;
         	 $this->db->where('id',$user_id);
            $this->db->update('user_registeration',$data);
           // echo $this->db->last_query();die;
 	$query = $this->db->get_where('user_registeration', array('id'=>$user_id));
		if($query->num_rows())
		 {
			$row=$query->row(); 
		    $result['status']="success";
			$result['id']=$row->id;
			$result['name']=$row->name;
			$result['email']=$row->email;
	    	$result['image']=$upload_url;
        //	$result['image']=$row->image;
			$result['msg']="register save successfully";
		    echo json_encode($result);
         }
   }
   }
    
	public function get_banner()
  	{
	$res = $this->am->selectres('banner',array('type'=>0));
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['id']=$row->id;
		$a['url']=$row->url;
	
	if(!empty($row->image)){
		$a['image']=base_url('uploads/').$row->image;
	      
		}
		
		else{
		    $a['image']='';
		}
		array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	} 
  	
  	
  	public function get_splash_screen()
  	{
	$res = $this->am->selectres('banner',array('type'=>1));
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['id']=$row->id;
		$a['s_url']=$row->url;
		
		if(!empty($row->image)){
	
		$a['image']=base_url('uploads/').$row->image;
	      
		}
		else{
		    $a['image']='';
		}
		array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	}
  	
	
	public function get_countries()
  	{
  	    
	$res = $this->am->selectres('countries');
	
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['id']=$row->id;
        $a['country_name']=$row->country_name;
        
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	}
	
	
	public function get_category()
  	{
  	    $user_id= $this->input->post('user_id');
  	  $users=  $this->db->where(array('id'=>$user_id))->get('user_registeration')->row_array();
  	    
  	    
  	    $res= $this->am->selectres('category',array('type'=>$users['kyc_type']));
  	    
  	 
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['id']=$row->id;
        $a['category_name']=ucfirst($row->name);
        $a['image']=base_url('uploads/').$row->image;
        
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	}
  	
  	public function get_category_market()
  	{
  	    $user_id= $this->input->post('user_id');
  	  
  	    
  	    $res= $this->am->selectres('category',array('type'=>1));
  	    
  	 
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['id']=$row->id;
        $a['category_name']=ucfirst($row->name);
        $a['image']=base_url('uploads/').$row->image;
        
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	}
  	public function get_brand()
  	{
  	    $user_id= $this->input->post('user_id');
  	  $users=  $this->db->where(array('id'=>$user_id))->get('user_registeration')->row_array();
  	    
  	    $res= $this->am->selectres('brand',array('type'=>$users['kyc_type']));
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['id']=$row->id;
        $a['brand_name']=ucfirst($row->brand_name);
        
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	}
  	
  		public function get_color_list()
  	{
	$res = $this->am->selectres('color');
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['id']=$row->id;
        $a['color_name']=ucfirst($row->color_name);
        
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	}
  	

	
	
	 public function get_subcategory()
  	{
  	    
  	    $category=$this->input->post('category');
    	$res = $this->am->selectres('subcategory',array('category_name'=>$category));
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['id']=$row->id;
		$a['cat_id']=$row->category_name;
		$a['subcategory']=$row->sub_category;
		$a['image']=base_url('uploads/').$row->image;
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	} 
	
	
	 public function get_sub_subcategory()
  	{
  	    
  	   $subcategory=$this->input->post('subcategory');
    	$res = $this->am->selectres('sub_subcategory',array('subcategory'=>$subcategory));
	
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['id']=$row->id;
		$a['sub_subcategory']=$row->sub_subcategory;
			$a['weight']=$row->weight;
			$a['price']=$row->price;
			$a['image']=base_url('uploads/').$row->image;
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	} 
  	
  	
  	
  	 public function get_product()
  	{
     $res = $this->am->selectres('product');
	
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['id']=$row->id;
		$a['product_name']=ucfirst($row->product_name);
		$a['category']=$row->category;
		$a['subcategory']=$row->subcategory;
		$a['sub_subcategory']=$row->sub_subcategory;
		$a['quantity']=$row->quantity;
		$a['weight']=$row->weight;
		$a['description']=$row->description;
		$a['weight']=$row->weight;
		$a['price']=$row->price;
		$a['price2']=$row->price2;
			$a['image']=base_url('uploads/').$row->image;
			$a['image1']=base_url('uploads/').$row->image1;
			$a['image2']=base_url('uploads/').$row->image2;
			$a['image3']=base_url('uploads/').$row->image3;
			$a['video']=base_url('video/').$row->video;
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	} 
  	
  	
  
  	
  	 
   /* public function get_cart_product()
    {
      $b=array();
      $user_id=$this->input->post('user_id');
      $product_id=$this->input->post('product_id');
     
      $res = $this->am->selectres('cart',array("user_id"=>$user_id,'status'=>'1'));
   
    if(!empty($res))
    {
       
    foreach ($res as $row)               
    {

      $result['id']=$row->id;
     $result['user_id']=$row->user_id;
     $res = $this->am->selectrow('product',array('id'=>$row->product_id));
    //   print_r($res);die;
     
        $this->db->select_sum('total_price');
                    $this->db->from('cart');
                    $this->db->where('user_id',$user_id);
                     $this->db->where('status','1');
                    $query=$this->db->get();
                    $amount=$query->row()->total_price;
      
      
                    $grandtotal=$amount*4/100;
                    
                    $grand_total=$grandtotal+$amount;
                    $grand_total = money_format('%!i', $grand_total);
                    $grandtotal=money_format('%!i', $grandtotal);
                    $amount=money_format('%!i', $amount);
                    
            
             $result['product_id']=$row->product_id;     
             $result['product_name']=$res->product_name;
      
      $result['Quantity']=$res->quantity;
      
      $quentiy=$row->quantity;
      $res1 = $this->am->selectrow('brand',array('id'=>$res->brand_name));
      $result['Brand_Name']=$res1->brand_name;
      
     $result['image']=base_url('uploads/').$res->image;
    
      $result['price']=$res->price;
      //$product_price2=$row->price*$row->quantity;
      //$result['product_price2']=money_format('%!i', $product_price2);
      
      
      $sale_offe=$res->quantity;
      $delivery_charge=$res->delivery_charge;
      $product_price=$res->price*$sale_offe+$delivery_charge;

     $result['total_amount']=$product_price;
      $amount +=$row->quantity*$product_price;
  
          array_push($b,$result);
    }
      }
      else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
	    if (!empty($res))
	    {
	        $val= array("status" => "success", "total_amount"=>"$amount", "grand_total_price"=>"$grand_total","services_charge"=>"$grandtotal", "message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
    }*/
  	
  	
  	
  	
  	public function get_cart_product()
    {
      $b=array();
      $user_id=$this->input->post('user_id');
     
      $res = $this->am->selectres('cart',array("user_id"=>$user_id));
      
      
    
    //  print_r($res);die;
  
   
    if(!empty($res))
    {
        $amount=0;
        $delivery_charge=0;
    foreach ($res as $row)               
    {

      $result['id']=$row->id;

     $res = $this->am->selectrow('product',array('id'=>$row->product_id));
     
     
        $this->db->select_sum('price');
        $this->db->from('cart');
        $this->db->where('user_id',$user_id);
        $this->db->where('status','1');
        $query=$this->db->get();
        $query->row()->price;
                   
          
      $result['product_name']=ucfirst($res->product_name);
      $result['product_id']=$row->product_id;

      $result['Description']=$res->description;
      
      $result['image']=base_url('uploads/').$res->image;
      $result['price']=$res->price;
      $result['discount']=$res->discount;
       $result['qty']=$row->quantity;
      $sale_offe=$res->discount;
      $product_price=$res->price*$sale_offe/100;
      
       $sale_offe=$res->price;
       $total_price=$sale_offe-$product_price*$row->quantity;
      $result['product_price']=$total_price;
      
      $amount +=$row->quantity*$total_price;
      
      $delivery_charge +=$res->delivery_charge;
  
          array_push($b,$result);
    }
      }
      if (!empty($res))
      {
          $val= array("status" => "success","total_amount"=>"$amount","delivery_charge"=>$delivery_charge, "message"=>"Record found","data" =>$b);
          $data= json_encode($val);
          echo $data;    
           //echo json_encode($result);
      } 
      else 
      {
            $val= array("status" => "fail","message"=>"Record not found!","data" =>'');
            $data = json_encode($val);                   
            echo $data; 
      } 
    }
  	
  	
  	
  	
  	
  	
  	
  
  	 public function get_product_bysubcategory()
  	{
    	$subcategory=$this->input->post('subcategory');
    	
    	$res1 = $this->am->selectres('sub_subcategory',array('subcategory'=>$subcategory));
    	// print_r($res1);die;
    	
    	if(!empty($res1))
    	{
    	   	foreach ($res1 as $val)		           
		{ 
		    $subcate_id=$val->id;
		    
		    $result = $this->am->selectres('product',array('sub_subcategory'=>$subcate_id));
		   //print_r($subcate_id);die;
	  	}
		 $b=array();
	   if(!empty($result))
	   {
		foreach ($result as $row)		           
		{		           
		$a['id']=$row->id;
		$a['product_name']=$row->product_name;
		$a['category']=$row->category;
		$a['subcategory']=$row->subcategory;
		$a['sub_subcategory']=$row->sub_subcategory;
		$a['quantity']=$row->quantity;
		$a['weight']=$row->weight;
		$a['description']=$row->description;
		$a['weight']=$row->weight;
		$a['price']=$row->price;
		$a['price2']=$row->price2;
			$a['image']=base_url('uploads/').$row->image;
			$a['image1']=base_url('uploads/').$row->image1;
			$a['image2']=base_url('uploads/').$row->image2;
			$a['image3']=base_url('uploads/').$row->image3;
			$a['video']=base_url('video/').$row->video;
	      array_push($b,$a);
		}
      }
	    if (!empty($result))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    { 
	   $res = $this->am->selectres('product',array('subcategory'=>$subcategory));
	  $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['id']=$row->id;
		$a['product_name']=$row->product_name;
		$a['category']=$row->category;
		$a['subcategory']=$row->subcategory;
		$a['sub_subcategory']=$row->sub_subcategory;
		$a['quantity']=$row->quantity;
		$a['weight']=$row->weight;
		$a['description']=$row->description;
		$a['weight']=$row->weight;
		$a['price']=$row->price;
		$a['price2']=$row->price2;
			$a['image']=base_url('uploads/').$row->image;
			$a['image1']=base_url('uploads/').$row->image1;
			$a['image2']=base_url('uploads/').$row->image2;
			$a['image3']=base_url('uploads/').$row->image3;
			$a['video']=base_url('video/').$row->video;
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    }
	    } 
	}
    	
    	else
    	{
    	    
    	    $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
      
  	} 
  	}
  	
  	
  	
  	public function get_user_cartlist()
  	{
  	    
  	   $user_id=$this->input->post('user_id');
    	$res = $this->am->selectres('cart',array('user_id'=>$user_id));
    	
    //	print_r($res);die;
	
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
        	$result['id']=$row->id;
		    $result['user_id']=$row->user_id;
		    $res = $this->am->selectrow('product',array('id'=>$row->product_id));
			$result['product_id']=$row->product_id;
			$result['product_name']=$res->product_name;
			
			$result['product_price']=$res->price*$row->quentity;
				$result['product_price2']=$res->price2*$row->quentity;
				
				
				
				
			$result['product_image']=base_url('uploads/').$res->image;
			$result['quentity']=$row->quentity;
			
	      array_push($b,$result);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	} 
  	
  	
  	public function get_user_profile()
  	{
  	   $user_id=$this->input->post('user_id');
    	$res = $this->am->selectres('user_registeration',array('id'=>$user_id));
	
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{

		     $result['status']="success";
        	$result['user_id']=$row->id;
		    $result['name']=$row->name;
			$result['mobile_no']=$row->mobile_no;
			$result['email']=$row->email;
			$result['image']=$row->image; 
			$result['msg']="record found";
		   // echo json_encode($result);
	        array_push($b,$result);
		}
      }
	    if (!empty($res))
	    {
	         echo json_encode($result);
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>'');
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	} 
  	
  	

public function profile_update()
    {
       	 $user_id=$this->input->post('user_id');
          $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('image'))
      {
        $image=$this->upload->data();
         $upload=base_url('uploads/').$image['file_name'];              
        //echo "file upload success"; die;
      }
      else
      {
        $this->upload->display_errors();  
      }
      
     
	         $data = array(		
			 		'name' => $this->input->post('name'),
			 		'email' => $this->input->post('email'),
                    );
            if(!empty($upload))
            {
                $data['image']=$upload;            
                
            }
           
                 
         	 $this->db->where('id',$user_id);
            $this->db->update('user_registeration',$data);
    	$query = $this->db->get_where('user_registeration', array('id'=>$user_id));
		if($query->num_rows())
		 {
			$row=$query->row(); 
		    $result['status']="success";
			$result['user_id']=$row->id;
		    $result['name']=$row->name;
			//$result['mobile_no']=$row->mobile_no;
			$result['email']=$row->email;
	
	    if(!empty($row->image))
			{
			   	$result['image']=$row->image; 
			}
			else
			{
			   $result['image']=''; 
			}
	    	
			$result['msg']="Profile Update successfully";
		    echo json_encode($result);
         }
   
    }
   
   
   public function get_bysubcategory()
  	{
  	     $b=array();
    	$category=$this->input->post('category');
    	$res1 = $this->am->selectres('subcategory',array('category_name'=>$category));
    	if(!empty($res1))
    	{
    	   	foreach ($res1 as $val)		           
		{ 
		    $subcate_id=$val->id;
		    
		    $result = $this->am->selectres('sub_subcategory',array('subcategory'=>$subcate_id));
		    
		   // echo $this->db->last_query();die;
		   //print_r($subcate_id);die;
    	}
    	}
    	else
    	{
    	    
    	}
		
	   if(empty($result))
	   {
		    $a['status']="success";
	      	$a['message']="record found";
	        $a['type']='child';
		   echo json_encode($a);
      }
	    elseif(!empty($result)) 
	    { 
	        
	        $result['status']="success";
			$result['message']="record found";
			$result['type']='subcategory';
		    echo json_encode($result);

	    } 
    	
  	}
  	
  	
  	   public function get_subcategory_bycatgegory()
    	{
    	    
      	$category=$this->input->post('category');
    	$res1 = $this->am->selectres('subcategory',array('category_name'=>$category));
    	// print_r($res1);die;
    	
    	if(!empty($res1))
    	{
    	   	foreach ($res1 as $val)		           
		{ 
		    $subcate_id=$val->id;
		    
		  
		  // print_r($subcate_id);die;
	  	}
	  	  $result = $this->am->selectres('sub_subcategory',array("subcategory"=>$subcate_id));
		   // echo $this->db->last_query();die;
		 $b=array();
	   if(!empty($result))
	   {
		foreach ($result as $row)		           
		{		           
		 $subcat = $this->am->selectrow('subcategory',array("id"=>$row->subcategory));
		 $cat = $this->am->selectrow('category',array("id"=>$row->category));
		  $a['id']=$subcat->id;
    		$a['category']=$cat->name;
    		$a['subcategory']=$subcat->sub_category;
	      array_push($b,$a);
		}
      }
	    if (!empty($result))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    { 
	    $res = $this->am->selectres('subcategory',array('category_name'=>$category));
	    $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		 $a['id']=$row->id;
		$a['category']=$row->category_name;
		$a['subcategory']=$row->sub_category;
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    }
	    } 
	}
	else
    	{
    	    
    	    $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
      
  	} 
  	}
  	 public function get_allproduct()
  	{
  	  $category=$this->input->post('category');
      $res = $this->am->selectres('product',array('category'=>$category,'sub_subcategory'=>''));
	
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['id']=$row->id;
		$a['product_name']=$row->product_name;
	//	$a['category']=$row->category;
	//	$a['subcategory']=$row->subcategory;
	//	$a['sub_subcategory']=$row->sub_subcategory;
		$a['quantity']=$row->quantity;
		$a['weight']=$row->weight;
	//	$a['description']=$row->description;
		$a['weight']=$row->weight;
		$a['price']=$row->price;
		$a['price2']=$row->price2;
		if(!empty($row->image))
		{
		  $a['image']=base_url('uploads/').$row->image;  
		}
		else
		{
		   $a['image']=""; 
		}
		
		if(!empty($row->image1))
		{
		  $a['image1']=base_url('uploads/').$row->image1;  
		}
		else
		{
		   $a['image1']=""; 
		}
			if(!empty($row->image2))
		{
		  $a['image2']=base_url('uploads/').$row->image2;  
		}
		else
		{
		   $a['image2']=""; 
		}
			if(!empty($row->image3))
		{
		  $a['image3']=base_url('uploads/').$row->image3;  
		}
		else
		{
		   $a['image3']=""; 
		}
			if(!empty($row->image))
		{
		  $a['video']=base_url('video/').$row->video;  
		}
		else
		{
		   $a['video']=""; 
		}
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	} 
  	
  	
  	
  	 public function get_allproduct_by_subcategory()
  	{
  	    
      $subcategory=$this->input->post('subcategory');
      $category=$this->input->post('category');
      $res = $this->am->selectres('product',array('category'=>$category,'subcategory'=>$subcategory,'sub_subcategory'=>'0'));
	
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['id']=$row->id;
		$a['product_name']=$row->product_name;
	//	$a['category']=$row->category;
	//	$a['subcategory']=$row->subcategory;
	//	$a['sub_subcategory']=$row->sub_subcategory;
		$a['quantity']=$row->quantity;
		$a['weight']=$row->weight;
	//	$a['description']=$row->description;
		$a['weight']=$row->weight;
		$a['price']=$row->price;
		$a['price2']=$row->price2;
// 			$a['image']=base_url('uploads/').$row->image;
// 			$a['image1']=base_url('uploads/').$row->image1;
// 			$a['image2']=base_url('uploads/').$row->image2;
// 			$a['image3']=base_url('uploads/').$row->image3;
// 			$a['video']=base_url('video/').$row->video;
		if(!empty($row->image))
		{
		  $a['image']=base_url('uploads/').$row->image;  
		}
		else
		{
		   $a['image']=""; 
		}
		
		if(!empty($row->image1))
		{
		  $a['image1']=base_url('uploads/').$row->image1;  
		}
		else
		{
		   $a['image1']=""; 
		}
			if(!empty($row->image2))
		{
		  $a['image2']=base_url('uploads/').$row->image2;  
		}
		else
		{
		   $a['image2']=""; 
		}
			if(!empty($row->image3))
		{
		  $a['image3']=base_url('uploads/').$row->image3;  
		}
		else
		{
		   $a['image3']=""; 
		}
			if(!empty($row->image))
		{
		  $a['video']=base_url('video/').$row->video;  
		}
		else
		{
		   $a['video']=""; 
		}


	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	} 
  	
  	
  	 public function get_allproduct_bysub_subcategory()
  	{
  	  $sub_subcategory=$this->input->post('sub_subcategory');
      $res = $this->am->selectres('product',array('sub_subcategory'=>$sub_subcategory));

	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['id']=$row->id;
		$a['product_name']=$row->product_name;
	//	$a['category']=$row->category;
	//	$a['subcategory']=$row->subcategory;
	//	$a['sub_subcategory']=$row->sub_subcategory;
		$a['quantity']=$row->quantity;
		$a['weight']=$row->weight;
	//	$a['description']=$row->description;
		$a['weight']=$row->weight;
		$a['price']=$row->price;
		$a['price2']=$row->price2;
// 			$a['image']=base_url('uploads/').$row->image;
// 			$a['image1']=base_url('uploads/').$row->image1;
// 			$a['image2']=base_url('uploads/').$row->image2;
// 			$a['image3']=base_url('uploads/').$row->image3;
// 			$a['video']=base_url('video/').$row->video;

		if(!empty($row->image))
		{
		  $a['image']=base_url('uploads/').$row->image;  
		}
		else
		{
		   $a['image']=""; 
		}
		
		if(!empty($row->image1))
		{
		  $a['image1']=base_url('uploads/').$row->image1;  
		}
		else
		{
		   $a['image1']=""; 
		}
			if(!empty($row->image2))
		{
		  $a['image2']=base_url('uploads/').$row->image2;  
		}
		else
		{
		   $a['image2']=""; 
		}
			if(!empty($row->image3))
		{
		  $a['image3']=base_url('uploads/').$row->image3;  
		}
		else
		{
		   $a['image3']=""; 
		}
			if(!empty($row->image))
		{
		  $a['video']=base_url('video/').$row->video;  
		  //print_r($a);
		  //die();
		}
		else
		{
		   $a['video']="=base_url('video/').$row->video"; 
		}
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	} 
  	
  	 public function check_out_details()
   {
      $user_id = $this->input->post('user_id');
      $b=array();
	  $data = array(
			 		'user_id' => $this->input->post('user_id'),
			 //		'status' =>'0',
			         'status' =>'1',
                   );
                //  print_r($data);die;
                     $this->db->where('user_id',$user_id);
                     //$this->db->where('status','0');
                    $this->db->update('cart',$data);
                    
                  //  echo $this->db->last_query();die;
                    
 	$query = $this->db->get_where('cart', array('user_id'=>$user_id));
		if($query->num_rows())
		 {
			$row=$query->row(); 
		    $result['status']="success";
		    $result['user_id']=$row->user_id;
			$result['msg']="Details Check out successfully";
		    echo json_encode($result);
         }
         else
         {
             $result['status']="fail";
		  //  $result['user_id']=$row->user_id;
			$result['msg']="record not found";
		    echo json_encode($result); 
         }
     }
     
     
     public function update_product_quentity()
   {
      $user_id = $this->input->post('user_id');
      $product_id = $this->input->post('product_id');
      $quentity = $this->input->post('quentity');
      $price = $this->input->post('price');
      
      $res = $this->am->selectrow('product',array('id'=>$product_id));
       
	   $weight=$res->weight;
       
       $total_price=$price*$quentity;
       
       $total_weight=$weight*$quentity;
     
       
      
      $b=array();
	  $data = array(
			 		'user_id' => $this->input->post('user_id'),
			 		'quentity' => $this->input->post('quentity'),
			 		'price' => $this->input->post('price'),
			 		 'status' =>'1',
			 		 'total_price'=>$total_price,
			 		 'total_weight'=>$total_weight,
                   );
                 // print_r($data);die;
                     $this->db->where('user_id',$user_id);
                     $this->db->where('product_id',$product_id);
                     $this->db->where('status','1');
                    $this->db->update('cart',$data);
                    
                  // echo $this->db->last_query();die;
                    
 	    $query = $this->db->get_where('cart', array('user_id'=>$user_id,'product_id'=>$product_id));
		if($query->num_rows())
		 {
			$row=$query->row(); 
		    $result['status']="success";
		    $result['user_id']=$row->user_id;
		     $result['product_id']=$row->product_id;
		      $res = $this->am->selectrow('product',array('id'=>$row->product_id));
		     $weight=$res->weight;
		     $quentiy=$row->quentity;
		     $total_weight=$weight*$quentiy;
		     $result['weight']="$total_weight";
			$result['quentity']=$row->quentity;
			
		    $result['quentity']=$row->quentity;
		    $result['product_price']=$row->price;
		 	$result['product_price2']=$row->price*$row->quentity;
			$result['msg']="Details Check out successfully";
		    echo json_encode($result);
         }
         else
         {
             $result['status']="fail";
		  //  $result['user_id']=$row->user_id;
			$result['msg']="record not found";
		    echo json_encode($result); 
         }
     }
     
     	public function get_user_cart_history()
  	{
  	    
  	   $user_id=$this->input->post('user_id');
    	$res = $this->am->selectres('cart',array('user_id'=>$user_id,'status'=>'0'));
    	
    //	print_r($res);die;
	
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
        	$result['id']=$row->id;
		    $result['user_id']=$row->user_id;
		    $res = $this->am->selectrow('product',array('id'=>$row->product_id));
			$result['product_id']=$row->product_id;
			$result['product_name']=$res->product_name;
			$weight=$res->weight;
			$result['quentity']=$row->quentity;
		     $quentiy=$row->quentity;
		     $total_weight=$weight*$quentiy;
		     $result['weight']="$total_weight";
			 $this->db->select_sum('total_price');
                    $this->db->from('cart');
                    $this->db->where('user_id',$user_id);
                     $this->db->where('status','1');
                    $query=$this->db->get();
                    $amount=$query->row()->total_price;
                    

             $grand_total=$amount*4/100;
			$product_price=$res->price*$row->quentity;
		    $product_price2=$res->price2*$row->quentity;
// 			$result['product_price']="$product_price";
            $result['product_price']=money_format('%!i', $product_price);
		  //  $result['product_price2']="$amount";
		   $result['product_price2']=money_format('%!i', $amount);
			$result['product_image']=base_url('uploads/').$res->image;
			$result['quentity']=$row->quentity;
				$result['date']=$row->date;
			
	      array_push($b,$result);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	} 
  	
  	
  	//==============================new============================//
  	
  	
  	 public function register()
   {
       $user_id=$this->input->post('user_id');
	  	//  $upload="";
    //       $config = array('upload_path' =>'./uploads/', 
    //             'allowed_types' => "gif|jpg|png|jpeg|mp4",
    //               'overwrite' => TRUE    
    //             );
    //   $this->load->library('upload',$config);
    //   if($this->upload->do_upload('image'))
    //   {
    //     $banner=$this->upload->data();
    //     $upload=$banner['file_name'];              
    //       //echo "file upload success";
    //   }
    //   else
    //   {
    //     $data['imageError']= $this->upload->display_errors();  
    //   }    
    
    if($this->input->post('name')){
	  	 $upload=$this->input->post('image');
	  	 $img=base64_decode($upload);
	  	 $imgname=$this->input->post('name');
	  	 $upload_url="uploads/".$imgname.".jpg";
	  	 $upload_ur="./uploads/".$imgname.".jpg";
        file_put_contents($upload_ur,$img);
	   $data = array(		
			 		'name' => $this->input->post('name'),
			 		'mobile_no' => $this->input->post('mobile_no'),
			 		'email' => $this->input->post('email'),
			     	'call_type' => $this->input->post('call_type'),
			     	'type' => $this->input->post('type'),
			     	'date'=>date('d-m-Y'),
				 	'image' =>$upload_url,
                    );
                  // print_r($data);die;
          $member = $this->am->insert('users',$data);
          // echo $this->db->last_query();die;
           $last_id = $this->db->insert_id();
 	$query = $this->db->get_where('users', array('id'=>$last_id));
		if($query->num_rows())
		 {
			$row=$query->row(); 
		    $result['status']="success";
			$result['id']=$row->id;
			$result['name']=$row->name;
			$result['email']=$row->email;
				$result['mobile_no']=$row->mobile_no;
					$result['type']=$row->type;
						$result['call_type']=$row->call_type;
	    	$result['image']=$upload_url;
        //	$result['image']=$row->image;
			$result['msg']="register save successfully";
		    echo json_encode($result);
       
       }
       }
   }
     
    	 public function get_seller_image_ecomm()
  	{
  	    
  	   $user_id=$this->input->post('user_id');
  	   $type= $this->input->post('kyc_type');
  	   
       $user =$this->db->where(array('id'=>$user_id))->get('user_registeration')->row_array();
 
 //print_r($user);die();
    	$res = $this->db->select('seller_product.*')->where(array('user_registeration.kyc_type'=>$type,'seller_product.type'=>2))->join('user_registeration','user_registeration.id=seller_product.user_id','left')->order_by('id','desc')->get('seller_product')->result();
    
	
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['user_id']=$row->user_id;
		 $query=$this->db->where(array('user_id'=>$user_id,'product_id'=>$row->id))->get('tbl_wishlish');
                   $count = $query->num_rows();
         $query=$this->db->where(array('product_id'=>$row->id))->get('product_view');
                   $views_count = $query->num_rows();
                   
		
		if($count){
		    $a['wishlist_status']="1";
		}else{
		     $a['wishlist_status']="0";
		}
		$a['views_count']="$views_count";
		/*$a['sub_subcategory']=$row->sub_subcategory;
			$a['weight']=$row->weight;
			$a['price']=$row->price;*/
			$a['product_id']=$row->id;
			$a['product_name']=ucfirst($row->product_name);
			if(!empty($row->image))
               {
                 $result['image']=base_url().$row->image;
               }
               else{
                 $result['image']="";
               }
			//$a['image']=base_url().$row->image;
			
			
			if(!empty($row->image1))
               {
                 $result['image1']=base_url().$row->image1;
               }
               else{
                 $result['image1']="";
               }
		//	$a['image1']=base_url().$row->image1;
		
		if(!empty($row->image2))
               {
                 $result['image2']=base_url().$row->image2;
               }
               else{
                 $result['image2']="";
               }
		//	$a['image2']=base_url().$row->image2;
			$a['count']="";
		
			
			if(!empty($row->image))
			{
			    $a['image']=base_url().$row->image;
			}
			else
			{
			    $a['image'] = "";
			}
			if(!empty($row->image1))
			{
			    $a['image1']=base_url().$row->image1;
			}
			else
			{
			    $a['image1']="";
			}
			if(!empty($row->image2))
			{
			    $a['image2']=base_url().$row->image2;
			}
			else
			{
			 $a ['image2']= "";   
			}
		   $a['product_url']=base_url('product_details/').$row->slug;
			
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	} 
  	
  	public function get_seller_image_grocery()
  	{
  	    
  	   $user_id=$this->input->post('user_id');
  	   $type= $this->input->post('kyc_type');
  	   
  	     
  	   //$product_id=$this->input->post('product_id');
     
    	$latitude= $this->input->post('lat')?$this->input->post('lat'):'28.6389057';
    	$longitude=$this->input->post('lng')?$this->input->post('lng'):'77.4814559';
    	$distance_km=115;
    	  $radius_km = $distance_km; 
    $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
     
    $having = " HAVING (distance <= $radius_km) "; 
     
    $order_by = 'distance ASC '; 
 
 
// Fetch places from the database 
  $sql = "SELECT user.*,seller_product.*".$sql_distance." FROM user_registeration  user INNER JOIN seller_product
ON seller_product.user_id = user.id where user.kyc_type=2 && seller_product.type=2 $having ORDER BY $order_by"; 

 $res=$this->db->query($sql)->result(); 
    	

	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['user_id']=$row->user_id;
		 $query=$this->db->where(array('user_id'=>$user_id,'product_id'=>$row->id))->get('tbl_wishlish');
                   $count = $query->num_rows();
         $query=$this->db->where(array('product_id'=>$row->id))->get('product_view');
                   $views_count = $query->num_rows();
                   
		
		if($count){
		    $a['wishlist_status']="1";
		}else{
		     $a['wishlist_status']="0";
		}
		$a['views_count']="$views_count";
		/*$a['sub_subcategory']=$row->sub_subcategory;
			$a['weight']=$row->weight;
			$a['price']=$row->price;*/
			$a['product_id']=$row->id;
			$a['product_name']=ucfirst($row->product_name);
			if(!empty($row->image))
               {
                 $result['image']=base_url().$row->image;
               }
               else{
                 $result['image']="";
               }
			//$a['image']=base_url().$row->image;
			
			
			if(!empty($row->image1))
               {
                 $result['image1']=base_url().$row->image1;
               }
               else{
                 $result['image1']="";
               }
		//	$a['image1']=base_url().$row->image1;
		
		if(!empty($row->image2))
               {
                 $result['image2']=base_url().$row->image2;
               }
               else{
                 $result['image2']="";
               }
		//	$a['image2']=base_url().$row->image2;
			$a['count']="";
		
			
			if(!empty($row->image))
			{
			    $a['image']=base_url().$row->image;
			}
			else
			{
			    $a['image'] = "";
			}
			if(!empty($row->image1))
			{
			    $a['image1']=base_url().$row->image1;
			}
			else
			{
			    $a['image1']="";
			}
			if(!empty($row->image2))
			{
			    $a['image2']=base_url().$row->image2;
			}
			else
			{
			 $a ['image2']= "";   
			}
			$a['product_url']=base_url('product_details/').$row->slug;
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	   
  	   
  	   
  	   
  	   
  	   
  	   
       
  	}
  	
  	public function get_seller_image_fresh()
  	{
  	    
  	   $user_id=$this->input->post('user_id');
  	   $type= $this->input->post('kyc_type');
  	   
  	     
  	   //$product_id=$this->input->post('product_id');
     
    	$latitude= $this->input->post('lat')?$this->input->post('lat'):'28.6389057';
    	$longitude=$this->input->post('lng')?$this->input->post('lng'):'77.4814559';
    	
    	
    	$distance_km=115;
    	  $radius_km = $distance_km; 
    $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
     
    $having = " HAVING (distance <= $radius_km) "; 
     
    $order_by = 'distance ASC '; 
 
 
// Fetch places from the database 
  $sql = "SELECT user.*,seller_product.*".$sql_distance." FROM user_registeration  user INNER JOIN seller_product
ON seller_product.user_id = user.id where user.kyc_type=3 && seller_product.type=2 $having ORDER BY $order_by"; 

 $res=$this->db->query($sql)->result(); 
    	

	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['user_id']=$row->user_id;
		 $query=$this->db->where(array('user_id'=>$user_id,'product_id'=>$row->id))->get('tbl_wishlish');
                   $count = $query->num_rows();
         $query=$this->db->where(array('product_id'=>$row->id))->get('product_view');
                   $views_count = $query->num_rows();
                   
		
		if($count){
		    $a['wishlist_status']="1";
		}else{
		     $a['wishlist_status']="0";
		}
		$a['views_count']="$views_count";
		/*$a['sub_subcategory']=$row->sub_subcategory;
			$a['weight']=$row->weight;
			$a['price']=$row->price;*/
			$a['product_id']=$row->id;
			$a['product_name']=ucfirst($row->product_name);
			if(!empty($row->image))
               {
                 $result['image']=base_url().$row->image;
               }
               else{
                 $result['image']="";
               }
			//$a['image']=base_url().$row->image;
			
			
			if(!empty($row->image1))
               {
                 $result['image1']=base_url().$row->image1;
               }
               else{
                 $result['image1']="";
               }
		//	$a['image1']=base_url().$row->image1;
		
		if(!empty($row->image2))
               {
                 $result['image2']=base_url().$row->image2;
               }
               else{
                 $result['image2']="";
               }
		//	$a['image2']=base_url().$row->image2;
			$a['count']="";
		
			
			if(!empty($row->image))
			{
			    $a['image']=base_url().$row->image;
			}
			else
			{
			    $a['image'] = "";
			}
			if(!empty($row->image1))
			{
			    $a['image1']=base_url().$row->image1;
			}
			else
			{
			    $a['image1']="";
			}
			if(!empty($row->image2))
			{
			    $a['image2']=base_url().$row->image2;
			}
			else
			{
			 $a ['image2']= "";   
			}
			$a['product_url']=base_url('product_details/').$row->slug;
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	   
  	   
       
  	}
  	    
  	    public function get_seller_image1()
  	{
  	    
  	   $user_id=$this->input->post('user_id');
  	   //$product_id=$this->input->post('product_id');
    	$res = $this->am->selectres('seller_product',array('type'=>2));
    	$latitude='28.6389057';
    	$longitude='77.4814559';
    	$distance_km=5;
    	  $radius_km = $distance_km; 
    $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
     
    $having = " HAVING (distance <= $radius_km) "; 
     
    $order_by = 'distance ASC '; 
 
 
// Fetch places from the database 
  $sql = "SELECT user.*".$sql_distance." FROM user_registeration  user INNER JOIN seller_product
ON seller_product.user_id = user.id $having ORDER BY $order_by"; 

$query = $this->db->query($sql)->result(); 
    	
	
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['user_id']=$row->user_id;
		 $query=$this->db->where(array('user_id'=>$user_id,'product_id'=>$row->id))->get('tbl_wishlish');
                   $count = $query->num_rows();
         $query=$this->db->where(array('product_id'=>$row->id))->get('product_view');
                   $views_count = $query->num_rows();
                   
		
		if($count){
		    $a['wishlist_status']="1";
		}else{
		     $a['wishlist_status']="0";
		}
		$a['views_count']="$views_count";
		/*$a['sub_subcategory']=$row->sub_subcategory;
			$a['weight']=$row->weight;
			$a['price']=$row->price;*/
			$a['product_id']=$row->id;
			$a['product_name']=ucfirst($row->product_name);
			if(!empty($row->image))
               {
                 $result['image']=base_url().$row->image;
               }
               else{
                 $result['image']="";
               }
			//$a['image']=base_url().$row->image;
			
			
			if(!empty($row->image1))
               {
                 $result['image1']=base_url().$row->image1;
               }
               else{
                 $result['image1']="";
               }
		//	$a['image1']=base_url().$row->image1;
		
		if(!empty($row->image2))
               {
                 $result['image2']=base_url().$row->image2;
               }
               else{
                 $result['image2']="";
               }
		//	$a['image2']=base_url().$row->image2;
			$a['count']="";
		
			
			if(!empty($row->image))
			{
			    $a['image']=base_url().$row->image;
			}
			else
			{
			    $a['image'] = "";
			}
			if(!empty($row->image1))
			{
			    $a['image1']=base_url().$row->image1;
			}
			else
			{
			    $a['image1']="";
			}
			if(!empty($row->image2))
			{
			    $a['image2']=base_url().$row->image2;
			}
			else
			{
			 $a ['image2']= "";   
			}
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	} 
  	    
  	    
  	    
  	    
  	    
  	    
  	    
  	    
  	    
  	    	 
  	    	 
  	
  	public function get_seller_video()
  	{
  	   
  	   $user_id=$this->input->post('user_id');
  	   $product_id=$this->input->post('product_id');
  	  
  	  
  	   
       //$res = $this->am->selectres('seller_product',array('id'=>$product_id));
       
       $res = $this->db->select('seller_product.*')->where(array('seller_product.id'=>$product_id))->join('category', 'seller_product.category=category.id')->get('seller_product')->result();
	 //echo $this->db->last_query();
	 $b=array();
	  if(!empty($res))
	  {
	     
		foreach ($res as $row)		           
		{	
		    
		$category_id=$row->category; 
		$a['user_id']=$row->user_id;
	    $a['product_id']=$row->id;
	    $query=$this->db->where(array('product_id'=>$product_id))->get('tbl_wishlish');
                   $count = $query->num_rows();
         $num_rows1=$this->db->where(array('user_id'=>$user_id,'product_id'=>$row->id))->get('tbl_wishlish');
                  $count1 = $num_rows1->num_rows();
                  
         $q=$this->db->where(array('user_id'=>$user_id,'product_id'=>$product_id))->get('product_view');
         if($q->num_rows()==0)
         {
            
             $data = array(
                 'user_id'=>$this->input->post('user_id'),
                 'product_id'=>$this->input->post('product_id'),
                 'status'=>1,
                 );
             	$member = $this->am->insert('product_view',$data);
         
         }
                  
		if($count1){
		    $a['wishlist_status']="1";
		}else{
		     $a['wishlist_status']="0";
		}
            $a['wishlist_count']="$count";       
			$a['product_name']=ucfirst($row->product_name);
			$a['price']=$row->price;
			//$a['category']=$row->category;
			


$offer=$row->price;
$offer2=$row->discount;
$product_price=$row->price*$offer2/100;
$comision_price=$offer-$product_price; 


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
     
       $offer1=$row->delivery_charge;
       $total_price=$offer-$product_price+$offer1+$value;
       
       
			
                /*$offer=$row->discount;
                $product_price=round(($row->price*$offer)/100);
                $offer=$row->price;
               $total_price=$offer-$product_price;*/
               
            $a['product_price']=round($total_price);
            $a['quantity']=$row->quantity;
			$a['description']=ucfirst($row->description);
			$a['video']=base_url().$row->video;
			$a['count']="";
			$a['product_url']=base_url('product_details/').$row->slug;
			
			
			if(!empty($row->video))
		{
		  $a['video']=base_url().$row->video;  
		}
		else
		{
		   $a['video']=""; 
		}
		 
		
	      array_push($b,$a);
		}
      }
      
        $result = $this->db->select('seller_product.*, category.name as category, category.id as cat_id')->where(array('category.id'=>$category_id,'seller_product.id !='=>$product_id))->join('category', 'seller_product.category=category.id')->get('seller_product')->result();
      
      	 $all_related=array();
	  if(!empty($result))
	  {
		foreach ($result as $row)		           
		{		           
		$a['user_id']=$row->user_id;
	    $a['product_id']=$row->id;
	    $query=$this->db->where(array('product_id'=>$row->id))->get('tbl_wishlish');
                   $count = $query->num_rows();
         $num_rows1=$this->db->where(array('user_id'=>$user_id,'product_id'=>$row->id))->get('tbl_wishlish');
                  $count1 = $num_rows1->num_rows();
                  
         $q=$this->db->where(array('user_id'=>$user_id,'product_id'=>$product_id))->get('product_view');
         if($q->num_rows()==0)
         {
            
             $data = array(
                 'user_id'=>$this->input->post('user_id'),
                 'product_id'=>$this->input->post('product_id'),
                 'status'=>1,
                 );
             	$member = $this->am->insert('product_view',$data);
         
         }
                  
		if($count1){
		    $a['wishlist_status']="1";
		}else{
		     $a['wishlist_status']="0";
		}
            $a['wishlist_count']="$count";       
			$a['product_name']=ucfirst($row->product_name);
			$a['price']=$row->price;
			//$a['category']=$row->category;
			


$offer=$row->price;
$offer2=$row->discount;
$product_price=$row->price*$offer2/100;
$comision_price=$offer-$product_price; 


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
     
       $offer1=$row->delivery_charge;
       $total_price=$offer-$product_price+$offer1+$value;
       
       
			
                /*$offer=$row->discount;
                $product_price=round(($row->price*$offer)/100);
                $offer=$row->price;
               $total_price=$offer-$product_price;*/
               
            $a['product_price']=round($total_price);
            $a['quantity']=$row->quantity;
			$a['description']=ucfirst($row->description);
			$a['video']=base_url().$row->video;
			$a['count']="";
			$a['product_url']=base_url('product_details/').$row->slug;
			
			
			if(!empty($row->video))
		{
		  $a['video']=base_url().$row->video;  
		}
		else
		{
		   $a['video']=""; 
		}
		 
		
	      array_push($all_related,$a);
		}
      }
      
      
    $c=array_merge($b,$all_related); 
      
      
      
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$c);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	} 
    
    
    
    public function single_seller_video()
    {
        $user_id = $this->input->post('user_id');
        /*$res = $this->am->selectres('seller_product',array('user_id'=>$user_id, 'type'=>2));*/
        $res= $this->db->select('seller_product.*, brand.brand_name as brand_name, category.name as category')->where(array('user_id'=>$user_id, 'seller_product.type'=>2))
        ->join('brand','brand.id=seller_product.brand_name','left')
        ->join('category','category.id=seller_product.category','left')
        ->get('seller_product')->result();
        //print_r($res);
        $b= array();
        if(!empty($res))
        {
            foreach($res as $row)
            {
                $a['user_id']=$user_id;
                $a['product_id']=$row->id;
                
                $query=$this->db->where(array('product_id'=>$row->id))->get('tbl_wishlish');
                   $count = $query->num_rows();
                   
                    $query2=$this->db->where(array('product_id'=>$row->id))->get('product_view');
                   $views_count = $query2->num_rows();
        /* $num_rows1=$this->db->where(array('user_id'=>$user_id,'product_id'=>$row->id))->get('tbl_wishlish');
                  $count1 = $num_rows1->num_rows();
                  if($count1){
		    $a['wishlist_status']="1";
		}else{
		     $a['wishlist_status']="0";
		}*/
                //$a['wishlist_count']="$count"; 
                $a['product_name']=$row->product_name;
                $a['brand_name']=$row->brand_name?$row->brand_name:'';
                $a['category']=$row->category?$row->category:'';
                $a['height']=$row->height;
                $a['weight']=$row->weight;
                $a['length']=$row->length;
                $a['width']=$row->width;
                $a['color']=$row->color;
                $a['price']=$row->price;
                $a['discount']=$row->discount;
                $a['other_offer']=$row->other_offer;
                $offer=$row->discount;
                $product_price=($row->price*$offer)/100;
                $offer=$row->price;
               $total_price=$offer-$product_price;
                $a['total_price']="$total_price";
                $a['speciality']=$row->speciality;
                $a['description']=$row->description;
                $a['other_varient']=$row->other_varient;
                $a['country']=$row->country;
                $a['type']=$row->kyc_type;
                $a['product_view']="$views_count";
                //$a['video']=base_url().$row->video;
                //$a['description']=$row->description;
                //$a['count']="";
                
            if(!empty($row->image))
		{
		  $a['image']=base_url().$row->image;  
		}
		else
		{
		   $a['image']=""; 
		}
		
		 if(!empty($row->image1))
		{
		  $a['image1']=base_url().$row->image1;  
		}
		else
		{
		   $a['image1']=""; 
		}
		 if(!empty($row->image2))
		{
		  $a['image2']=base_url().$row->image2;  
		}
		else
		{
		   $a['image2']=""; 
		}
		
		if(!empty($row->video))
		{
		  $a['video']=base_url().$row->video;  
		}
		else
		{
		   $a['video']=""; 
		}
		
		if($row->status==1)
            {
                $a['status']="Pending";
            }
            
            elseif ($row->status==2)
            {
                $a['status']="Shipped";
            }
             elseif ($row->status==3)
            {
                $a['status']="Out of Delivery";
            }
            elseif ($row->status==4)
            {
                $a['status']="Delivered";
            }
            else
            {
                $a['status']="Cancelled";
            }
		$a['product_url']=base_url('/product_details/').$row->slug;
		
	      array_push($b,$a);
               
            }
        }
        
        if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
        
    }
    
    public function delete_single_seller_video()
  	{
  	    $a=array();
  	    $user_id=$this->input->post('user_id');
  	    $product_id=$this->input->post('product_id');
  	    $res = $this->am->selectrow('seller_product',array("id"=>$product_id,"user_id"=>$user_id));
  	    $res1 = $this->db->delete('seller_product',array("id"=>$product_id,"user_id"=>$user_id));
  	    if(!empty($res))
  	    {
  	        $val= array("status" => "success","message"=>"Deleted successfully");
          $data= json_encode($val);
          echo $data; 
  	    }
  	     else 
      {
            $val= array("status" => "fail","message"=>"Some thing went wrong");
            $data = json_encode($val);                   
            echo $data; 
      } 
  	    
  	    
  	}
    

    public function get_product_by_category()
    {
      $b=array();
      $category=$this->input->post('category');
      $res = $this->am->selectres('seller_product',array("category"=>$category,"type"=>1));
   
    if(!empty($res))
    {
    foreach ($res as $row)               
    {

      $result['id']=$row->id;

     $res1 = $this->am->selectrow('seller_product',array('id'=>$row->id));
      
      $result['product_name']=$res1->product_name;
      
      
      
$offer2=$row->discount;
$offer=$row->price;
$product_price=$row->price*$offer2/100;
$comision_price=$offer-$product_price; 

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
      
       $offer1=$row->delivery_charge;
       $total_price=$offer-$product_price+$offer1+$value;
  
      //$result['discount']=$row->discount;
      $result['price']="$total_price";
      $result['image']=base_url().$res1->image;
      $res = $this->am->selectrow('brand',array('id'=>$row->brand_name));
       if(!empty($res)){
      $result['brand_name']=$res->brand_name;
       }else{
           $result['brand_name']='';
       }
          array_push($b,$result);
    }
      }
      if (!empty($res1))
      {
          $val= array("status" => "success","message"=>"record found","data" =>$b);
          $data= json_encode($val);
          echo $data;    
           //echo json_encode($result);
      } 
      else 
      {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);                   
            echo $data; 
      } 
    } 
     
     
       	 public function add_cart()
   {
       
      $product_id = $this->input->post('product_id');
      $user_id = $this->input->post('user_id');
       
      $res = $this->am->selectrow('cart',array("product_id"=>$product_id,"user_id"=>$user_id));
      
     if(!empty($res))
     {
           $data = array(		
			 		'product_id' => $this->input->post('product_id'),
			 		'user_id'=> $this->input->post('user_id'),
			 		'color'=> $this->input->post('color'),
			 		'price'=> $this->input->post('price'),
			 		'size'=> $this->input->post('size'),
			 		'quantity'=> $this->input->post('quantity'),
                   );
                   
                    $qty_get= $this->db->where(array('user_id'=> $this->input->post('user_id'),'product_id'=>$product_id))->get('cart')->row_array();
                
                     $this->db->where('user_id',$user_id);
                     $this->db->where('product_id',$product_id);
                     $this->db->update('cart',$data);
                    
      $query = $this->db->get_where('cart', array('user_id'=>$user_id,'product_id'=>$product_id));
		if($query->num_rows())
		 {
			$row=$query->row(); 
		    $result['status']="success";
			$price=$res->price;
		     $quantity=$row->quantity;
		     $total_price=$price*$quantity;
			$result['product_id']=$row->product_id;
		    $result['user_id']=$row->user_id;
		    $result['color']=$row->color;
		    $result['size']=$row->size;
		    $result['quantity']=$row->quantity;
		    $result['price']=$row->price;
			$result['msg']="Cart added successfully!";
		    echo json_encode($result);
         }
                            
     }
     else{
       
      $b=array();
	  $data = array(		
			 		'product_id' => $this->input->post('product_id'),
			 		'user_id'=> $this->input->post('user_id'),
			 		'color'=> $this->input->post('color'),
			 		'price'=> $this->input->post('price'),
			 		'date'=>date('d-m-Y'),
			 		'quantity'=>$this->input->post('quantity')
			 		 
                   );
                  // print_r($data);die;
 	$member = $this->am->insert('cart',$data);
 	$last_id = $this->db->insert_id();
 	$query = $this->db->get_where('cart', array('id'=>$last_id));
		if($query->num_rows())
		 {
			$row=$query->row(); 
		    $result['status']="success";
			$result['id']=$row->id;
			$result['product_id']=$row->product_id;
			$result['user_id']=$row->user_id;
			$result['color']=$row->color;
			$result['quantity']=$row->quantity;
			$result['price']=$row->price;
			$result['size']=$row->size;
			
			/*$res = $this->am->selectrow('product',array('id'=>$row->product_id));
			$result['quantity']=$row->quantity;
			$result['price']=$row->price;*/
			$result['msg']="Cart added successfully";
		    echo json_encode($result);
         }
     }

     }
     
    
    
     public function update_cart_qty()
   {
       
      $product_id = $this->input->post('product_id');
      $user_id = $this->input->post('user_id');
       
      $res = $this->am->selectrow('cart',array("product_id"=>$product_id,"user_id"=>$user_id));
      
     if(!empty($res))
     {
           $data = array(		
			 		'product_id' => $this->input->post('product_id'),
			 		'user_id'=> $this->input->post('user_id'),
			 
                   );
                   
                   $type = $this->input->post('type');
             $qty_get= $this->db->where(array('user_id'=> $this->input->post('user_id'),'product_id'=>$product_id))->get('cart')->row_array();
             
             if($type=='plus'){
                  
                  $qty= $qty_get['quantity']+1;
                  
                   $this->db->set('quantity',$qty, true);
                 
             }else{
                 
                  $qty= $qty_get['quantity']-1;
                   $this->db->set('quantity',$qty, true);
                  if($qty==0){
                      
                      $this->db->where('user_id', $user_id);
                      $this->db->where('product_id', $product_id);
                      $this->db->delete('cart');
                      $result['status']="fail";
                      $result['msg']="Cart deleted successfully!";
                      echo json_encode($result);
                      
                  }
             }
                  
                  
                     $this->db->where('user_id',$user_id);
                     $this->db->where('product_id',$product_id);
                     $this->db->update('cart',$data);
                    
      $query = $this->db->get_where('cart', array('user_id'=>$user_id,'product_id'=>$product_id));
		if($query->num_rows())
		 {
			$row=$query->row(); 
		    $result['status']="success";
		 
			$price=$res->price;
		     $quantity=$row->quantity;
		     $total_price=$price*$quantity;
		     
			$result['product_id']=$row->product_id;
		    $result['user_id']=$row->user_id;
		    $result['color']=$row->color;
		    $result['size']=$row->size;
		    $result['quantity']=$row->quantity;
		    
		    $result['price']=$row->price;
		   
			$result['msg']="Cart added successfully!";
		    echo json_encode($result);
         }
                            
     }
     else{
       
      $b=array();
	  $data = array(		
			 		'product_id' => $this->input->post('product_id'),
			 		'user_id'=> $this->input->post('user_id'),
			 		'color'=> $this->input->post('color'),
			 		'price'=> $this->input->post('price'),
			 		'date'=>date('d-m-Y'),
			 		'quantity'=>1
			 		 
                   );
                  // print_r($data);die;
 	$member = $this->am->insert('cart',$data);
 	$last_id = $this->db->insert_id();
 	$query = $this->db->get_where('cart', array('id'=>$last_id));
		if($query->num_rows())
		 {
			$row=$query->row(); 
		    $result['status']="success";
			$result['id']=$row->id;
			$result['product_id']=$row->product_id;
			$result['user_id']=$row->user_id;
			$result['color']=$row->color;
			$result['quantity']=$row->quantity;
			$result['price']=$row->price;
			$result['size']=$row->size;
			
			$res = $this->am->selectrow('seller_product',array('id'=>$row->product_id));
			$result['quantity']=$row->quantity;
			$result['price']=$row->price;
			$result['msg']="Cart added successfully";
		    echo json_encode($result);
         }
     }

     }
     
     
       	public function get_seller_product_details()
  	{
  	   $product_id=$this->input->post('product_id');
  	   $address_id=$this->input->post('address_id');
  	   
    	$res = $this->am->selectres('seller_product',array('id'=>$product_id));
	
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)	
		
		{  
		    
		    
    		$color= explode('Taudu',$row->color);
    		if($row->color){
            $array1=array();
            
            foreach ($color as $key => $value) { 
            	 $colors[] = (object)['color'=>$value];
            } 
    		}else{
    		    $colors=[];
    		}
		    
		    	$other= explode('Taudu',$row->other_varient);
    		if($row->other_varient){
            $array1=array();
            
            foreach ($other as $key => $value) { 
            	 $others[] = (object)['other_varient'=>$value];
            } 
    		}else{
    		    $others=[];
    		}
    		
    		$brand=$this->db->where(array('id'=>$row->brand_name))->get('brand')->row_array();
		    
		    $result['status']="success";
        	$result['product_id']=$row->id;
        	$result['stock']=$row->stock;
		    $result['product_name']=$row->product_name;
			$result['brand_name']=$brand['brand_name']?$brand['brand_name']:'';
			$result['speciality']=$row->speciality;
			$result['description']=$row->description; 
			$result['price']=$row->price;
			$result['delivery_charge']=$row->delivery_charge;
			$result['color']=$colors;
			$result['other_varient']=$others;
			
		
$offer2=$row->discount;
$offer=$row->price;
$product_price=$row->price*$offer2/100;
$comision_price=$offer-$product_price; 

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

       $offer1=$row->delivery_charge;
       
       $total_price=$offer-$product_price+$offer1+$value;
  
      //$result['discount']=$row->discount;
      $result['product_price']=round($total_price);
      $result['other_offer']=$row->other_offer;
      	$result['msg']="record found";
	
		   // echo json_encode($result);
	        array_push($b,$result);
		}
      }
	    if (!empty($res))
	    {
	         echo json_encode($result);
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>'');
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	}
  	
public function get_image()
  	{
  	    
  	   $product_id=$this->input->post('product_id');
  	   //$product_id=$this->input->post('product_id');
    	$res = $this->am->selectres('seller_product',array('id'=>$product_id));
	
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		  //$a['product_id']=$row->id;
		/*$a['sub_subcategory']=$row->sub_subcategory;
			$a['weight']=$row->weight;
			$a['price']=$row->price;*/
			$a['product_id']=$row->id;
			//$a['product_name']=$row->product_name;
			if(!empty($row->image))
               {
                 $result['image']=base_url().$row->image;
               }
               else{
                 $result['profile_image']="";
               }
		//	$a['image']=base_url('uploads/').$row->image;
		
			if(!empty($row->image1))
               {
                 $result['image1']=base_url().$row->image;
               }
               else{
                 $result['image1']="";
               }
               
		//	$a['image1']=base_url('uploads/').$row->image1;
		
			if(!empty($row->image2))
               {
                 $result['image2']=base_url().$row->image2;
               }
               else{
                 $result['image2']="";
               }
			//$a['image2']=base_url('uploads/').$row->image2;
		    
			   
			if(!empty($row->image))
			{
			    $a['image']=base_url().$row->image;
			}
			else
			{
			    $a['image'] = "";
			}
			if(!empty($row->image1))
			{
			    $a['image1']=base_url().$row->image1;
			}
			else
			{
			    $a['image1']="";
			}
			if(!empty($row->image2))
			{
			    $a['image2']=base_url().$row->image2;
			}
			else
			{
			 $a ['image2']= "";   
			}
	      array_push($b,$a);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;      
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	}
  	
  	
  	
  	//add_address_API
  	
  	public function add_address()
  	{
  	    $user_id=$this->input->post('user_id');
  	    $data = array(
  	        
  	        'user_id' => $this->input->post('user_id'),
  	        'name' => $this->input->post('name'),
  	        'area_street' => $this->input->post('area_street'),
  	        'town_village' =>$this->input->post('town_village'),
  	        'city' => $this->input->post('city'),
  	        'state' =>$this->input->post('state'),
  	        'mobile_no' =>$this->input->post('mobile_no'),
  	        'pin_code' =>$this->input->post('pin_code'),
  	        'landmark' =>$this->input->post('landmark'),
  	        'address_type'=>$this->input->post('address_type'),
  	        
  	        );
  	         $member = $this->am->insert('address',$data);
  	        $last_id = $this->db->insert_id();
  	        $query = $this->db->get_where('address', array('address_id'=>$last_id));
  	        if($query->num_rows())
  	        {
  	            $row=$query->row();
  	            $result['status']="success";
  	            $result['address_id']=$row->address_id;
  	            $result['user_id']=$row->user_id;
  	            $result['name']=$row->name;
  	            $result['area_street']=$row->area_street;
  	            $result['town_village']=$row->town_village;
  	            $result['city']=$row->city;
  	            $result['state']=$row->state;
  	            $result['mobile_no']=$row->mobile_no;
  	            $result['pin_code']=$row->pin_code;
  	            $result['landmark']=$row->landmark;
  	            $result['address_type']=$row->address_type;
  	            $result['msg']="Address Added Successfully";
  	            echo json_encode($result);
  	            
  	        }
  	}
  	
  	 public function get_address()
  	{
  	   $b=array();
  	   $user_id=$this->input->post('user_id');
       $res = $this->am->selectres('address',array('user_id'=>$user_id));
    //	print_r($res);die;
	
	 
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{

			    $result['address_id']=$row->address_id;
			    $result['user_id']=$row->user_id;
			    $result['name']=$row->name;
			    $result['area_street']=$row->area_street;
  	            $result['town_village']=$row->town_village;
  	            $result['city']=$row->city;
  	            $result['state']=$row->state;
  	            $result['mobile_no']=$row->mobile_no;
  	            $result['pin_code']=$row->pin_code;
  	            $result['landmark']=$row->landmark;
  	            $result['address_type']=$row->address_type;
  	            $result['address']=$row->address;
  	            $result['lat']=$row->lat;
  	            $result['lng']=$row->lng;
			//$result['msg']="record found";
		   // echo json_encode($result);
	        array_push($b,$result);
		}
      }
	    if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;    
	         //echo json_encode($result);
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
  	} 
  	
  	public function delete_address()
  	{
  	    $b=array();
  	    $user_id=$this->input->post('user_id');
  	    $address_id=$this->input->post('address_id');
  	    $res = $this->am->selectrow('address',array("address_id"=>$address_id,"user_id"=>$user_id));
  	    $res1 = $this->db->delete('address',array("address_id"=>$address_id,"user_id"=>$user_id));
  	    if(!empty($res))
  	    {
  	        $val= array("status" => "success","message"=>"Address deleted successfully");
          $data= json_encode($val);
          echo $data; 
  	    }
  	     else 
      {
            $val= array("status" => "fail","message"=>"Some thing went wrong");
            $data = json_encode($val);                   
            echo $data; 
      } 
  	    
  	    
  	}
  	
  	 // check user_count api......... start
    
    public function user_count()
    {
    $user_id=$this->input->post('user_id');
    $this->db->where('user_id',$user_id);
    $query = $this->db->get('users');
    $res1= $query->num_rows();
    
      $res['status']="success";
      $res['count']="$res1";
      //$res1['count']="2";
	  echo json_encode($res);
  	        }
    
    
    
    
    //stop...............


       public function cart_list1()
   {
       
       
      $user_id = $this->input->post('user_id');
       
     $res = $this->am->selectres('cart',array('user_id'=>$user_id));
     $b=array();
    if(!empty($res))
	  {
		foreach ($res as $row)		           
		{
			    $result['product_id']=$row->product_id;
			    $result['user_id']=$row->user_id;
			    $result['price']=$row->price;
			    $result['total_price']=$row->total_price;
  	            $result['color']=$row->color;
  	            $result['quantity']=$row->quantity;
		   	//$result['msg']="record found";
		   // echo json_encode($result);
	        array_push($b,$result);
		}
      }
 if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;    
	         //echo json_encode($result);
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
}


 public function cart_list()
    {
      $b=array();
      $user_id=$this->input->post('user_id');
     
      $res1 = $this->am->selectres('cart',array("user_id"=>$user_id));
    
   
    if(!empty($res1))
    {
        $amount=0;
        $shipping_amount=0;
        
        
     	$latitude= $this->input->post('lat')?$this->input->post('lat'):'28.6389057';
    	$longitude=$this->input->post('lng')?$this->input->post('lng'):'77.4814559';
    	$distance_km=115;
    	  $radius_km = $distance_km; 
    $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
     
    $having = " HAVING (distance <= $radius_km) "; 
     
    $order_by = 'distance ASC '; 
 
 
// Fetch places from the database 
 
        
        
        
        $delivery_status_count=0;
        foreach ($res1 as $row)               
        {
    
          $result['id']=$row->id;
         $res = $this->am->selectrow('seller_product',array('id'=>$row->product_id));
         
         
         
         if($res->type==2){
             $users = $this->am->selectrow('user_registeration',array('id'=>$res->user_id));
             
              if($users->kyc_type==2 || $users->kyc_type==3){
              $sql = "SELECT user.*,seller_product.*".$sql_distance." FROM user_registeration  user INNER JOIN seller_product ON seller_product.user_id = user.id where (user.kyc_type=2 ||user.kyc_type=3 ) && (seller_product.type=2 && seller_product.id=$row->product_id) $having ORDER BY $order_by"; 
             
            $num_product=$this->db->query($sql)->num_rows();
            if($num_product){
              $result['delivery_status']=1;
            }else{
                 $result['delivery_status']=0;
                 $delivery_status_count +=1;
            }
              
              
              }else{
                  $result['delivery_status']=1;
              }
              
              
         } else{
               $result['delivery_status']=1;
          }
         
        
         
         
        //   print_r($res);
            $this->db->select_sum('price');
            $this->db->from('cart');
            $this->db->where('user_id',$user_id);
            $this->db->where('status','1');
            $query=$this->db->get();
            $query->row()->price;
                       
          $result['user_id']=$user_id;
          $result['product_name']=$res->product_name;
          $result['product_id']=$row->product_id;
          $result['quantity']=$row->quantity;
		  
		  $res1 = $this->am->selectrow('brand',array('id'=>$res->brand_name));
		  
          $result['Brand_Name']=$res1->brand_name;
          $result['price']=$res->price;
          $result['image1']=base_url().$res->image;
          $result['sale_offer']=$res->discount;
          $sale_offe=$res->discount;
          
$offer2=$res->discount;
$offer=$res->price;
$product_price=$res->price*$offer2/100;
$comision_price=$offer-$product_price;

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
      
       $offer1=$res->delivery_charge;
       
       $total_price=$offer-$product_price+$value+$offer1;
      //$result['discount']=$row->discount;
       $result['product_price']="$total_price";
          
          
        //   $product_price=$res->price*$sale_offe/100;
          
          
        //   $sale_offe=$res->price;
          $result['qty']=$row->quantity;
           
        //   $total_price=$sale_offe-$product_price;
          $product_total_price=$row->quantity*$total_price;
          $result['product_price']="$total_price";
          $result['product_total_price']="$product_total_price";
          $amount +=$row->quantity*$total_price;
          
          if($users->kyc_type==1){
          if($amount > 500)
          {
              $delivery_chargre=0;
          }
          else
          {
              $delivery_chargre=50;
          }
          }
          
          
          if($users->kyc_type==2 || $users->kyc_type==3)
          {
              if($res->weight > 30)
              {
                 $delivery_chargre=0; 
              }
              else
              {
                  $delivery_chargre=50;
              }
          }
           
      
              array_push($b,$result);
        }
      
       
          $grand=$amount+$delivery_chargre;
          $val= array("status" => "success","total_amount"=>"$amount", 'delivery_charge'=>"$delivery_chargre",'grand_total'=>"$grand",'delivery_status_count'=>$delivery_status_count, "message"=>"Record found","data" =>$b);
          $data= json_encode($val);
          echo $data;    
          //echo json_encode($result);
      }  else 
      {
            $val= array("status" => "fail","message"=>"Record not found!","data" =>[]);
            $data = json_encode($val);                   
            echo $data; 
      } 
}










  
         public function product_listing_api()
   {
       
      $product_id = $this->input->post('product_id');
      $user_id = $this->input->post('user_id');
       
      $res = $this->am->selectres('cart',array('product_id'=>$product_id,'user_id'=>$user_id));
  
     $b=array();
    if(!empty($res))
	  {
		foreach ($res as $row)		           
		{
			    $result['product_id']=$row->product_id;
			    $result['user_id']=$row->user_id;
			    $result['price']=$row->price;
			    $result['total_price']=$row->total_price;
  	            $result['color']=$row->color;
  	            $result['quantity']=$row->quantity;
		   	//$result['msg']="record found";
		   // echo json_encode($result);
	        array_push($b,$result);
		}
      }
 if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;    
	         //echo json_encode($result);
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
}
  
       public function delete_cart()
  	{
  	    $b=array();
  	    $user_id=$this->input->post('user_id');
  	    $id=$this->input->post('id');
  	    
  	    $res1 = $this->db->delete('cart',array("id"=>$id,"user_id"=>$user_id));
  	     if(!empty($res1))
  	    {
  	        $val= array("status" => "success","message"=>"cart deleted successfully");
          $data= json_encode($val);
          echo $data; 
  	    }
  	    
  	     else 
      {
            $val= array("status" => "fail","message"=>"Some thing went wrong");
            $data = json_encode($val);                   
            echo $data; 
      } 
  	    
  	    
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
  	
 
      public function select_all_product()
   {
       
      $product_id = $this->input->post('product_id');
      $user_id = $this->input->post('user_id');
       
      $res = $this->am->selectres('seller_product',array('type'=>2,'user_id'=>$user_id));
      
  
     $b=array();
    if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['user_id']=$row->user_id;
	    $a['product_id']=$row->id;
	    $query=$this->db->where(array('product_id'=>$row->id))->get('tbl_wishlish');
                   $count = $query->num_rows();
         $num_rows1=$this->db->where(array('user_id'=>$user_id,'product_id'=>$row->id))->get('tbl_wishlish');
                  $count1 = $num_rows1->num_rows();
                  
         $q=$this->db->where(array('user_id'=>$user_id,'product_id'=>$product_id))->get('product_view');
         if($q->num_rows()==0)
         {
            
             $data = array(
                 'user_id'=>$this->input->post('user_id'),
                 'product_id'=>$this->input->post('product_id'),
                 'status'=>1,
                 );
             	$member = $this->am->insert('product_view',$data);
         
         }
                  
		if($count1){
		    $a['wishlist_status']="1";
		}else{
		     $a['wishlist_status']="0";
		}
            $a['wishlist_count']="$count";       
			$a['product_name']=ucfirst($row->product_name);
			$a['price']=$row->price;
			//$a['category']=$row->category;
			
			
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
      $offer2=$row->discount;
      $product_price=($row->price*$offer2)/100;
      
       $offer=$row->price;
       $offer1=$row->delivery_charge;
       
       $total_price=$offer-$product_price+$offer1+$value;
       
       
			
                /*$offer=$row->discount;
                $product_price=round(($row->price*$offer)/100);
                $offer=$row->price;
               $total_price=$offer-$product_price;*/
               
                $a['product_price']=round($total_price);
			$a['description']=ucfirst($row->description);
			$a['video']=base_url().$row->video;
			$a['count']="";
			$a['product_url']=base_url('product_details/').$row->slug;
			
			
			if(!empty($row->video))
		{
		  $a['video']=base_url().$row->video;  
		}
		else
		{
		   $a['video']=""; 
		}
		 
		
	      array_push($b,$a);
		}
      }
 if (!empty($res))
	    {
	        $val= array("status" => "success","message"=>"record found","data" =>$b);
	        $data= json_encode($val);
	        echo $data;    
	         //echo json_encode($result);
	    } 
	    else 
	    {
            $val= array("status" => "fail","message"=>"record not found","data" =>[]);
            $data = json_encode($val);		               
            echo $data; 
	    } 
} 	
  	
  	
  	
  	     public function followers()
   {
       
              $user_id = $this->input->post('user_id');
              $follower_status = $this->input->post('follower_status');
              
              if($follower_status==1){
                  
               $data = array(		
			 		'user_id' => $this->input->post('user_id'),
			 		'vendor_id' => $this->input->post('vendor_id'),
			 		'follower_status' =>1
                    );
                   
                   $res1 = $this->am->insert('tbl_follower',$data); 
                   
               
                 $val= array("status" => "success","message"=>"Follow Successfully");
	            $data= json_encode($val);
	            echo $data;
              }
              else{
                  $res = $this->db->where( array(		
			 		'user_id' => $this->input->post('user_id'),
			 		'vendor_id' => $this->input->post('vendor_id')
                    ))->delete('tbl_follower'); 
                      $val= array("status" => "success","message"=>"Unfollow Successfully");
	            $data= json_encode($val);
	            echo $data;
              }
              
                                                    
       
   }
  	
  	
  	     public function wishlish()
   {
              $user_id = $this->input->post('user_id');
              $status = $this->input->post('status');
              
              if($status==0){
               $data = array(		
			 		'user_id' => $this->input->post('user_id'),
			 		'product_id' => $this->input->post('product_id'),
			 		'status' =>1
                    );
                    $query=$this->db->get_where('tbl_wishlish', array('user_id'=>$user_id,'product_id' => $this->input->post('product_id')));
                   $count = $query->num_rows();
                   if($count<=0){
                     $res1 = $this->am->insert('tbl_wishlish',$data); 
                   }
                   
                   $query=$this->db->get_where('tbl_wishlish', array('product_id' => $this->input->post('product_id')));
                   $count = $query->num_rows();
                  
               
                 $val= array("status" => "success","message"=>"Like Successfully","count"=>"$count");
	             $data= json_encode($val);
	            echo $data;
              } else{
                  $res = $this->db->where( array(		
			 		'user_id' => $this->input->post('user_id'),
			 		'product_id' => $this->input->post('product_id')
                    ))->delete('tbl_wishlish'); 
                    $query=$this->db->get_where('tbl_wishlish', array('product_id' => $this->input->post('product_id')));
                   $count = $query->num_rows();
                      $val= array("status" => "success","message"=>"UnLike Successfully","count"=>"$count");
	            $data= json_encode($val);
	            echo $data;
              }
              
               
       
   }
   
   
   
    public function checkout_new1()
   {
       $amount=$this->input->post('amount');
       $checkout_type=$this->input->post('checkout_type')??'cart';
        $payment_type=$this->input->post('payment_type')??2;
       $user_id=$this->input->post('user_id');
       $token=$this->input->post('token');
       $address_id=$this->input->post('address_id');
       $coupan_code=$this->input->post('coupan_code')?$this->input->post('coupan_code'):'';
       $coupn_amount=$this->input->post('coupn_amount')?$this->input->post('coupn_amount'):'';
       $shipping_charge_amount=$this->input->post('shipping_charge_amount')?$this->input->post('shipping_charge_amount'):'';
      
       $coupon_data=$this->db->where(array('code'=>$coupan_code))->get('coupon')->row_array();
     
    
      if(($checkout_type=='cart')){
       $cart_details=$this->db->where(array('user_id'=>$user_id))->get('cart')->result();
       if($payment_type==2){
           $order_confirm=1;
       }else{
           $order_confirm=0;
       }

       
       
       
       if(!empty($cart_details)){
           
           
           
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
				 	'shipping_charge_amount' =>$this->input->post('shipping_charge_amount'),
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
				 	
                   );
         $this->db->insert('user_payment_details',$data);
         $last_id=$this->db->insert_id();
        $arr=array();
        
        $total_product_price=0;
       foreach($cart_details as $res){
          $product_details=$this->db->where(array('id'=>$res->product_id))->get('seller_product')->row_array();
          $sale_offe=$product_details['discount'];
          $product_price=$product_details['price']*$sale_offe/100;
          
           $sale_offe=$product_details['price'];
           
           $total_price=$sale_offe-$product_price;
          
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
      $this->check_notification($device_id,$title,$body,$type,$user_id);
    //   $this->db->where(array('token'=>$token))->delete('cart');
    
    $this->send_mail_admin($row2->email,$order_id);
    
       echo json_encode(array('status'=>'success','message'=>'Order created successfully','data'=>$data));
       
       }else{
             echo json_encode(array('status'=>'fail','message'=>'Some thing went wrong'));
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
     
     public function checkout_new()
   {
       $amount=$this->input->post('amount');
       $checkout_type=$this->input->post('checkout_type')??'cart';
       $payment_type=$this->input->post('payment_type')??2;
       $user_id=$this->input->post('user_id');
       $token=$this->input->post('token');
       $address_id=$this->input->post('address_id');
       $coupan_code=$this->input->post('coupan_code')?$this->input->post('coupan_code'):'';
       $coupn_amount=$this->input->post('coupn_amount')?$this->input->post('coupn_amount'):'';
       $shipping_charge_amount=$this->input->post('shipping_charge_amount')?$this->input->post('shipping_charge_amount'):'';
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
				 	'shipping_charge_amount' =>$this->input->post('shipping_charge_amount'),
				 	'payment_type' =>$this->input->post('payment_type')??2,
				 	'full_name'=>$address_details['name'],
				 	'mobile_no'=>$address_details['mobile_no'],
				 	'email'=>$address_details['email'],
				 	'house_no'=>$address_details['area_street'],
				 	'colony'=>$address_details['town_village'],
				 	'landmark'=>$address_details['landmark'],
				 	'city'=>$address_details['city'],
				 	'state'=>ucfirst($address_details['state']).' '.$address_details['pin_code'],
				 	'address_type'=>$address_details['address_type'],
				 	'full_address'=>$address_details['address'],
				 	
                   );
         $this->db->insert('user_payment_details',$data);
         $last_id=$this->db->insert_id();
        $arr=array();
        
        $total_product_price=0;
      
         $product_details=$this->db->where(array('id'=>$res->product_id))->get('seller_product')->row_array();
          $sale_offe=$product_details['discount'];
          
   
   
$offer2=$product_details['discount'];
$offer=$product_details['price'];
$product_price=$product_details['price']*$offer2/100;
$comision_price=$offer-$product_price; 

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
       $offer=$product_details['discount'];
       $product_price=($product_details['price']*$offer)/100;
       $offer=$product_details['price'];
       $offer3=$product_details['delivery_charge'];
       
       $total_price=$offer-$product_price+$value+$offer3;
  
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
      $this->check_notification($device_id,$title,$body,$type,$user_id);
    //   $this->db->where(array('token'=>$token))->delete('cart');
    
    $this->send_mail_admin($row2->email,$order_id);
    //$this->send_mail_user($row1->email,$order_id);
    
       echo json_encode(array('status'=>'success','message'=>'Order created successfully','data'=>$data));
       
       }else{
             echo json_encode(array('status'=>'fail','message'=>'Some thing went wrong'));
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
     
     public function order_list()
    {
      $user_id = $this->input->post('user_id');
     $order_id = $this->input->post('order_id');
         
    $res = $this->am->selectres('user_payment_details',array('user_id'=>$user_id,'order_confirm !='=>'0'));
         
         
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
         
        $result['transaction_id']=$row->transaction_id;
        $result['order_date']=$row->created_at;
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
        
        $total_amount=0;
        
      $product_row = $this->am->selectrow('check_out',array('user_id'=>$row->user_id,'order_id'=>$order_id));
      $result['product_name']=ucfirst($product_row->product_name);
      $product_detail = $this->am->selectrow('seller_product',array('id'=>$product_row->product_id,));
      if($product_detail){
      $result['product_image']=$product_detail->image?base_url().$product_detail->image:'';
      }else{
           $result['product_image']='';
      }
      $product_res = $this->am->selectres('check_out',array('user_id'=>$row->user_id,'order_id'=>$order_id));
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
      if (!empty($res))
      {
          $val= array("status" => "success","message"=>"Record found","data" =>$b);
          $data= json_encode($val);
          echo $data;      
      } 
      else 
      {
            $val= array("status" => "fail","message"=>"Record not found!","data" =>[]);
            $data = json_encode($val);                   
            echo $data; 
      } 
      
    } 
     
     
     
       public function seller_order_list()
    {
      //$vendor_id = $this->input->post('vendor_id');
      $user_id = $this->input->post('user_id');
     $order_id = $this->input->post('order_id');
         
    $res = $this->db->select('check_out.*')->where(array('vendor_id'=>$user_id,'user_payment_details.order_confirm'=>1))->join('user_payment_details','user_payment_details.order_id=check_out.order_id')->get('check_out')->result();
    
 
         
   $b=array();
    if(!empty($res))
    {
    foreach ($res as $row)               
    {            
        $order_id=$row->order_id;
        $result['id']=$row->id;
        $result['user_id']=$row->user_id;
        $result['order_id']=$row->order_id;
      
         
        $result['transaction_id']=$row->transaction_id;
        // $result['order_date']=$row->created_at	;
        //  if($row->status==1)
        //     {
        //         $result['status']="Pending";
        //     }
            
        //     elseif ($row->status==2)
        //     {
        //         $result['status']="Shipped";
        //     }
        //      elseif ($row->status==3)
        //     {
        //         $result['status']="Out of Delivery";
        //     }
        //     elseif ($row->status==4)
        //     {
        //         $result['status']="Delivered";
        //     }
        //     else
        //     {
        //         $result['status']="Cancelled";
        //     }
        $result['inovice_pdf']='';
        
        $total_amount=0;
        
      $product_row = $this->am->selectrow('check_out',array('user_id'=>$row->user_id,'order_id'=>$order_id));
      $result['product_name']=$product_row->product_name;
      $product_detail = $this->am->selectrow('seller_product',array('id'=>$product_row->product_id,));
      if($product_detail){
      $result['product_image']=$product_detail->image?base_url().$product_detail->image:'';
      }else{
           $result['product_image']='';
      }
      $product_res = $this->am->selectres('check_out',array('user_id'=>$row->user_id,'order_id'=>$order_id));
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
      if (!empty($res))
      {
          $val= array("status" => "success","message"=>"Record found","data" =>$b);
          $data= json_encode($val);
          echo $data;      
      } 
      else 
      {
            $val= array("status" => "fail","message"=>"Record not found!","data" =>[]);
            $data = json_encode($val);                   
            echo $data; 
      } 
      
    }
    
    
    public function cancel_order()
    {
        $user_id= $this->input->post('user_id');
        $order_id = $this->input->post('order_id');
        $res = $this->am->selectrow('user_payment_details', array('user_id'=>$user_id, 'order_id'=>$order_id));
        
         $b=array();
             $data = array(
               'status' => 5,
               
                   );
                   
     $row1 = $this->am->selectrow('user_registeration',array('id'=>$user_id));
                
      $device_id=$row1->device_id;
      $title='Order Cancelled';
      $body='As per your request, your item has been cancelled.';
      $type=3;
      $this->check_notification($device_id,$title,$body,$type,$user_id);
                   
        $this->db->where('user_id',$user_id);
        $this->db->where('order_id',$order_id);
        $this->db->update('user_payment_details',$data);
        $query = $this->db->get_where('user_payment_details', array('user_id'=>$user_id, 'order_id'=>$order_id));
        
        
        
        if($query->num_rows())
        {
            $row=$query->row();
            $result['status']="success";
            $result['msg']="Order Cancel Successfully!";
            echo json_encode($result);
            
        }
        else{
            $result['status']="fail";
            $result['msg']="Record not found";
            echo json_encode($result);
        }
        
        
    }
    

      public function order_history()
     {
     $user_id = $this->input->post('user_id');
     $order_id = $this->input->post('order_id');
     $row = $this->am->selectrow('user_payment_details',array('user_id'=>$user_id,'order_id'=>$order_id,'order_confirm'=>'1'));
     $row2 = $this->am->selectrow('feedback',array('user_id'=>$user_id,'order_id'=>$order_id,'status'=>'1'));
     $array=array();
    if(!empty($row2))
    {
        $result['feedback_status']=$row2->status;
        $result['star_count']=$row2->star_count;
        $result['feedback']=$row2->feedback;
    }
    else{
        $result['feedback_status']=0;
        $result['star_count']=0;
        $result['feedback']='';
    }
         
   $array=array();
    if(!empty($row))
    {
                  
        $result['id']=$row->id;
        $result['user_id']=$row->user_id;
        $result['order_id']=$row->order_id;
        $result['full_name']=$row->full_name;
        $result['mobile_no']=$row->mobile_no;
        $result['status']=$row->status;
        $result['transaction_id']=$row->transaction_id;
        $result['house_no']=$row->house_no;
        $result['colony']=$row->colony;
        $result['landmark']=$row->landmark;
        $result['city']=$row->city;
        // $result['pin_code']=$row->pin_code;
        $result['state']=$row->state;
        $result['address_type']=$row->address_type;
        $result['full_address']=$row->house_no.' '.$row->colony.' '.$row->landmark.' '.$row->city .' '.$row->state.' TYPE- '.$row->address_type.' '.$row->full_address;
        $result['delivery_date']=$row->order_delivered_date;
      
        $result['order_date']=$row->created_at	;
        
        $result['invoice_pdf']='';
        
        $total_amount=0;
        
      $product_res = $this->am->selectres('check_out',array('user_id'=>$row->user_id,'order_id'=>$order_id));
      $count=0;
     
      
      foreach($product_res as $pro_result){
          
          $product_detail['product_id']=ucfirst($pro_result->product_id);
          $product_detail['product_name']=ucfirst($pro_result->product_name);
          $product_detail['price']=$pro_result->price;
          $product_detail['discount']=$pro_result->discount;
          $product_detail['product_price']=$pro_result->product_price;
          $product_detail['size']=$pro_result->size;
          $product_detail['qty']=$pro_result->quentity;
          $product_details = $this->am->selectrow('seller_product',array('id'=>$pro_result->product_id,));
          if($product_details){
          $product_detail['product_image']=$product_details->image?base_url().$product_details->image:'';
          }else{
              $product_detail['product_image']='';
          }
          $total_amount +=$pro_result->product_price;
          $count++;
           array_push($array,$product_detail);
      }
    //   $result['product_id']=$row->product_id;
    
    
    $result['total_amount_product']=$total_amount;
    $result['product_total_count']=$count;
      
       
      }
   
      if (!empty($row))
      {
          $val= array("status" => "success","message"=>"Record found","data" =>$result,'product_list'=>$array);
          $data= json_encode($val);
          echo $data;      
      } 
      else 
      {
            $val= array("status" => "fail","message"=>"Record not found!","data" =>[]);
            $data = json_encode($val);                   
            echo $data; 
      } 
     }
     
     
     
     
    public function send_notification($registatoin_ids, $notification,$device_type='Android') {
        $url = 'https://fcm.googleapis.com/fcm/send';
      
      if($device_type == "Android"){
            $fields = array(
                'to' => $registatoin_ids,
                'notification' => $notification
            );
      } else {
            $fields = array(
                'to' => $registatoin_ids,
                'notification' => $notification
            );
      }
      // Firebase API Key
      $headers = array('Authorization:key=AAAAgecwM6U:APA91bEBAdfegcm4klmojc0nMQnkSmJz55ZFBTm5M1LgRBit8lDajLWRajJcr343mLFljAnSOBxtmxJZnAH7PUXf53oXREEq1vvsspDOktDayIu8QCzI0MfkKuullLFX1AnSU5jWe24A','Content-Type:application/json');
     // Open connection
      $ch = curl_init();
      // Set the url, number of POST vars, POST data
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // Disabling SSL Certificate support temporarly
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      $result = curl_exec($ch);
      if ($result === FALSE) {
        //   die('Curl failed: ' . curl_error($ch));
      }
      curl_close($ch);
      return true;
    //   print_r($result);
  }
    
    
    
    
    public function check_notification($device_id,$title,$body,$type,$user_id){
   $dType='Android';
    $regId =$device_id;
 
    // INCLUDE YOUR FCM FILE
      
 
    $arrNotification= array();          
                                         
    $arrNotification["body"] =$body;
    $arrNotification["title"] = $title;
    $arrNotification["sound"] = "default";
    $arrNotification["type"] = $type;
    $data = array(
        'user_id'=>$user_id,
        'device_id'=>$device_id,
        'title'=>$title,
        'type'=>$type,
        'body'=>$body,
        'status'=>'0',
        
        );
      
     $member = $this->am->insert('notifaction',$data);
          
    $result = $this->send_notification($regId, $arrNotification,$dType);
    }
    
    
    public function get_notification()
    {  
        $b=array(); 
        $user_id= $this->input->post('user_id');
        $res= $this->db->where(array('user_id'=>$user_id))->order_by('id','desc')->get('notifaction')->result();
        $this->db->select('*');
            $this->db->from('notifaction');
            $this->db->where(array('user_id'=>$user_id));
            $query = $this->db->get();
            $num=$query->num_rows();
         
         $user_id=$this->input->post('user_id');
    $data = array(		
			 		'status' => '1'
                    );
                  // print_r($data);die;
         	 $this->db->where('user_id',$user_id);
	         $num = $this->db->update('notifaction',$data );
    
        if(!empty($res))
        {
            
            foreach($res as $row)
            {
                
            $result['user_id']=$row->user_id;
            $result['device_id']=$row->device_id;
            $result['title']=$row->title;
            $result['body']=$row->body;
           
            array_push($b,$result);
            }
        }
        if(!empty($res))
        {
            $val= array("status"=> "success", "message"=>"Record found", "count"=>$num, "data"=>$b);
            $data= json_encode($val);
            echo $data;
             
        }
        else
        {
            $val= array("status" => "fail","message"=>"Record not found!",);
            $data = json_encode($val);		               
            echo $data; 
        }
    }
    
    
    public function notification_count()
    {
    $user_id=$this->input->post('user_id');
    $this->db->select('*');
    $this->db->from('notifaction');
    $this->db->where(array('status'=>'0','user_id'=>$user_id));
    $query = $this->db->get();
     $num=$query->num_rows();
      $res1['status']="success";
      $res1['count']="$num";
      //$res1['count']="2";
	  echo json_encode($res1);
    }
    
    
    
    public function searching_api()
    {
        
        $user_id=$this->input->post('user_id');
        $category = $this->input->post('category');
        $title = $this->input->post('title');
        $starting_point = $this->input->post('starting_point')?$this->input->post('starting_point'):0;
        if(!empty($this->input->post('category'))){
         $this->db->where(array('category'=>$category,'type'=>'2'))->like('product_name',$title) ;
         if(!empty($starting_point)){
                 $this->db->limit((5),($starting_point*5)+5);
            }
           $res=$this->db->get('seller_product')->result();
        }
        else{
             $this->db->where(array('type'=>'2'))->like('product_name',$title);
            if(!empty($starting_point)){
                $this->db->limit((5),($starting_point*5)+5);
            }
            
            $res=$this->db->get('seller_product')->result();
        }
         
         
        $b=array();
        if(!empty($res))
        {
            foreach($res as $row)
            {
                $result['product_id']=$row->id;
                $result['user_id']=$row->user_id;
                $result['product_name']=$row->product_name;
    			$result['brand_name']=$row->brand_name;
    			$result['speciality']=$row->speciality;
    			$result['description']=$row->description; 
    			$result['total_price']=$row->price;
    			$result['delivery_charge']=$row->delivery_charge;
		        $query=$this->db->where(array('user_id'=>$user_id,'product_id'=>$row->id))->get('tbl_wishlish');
                $count = $query->num_rows();
			    $query=$this->db->where(array('product_id'=>$row->id))->get('tbl_wishlish');
			    $wish_count = $query->num_rows();
				$query=$this->db->where(array('product_id'=>$row->id))->get('product_view');
			    $views_count = $query->num_rows();
                   
		
		if($count){
		    $result['wishlist_status']="1";
		}else{
		     $result['wishlist_status']="0";
		}
		$result['views_count']="$views_count";
		$result['wishlist_count']="$wish_count";   
		$result['count']="";   
		
$offer2=$row->discount;
$offer=$row->price;
$product_price=$row->price*$offer2/100;
$comision_price=$offer-$product_price; 		
			
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
    
       $offer1=$row->delivery_charge;
       
       $total_price=$offer-$product_price+$value+$offer1;
  
      //$result['discount']=$row->discount;
      $result['product_price']=round("$total_price");
      $result['other_offer']=$row->other_offer;
      
      
      if(!empty($row->image))
      {
          $result['image']=base_url($row->image);
      }
      else{
          $result['image']="";
      }
      
       if(!empty($row->video))
      {
          $result['video']=base_url($row->video);
      }
      else{
          $result['video']="";
      }
      $result['product_url']=base_url('product_details/').$row->slug;
      
      
      
      	$result['msg']="record found";
	
		   // echo json_encode($result);
	        array_push($b,$result);
                
            }
            
        }
        if(!empty($res))
        {
            $val = array("status"=>"success", "message"=>"Record found", "data"=>$b);
            $data = json_encode($val);
            echo $data;
        }
        else
        {
            $val = array("status"=>"failed", "message"=>"Record not found", "data"=>[]);
            $data = json_encode($val);
            echo $data;
        }
        
        
    }
    
    public function send_mail_admin($from_email,$order_id)
    {
        $tex ='<html>
    <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WhyShy</title>
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
			<img src="'.base_url().'uploads/logo.png">
		</div>
		<div class="head">
			Hi Team,
		</div>
		<div class="text">
			<span>You have received a order from</span><span><a href="mail:to'.$from_email.'"> '.$from_email.'</a> </span><span> Order id is</span><span> <a href=""> #'.$order_id.'</a></span>
			<p>Kindly work on the next process and deliver to the customer as soon as possible.</p><br>
			<p class="thankyou">Thank you <br> <span>Taudu Brothers   Team</span> </p>
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
   
    public function near_shop_location(){
        
        $user_id=$this->input->post('user_id');
  	    //$product_id=$this->input->post('product_id');
    	$res = $this->am->selectres('seller_product',array('type'=>2));
    	$latitude=$this->input->post('lat')?$this->input->post('lat'):'28.617825';
    	$longitude=$this->input->post('lng')?$this->input->post('lng'):'77.383855';
    	$distance_km=1150;
    	$radius_km = $distance_km; 
        $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
         
        $having = "HAVING (distance <= $radius_km)"; 
        $order_by = 'distance ASC '; 
     
     
        // Fetch places from the database 
          $sql = "SELECT user.*,seller_registeration.*".$sql_distance." FROM user_registeration  user INNER JOIN seller_registeration
        ON seller_registeration.user_id = user.id where user.kyc_status=1 $having ORDER BY $order_by"; 
    
  
         $query = $this->db->query($sql)->result(); 
         //print_r($query);
         $arr=array();
         if($query){
         foreach($query as $res){
             if(!empty($res->lat)){
            
                $num_rows=$this->db->where(array('vendor_id'=>$res->user_id,'user_id'=>$user_id))->get('tbl_follower')->num_rows();
                   if($num_rows){
                       $follow_status="1";
                   }else{
                        $follow_status="0";
                   }
             $result['follow_status']=$follow_status;
             $result['id']=$res->id;
             $result['vendor_id']=$res->user_id;
             $result['user_id']=$res->user_id;
             $result['shop_name']=$res->shop_name;
             $result['shop_area']=$res->shop_area;
             $result['lat']=$res->lat;
             $result['lng']=$res->long;
             $result['lat_long']="$res->lat,$res->long";
             $result['shop_town']=$res->shop_town;
             $result['shop_distric']=$res->shop_distric;
             $result['shop_state']=$res->shop_state;
             $result['area_pincode']=$res->area_pincode;
             $result['distance']=number_format((float)$res->distance, 2, '.', '');
             $result['description']=$res->description;
             $result['profile_image']=$res->profile_image?base_url().$res->profile_image:'';
             $result['profile_url']=base_url('seller_profile/').$res->user_id;
            
               array_push($arr,$result);
             }
         }
         
         echo json_encode(array('status'=>'success','msg'=>'record found','data'=>$arr));
         }else{
             echo json_encode(array('status'=>'fail','msg'=>'No store Found','data'=>[]));
         }
        //  print_r($query);
    	
        
    }
    
    
    
    public function near_shop(){
        
        $lat=$this->input->post('lat')?$this->input->post('lat'):'28.617825';
        $long=$this->input->post('lng')?$this->input->post('lng'):'77.383855';
        $user_id=$this->input->post('user_id');
  	   //$product_id=$this->input->post('product_id');
    // 	$res = $this->am->selectres('seller_product',array('type'=>2));
    	$latitude=$lat;
    	$longitude=$long;
    	$distance_km=115;
    	$radius_km = $distance_km; 
        $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
         
        $having = " HAVING (distance <= $radius_km) "; 
         
        $order_by = 'distance ASC '; 
     
     
        // Fetch places from the database 
          $sql = "SELECT user.*,seller_registeration.*,user.lat  lati ,user.long as longi".$sql_distance." FROM user_registeration  user INNER JOIN seller_registeration
        ON seller_registeration.user_id = user.id where user.kyc_status=1 $having ORDER BY $order_by"; 
    
         $query = $this->db->query($sql)->result(); 
         $arr=array();
         if($query){
         foreach($query as $res){
             if(!empty($res->lat)){
             $result['id']=$res->id;
             $result['shop_name']=ucfirst($res->shop_name);
             $result['shop_area']=$res->shop_area;
             $result['lat']=$res->lati;
             $result['long']=$res->longi;
             $result['lat_long']="$res->lat,$res->long";
             $result['shop_town']=$res->shop_town;
             $result['shop_distric']=$res->shop_distric;
             $result['shop_state']=$res->shop_state;
             $result['area_pincode']=$res->area_pincode;
             $result['distance']=$res->distance;
             $result['description']=$res->description;
             $result['profile_image']=$res->profile_image?base_url().$res->profile_image:'';
             
               array_push($arr,$result);
             }
         }
         
         echo json_encode(array('status'=>'success','msg'=>'record found','array'=>$arr));
         }else{
             echo json_encode(array('status'=>'fail','msg'=>'No store Found','data'=>[]));
         }
        //  print_r($query);
    	
        
    }
    
    
    
    
    
 public function about()
    {
        
     $array=array('email'=>'taudubrothers@gmail.com','phone'=>'+91-7417104056','terms'=>'<h3>Terms &amp; Conditions</h3>

<p>Welcome to Taudu Brothers!</p>

<ul>
	<li>These terms and conditions outline the rules and regulations for the use of Taudu Brothers&#39;s Website, located at&nbsp;<a href="https://taudubrothers.com/">https://taudubrothers.com/</a></li>
	<li>By accessing this website we assume you accept these terms and conditions. Do not continue to use Taudu Brothers if you do not agree to take all of the terms and conditions stated on this page.</li>
	<li>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: &quot;Client&quot;, &quot;You&quot; and &quot;Your&quot; refers to you, the person log on this website and compliant to the Company&rsquo;s terms and conditions. &quot;The Company&quot;, &quot;Ourselves&quot;, &quot;We&quot;, &quot;Our&quot; and &quot;Us&quot;, refers to our Company. &quot;Party&quot;, &quot;Parties&quot;, or &quot;Us&quot;, refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client&rsquo;s needs in respect of provision of the Company&rsquo;s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</li>
</ul>

<h3>Cookies</h3>

<ul>
	<li>&nbsp;We employ the use of cookies. By accessing Taudu Brothers, you agreed to use cookies in agreement with the Taudu Brothers&#39;s Privacy Policy.</li>
	<li>&nbsp;Most interactive websites use cookies to let us retrieve the user&rsquo;s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</li>
</ul>

<h3>License</h3>

<ul>
	<li>Unless otherwise stated, Taudu Brothers and/or its licensors own the intellectual property rights for all material on Taudu Brothers. All intellectual property rights are reserved. You may access this from Taudu Brothers for your own personal use subjected to restrictions set in these terms and conditions.</li>
</ul>

<h3>You must not:</h3>

<ul>
	<li>Republish material from Taudu Brothers</li>
	<li>&nbsp;Sell, rent or sub-license material from Taudu Brothers</li>
	<li>&nbsp;Reproduce, duplicate or copy material from Taudu Brothers</li>
	<li>&nbsp;Redistribute content from Taudu Brothers</li>
	<li>&nbsp;This Agreement shall begin on the date hereof. Our Terms and Conditions were created with the help of the Terms And Conditions Generator.</li>
	<li>&nbsp;Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. Taudu Brothers does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of Taudu Brothers,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, Taudu Brothers shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</li>
	<li>&nbsp;Taudu Brothers reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.</li>
</ul>

<h3>You warrant and represent that:</h3>

<ul>
	<li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li>
	<li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;</li>
	<li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy</li>
	<li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li>
	<li>You hereby grant Taudu Brothers a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</li>
</ul>

<h3>Hyperlinking to our Content</h3>

<p>The following organizations may link to our Website without prior written approval:</p>

<ul>
	<li>Government agencies;</li>
	<li>Search engines;</li>
	<li>News organizations;</li>
	<li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses;</li>
	<li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site. These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party&rsquo;s site.</li>
</ul>

<h3>We may consider and approve other link requests from the following types of organizations:</h3>

<ul>
	<li>commonly-known consumer and/or business information sources; dot.com community sites;</li>
	<li>associations or other groups representing charities;</li>
	<li>online directory distributors;</li>
	<li>internet portals;</li>
	<li>accounting, law and consulting firms; and</li>
	<li>educational institutions and trade associations.</li>
	<li>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of Taudu Brothers; and (d) the link is in the context of general resource information.</li>
	<li>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party&rsquo;s site.</li>
	<li>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to Taudu Brothers. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</li>
</ul>

<h3>Approved organizations may hyperlink to our Website as follows:</h3>

<ul>
	<li>By use of our corporate name; or</li>
	<li>By use of the uniform resource locator being linked to; or</li>
	<li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party&rsquo;s site.</li>
	<li>No use of Taudu Brothers&#39;s logo or other artwork will be allowed for linking absent a trademark license agreement.</li>
</ul>

<h3>iFrames</h3>

<ul>
	<li>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</li>
</ul>

<h3>Content Liability</h3>

<ul>
	<li>We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</li>
</ul>

<h3>Your Privacy</h3>

<ul>
	<li>Please read Privacy Policy</li>
</ul>

<h3>Reservation of Rights</h3>

<ul>
	<li>Please read Privacy PolicyWe reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it&rsquo;s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</li>
</ul>

<h3>Removal of links from our website</h3>

<ul>
	<li>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</li>
	<li>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</li>
</ul>

<h3>Disclaimer</h3>

<p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</p>

<ul>
	<li>limit or exclude our or your liability for death or personal injury;</li>
	<li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>
	<li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
	<li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>
	<li>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</li>
</ul>

<p>As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p>
',"privacy"=>'<h3>Privacy Policy For Taudu Brothers</h3>

<p>At Taudu Brothers, accessible from&nbsp;<a href="https://taudubrothers.com/">https://taudubrothers.com</a>, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by Taudu Brothers and how we use it.</p>

<p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>

<p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in Taudu Brothers. This policy is not applicable to any information collected offline or via channels other than this website.</p>

<h3>Consent</h3>

<ul>
	<li>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</li>
</ul>

<p>&nbsp;</p>

<h3>Information we collect</h3>

<ul>
	<li>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</li>
	<li>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</li>
	<li>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</li>
</ul>

<p>&nbsp;</p>

<h3>How we use your information</h3>

<p><strong>We use the information we collect in various ways, including to:</strong></p>

<ul>
	<li>Provide, operate, and maintain our website</li>
	<li>Improve, personalize, and expand our website</li>
	<li>Understand and analyze how you use our website</li>
	<li>Develop new products, services, features, and functionality</li>
	<li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</li>
	<li>Send you emails</li>
	<li>Find and prevent fraud</li>
</ul>

<p>&nbsp;</p>

<h3>Log Files</h3>

<p>Taudu Brothers follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services&#39; analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users&#39; movement on the website, and gathering demographic information.</p>

<p>&nbsp;</p>

<h3>Cookies and Web Beacons</h3>

<p>Like any other website, Taudu Brothers uses &#39;cookies&#39;. These cookies are used to store information including visitors&#39; preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users&#39; experience by customizing our web page content based on visitors&#39; browser type and/or other information.</p>

<p>&nbsp;</p>

<h3>Advertising Partners Privacy Policies</h3>

<p>You may consult this list to find the Privacy Policy for each of the advertising partners of Taudu Brothers.</p>

<p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on Taudu Brothers, which are sent directly to users&#39; browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>

<p>Note that Taudu Brothers has no access to or control over these cookies that are used by third-party advertisers.</p>

<p>&nbsp;</p>

<h3>Third Party Privacy Policies</h3>

<p>Taudu Brothers&#39;s Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options.</p>

<p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers&#39; respective websites.</p>

<p>Request that a business that collects a consumer&#39;s personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>

<p>Request that a business delete any personal data about the consumer that a business has collected.</p>

<p>Request that a business that sells a consumer&#39;s personal data, not sell the consumer&#39;s personal data.</p>

<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

<p>&nbsp;</p>

<h3>Children&#39;s Information</h3>

<p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p>

<p>Taudu Brothers does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>

 
');  
     
      $val= array("status" => "success","message"=>"Record found","data" =>$array);
      $array['status']="success";
      $array['message']="Record found";
        $data= json_encode($array);
          echo $data;      
    
    } 


public function return_policy()
{
    $user_id = $this->input->post('user_id');
    $order_id = $this->input->post('order_id');
    $res = $this->am->selectrow('return_policy', array('user_id'=>$user_id, 'order_id'=>$order_id));
    
     if($this->input->post('image')){
        // print_r($this->input->post('image'));
    	  	 $upload=$this->input->post('image');
    	  	 $img=base64_decode($upload);
    	  	 $imgname=rand('1000','9999999');
    	  	 $upload_url="uploads/".$imgname.".jpg";
    	  	 $upload_ur="./uploads/".$imgname.".jpg";
            file_put_contents($upload_ur,$img);
            
          }else{
              $upload_url='';
          }
          if($this->input->post('image1')){
    	  	 $upload=$this->input->post('image1');
    	  	 $img=base64_decode($upload);
    	  	 $imgname=rand('1000','9999999');
    	  	 $upload_url1="uploads/".$imgname.".jpg";
    	  	 $upload_ur="./uploads/".$imgname.".jpg";
            file_put_contents($upload_ur,$img);
          }else{
              $upload_url1='';
          }
            
             
           if($this->input->post('image2')){
    	  	 $upload=$this->input->post('image2');
    	  	 $img=base64_decode($upload);
    	  	 $imgname=rand('1000','9999999');
    	  	 $upload_url2="uploads/".$imgname.".jpg";
    	  	 $upload_ur="./uploads/".$imgname.".jpg";
            file_put_contents($upload_ur,$img);
          }else{
              $upload_url2='';
          }
     
    $data = array(
        'user_id'=> $this->input->post('user_id'),
        'order_id'=> $this->input->post('order_id'),
        'return_type'=> $this->input->post('return_type'),
        'description'=> $this->input->post('description'),
        'image'=>$upload_url,
        'image1'=>$upload_url1,
        'image2'=>$upload_url2,
        
        );
        
        $array = array(
            'status'=>5,
            );
        
        $member = $this->am->insert('return_policy',$data);
        $last_id = $this->db->insert_id();
        $query = $this->db->get_where('return_policy',array('id'=>$last_id));
        $this->db->where(array('order_id'=>$order_id))->update('user_payment_details',$array);
        if($query->num_rows()){
            
            $row= $query->row();
            $result['status']="success";
           $result['user_id']=$row->user_id;
           $result['order_id']=$row->order_id;
           
           if(!empty($row->image)){
               
           $result['image']=base_url().$row->image;
           }
           else{
               $result['image']="";
               
           }
           if(!empty($row->image1)){
           $result['image1']=base_url().$row->image1;
           }
           else
           {
               $result['image1']='';
               
           }
           
           if(!empty($row->image2)){
           $result['image2']=base_url().$row->image2;
           }
           else
           {
               $result['image2']='';
               
           }
           $result['description']=$row->description;
           $result['msg']="Request has been generated!";
           echo json_encode($result);
        }
    
}    



public function upload_image_amit()
    {
       	
          $upload="";
          $config = array('upload_path' =>'./uploads/amit/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('image'))
      {
        $image=$this->upload->data();
         $upload=$image['file_name'];              
        echo "file upload success.$upload"; die;
      }
      else
      {
        print_r ($this->upload->display_errors());  
      }
      
     
	       
   
    }
    
    
    
    public function update_seller_product()
    {
        $product_id = $this->input->post('product_id');
        $user_id = $this->input->post('user_id');
        
        $res = $this->am->selectrow('seller_product',array("id"=>$product_id,"user_id"=>$user_id));
        
      $data = array(   
          'user_id'=>$this->input->post('user_id'),
          'product_name' => $this->input->post('product_name'),
          //'quantity' => $this->input->post('quantity'),
          'height' => $this->input->post('height'),
          'width' => $this->input->post('width'),
          'length' => $this->input->post('length'),
          'weight' => $this->input->post('weight'),
          'description' => $this->input->post('description'),
          'color' => $this->input->post('color'),
          'discount' => $this->input->post('discount')? $this->input->post('discount'):'0',
          'price' => $this->input->post('price'),
          'other_offer' => $this->input->post('other_offer'),
          'speciality' => $this->input->post('speciality')?$this->input->post('speciality'):'',
          'other_varient' =>$this->input->post('other_varient')?$this->input->post('other_varient'):'',
          'type' =>2,
          
     
        );
        
            
        
            $this->db->where('id',$product_id);
            $this->db->where('user_id',$user_id);
            $this->db->update('seller_product',$data);
           $last_id = $this->db->insert_id();
           
           $slug = url_title(convert_accented_characters(strtolower(strip_tags(preg_replace ('/[0-9]+$/','-',$this->input->post('product_name'))))), 'dash', true);
           $slugs=$slug.'-'.$product_id;
  
            $this->db->where('id',$product_id)->update('seller_product', array('slug'=>$slugs));
        
        $query = $this->db->get_where('seller_product', array('id'=>$product_id,'user_id'=>$user_id));
        
    if($query->num_rows())
     {
      $row=$query->row(); 
      
        $result['status']="success";
      //$result['user_id']=$row->id;
      $result['user_id']=$row->user_id;
      $result['product_name']=$row->product_name;
      $result['category']=$row->category;
      $result['brand_name']=$row->brand_name;
      $result['country']=$row->country;
      //$result['quantity']=$row->quantity;
      $result['height']=$row->height;
      $result['weight']=$row->weight;
      $result['length']=$row->length;
      $result['width']=$row->width;
      $result['color']=$row->color;
      $val=$row->price;
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
      $product_price=$row->price*$offer/100;
      
       $offer=$row->price;
       
       $total_price=$offer-$product_price+$value;
     
      //$result['price']=$row->price;
      //$result['charger_price']=$value;
      $result['discount']=$row->discount;
      $result['price']="$total_price";
      $result['other_offer']=$row->other_offer;
      $result['speciality']=$row->speciality;
      $result['description']=$row->description;
      $result['other_varient']=$row->other_varient;
      $result['type']=$row->kyc_type;
      $result['image']=base_url().$row->image;
      $result['image1']=base_url().$row->image1;
      $result['image2']=base_url().$row->image2;
      $result['video']=base_url().$row->video;
      $result['msg']="Product Update Successfully";
        echo json_encode($result);
       
     }
        
        
        
        
    }
    
    
    
    public function update_fresh_and_grocery_product()
    {
        $product_id = $this->input->post('product_id');
        $user_id = $this->input->post('user_id');
        
        $res = $this->am->selectrow('seller_product',array("id"=>$product_id,"user_id"=>$user_id));
        
         $data = array(   
          'user_id'=>$this->input->post('user_id'),
          'product_name' => $this->input->post('product_name'),
          'discount' => $this->input->post('discount')? $this->input->post('discount'):'0',
          'price' => $this->input->post('price'),
          'description' => $this->input->post('description'),
          'other_offer' => $this->input->post('other_offer'),
          'other_varient' =>$this->input->post('other_varient')?$this->input->post('other_varient'):'',
          'type' =>2,
          
        );
        
            
        
            $this->db->where('id',$product_id);
            $this->db->where('user_id',$user_id);
            $this->db->update('seller_product',$data);
           $last_id = $this->db->insert_id();
           
           $slug = url_title(convert_accented_characters(strtolower(strip_tags(preg_replace ('/[0-9]+$/','-',$this->input->post('product_name'))))), 'dash', true);
           $slugs=$slug.'-'.$product_id;
  
            $this->db->where('id',$product_id)->update('seller_product', array('slug'=>$slugs));
        
        $query = $this->db->get_where('seller_product', array('id'=>$product_id,'user_id'=>$user_id));
        
    if($query->num_rows())
     {
      $row=$query->row(); 
      
        $result['status']="success";
      //$result['user_id']=$row->id;
      $result['user_id']=$row->user_id;
      $result['product_name']=$row->product_name;
      $result['category']=$row->category;
      $result['brand_name']=$row->brand_name;
      $result['country']=$row->country;
      //$result['quantity']=$row->quantity;
      $result['height']=$row->height;
      $result['weight']=$row->weight;
      $result['length']=$row->length;
      $result['width']=$row->width;
      $result['color']=$row->color;
      $val=$row->price;
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
      $product_price=$row->price*$offer/100;
      
       $offer=$row->price;
       
       $total_price=$offer-$product_price+$value;
     
      //$result['price']=$row->price;
      //$result['charger_price']=$value;
      $result['discount']=$row->discount;
      $result['price']="$total_price";
      $result['other_offer']=$row->other_offer;
      $result['speciality']=$row->speciality;
      $result['description']=$row->description;
      $result['other_varient']=$row->other_varient;
      $result['type']=$row->kyc_type;
      $result['image']=base_url().$row->image;
      $result['image1']=base_url().$row->image1;
      $result['image2']=base_url().$row->image2;
      $result['video']=base_url().$row->video;
      $result['msg']="Product Update Successfully";
        echo json_encode($result);
       
     }
        
        
        
        
    }
    
    
    public function stock()
    {
        $user_id = $this->input->post('user_id');
        $product_id = $this->input->post('product_id');
        
        $data = array(
            
            'stock' => $this->input->post('stock'),
            
            );
            
            $this->db->where('id', $product_id);
            $this->db->where('user_id', $user_id);
            $this->db->update('seller_product', $data);
            $query = $this->db->get_where('seller_product', array('id'=>$product_id, 'user_id'=>$user_id));
            
            if($query->num_rows())
		 {
		     $row=$query->row(); 
		     
		     
		    $result['status']="success";
		    $result['product_id']=$row->id;
		    $result['user_id']=$row->user_id;
		    $result['stock']=$row->stock;
		    
		    
		    if($row->stock == 1)
		    {
		    $result['msg']="Product in Stock";
		    }
		    else
		    {
		        $result['msg']="Product Out of Stock";
		    }
		    
		    echo json_encode($result);
		    
		 }
		 
        
    }
    
    
    
    
    
    public function follower_list(){
        
        $user_id=$this->input->post('user_id');
        $follower_list= $this->db->select('user_registeration.*, tbl_follower.id,user_registeration.name as user_name,tbl_follower.vendor_id, seller_registeration.user_id, seller_registeration.shop_name, seller_registeration.description,')->where(array('tbl_follower.user_id'=>$user_id))
        ->join('tbl_follower','user_registeration.id=tbl_follower.vendor_id','left')
        ->join('seller_registeration','seller_registeration.user_id=tbl_follower.vendor_id')->get('user_registeration')->result();
        
        //print_r($follower_list);
         $arr=array();
         if($follower_list){
         foreach($follower_list as $res){
  
                  
            
             $result['id']=$res->id;
             $result['vendor_id']=$res->vendor_id;
             $result['user_id']=$res->user_id;
             $result['seller_name']=$res->user_name;
             $result['shop_name']=$res->shop_name;
             $result['description']=$res->description;
             $result['profile_image']=$res->image;
             $result['profile_url']=base_url('seller_profile/').$res->user_id;
            
               array_push($arr,$result);
             
         }
         
         echo json_encode(array('status'=>'success','msg'=>'record found','data'=>$arr));
         }else{
             echo json_encode(array('status'=>'fail','msg'=>'No store Found','data'=>[]));
         }
        //  print_r($query);
    	
        
    }
    
    
     public function checkout_new_online()
   {
       $amount=$this->input->post('amount');
       $checkout_type=$this->input->post('checkout_type')??'online';
       $payment_type=$this->input->post('payment_type')??1;
       $user_id=$this->input->post('user_id');
       $transaction_id=$this->input->post('transaction_id');
       $token=$this->input->post('token');
       $address_id=$this->input->post('address_id');
       $coupan_code=$this->input->post('coupan_code')?$this->input->post('coupan_code'):'';
       $coupn_amount=$this->input->post('coupn_amount')?$this->input->post('coupn_amount'):'';
       $shipping_charge_amount=$this->input->post('shipping_charge_amount')?$this->input->post('shipping_charge_amount'):'';
       $coupon_data=$this->db->where(array('code'=>$coupan_code))->get('coupon')->row_array();
     
    
      if(($checkout_type=='online')){
       $cart_details=$this->db->where(array('user_id'=>$user_id))->get('cart')->result();
       if($payment_type==1){
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
			 		'transaction_id' => $transaction_id,
				 	'checkout_type' =>$checkout_type,
				 	'order_id'=>$order_id,
				 	'date'=>date('d-m-Y'),
				 	'status'=>'1',
				 	'payment_status'=>$payment_type,
				 	'order_confirm'=>$order_confirm,
				 	'coupan_code' =>$this->input->post('coupan_code')?$this->input->post('coupan_code'):'',
				 	'coupn_amount' =>$this->input->post('coupn_amount')?$this->input->post('coupn_amount'):'',
				 	'shipping_charge_amount' =>$this->input->post('shipping_charge_amount'),
				 	'payment_type' =>$this->input->post('payment_type')??1,
				 	'full_name'=>$address_details['name'],
				 	'mobile_no'=>$address_details['mobile_no'],
				 	'email'=>$address_details['email'],
				 	'house_no'=>$address_details['area_street'],
				 	'colony'=>$address_details['town_village'],
				 	'landmark'=>$address_details['landmark'],
				 	'city'=>$address_details['city'],
				 	'state'=>ucfirst($address_details['state']).' '.$address_details['pin_code'],
				 	'address_type'=>$address_details['address_type'],
				 	'full_address'=>$address_details['address'],
				 	
                   );
         $this->db->insert('user_payment_details',$data);
         $last_id=$this->db->insert_id();
        $arr=array();
        
        $total_product_price=0;
      
         $product_details=$this->db->where(array('id'=>$res->product_id))->get('seller_product')->row_array();
          $sale_offe=$product_details['discount'];
          
   
   
$offer2=$product_details['discount'];
$offer=$product_details['price'];
$product_price=$product_details['price']*$offer2/100;
$comision_price=$offer-$product_price; 

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
       $offer=$product_details['discount'];
       $product_price=($product_details['price']*$offer)/100;
       $offer=$product_details['price'];
       $offer3=$product_details['delivery_charge'];
       
       $total_price=$offer-$product_price+$value+$offer3;
  
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
                
      $device_id=$row1->device_id;
      $title='Order completed successfully';
      $body='Thank you for shopping with us, We are prepping your order as soon as possible.';
      $type=1;
      $this->check_notification($device_id,$title,$body,$type,$user_id);
    //   $this->db->where(array('token'=>$token))->delete('cart');
    
    $this->send_mail_admin($row1->email,$order_id);
    //$this->send_mail_user($row1->email,$order_id);
    
       echo json_encode(array('status'=>'success','message'=>'Order created successfully','data'=>$data));
       
       }else{
             echo json_encode(array('status'=>'fail','message'=>'Some thing went wrong'));
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
     
    
    
    public function get_kyc_details()
    {
        $user_id = $this->input->post('user_id');
        
        $kyc_data = $this->db->select('seller_registeration.*, user_registeration.delivery_type')->where(array('user_id'=>$user_id))->join('user_registeration','user_registeration.id=seller_registeration.user_id')->get('seller_registeration')->result();
    
        
        $arr=array();
         if($kyc_data){
         foreach($kyc_data as $res){
  
                  
            
             $result['id']=$res->id;
             $result['user_id']=$res->user_id;
             $result['name']=$res->name;
             $result['shop_name']=$res->shop_name;
             $result['shop_area']=$res->shop_area;
             $result['shop_town']=$res->shop_town;
             $result['shop_distric']=$res->shop_distric;
             $result['shop_state']=$res->shop_state;
             $result['area_pincode']=$res->area_pincode;
             $result['pan_no']=$res->pan_no;
             $result['adhar_no']=$res->adhar_no;
             $result['gst_no']=$res->gst_no;
             $result['landmark']=$res->landmark;
             $result['description']=$res->description;
             $result['lat']=$res->lat;
             $result['long']=$res->long;
             $result['kyc_type']=$res->kyc_type;
             if($res->delivery_type == 1)
             {
                 $result['delivery_type']='Self';
             }
             if($res->delivery_type == 2)
             {
                 $result['delivery_type']='Partenership';
             }
             
             $result['created_at']=$res->created_at;
             if(!empty($res->pan_image)){
               
           $result['pan_image']=base_url().$res->pan_image;
           }
           else{
               $result['pan_image']="";
               
           }
           
           if(!empty($res->adhar_image))
           {
               $result['adhar_image']=base_url().$res->adhar_image;
           }
           else{
               $result['adhar_image']="";
           }
           
           if(!empty($res->gst_image))
           {
               $result['gst_image']=base_url().$res->gst_image;
           }
           else
           {
               $result['gst_image']="";
           }
           if(!empty($res->landmark_image))
           {
               $result['landmark_image']=base_url().$res->landmark_image;
           }
           else
           {
               $result['landmark_image']="";
           }
           
           if(!empty($res->profile_image))
           {
               $result['profile_image']=base_url().$res->profile_image;
           }
           else
           {
               $result['profile_image']="";
           }
             
             
            
               array_push($arr,$result);
             
         }
         
         echo json_encode(array('status'=>'success','msg'=>'record found','data'=>$arr));
         }else{
             echo json_encode(array('status'=>'fail','msg'=>'No record found','data'=>[]));
         }
         
        
        
        
    }
    
     }
?>