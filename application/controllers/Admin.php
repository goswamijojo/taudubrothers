<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
  public function __construct()
   {
    parent::__construct(); 
    $this->load->model('Admin_Model','am');
    $this->load->library("form_validation");
    $this->load->library('email');
    $this->load->library('session');
    $this->load->library('common'); 
    $this->load->helper('text');
    $this->load->helper('url');
 }//__construct method close        
   public function index()
  {
    $this->load->view('admin/login'); 
    if($_POST)
    { 
        $pass=strtolower($this->input->post('password'));
        $email=strtolower($this->input->post('email'));
        $row=$this->am->login($email,$pass);
        
        if($row)
        {
          $this->session->set_userdata("Aid",$row->id);
          $this->session->set_userdata("Aname",$row->name);
          return redirect(base_url('admin/dashboard')); 
        }
        else
        {
        $this->session->set_flashdata('pwd_error', 'Wrong  Email or Password');
        return redirect(base_url('admin/index'));
        }  
    }
 }
 
 
   public function test_noti(){
      $load = array();
     $username = "test";
    $load['title'] = "demo";  
    $load['message'] = "This is a test msg from".$username;                    
    $token[] =  "e85SoFbbRFGlsatvs2EIb0:APA91bFTMK2-Wbv2WNIFIfzWKcBhbugjchWIvuGCbi9eoT6o3Fs3cC42O0V871_I92fZiR00-wYkIfgeJITq8wb61YwXk25fAmd6h0NCNtUqPjV6NNV7O84zZOhtOm8cLXe03oB6I4Oo"; 
    $res= $this->common->android_push($token, $load, 'AAAAOV5s2ng:APA91bHDOzpehQu_TGDaSntqwIX1xb-KrYkL6lai2OyYhhIkLw4SFXJuz83wKrYvZ3fMtLPtPLW2KhKmLu23dpcORVPq3FmwpgOt_ih6j9QZeLz1hqAUZzaHsZRfWS7V9e7blIDonLxl'); 
 print_r($res); die;
  }
 

  public function notissetuser()
  {
    if(!$this->session->userdata("Aid"))
    return redirect(base_url("admin/index"));
  }//notissetuser

     public function logout()
  {
    $this->notissetuser();
    $this->session->unset_userdata("Aid"); 
    $this->session->unset_userdata("Auserid"); 
    $this->session->unset_userdata("Afullname");
     return redirect(base_url('admin/')); 
  }//logout method close
  
  
 public function dashboard()
 {
  $this->notissetuser();
  $this->load->view('admin/header'); 
  $this->load->view('admin/dashboard'); 
  $this->load->view('admin/footer'); 
 }

     
           public function edit_profile($id)
        {

                  if(!empty($_POST))
                  {           
                           $data = array(          
                              'fullname' =>$this->input->post('fullname'),
                              'mobile_no' => $this->input->post('mobile_no'),
                              'email' =>$this->input->post('email'),
                              'password' =>md5($this->input->post('password')),
                              'aadhar_card' => $this->input->post('aadhar_card'),
                              'pan_card' =>$this->input->post('pan_card'),
                         );
                          // print_r($data);die;
                        $this->db->where('id',$id);
                        $this->db->update('user_registeration',$data);   
                        $this->session->set_flashdata('success_msg', 'Data Save Successfully..');
                        return redirect($_SERVER['HTTP_REFERER']);
                  }
            else
            {
             // $this->session->set_flashdata('pwd_error', 'Data Not Edit Successfully..');
              $result['data'] = $this->am->selectr('user_registeration',array('id'=>$id));  
             $this->notissetuser();
     $this->load->view('admin/dashboardheader');
     $this->load->view('admin/MyProfile',$result);
     $this->load->view('admin/footer');
            }
      }
      
          public function debit_payment_details()
    {
      $result['data'] = $this->am->selectres('daily_bouns'); 
      $this->load->view('admin/dashboardheader');
      $this->load->view('admin/debit_payment_details',$result);
      $this->load->view('admin/footer');
    }
    
    
    public function credit_details()
    {
      $result['data'] = $this->am->selectres('user_registeration',array('status'=>1)); 
      $this->load->view('admin/dashboardheader');
      $this->load->view('admin/credit_amount_details',$result);
      $this->load->view('admin/footer');

    }
    
    public function user_list()
    {
      $this->notissetuser();
      $result['data'] = $this->am->selectres('user_registeration');
      $this->load->view('admin/header');
      $this->load->view('admin/user_list',$result);
      $this->load->view('admin/footer');
    }
    
     public function order_list()
    {
         $this->notissetuser();
          $result['data'] = $this->am->get_order_list();
    //     echo"<pre>";
    //   print_r($result1); die;
          $result['data'] = $this->am->selectres('user_payment_details',array('order_confirm'=>1));
     
          //$result['data1'] = $this->am->selectres('add_user');
           $this->load->view('admin/header');
           $this->load->view('admin/order_list',$result);
           $this->load->view('admin/footer');
    }
    
    

    //  public function order_list()
    // {
    //   //$result['data'] = $this->am->get_order_list();
    //     $result['data'] = $this->am->selectres('cart');
    //   $this->load->view('admin/header');
    //   $this->load->view('admin/order_list',$result);
    //   $this->load->view('admin/footer');
    // }
    
    
     public function purchase_product_list($order_id)
    {
        $this->db->select('user_payment_details.*,check_out.*');
        $this->db->from('user_payment_details')->where('check_out.order_id',$order_id);
        $this->db->join('check_out', 'user_payment_details.order_id = check_out.order_id'); 
        $query = $this->db->get();
        $row=$query->row();
        $result['data']= $query->result();
      $this->load->view('admin/header');
      $this->load->view('admin/purchase_product_list',$result);
      $this->load->view('admin/footer');
    }

    public function best_seller()
    {
      $result['data'] = $this->am->selectres('category');
      $this->load->view('admin/header');
      $this->load->view('admin/add_best_seller_price',$result);
      $this->load->view('admin/footer');
    }
    
    public function category()
    {
      $this->notissetuser();    
      $result['data'] = $this->am->selectres('category');
      $this->load->view('admin/header');
      $this->load->view('admin/add_category',$result);
      $this->load->view('admin/footer');
    }

public function add_category()
        {
          $this->notissetuser();
          $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('image'))
      {
        $banner=$this->upload->data();
        $upload=$banner['file_name']; 
       
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
      
       $slug =  url_title(convert_accented_characters(strtolower(strip_tags(preg_replace ('/[0-9]+$/','-',$this->input->post('name'))))), 'dash', true);
            $data = array(     
                      'type' => $this->input->post('type'),
                      'name' => $this->input->post('name'),
                      'image' =>$upload,
                      'slug'  =>$slug
                         );
           
        $res = $this->am->insert('category',$data); 
        $this->session->set_flashdata('success_msg', 'Category Add Successfully..');
        return redirect(base_url().'Admin/category');
      }
     public function category_list()
      {
           //$this->notissetuser();
          $result['data'] = $this->am->selectres('category');
          $this->load->view('admin/dashboardheader');
         $this->load->view('super_admin/category_list',$result);
         $this->load->view('admin/footer');
      }
  public function add_price()
        {
          $this->notissetuser();
          $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('image'))
      {
        $banner=$this->upload->data();
        $upload=$banner['file_name'];              
         
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
        $price2= $this->input->post('price2');
        $discount=  $this->input->post('discount');
                
        $percentage = $discount;
        $totalValue =$price2;
 
        // 10% of 500
        $newValue = ($percentage*$totalValue)/100;
        $abc=$price2- $newValue;
     
            $data = array(          
                      'name'=>$abc,
                      'price2'=>$price2,
                      'discount'=>$discount,
                      'image' =>$upload,
                         );
            //print_r($data);die;
        $res = $this->am->insert('category',$data); 
        $this->session->set_flashdata('success_msg', 'Product Add Successfully..');
        return redirect(base_url().'Admin/best_seller');
      }
         public function edit_best_seller($id)
        {
          
          if(!empty($_POST))
      {   
        $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
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
   
      if(!empty($upload))
      {
        $data = array(  
        'name' => $this->input->post('price1'),
        'price2' => $this->input->post('price2'),
        'discount' => $this->input->post('discount'),
        'image'=>$upload,
        );
        $this->db->where('id',$id);
        $this->db->update('category',$data); 
        $this->session->set_flashdata('success_msg', 'Category Edit Successfully..');
        return redirect(base_url().'admin/best_seller');
      }
      else
      {
          $data = array(  
        'name' => $this->input->post('price1'),  
        'price2' => $this->input->post('price2'),
        'discount' => $this->input->post('discount'),
        );
        $this->db->where('id',$id);
        $this->db->update('category',$data);
        $this->session->set_flashdata('success_msg', 'Category Edit Successfully..');
        return redirect(base_url().'admin/best_seller');
      }
    }
    else
    {  
        $result['data'] = $this->am->selectrow('category',array('id'=>$id));
        $result['data1'] = $this->am->selectres('category');
        $this->load->view('admin/header');
        $this->load->view('admin/edit_category',$result);
        $this->load->view('admin/footer');
    }
  }


   public function edit_subcategory($id)
        {
          
          if(!empty($_POST))
      {   
        $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
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
   
      if(!empty($upload))
      {
        $slug = url_title(convert_accented_characters(strtolower(strip_tags(preg_replace ('/[0-9]+$/','-',$this->input->post('sub_category'))))), 'dash', true);
         $slugs=$slug;  
        $data = array(  
                      'category_name' => $this->input->post('category'),
                      'sub_category' => $this->input->post('sub_category'),
                      'slug'=>$slugs,
                    //   'weight' => $this->input->post('weight'),
                    //   'price' => $this->input->post('price'),
                    //     'price2' => $this->input->post('price2'),
                      'image'=>$upload,
        );
        $this->db->where('id',$id);
        $this->db->update('subcategory',$data); 
        $this->session->set_flashdata('success_msg', 'SubCategory Edit Successfully..');
        return redirect(base_url().'admin/sub_category');
      }
      else
      {
          $data = array(  
                      'category_name' => $this->input->post('category'),
                      'sub_category' => $this->input->post('sub_category'),
                       'weight' => $this->input->post('weight'),
                       'price' => $this->input->post('price'),
                        'price2' => $this->input->post('price2'),
                     // 'image'=>$upload,
        );
        $this->db->where('id',$id);
        $this->db->update('subcategory',$data);
        $this->session->set_flashdata('success_msg', 'SubCategory Edit Successfully..');
        return redirect(base_url().'admin/sub_category');
      }
    }
    else
    {  
        $this->notissetuser();
        $result['data'] = $this->am->selectrow('subcategory',array('id'=>$id));
        $result['cat'] = $this->am->selectres('category');
        $this->load->view('admin/header');
      $this->load->view('admin/edit_subcategory',$result);
      $this->load->view('admin/footer');
    }
  }


     public function edit_sub_subcategory($id)
        {
          
          if(!empty($_POST))
      {   
        $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
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
   
      if(!empty($upload))
      {
        $data = array(  
                      'category' => $this->input->post('category'),
                      'subcategory' => $this->input->post('subcategory'),
                       'sub_subcategory' => $this->input->post('sub_subcategory'),
                       'weight' => $this->input->post('weight'),
                       'price' => $this->input->post('price'),
                       'price2' => $this->input->post('price2'),
                       'image'=>$upload,
        );
        $this->db->where('id',$id);
        $this->db->update('sub_subcategory',$data); 
        $this->session->set_flashdata('success_msg', 'Sub_SubCategory Edit Successfully..');
        return redirect(base_url().'admin/sub_subcategory');
      }
      else
      {
          $data = array(  
                      'category' => $this->input->post('category'),
                      'subcategory' => $this->input->post('subcategory'),
                       'sub_subcategory' => $this->input->post('sub_subcategory'),
                       'weight' => $this->input->post('weight'),
                       'price' => $this->input->post('price'),
                       'price2' => $this->input->post('price2'),
                      // 'image'=>$upload,
        );
        $this->db->where('id',$id);
        $this->db->update('sub_subcategory',$data);
        $this->session->set_flashdata('success_msg', 'Sub_SubCategory Edit Successfully..');
        return redirect(base_url().'admin/sub_subcategory');
      }
    }
    else
    {  
         $result['cat'] = $this->am->selectres('category');
          $result['subcat'] = $this->am->selectres('subcategory');
          $result['sub_subcat'] = $this->am->selectres('sub_subcategory');
         $result['data'] = $this->am->selectrow('sub_subcategory',array('id'=>$id));
        $this->load->view('admin/header');
      $this->load->view('admin/edit_sub_subcategory',$result);
      $this->load->view('admin/footer');
    }
  }
  
  
   public function delete_user($id)
  {
    $this->am->delete('user_registeration',$id);
    if($id)
    {
      $this->session->set_flashdata('success_msg', "Delete Successfully.");
      //redirect(base_url('Admin/category'));
      return redirect($_SERVER['HTTP_REFERER']);
    }
  }

  public function delete_best_seller($id)
  {
    $this->am->delete('category',$id);
    if($id)
    {
      $this->session->set_flashdata('success_msg', "Category Delete Successfully.");
      //redirect(base_url('Admin/category'));
      return redirect($_SERVER['HTTP_REFERER']);
    }
  }
  public function delete_subcategory($id)
  {
    $this->am->delete('subcategory',$id);
    if($id)
    {
      $this->session->set_flashdata('success_msg', "Sub Category Delete Successfully.");
      //redirect(base_url('Admin/sub_category'));
      return redirect($_SERVER['HTTP_REFERER']);
    }
  }

  public function delete_sub_subcategory($id)
  {
    $this->am->delete('sub_subcategory',$id);
    if($id)
    {
      $this->session->set_flashdata('success_msg', "Sub Category Delete Successfully.");
     // redirect(base_url('Admin/sub_subcategory'));
      return redirect($_SERVER['HTTP_REFERER']);
    }
  }

  public function delete_banner($id)
  {
    $this->am->delete('banner',$id);
    if($id)
    {
      $this->session->set_flashdata('success_msg', "Banner Delete Successfully.");
      redirect(base_url('Admin/banner'));
    }
  }

   public function sub_category()
    {
       $this->notissetuser();
       $result['data'] = $this->am->selectres('category');
       $result['data1'] = $this->am->selectres('subcategory');
      $this->load->view('admin/header');
      $this->load->view('admin/add_subcategory',$result);
      $this->load->view('admin/footer');
    }

    public function add_subcategory()
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
        $upload=$banner['file_name'];              
          //echo "file upload success";
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
            // $this->notissetuser();
            $q=$this->db->get_where("subcategory",array("sub_category"=>$this->input->post('sub_category')));
                if($q->num_rows())
                 {
                       $this->session->set_flashdata('failsmsg',"Already Exist..");
                        return redirect($_SERVER['HTTP_REFERER']);
                 }
         else{
             $slug =  url_title(convert_accented_characters(strtolower(strip_tags(preg_replace ('/[0-9]+$/','-',$this->input->post('sub_category'))))), 'dash', true);
            $data = array(          
                      'category_name' => $this->input->post('category_name'),
                      'sub_category' => $this->input->post('sub_category'),
                    //   'weight' => $this->input->post('weight'),
                    //   'price' => $this->input->post('price'),
                    //     'price2' => $this->input->post('price2'),
                        'slug'=>$slug,
                        'image'=>$upload,
                         );
        $res = $this->am->insert('subcategory',$data); 
        $this->session->set_flashdata('success_msg', 'Sub Category Add Successfully..');
        return redirect(base_url().'Admin/sub_category');
      }
    }


 public function sub_subcategory()
    {
       $result['data'] = $this->am->selectres('category');
       $result['data1'] = $this->am->selectres('subcategory');
       $result['sub_subcat'] = $this->am->selectres('sub_subcategory');
       //print_r($result1);die;
      $this->load->view('admin/header');
      $this->load->view('admin/add_sub_subcategory',$result);
      $this->load->view('admin/footer');
    }

    public function add_sub_subcategory()
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
        $upload=$banner['file_name'];              
          //echo "file upload success";
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
           //$this->notissetuser();
            $q=$this->db->get_where("sub_subcategory",array("sub_subcategory"=>$this->input->post('sub_subcategory')));
                if($q->num_rows())
                 {
                       $this->session->set_flashdata('failsmsg',"Already Exist..");
                        return redirect($_SERVER['HTTP_REFERER']);
                 }
         else{
            $data = array(          
                      'category' => $this->input->post('category'),
                      'subcategory' => $this->input->post('subcategory'),
                       'sub_subcategory' => $this->input->post('sub_subcategory'),
                       'weight' => $this->input->post('weight'),
                       'price' => $this->input->post('price'),
                        'price2' => $this->input->post('price2'),
                       
                       'image'=>$upload,
                         );
          
        $res = $this->am->insert('sub_subcategory',$data); 
        $this->session->set_flashdata('success_msg', 'Sub Category Add Successfully..');
        return redirect(base_url().'Admin/sub_subcategory');
      }
        }

      public function banner()
    {
           $this->notissetuser();
           $result['data'] = $this->am->selectres('banner');
           $this->load->view('admin/header');
           $this->load->view('admin/add_banner',$result);
           $this->load->view('admin/footer');
    
    }

    public function add_banner()
        {
          $this->notissetuser();
          $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('image'))
      {
        $banner=$this->upload->data();
        $upload=$banner['file_name'];              
         
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
            $data = array(          
                      'url' => $this->input->post('url'),
                      'image' =>$upload,
                       'type'=>$this->input->post('type')
                        );
            //print_r($data);die;
        $res = $this->am->insert('banner',$data); 
        $this->session->set_flashdata('success_msg', 'Banner Add Successfully..');
        return redirect(base_url().'Admin/banner');
      }
     
     
      //====================    22-12-2020=========================//

   
    public function product()
    {
          $this->notissetuser();    
          $result['cat'] = $this->am->selectres('category');
          $result['subcat'] = $this->am->selectres('subcategory');
          $result['sub_subcat'] = $this->am->selectres('sub_subcategory');
          $result['product'] = $this->am->selectres('product');
          $result['brand_name'] = $this->am->selectres('brand');
          $result['data'] = $this->am->get_product('product');
          $this->load->view('admin/header');
          $this->load->view('admin/add_product',$result);
          $this->load->view('admin/footer');
    }


     public function product_list()
    {
       $this->notissetuser();
       $result['cat'] = $this->am->selectres('category');
       $result['subcat'] = $this->am->selectres('subcategory');
       $result['sub_subcat'] = $this->am->selectres('sub_subcategory');
       $result['product'] = $this->am->selectres('seller_product',array(  
        'type'=>1));
       $result['brand_name'] = $this->am->selectres('brand');
      $this->load->view('admin/header');
      $this->load->view('admin/product_list',$result);
      $this->load->view('admin/footer');
    }
    
  public function add_product()
  {
    $upload_video="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg|mp4",
                  'overwrite' => TRUE,
                  'encrypt_name' => TRUE
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('video'))
      {
        $banner=$this->upload->data();
        $upload_video=$banner['file_name'];              
          //echo "file upload success"; die;
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
        
         //echo "file fille"; die;
      }
      $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE,
                  'encrypt_name' => TRUE
                );
      $this->load->library('upload',$config);
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
                  'overwrite' => TRUE,
                  'encrypt_name' => TRUE
                );
      $this->load->library('upload',$config);
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
                  'overwrite' => TRUE,
                  'encrypt_name' => TRUE
                );
      $this->load->library('upload',$config);
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
       $upload3="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE,
                  'encrypt_name' => TRUE
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('image3'))
      {
        $image=$this->upload->data();
        $upload3=$image['file_name'];              
        //echo "file upload success"; die;
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
      $slug =  url_title(convert_accented_characters(strtolower(strip_tags(preg_replace ('/[0-9]+$/','-',$this->input->post('product_name'))))), 'dash', true); 
       $data = array(  
        'category' => $this->input->post('category'),  
        'subcategory' => $this->input->post('subcategory'),  
          'type'=>1,    
        'brand_name' => $this->input->post('brand_name'),
        'product_name' => $this->input->post('product_name'),
        'quantity' =>$this->input->post('quantity'),
        'weight' =>$this->input->post('weight'),
        'price' =>$this->input->post('price'),
        'discount' =>$this->input->post('discount')?$this->input->post('discount'):'0',
        'slug'=>$slug,
        'image'=>"uploads/".$upload,
        'image1'=>"uploads/".$upload1,
        'image2'=>"uploads/".$upload2,
        'image3'=>"uploads/".$upload3,
        'video'=>"uploads/".$upload_video,
        'description' =>$this->input->post('description'),
        
        );
        //  echo "<pre>";
        //  print_r($data);die;
        $res = $this->am->insert('seller_product',$data);
        $this->session->set_flashdata('success_msg', 'Product Add Successfully..');
        return redirect(base_url().'admin/product_list');
      }

      public function edit_product($id)
        {
          if(!empty($_POST))
      {   
      $upload_video="";
          $config = array('upload_path' =>'./video/', 
                'allowed_types' => "gif|jpg|png|jpeg|mp4",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('video'))
      {
        $banner=$this->upload->data();
        $upload_video=$banner['file_name'];              
          //echo "file upload success"; die;
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
        
         //echo "file fille"; die;
      }
     $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
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
       $upload3="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('image3'))
      {
        $image=$this->upload->data();
        $upload3=$image['file_name'];              
        //echo "file upload success"; die;
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      } 
      
      if(!empty($upload) OR!empty($upload1) OR!empty($upload2) OR!empty($upload3) OR!empty($upload_video))
      {
          
         $slug = url_title(convert_accented_characters(strtolower(strip_tags(preg_replace ('/[0-9]+$/','-',$this->input->post('product_name'))))), 'dash', true);
         $slugs=$slug;
         $data = array(  
        'type'=>1,         
        'category' => $this->input->post('category'),  
        'brand_name' => $this->input->post('brand_name'), 
        'subcategory' => $this->input->post('subcategory'),  
        'product_name' => $this->input->post('product_name'),
        'quantity' =>$this->input->post('quantity'),
        'weight' =>$this->input->post('weight'),
        'price' =>$this->input->post('price'),
        'slug'=>$slugs,
        'image'=>"uploads/".$upload,
        'image1'=>"uploads/".$upload1,
        'image2'=>"uploads/".$upload2,
        'image3'=>"uploads/".$upload3,
        'video'=>"uploads/".$upload_video,
        'description' =>$this->input->post('description'),
        );
            
        $this->db->where('id',$id);
        $this->db->update('seller_product',$data); 
        $this->session->set_flashdata('success_msg', 'Product Edit Successfully..');
        return redirect(base_url().'admin/product_list');
      }
      else
      {
        // echo"hello php else";  die;
         $slug = url_title(convert_accented_characters(strtolower(strip_tags(preg_replace ('/[0-9]+$/','-',$this->input->post('product_name'))))), 'dash', true);
         $slugs=$slug;
         $data = array(  
        'type'=>1,  
        'category' => $this->input->post('category'),  
        'subcategory' => $this->input->post('subcategory'),  
        'brand_name' => $this->input->post('brand_name'),  
        'product_name' => $this->input->post('product_name'),
        'quantity' =>$this->input->post('quantity'),
        'weight' =>$this->input->post('weight'),
        'price' =>$this->input->post('price'),
        'slug'=>$slugs,
        'description' =>$this->input->post('description'),
        );
        $this->db->where('id',$id);
        $this->db->update('seller_product',$data);
        $this->session->set_flashdata('success_msg', 'Product Edit Successfully..');
        return redirect(base_url().'admin/product_list');
      }
    }
    else
    {    
        $this->notissetuser();
        
          $result['brand'] = $this->am->selectres('brand');
          $result['cat'] = $this->am->selectres('category');
          $result['subcat'] = $this->am->selectres('subcategory');
          $result['sub_subcat'] = $this->am->selectres('sub_subcategory');
          $result['product'] = $this->am->selectres('product');
          $result['data'] = $this->am->selectrow('seller_product',array('id'=>$id));
          $this->load->view('admin/header');
      $this->load->view('admin/edit_product',$result);
      $this->load->view('admin/footer');
    }
  }

    public function delete_product($id)
  {
    $this->am->delete('seller_product',$id);
    if($id)
    {
      $this->session->set_flashdata('smsg', "Product Delete Successfully.");
     
      return redirect($_SERVER['HTTP_REFERER']);
    }
  }
  
  public function seller_delete_product($id)
  {
    $this -> db -> where('id', $id);
    $this -> db -> where('type', '2');
    $this -> db -> delete('seller_product');
    $this->session->set_flashdata('smsg', "Product Delete Successfully.");
    return redirect('Admin/seller_product_manage');
  }
  

public function subcategoryget()
  {
  $cid= $_POST['cid'];
  $con = array('category_name'=>$cid);
    $data = $this->am->selectres('subcategory',$con);
        echo '<option disabled selected value>--Select Sub Category--</option>';
                    if(!empty($data))
                    {
                     foreach($data as $val)
                     {
                      echo ' <option value='.$val->id.'>'.$val->sub_category.'</option>';
                     }
                    }
  }

  public function sub_subcategoryget()
  {
  $scid= $_POST['scid'];
  $con = array('subcategory'=>$scid);
    $data = $this->am->selectres('sub_subcategory',$con);
        echo '<option disabled selected value>--Select Sub SubCategory--</option>';
                    if(!empty($data))
                    {
                     foreach($data as $val)
                     {
                      echo ' <option value='.$val->id.'>'.$val->sub_subcategory.'</option>';
                     }
                    }
  }
  
  
  public function changestatus()
        {
           $user_id =$this->input->post('user_id');  
         $data = array(  
        'status'=>'1',
        );
        $this->db->where('id',$user_id);
        $this->db->update('user_registeration',$data); 
        $this->session->set_flashdata('success_msg', 'Status Change Successfully..');
        return redirect($_SERVER['HTTP_REFERER']);
      }
      public function changestatus1()
        {
           $user_id =$this->input->post('user_id');  
         $data = array(  
        'status'=>'0',
        );
        $this->db->where('id',$user_id);
        $this->db->update('user_registeration',$data); 
        $this->session->set_flashdata('success_msg', 'Status Change Successfully..');
        return redirect($_SERVER['HTTP_REFERER']);
      }
  
  
   public function change_statuse3()
        {
        $order_id =$this->input->post('order_id');  
        $data = array(  
        'order_id' => $this->input->post('order_id'),  
        'status'=>'0',
        );
        $this->db->where('order_id',$order_id);
        $this->db->where('status','1');
        $this->db->update('user_payment_details',$data); 
        $this->session->set_flashdata('success_msg', 'Category Edit Successfully..');
        return redirect($_SERVER['HTTP_REFERER']);
      }
      
      public function notifaction()
		{
		    $this->notissetuser();
			$this->notissetuser();
			$result['data'] = $this->am->selectres('notifaction');
			$this->load->view('admin/header');
			$this->load->view('admin/notifaction',$result);
			$this->load->view('admin/footer');
		}
        public function add_notifaction()
		{
		$this->notissetuser();
		 $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
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
		$data = array(
		'title' => $this->input->post('title'),
		'description' => $this->input->post('description'),
		'image'=>$upload,
		);
		$notifaction = $this->am->insert('notifaction',$data);
			if($notifaction)
				{
				   
    $load['title'] = $this->input->post('title');  
    $load['body'] = $this->input->post('description'); 
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
            $key="1";
            $ress= $this->common->android_push($token, $load,$key); 
            
        }

				$this->session->set_flashdata('success_msg', 'Notifaction Add Successfully');
				return redirect($_SERVER['HTTP_REFERER']);
			}
		}

      public function send_message($id)
		{
		  $date=date('Y-m-d');
		  
		    $result = $this->am->selectres('users');
				foreach ($result as $key => $value){
				$user_id = $value->id;
				
		$this->notissetuser();
		$data = array(
		'notifaction_id'=>$id,
		'user_id'=>$user_id,
		'date'=>$date,
		);
		$message = $this->am->insert('message',$data);
				}
			if($message)
				{
				$this->session->set_flashdata('success_msg', 'send message Successfully');
				return redirect($_SERVER['HTTP_REFERER']);
			}
		}
 


public function brand()
		{
		  
			$this->notissetuser();
			$result['data'] = $this->am->selectres('brand');
			$this->load->view('admin/header');
			$this->load->view('admin/add_brand',$result);
		}
		
		
  public function add_brand()
        {
            $data = array(    
                      'type' => $this->input->post('type'),
                      'brand_name' => $this->input->post('brand_name')
                         );
        $res = $this->am->insert('brand',$data); 
        $this->session->set_flashdata('success_msg', 'Brand Name Add Successfully..');
        return redirect(base_url().'Admin/brand');
      
    }
    
    public function delete_brand($id)
  {
    $this->am->delete('brand',$id);
    if($id)
    {
      $this->session->set_flashdata('success_msg', "Brand Delete Successfully.");
     
      return redirect($_SERVER['HTTP_REFERER']);
    }
  }
   
   public function color()
		{
			$this->notissetuser();
			$result['data'] = $this->am->selectres('color');
			$this->load->view('admin/header');
			$this->load->view('admin/add_color',$result);
			$this->load->view('admin/footer');
		}
		
		
  public function add_color()
        {
            $data = array(          
                      'color_name' => $this->input->post('color_name'),
                      
                         );
        $res = $this->am->insert('color',$data); 
        $this->session->set_flashdata('success_msg', 'Color Name Add Successfully..');
        return redirect(base_url().'Admin/color');
      
    }
    
    public function delete_color($id)
  {
    $this->am->delete('color',$id);
    if($id)
    {
      $this->session->set_flashdata('success_msg', "Color Delete Successfully.");
     
      return redirect($_SERVER['HTTP_REFERER']);
    }
  }
  
   public function delete_category($id)
  {
    $this->am->delete('category',$id);
    if($id)
    {
      $this->session->set_flashdata('success_msg', "Category Delete Successfully.");
     
      return redirect($_SERVER['HTTP_REFERER']);
    }
  }
  
              public function edit_category($id)
        {
          
          if(!empty($_POST))
      {   
        $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('image'))
      {
        $image=$this->upload->data();
        $upload=$image['file_name'];              
        
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
   
      if(!empty($upload))
      {
        $slug =  url_title(convert_accented_characters(strtolower(strip_tags(preg_replace ('/[0-9]+$/','-',$this->input->post('name'))))), 'dash', true);  
        $data = array(  
             'type' => $this->input->post('type'),
        'name' => $this->input->post('name'),
        'slug' =>$slug,
        'image'=>$upload
        );
        $this->db->where('id',$id);
        $this->db->update('category',$data); 
        $this->session->set_flashdata('success_msg', 'Category Edit Successfully..');
        return redirect(base_url().'admin/category');
      }
      else
      {
          $slug = url_title(convert_accented_characters(strtolower(strip_tags(preg_replace ('/[0-9]+$/','-',$this->input->post('name'))))), 'dash', true);
         $slugs=$slug;
          $data = array(  
               'type' => $this->input->post('type'),
        'name' => $this->input->post('name'),  
        'slug'=>$slugs
        );
         
        $this->db->where('id',$id);
        $this->db->update('category',$data);
        $this->session->set_flashdata('success_msg', 'Category Edit Successfully..');
        return redirect(base_url().'admin/category');
      }
    }
    else
    {
        if (isset($this->session->userdata['Aid']))
             {
        $result['data']=$this->db->order_by('type','ASC');
        $result['data'] = $this->am->selectrow('category',array('id'=>$id));
        $result['data1'] = $this->am->selectres('category');
        $this->load->view('admin/header');
        $this->load->view('admin/edit_category',$result);
        $this->load->view('admin/footer');
             }
       else{
           redirect('admin');
       }         
    }
  }
  
  
       public function change_status()
        {
           $order_id =$this->input->post('order_id');  
           $row = $this->am->selectrow('user_payment_details',array('order_id'=>$order_id));
           
           $row1 = $this->am->selectrow('user_registeration',array('id'=>$row->user_id));
           $user_id=$row->user_id;
             $device_id=$row1->device_id;
             
           
            $status =$this->input->post('status');  
       
            if($status=='Pending')
            {
                $status=1;
              
                  $title='Order On Process';
                  $body='Your order is being processed from Whyshy';
                  $type=2;
                  $this->check_notification($device_id,$title,$body,$type,$user_id);
            }
            elseif($status=='order_shiped')
            {
                $status=2;
                $title='Order Shipped';
                  $body='Your item has been shipped';
                  $type=3;
                  $this->check_notification($device_id,$title,$body,$type,$user_id);
            }
            elseif($status=='out_of_delivery')
            {
                $status=3;
                $title='Order Out of delivery';
                  $body='Your item is out for delivery';
                  $type=4;
                  $this->check_notification($device_id,$title,$body,$type,$user_id);
            }
            elseif($status=='Delivered')
            {
                $status=4;
                 $title='Order Delivered ';
                  $body='Your item has been delivered';
                  $type=5;
                  $this->check_notification($device_id,$title,$body,$type,$user_id);
            }
            else
            {
                $status=5;
                $title='Order Cancelled';
                  $body='As per your request, your item has been cancelled ';
                  $type=6;
                  $this->check_notification($device_id,$title,$body,$type,$user_id); 
            }
            
                 
        $data = array(  
        
            'status'=>$status,
        );
        $this->db->where('order_id',$order_id);
        $this->db->update('user_payment_details',$data); 
        $this->session->set_flashdata('success_msg', 'Status Update Successfully..');
        return redirect($_SERVER['HTTP_REFERER']);
      }
  
      public function check_notification($device_id,$title,$body,$type,$user_id){
   $dType='Android';
    $regId =$device_id;
 
   
      
 
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
     
      $headers = array('Authorization:key=AAAAq8WSTE4:APA91bGGzJb89mxsQNlqd_N0yvepJePixrGRpDaDfrgYpvhsjCh5gtv3L8iYLGFA-i-a1iIwwVv_r2FzLHV3XCM1EH3To4Mhxc19-of80T5iIalDjG8xDoup2ovqRhjvx5NfYf_Ebn0x','Content-Type:application/json');
     
      $ch = curl_init();
     
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      $result = curl_exec($ch);
      if ($result === FALSE) {
        //   die('Curl failed: ' . curl_error($ch));
      }
      curl_close($ch);
      return true;
  
  } 
  
   public function  seller_product_manage(){
       
       if (isset($this->session->userdata['Aid']))
        {
           $result['data'] = $this->db->select('seller_product.*, category.name as category, brand.brand_name, subcategory.sub_category as subcategory ')->where(array('seller_product.type'=>2))
           ->join('brand','brand.id=seller_product.brand_name','left')
           ->join('category','category.id=seller_product.category','left')
           ->join('subcategory','subcategory.id=seller_product.subcategory','left')->get('seller_product')->result();
          
           
           $this->load->view('admin/header');
           $this->load->view('admin/seller_product_manage',$result);
           $this->load->view('admin/footer');
        }
        else
        {
            redirect('admin');
        }
   }
   
   public function testimonial()
    {
        if (isset($this->session->userdata['Aid']))
             {
      $result['data'] = $this->am->selectres('testimonial');
      $this->load->view('admin/header');
      $this->load->view('admin/testimonial',$result);
      $this->load->view('admin/footer');
             }
             else
             {
                 redirect('admin');
             }
    } 
  
   public function add_testimonial(){
       $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('image'))
      {
        $image=$this->upload->data();
        $upload=$image['file_name'];              
      
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
       
        $data = array(  
        'title' => $this->input->post('title'),  
        'designation' => $this->input->post('designation'),  
        'description' => $this->input->post('description'),
        'image'=>$upload,
        'status' =>1,
        );
        
        $res = $this->am->insert('testimonial',$data);
        $this->session->set_flashdata('success_msg', 'Testimonial Add Successfully..');
        return redirect(base_url().'admin/testimonial');
   } 
   
     public function delete_testimonial($id)
  {
    $this->am->delete('testimonial',$id);
    if($id)
    {
      $this->session->set_flashdata('success_msg', "Testimonial Delete Successfully.");
      redirect(base_url('Admin/testimonial'));
    }
  }
  
               public function edit_testimonial($id)
        {
          
          if(!empty($_POST))
      {   
        $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('image'))
      {
        $image=$this->upload->data();
        $upload=$image['file_name'];              
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
   
      if(!empty($upload))
      {
        
        $data = array(  
        'title' => $this->input->post('title'),
        'designation' => $this->input->post('designation'),
        'description' => $this->input->post('description'),
        // 'slug' =>$slug,
        'image'=>$upload
        
        );
        $this->db->where('id',$id);
        $this->db->update('testimonial',$data); 
        $this->session->set_flashdata('success_msg', 'Testmonial Edit Successfully..');
        return redirect(base_url().'admin/testimonial');
      }
      else
      {
       
          $data = array(  
        'title' => $this->input->post('title'),
        'designation' => $this->input->post('designation'),
        'description' => $this->input->post('description'),
        // 'slug' =>$slug,
        'image'=>$upload
        );
         
        $this->db->where('id',$id);
        $this->db->update('testimonial',$data);
        $this->session->set_flashdata('success_msg', 'Category Edit Successfully..');
        return redirect(base_url().'admin/testimonial');
      }
    }
    else
    {  
      $result['data'] = $this->am->selectrow('testimonial',array('id'=>$id));
      
      $this->load->view('admin/header');
      $this->load->view('admin/edit_testmonial',$result);
      $this->load->view('admin/footer');
    }
  }
  
 public function blog()
    {
        if (isset($this->session->userdata['Aid']))
            {
      $result['data'] = $this->am->selectres('blog');
      $this->load->view('admin/header');
      $this->load->view('admin/blog',$result);
      $this->load->view('admin/footer');
            }
            else
            {
                redirect('admin');
            }
            
    }
    
   public function add_blog(){
       
       $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
      if($this->upload->do_upload('image'))
      {
        $image=$this->upload->data();
        $upload=$image['file_name'];              
     
      }
      else
      {
        $data['imageError']= $this->upload->display_errors();  
      }
        $slug =  url_title(convert_accented_characters(strtolower(strip_tags(preg_replace ('/[0-9]+$/','-',$this->input->post('title'))))), 'dash', true);
        $data = array(  
        'title' => $this->input->post('title'), 
        'slug'=>$slug,
        'date' => $this->input->post('date'),  
        'discription' => $this->input->post('discription'),
        'image'=>$upload,
        'status' =>1,
        );
        $res = $this->am->insert('blog',$data);
        $this->session->set_flashdata('success_msg', 'Blog Add Successfully..');
        return redirect(base_url().'admin/blog');
   }     
  
   
     public function delete_blog($id)
  {
    $this->am->delete('blog',$id);
    if($id)
    {
      $this->session->set_flashdata('success_msg', "Blog Delete Successfully.");
      redirect(base_url('Admin/blog'));
    }
  }  
                     
          
                  public function edit_blog($id)
        {
          
          if(!empty($_POST))
      {   
        $upload="";
          $config = array('upload_path' =>'./uploads/', 
                'allowed_types' => "gif|jpg|png|jpeg",
                  'overwrite' => TRUE    
                );
      $this->load->library('upload',$config);
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
   
      if(!empty($upload))
      {
        $slug = url_title(convert_accented_characters(strtolower(strip_tags(preg_replace ('/[0-9]+$/','-',$this->input->post('title'))))), 'dash', true);
         $slugs=$slug;  
        $data = array(  
        'title' => $this->input->post('title'),
        'date' => $this->input->post('date'),
        'discription' => $this->input->post('discription'),
        'slug' =>$slugs,
        'image'=>$upload
        
        );
        $this->db->where('id',$id);
        $this->db->update('blog',$data); 
        $this->session->set_flashdata('success_msg', 'Blog Edit Successfully..');
        return redirect(base_url().'admin/blog');
      }
      else
      {
          $slug = url_title(convert_accented_characters(strtolower(strip_tags(preg_replace ('/[0-9]+$/','-',$this->input->post('title'))))), 'dash', true);
          $slugs=$slug;
          $data = array(  
        'title' => $this->input->post('title'),
        'date' => $this->input->post('date'),
        'discription' => $this->input->post('discription'),
         'slug' =>$slugs,
        'image'=>$upload
        );
         
        $this->db->where('id',$id);
        $this->db->update('blog',$data);
        $this->session->set_flashdata('success_msg', 'Blog Edit Successfully..');
        return redirect(base_url().'admin/blog');
      }
    }
    else
    {  
        $result['data'] = $this->am->selectrow('blog',array('id'=>$id));
        // $result['data1'] = $this->am->selectres('category');
        $this->load->view('admin/header');
      $this->load->view('admin/edit_blog',$result);
      $this->load->view('admin/footer');
    }
  }
   
   public function email_verification()
   {
      $this->load->view('admin/email_verification_view');
   }
   
      	public function otp_varification()
    {
		if($this->input->post('forgot'))
		{
			$email = $this->input->post('email');
			$con = array(
					'email'=>$email
				  );				  	  
				  
		    $this->session->set_userdata("check_email",$email);
				  
			$check_email = $this->am->otp_varify_model($email); 
			if($check_email->num_rows())
			{

				$otp=rand(1000,10000);		  
				$message = "<html>
					<head>
						<title>Veenus Forget password OTP</title>
					</head>
					<body>
					<p>Hi,</p>
					<p>You OTP: ".$otp."</p>
					</body>
					</html>
					";
						$to = "$email";
						$subject = "Password forget";
						$txt = "$message";
						$headers = "From: veenus@example.com" . "\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
						
					    $send_mail= mail($to,$subject,$txt,$headers);
				  	    $data = array(          
						  'otp' =>$otp,
					     );
					// For Technical Resion We Use otp condition 
						 if($data)
						 {
							 $this->session->set_userdata("otp",$data);
							 redirect('Admin/otp');
						 }
					  
					/*$this->db->where('id',$check->id);
					$this->db->update('login',$data);
		  		    redirect('admin/otp');
					*/
			}
			else
			{
				$this->session->set_flashdata('forgot', 'You are not Registered');
                redirect(base_url('Admin/email_verification'));
			}
			
		}
     
    }
   
    public function otp()
	{
		$this->load->view('admin/otp');
	}
	
	 public function match_otp()
{
	   	if($this->input->post('submit'))
		{
			$sess_otp = $this->session->userdata("otp");
		
			$sess_imp = implode(" ",$sess_otp);
			$otp = $this->input->post('otp');
			if($sess_imp==$otp)
			{
				redirect(base_url('Admin/change_password'));
			}
			else
			{
				$this->session->set_flashdata('nototp', 'OTP Not Match');
                redirect(base_url('Admin/otp'));
			}
			
		}
	} 
	
	public function change_password()
	{
		$this->load->view('admin/change_passwords');
	}
	
		    public function change_password_process()
	{
		if($this->input->post('change'))
		{
			$new = $this->input->post('new');
			$conform = $this->input->post('conform');
			if($new==$conform){
			$set = $this->am->setpass($new,$conform);
			$id_data=$set->id;
			$this->am->update_password($new,$conform,$id_data);
			$this->session->set_flashdata('password_change', 'Password Change Sucessfully');
            redirect(base_url('Admin/change_password'));
			}
			else{
				$this->session->set_flashdata('notmatch_pass', 'Password Not Match');
                redirect(base_url('Admin/change_password'));
			}
			
		}
	}
	
	
	public function delivery_enquiry()
	{
	    $this->notissetuser();
	    $result['data'] = $this->am->selectres('enquiry');
        $this->load->view('admin/header');
        $this->load->view('admin/delivery_enquiry',$result);
        $this->load->view('admin/footer');
	}
	
	public function delete_enquiry($id)
	{
	    
	    $this->am->delete('enquiry',$id);
	    if($id){
	    $this->session->set_flashdata('success','Delete Successfully!');
	    redirect('Admin/delivery_enquiry');
	    }
	}
	
	public function connect_seller_list(){
	    $this->notissetuser();
	    $result['data'] = $this->am->selectres('connect_seller');
	    
	    $this->load->view('admin/header');
	    $this->load->view('admin/contact_to_seller',$result);
	    $this->load->view('admin/footer');
	}
	
	public function deletet_connect_seller_list($id)
	{
	    $this->am->delete('connect_seller',$id);
	    if($id){
	        $this->session->set_flashdata('success', 'Delete Successfully!');
	        redirect('Admin/connect_seller_list');
	    }
	    
	}
         
}
?>
