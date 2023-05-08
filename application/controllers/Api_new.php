<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_new extends CI_Controller  
{
    
    	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
         $this->load->model('Admin_Model','am');
          $this->load->library('common'); 
    }
    
    
    //user api
           public function user_signup()
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
         }
   }
   }
    
       public function user_login()
    {
      $mobile_no=$this->input->post('mobile_no');
     $device_id=$this->input->post('device_id');
      $otp = rand(1000,9999);
        $otp=1234;
        $this->db->update("user_registeration", array("otp"=>$otp),array("mobile_no"=>$mobile_no));
        $q=$this->db->get_where("user_registeration",array("mobile_no"=>$this->input->post('mobile_no')));
        if($q->num_rows())
        {
            $row=$q->row();
            $result['status']="success";
            $result['user_id']=$row->id;
            $result['otp']=$row->otp;
            $result['mobile_no']=$row->mobile_no;
            $result['device_id']=$row->device_id;
            $result['user_type']="old";
            $result['kyc_status']=$row->kyc_status;
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
                $result['status']="success";
                $result['user_id']=$row->id;
                $result['contact_no']=$row->mobile_no;
                $result['otp']=$row->otp;
                $result['device_id']=$row->device_id;
                $result['user_type']="new";
                 $result['kyc_status']=0;
                $result['msg']="OTP Send Successfully";
                echo json_encode($result);
              }else
              {
                $result['status']="false";                          
                $result['msg']="OTP Not Send ";
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
    
    //end user api
    
    
    //start seller_API
    public function seller_register()
   {
       $user_id=$this->input->post('user_id');
    if(!empty($user_id)){
         $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('profile_image'))
      {
        $image=$this->upload->data();
        $upload=$image['file_name'];              
        //echo "file upload success"; die;
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
       $upload1="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('pan_image'))
      {
        $image=$this->upload->data();
        $upload1=$image['file_name'];              
        //echo "file upload success"; die;
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
       $upload2="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('adhar_image'))
      {
        $image=$this->upload->data();
        $upload2=$image['file_name'];              
        //echo "file upload success"; die;
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
       $upload3="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('gst_image'))
      {
        $image=$this->upload->data();
        $upload3=$image['file_name'];              
        //echo "file upload success"; die;
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
      
      $upload4="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('landmark_image'))
      {
        $image=$this->upload->data();
        $upload4=$image['file_name'];              
        //echo "file upload success"; die;
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
        
        
         
     $data = array(   
          'name' => $this->input->post('name'),
          'shop_name' => $this->input->post('shop_name'),
          'shop_area' => $this->input->post('shop_area'),
          'shop_town' => $this->input->post('shop_town'),
          'shop_distric' => $this->input->post('shop_distric'),
          'shop_state' => $this->input->post('shop_state'),
          //'shop_pincode' => $this->input->post('shop_pincode'),
          'area_pincode' => $this->input->post('area_pincode'),
          'pan_no' => $this->input->post('pan_no'),
          'adhar_no' => $this->input->post('adhar_no'),
          'gst_no' => $this->input->post('gst_no'),
          'landmark' => $this->input->post('landmark'),
          'description' => $this->input->post('description'),
          'profile_image' =>$upload,
          'pan_image' =>$upload1,
          'adhar_image' =>$upload2,
          'gst_image' =>$upload3,
          'landmark_image' =>$upload4,
          
                    );
                  // print_r($data);die;
          $member = $this->am->insert('seller_registeration',$data);
           $last_id = $this->db->insert_id();
         $update = $this->db->where(array('id'=>$user_id))->update('user_registeration',array('kyc_status'=>1));
        //   echo $this->db->last_query();die;
          
  $query = $this->db->get_where('seller_registeration', array('user_id'=>$last_id));
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
         $result['profile_image']=$upload;
         $result['pan_image']=$upload1;
         $result['adhar_image']=$upload2;
         $result['gst_image']=$upload3;
         $result['landmark_image']=$upload4;
         $result['kyc_status']='1';
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
       $user_id=$this->input->post('user_id');
       $res = $this->am->selectres('seller_registeration',array('user_id'=>$user_id));
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
               $result['seller_profile_image']=base_url('uploads/').$row->profile_image;
               $result['msg']="record found";
               array_push($b,$result);
           }
       }
       if(!empty($res))
       {
           echo json_encode($result);
           
       }
       else{
           $val=array("status"=>"fail","message"=>"record not found","data"=>'');
           $data = json_encode($val);
           echo $data;
       }
       
   }
    

    
     public function add_seller_product()
   {
       $user_id=$this->input->post('user_id');
    
         $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
       $this->upload->initialize($config);
      if($this->upload->do_upload('image'))
      {
        $image=$this->upload->data();
       $upload=$image['file_name'];              
        //echo "file upload success"; die;
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
      
     
       $upload1="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      $this->upload->initialize($config);
      if($this->upload->do_upload('image1'))
      {
        $image=$this->upload->data();
        $upload1=$image['file_name'];              
        //echo "file upload success"; die;
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
       $upload2="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      $this->upload->initialize($config);
      if($this->upload->do_upload('image2'))
      {
        $image=$this->upload->data();
        $upload2=$image['file_name'];              
        //echo "file upload success"; die;
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
    
      $upload_video="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg|mp4",
                  'overwrite' => TRUE
                );
      $this->load->library('upload',$config);
      $this->upload->initialize($config);
      if($this->upload->do_upload('video'))
      {
        $banner=$this->upload->data();
        $upload_video=$banner['file_name'];              
         //echo "file upload success"; die;
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
        /*print_r($data['imageError']);
        exit();*/
      }
      
     $data = array(   
          'user_id'=>$this->input->post('user_id'),
          'product_name' => $this->input->post('product_name'),
          'category' => $this->input->post('category'),  
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
          'speciality' => $this->input->post('speciality'),
          'brand_name' => $this->input->post('brand_name'),
          'country' => $this->input->post('country'),
          'image' =>$upload,
          'image1' =>$upload1,
          'image2' =>$upload2,
          'video' =>$upload_video,
     
                    );
                    //echo"<pre>";
                   //print_r($data);die;
          $member = $this->am->insert('seller_product',$data);
          // echo $this->db->last_query();die;
           $last_id = $this->db->insert_id();
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
         $result['image']=$upload;
         $result['image1']=$upload1;
         $result['image2']=$upload2;
         $result['video']=$upload_video;
      $result['msg']="Product Add Successfully";
        echo json_encode($result);
       
     }
          
      }
    
    public function get_seller_product_details()
  	{
  	   $product_id=$this->input->post('product_id');
    	$res = $this->am->selectres('seller_product',array('id'=>$product_id));
	
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{   $result['status']="success";
        	$result['product_id']=$row->id;
		    $result['product_name']=$row->product_name;
			$result['brand_name']=$row->brand_name;
			$result['speciality']=$row->speciality;
			$result['description']=$row->description; 
		
			
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
       
       $total_price=$offer-$product_price+$value;
  
      //$result['discount']=$row->discount;
      $result['price']="$total_price";
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
    
    
     public function get_seller_image()
  	{
  	    
  	   $user_id=$this->input->post('user_id');
  	   //$product_id=$this->input->post('product_id');
    	$res = $this->am->selectres('seller_product',array('user_id'=>$user_id));
	
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['user_id']=$row->user_id;
		/*$a['sub_subcategory']=$row->sub_subcategory;
			$a['weight']=$row->weight;
			$a['price']=$row->price;*/
			$a['product_id']=$row->id;
			$a['product_name']=$row->product_name;
			$a['image']=base_url('uploads/').$row->image;
			$a['image1']=base_url('uploads/').$row->image1;
			$a['image2']=base_url('uploads/').$row->image2;
			$a['count']="";
		
			
			if(!empty($row->image))
			{
			    $a['image']=base_url('uploads/').$row->image;
			}
			else
			{
			    $a['image'] = "";
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
  	    
  	   //$user_id=$this->input->post('user_id');
  	   $product_id=$this->input->post('product_id');
      $res = $this->am->selectres('seller_product',array('id'=>$product_id));
	
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['user_id']=$row->user_id;
	    $a['product_id']=$row->id;
			$a['product_name']=$row->product_name;
			$a['price']=$row->price;
			$a['description']=$row->description;
			$a['video']=base_url('uploads/').$row->video;
			$a['count']="";
			
			
			if(!empty($row->video))
		{
		  $a['video']=base_url('uploads/').$row->video;  
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
    
    
    	//end seller API
    	
    	
    	
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
    //end address Api
    
    
    //get_banner_api
    
    	public function get_banner()
  	{
	$res = $this->am->selectres('banner');
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['id']=$row->id;
	
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
  	
  	//end_banner_api
  	
  	
  	
  	//get_category_api
  	public function get_category()
  	{
	$res = $this->am->selectres('category');
	 $b=array();
	  if(!empty($res))
	  {
		foreach ($res as $row)		           
		{		           
		$a['id']=$row->id;
        $a['category_name']=$row->name;
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
  	//end_get_category_api
    
    
    
    //get_product_by_category
    
    public function get_product_by_category()
    {
      $b=array();
      $category=$this->input->post('category');
      $res = $this->am->selectres('product',array("category"=>$category));
   
    if(!empty($res))
    {
    foreach ($res as $row)               
    {

      $result['id']=$row->id;

     $res1 = $this->am->selectrow('product',array('id'=>$row->id));
      
      $result['product_name']=$res1->product_name;
      
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
       
       $total_price=$offer-$product_price+$value;
  
      //$result['discount']=$row->discount;
      $result['price']="$total_price";
      $result['image']=base_url('').$res1->image;
      $res = $this->am->selectrow('brand',array('id'=>$row->brand_name));
      $result['brand_name']=$res->brand_name;
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
    
    //end_get_product_by_category
    
         public function get_seller_profile_personal()
   
   {
         
         $user_id=$this->input->post('user_id');
       $res = $this->db->select('seller_registeration.*,user_registeration.name as user_name')->where(array('seller_registeration.id'=>$user_id))->join('seller_registeration','user_registeration.id=seller_registeration.user_id')->get('user_registeration')->result();
       
      // print_r($res);
       $b=array();
       if(!empty($res))
       {
           foreach($res as $row)
           {
             
               $result['user_id']=$row->id;
               $result['seller_name']=$row->name;
               $result['shop_name']=$row->shop_name;
               $result['shop_area']=$row->shop_area;
               $result['shop_town']=$row->shop_town;
               $result['shop_distric']=$row->shop_distric;
               $result['shop_state']=$row->shop_town;
               $result['shop_pincode']=$row->shop_pincode;
               $result['pan_no']=$row->pan_no;
               $result['pan_image']=$row->pan_image;
               $result['adhar_no']=$row->adhar_no;
               $result['adhar_image']=$row->adhar_image;
               $result['gst_no']=$row->gst_no;
               $result['gst_image']=$row->gst_image;
               $result['landmark']=$row->landmark;
               $result['landmark_image']=$row->landmark_image;
               $result['profile_image']=$row->profile_image;
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

    
    
    
    
     public function select_all_product()
   {
       
      //$product_id = $this->input->post('product_id');
      $user_id = $this->input->post('user_id');
       
      $res = $this->am->selectres('seller_product',array('type'=>2,'user_id'=>$user_id));
  
     $b=array();
    if(!empty($res))
	  {
		foreach ($res as $row)		           
		{
			   // $result['product_id']=$row->product_id;
			    $result['type']=$row->type;
			    $result['user_id']=$row->user_id;
			    $result['price']=$row->price;
  	            $result['color']=$row->color;
  	            $result['product_name']=$row->product_name;
  	            $result['height']=$row->height;
  	            $result['weight']=$row->weight;
  	            $result['width']=$row->width;
  	            $result['length']=$row->length;
  	            $result['speciality']=$row->speciality;
  	            $result['discount']=$row->discount;
  	            $result['other_offer']=$row->other_offer;
  	            $result['delivery_charge']=$row->delivery_charge;
  	            $result['brand_name']=$row->brand_name;
  	            $result['country']=$row->country;
  	            $result['category']=$row->category;
  	            $result['description']=$row->description;
  	            $result['status']=$row->status;
  	            $result['image']=base_url('uploads/').$row->image;
  	           $result['image1']=base_url('uploads/').$row->image1;
  	           $result['image2']=base_url('uploads/').$row->image2;
  	           $result['video']=base_url('uploads/').$row->video;


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
              
              if($status==1){
               $data = array(		
			 		'user_id' => $this->input->post('user_id'),
			 		'product_id' => $this->input->post('product_id'),
			 		'status' =>1
                    );
                    
                   $res1 = $this->am->insert('tbl_wishlish',$data); 
                   
                   $query=$this->db->query('SELECT * FROM tbl_wishlish');
                   $count = $query->num_rows();
                                                
               
                 $val= array("status" => "success","message"=>"Like Successfully","count"=>"$count");
	            $data= json_encode($val);
	            echo $data;
              }
             
                    
              else{
                  $res = $this->db->where( array(		
			 		'user_id' => $this->input->post('user_id'),
			 		'product_id' => $this->input->post('product_id')
                    ))->delete('tbl_wishlish'); 
                      $val= array("status" => "success","message"=>"UnLike Successfully");
	            $data= json_encode($val);
	            echo $data;
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
        $result['order_date']=$row->created_at	;
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
      $result['product_name']=$product_row->product_name;
      $product_detail = $this->am->selectrow('product',array('id'=>$product_row->product_id,));
      $result['product_image']=$product_detail->image?base_url('uploads/').$product_detail->image:'';
      
      $product_res = $this->am->selectres('check_out',array('user_id'=>$row->user_id,'order_id'=>$order_id));
      $count=0;
      foreach($product_res as $pro_res){
          $total_amount +=$pro_res->product_price;
          $count++;
      }
    //   $result['product_id']=$row->product_id;
    
    
    $result['total_amount_product']=$total_amount;
    $result['product_count']=$count;
      
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
    
  
    
    
    
}    


    