<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Web extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Web_model', 'web');
        $this->load->library("form_validation");
        $this->load->library("email");
        $this->load->library('common'); 
        $this->load->helper("url");
        $this->load->helper('text');
        $this->load->helper('cookie');
        $this->load->model('Admin_Model','am');
        $this->load->library('user_agent');
        $this->load->library('pagination');
    }
    public $per_page='12';
    
    public function index()
    {
       
        $data['brand']=$this->web->selectres('brand');
        $data['testimonial']= $this->web->selectres('testimonial');
        $data['blog']= $this->web->get_home_blog('blog','',6);
        
        
        
        $this->load->library('pagination');
        $config = array();
        $config["base_url"] = base_url() . "web/index";
        $config["total_rows"] = $this->web->index_count();
        $config["per_page"] = 12;
        $config["uri_segment"] = 3;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["product"] = $this->web->fetch_ecommerce_data($config["per_page"], $page);
            
        $str_links= $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
   
            
        $this->render('index',$data);
        
    }
    
      
    
    
    
    public function header(){
        
    }
    
    
    
    public function login(){
       $this->load->library('user_agent');
       $this->session->set_userdata('redirect_back', $this->agent->referrer());
       $this->render('login');
        
    }
    
    
    public function register()
    {
        
        $this->render('register');
        
    }
    
    public function grocery(){
        
         $slug= $this->uri->segment(1);
       
       
        $config["per_page"] = $this->per_page;
           
    //     $data['product']= $this->web->get_home_product('seller_product', array('type'=>2),$config["per_page"]);
        
    //       //$product_id=$this->input->post('product_id');
    // 	$res = $this->am->selectres('seller_product',array('type'=>2));
    	
    	$latitude='28.6389057';
    	$longitude='77.4814559';
    	$distance_km=115;
    	$radius_km = $distance_km; 
        $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
        $having = " HAVING (distance <= $radius_km) "; 
        $order_by = 'distance ASC '; 
 
 
// Fetch places from the database 
      $sql = "SELECT user.*,seller_product.* ".$sql_distance." FROM user_registeration  user INNER JOIN seller_product
    ON seller_product.user_id = user.id where user.kyc_type=2 $having ORDER BY $order_by"; 

         $query = $this->db->query($sql)->result(); 
         $data['product']=$query;
        //echo $this->db->last_query();
        $data['brand']=$this->web->selectres('brand');
        $data['testimonial']= $this->web->selectres('testimonial');
        $data['blog']= $this->web->get_home_blog('blog','',6);
        
        $this->render('grocery',$data);
        
        
    }
    
    public function fresh(){
        
        $slug= $this->uri->segment(1);
        $config = array();
        $config["base_url"] = base_url() . "web/fresh";
        $config["total_rows"] = $this->web->pagination_count();
        $config["per_page"] = 12;
        $config["uri_segment"] = 3;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["product"] = $this->web->fetch_fresh_data($config["per_page"], $page);
      
        // echo $this->db->last_query();
        $str_links= $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
    //     echo'<pre>';
    //   print_r($str_links);
    //     die;
        //$data['product']=$query;
        $data['brand']=$this->web->selectres('brand');
        $data['testimonial']= $this->web->selectres('testimonial');
        $data['blog']= $this->web->get_home_blog('blog','',6);
        $this->render('fresh',$data);
        
        
    }
    
    public function privacy_policy(){
        $this->render('privacy_policy');
        
        
    }
    
    public function return_policy(){
        
        $this->render('return_policy');
        
    }
    
     public function shipping_policy(){
        
        $this->render('shipping_policy');
        
    }
    
    public function term_condition(){
        $this->render('term_condition');
    }
    public function marketplace($id='',$rows=''){
        
       
        $config["per_page"] = $this->per_page;
        //$data['marketplace']= $this->web->get_home_product('seller_product', array('type'=>1),$config["per_page"]);
        $data['brand']=$this->web->selectres('brand');
        $data['testimonial']= $this->web->selectres('testimonial');
        $data['blog']= $this->web->selectres('blog');

    
    
        $this->load->library('pagination');
        $config = array();
        $config["base_url"] = base_url() . "web/marketplace";
        $config["total_rows"] = $this->web->marketplace_count();
        $config["per_page"] = 12;
        $config["uri_segment"] = 3;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
       
        $data["marketplace"] = $this->web->marketplace_fetch_data($config["per_page"], $page);
            
        $str_links= $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
        
   
    
  //  $data['marketplace']= $this->web->marketplace_fetch_data('seller_product', array('type'=>1),$config["per_page"],$page);
     
    
    
       $data['images']= $this->web->gallery();
        $data['count']= $this->web->count();
        
   $this->render('marketplace', $data);
    }
    
    
    public function productlist($id='',$rows='')
    { 
     $slug= $this->uri->segment(2);
    $data['product_details']= $this->web->selectrow('seller_product', array('slug'=>$slug));
    $data['brand'] = $this->web->selectrow('brand',array('id'=> $data['product_details']->brand_name));
  
  
    
     if(empty($data['product_details'])){
         show_404();
    }
   
   
   
         $this->load->library('pagination');
         $config = array();
         $config["base_url"] = base_url() . $slug."?page";
         $total_row = $this->web->get_count_product('seller_product', array('type'=>1,'category'=>$data['product_details']->category));
         $config = array();
        $config["base_url"] =  base_url() . $slug;
        $total_row = $total_row;
        $config["total_rows"] = $total_row;
        $config["per_page"] = 12;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
            
            $this->pagination->initialize($config);
            if($this->uri->segment(2)){
              $page = ($this->uri->segment(2));
             
            }
            else{
            $page = 0;
            }
         
       $str_links= $this->pagination->create_links();
    
       $data["links"] = explode('&nbsp;',$str_links );
    
    $data['related_product']= $this->web->get_product('seller_product', array('category'=>$data['product_details']->category), $config["per_page"],$page);
        
    $this->render('productlist',$data);
        
    }
    
    
    
    public function categorylist($id='',$rows='')
    { 
    $slug= $this->uri->segment(1);
    $data['category_details']= $this->web->selectrow('category', array('slug'=>$slug));
    if(empty($data['category_details'])){
         show_404();
    }
   
        $this->load->library('pagination');
         $config = array();
        $config["base_url"] = base_url() . $slug."?page";
          $total_row = $this->web->get_count_product('seller_product', array('type'=>2,'category'=>$data['category_details']->id));
          $config = array();
            $config["base_url"] =  base_url() . $slug;
            $total_row = $total_row;
            $config["total_rows"] = $total_row;
            $config["per_page"] = 12;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            
            $this->pagination->initialize($config);
            if($this->uri->segment(2)){
              $page = ($this->uri->segment(2)) ;
             
            }
            else{
            $page = 0;
            }
         
       $str_links= $this->pagination->create_links();
    
        $data["links"] = explode('&nbsp;',$str_links );
    
    $data['product']= $this->web->get_product('seller_product', array('type'=>2,'category'=>$data['category_details']->id),$config["per_page"],$page);
        
    $this->render('categorylist',$data);
        
    }
    
     public function typecategorylist($id='',$rows='')
    { 
      $slug= $this->uri->segment(2);
     
    $data['category_details']= $this->web->selectrow('category', array('slug'=>$slug));
    if(empty($data['category_details'])){
         show_404();
    }
      $this->load->library('pagination');
      

             $lat='28.617825';
         $long='77.383855';
          
    	$latitude=$lat;
    	$longitude=$long;
    	$distance_km=115;
    	$radius_km = $distance_km; 
    	
    	  $category_id=$data['category_details']->id;
        $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
         
        $having = " HAVING (distance <= $radius_km) "; 
         
        $order_by = 'distance ASC '; 
     
     
        // Fetch places from the database 
          $sql = "SELECT user.*,seller_product.* ".$sql_distance." FROM user_registeration  user INNER JOIN seller_product
    ON seller_product.user_id = user.id where user.kyc_type=2 && category=$category_id  $having ORDER BY $order_by"; 
    $query = $this->db->query($sql);
    
   $total_row=$query->num_rows(); 
    
    
   
      
         $config = array();
        $config["base_url"] = base_url() . $slug."?page";
          
          
          
          $config = array();
            $config["base_url"] =  base_url('grocery/') . $slug;
            $total_row = $total_row;
            $config["total_rows"] = $total_row;
            $config["per_page"] = 12;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            
            $this->pagination->initialize($config);
            if($this->uri->segment(3)){
              $page = ($this->uri->segment(3)) ;
             
            }
            else{
            $page = 0;
            }
         
       $str_links= $this->pagination->create_links();
    
        $data["links"] = explode('&nbsp;',$str_links );
    
    
      $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
         
        $having = " HAVING (distance <= $radius_km) "; 
         
        $order_by = 'distance ASC '; 
     
        $perpage=$config['per_page'];
        
        
        // Fetch places from the database 
         // Fetch places from the database 
      $sql = "SELECT user.*,seller_product.* ".$sql_distance." FROM user_registeration  user INNER JOIN seller_product
    ON seller_product.user_id = user.id where user.kyc_type=2  &&  category=$category_id  $having ORDER BY $order_by limit $page,$perpage"; 
    $query = $this->db->query($sql);
    // echo $this->db->last_query();
    $data['product']=$query->result();
        
        // print_r($data);
        // die();
    $this->render('categorylist',$data);
        
    }
    
    
    public function typecategorylistfresh($id='',$rows='')
    { 
      $slug= $this->uri->segment(2);
     
    $data['category_details']= $this->web->selectrow('category', array('slug'=>$slug));
    if(empty($data['category_details'])){
         show_404();
    }
      $this->load->library('pagination');
      

             $lat='28.617825';
         $long='77.383855';
          
    	$latitude=$lat;
    	$longitude=$long;
    	$distance_km=115;
    	$radius_km = $distance_km; 
    	
    	  $category_id=$data['category_details']->id;
        $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
         
        $having = " HAVING (distance <= $radius_km) "; 
         
        $order_by = 'distance ASC '; 
     
     
        // Fetch places from the database 
          $sql = "SELECT user.*,seller_product.* ".$sql_distance." FROM user_registeration  user INNER JOIN seller_product
    ON seller_product.user_id = user.id where user.kyc_type=3 && category=$category_id  $having ORDER BY $order_by"; 
    $query = $this->db->query($sql);
    
   $total_row=$query->num_rows(); 
    
    
   
      
         $config = array();
        $config["base_url"] = base_url() . $slug."?page";
          
          
          
          $config = array();
            $config["base_url"] =  base_url('fresh/') . $slug;
            $total_row = $total_row;
            $config["total_rows"] = $total_row;
            $config["per_page"] = 12;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            
            $this->pagination->initialize($config);
            if($this->uri->segment(3)){
              $page = ($this->uri->segment(3)) ;
             
            }
            else{
            $page = 0;
            }
         
       $str_links= $this->pagination->create_links();
    
        $data["links"] = explode('&nbsp;',$str_links );
    
    
      $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
         
        $having = " HAVING (distance <= $radius_km) "; 
         
        $order_by = 'distance ASC '; 
     
        $perpage=$config['per_page'];
        
        
        // Fetch places from the database 
         // Fetch places from the database 
      $sql = "SELECT user.*,seller_product.* ".$sql_distance." FROM user_registeration  user INNER JOIN seller_product
    ON seller_product.user_id = user.id where user.kyc_type=3  &&  category=$category_id  $having ORDER BY $order_by limit $page,$perpage"; 
    $query = $this->db->query($sql);
    // echo $this->db->last_query();
    $data['product']=$query->result();
        
        // print_r($data);
        // die();
    $this->render('categorylist',$data);
        
    }
    
    
    public function searchlist($id='',$rows='')
    { 
        
    $slug= $this->uri->segment(1);
    $cat= $this->input->get('category');
    $data['category_details']= $this->web->selectrow('category', array('id'=>$cat));
    // if(empty($data['category_details'])){
    //      show_404();
    // }
   
    $this->load->library('pagination');
         $config = array();
        $config["base_url"] = base_url() . $slug."?page";
          $total_row = $this->web->get_count_product_search('seller_product', array('type'=>2));
          
            $config = array();
            $config["base_url"] =  base_url() . $slug;
            $total_row = $total_row;
            $config["total_rows"] = $total_row;
            $config["per_page"] = 12;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            
            $this->pagination->initialize($config);
            if($this->uri->segment(2)){
              $page = ($this->uri->segment(2)) ;
             
            }
            else{
            $page = 0;
            }
         
       $str_links= $this->pagination->create_links();
    
        $data["links"] = explode('&nbsp;',$str_links );
    
    $data['product']= $this->web->get_product_search('seller_product', array('type'=>2),$config["per_page"],$page);
        
    $this->render('searchlist',$data);
        
    }
    
    
   public function all_blog()
    { 
    $slug= $this->uri->segment(1);
    //$data['blog']= $this->web->selectrow('blog', array('slug'=>$slug));
   
   
    $this->load->library('pagination');
    $config = array();
    $config["base_url"] = base_url() . "web/all_blog";
    $config["total_rows"] = $this->web->get_count_blog();
    $config["per_page"] = 9;
    $config["uri_segment"] = 3;
    $config['cur_tag_open'] = '&nbsp;<a class="current">';
    $config['cur_tag_close'] = '</a>';
    $config['next_link'] = 'Next';
    $config['prev_link'] = 'Previous';

    $this->pagination->initialize($config);

    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
   
    $data["product"] = $this->web->fetch_data($config["per_page"], $page);
        
    $str_links= $this->pagination->create_links();
    $data["links"] = explode('&nbsp;',$str_links );
    
    $data['all_blog']= $this->web->get_blog('blog','',$config["per_page"],$page);
    
    $this->render('blog',$data);
        
    }

    
     public function add_wishlist()
         {
              $user_id = $this->session->userdata('user_id');
              $status = 1;
              if($user_id){
              
              if($status==1){
               $data = array(		
			 		'user_id' => $user_id,
			 		'product_id' => $this->input->post('product_id'),
			 		'status' =>1
                    );
                $query=$this->db->get_where('tbl_wishlish', array('user_id'=>$user_id,'product_id' => $this->input->post('product_id')));
                    
                   $count = $query->num_rows();
                   if($count<=0){
                   $res1 = $this->db->insert('tbl_wishlish',$data); 
                   }
                   
                   $query=$this->db->get_where('tbl_wishlish', array('product_id' => $this->input->post('product_id')));
                   $count = $query->num_rows();
                  
               
                 $val= array("status" => "success","message"=>"Added to Wishlist","count"=>"$count");
	            $data= json_encode($val);
	            echo $data;
              }
             
                    
              else{
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
              }else{
                   $val= array("status" => "failed","message"=>"<a href='https://taudubrothers.com/web/login' style='color:red;'>Login First!</a>",);
	            $data= json_encode($val);
	            echo $data;
              }
              
       
   }
   
   public function delete_wishlist()
   {
       $user_id = $this->session->userdata('user_id');
        if($user_id){
       $wishlist_id= $this->input->post('wishlist_id');
       $res = $this->db->delete('tbl_wishlish', array('id'=>$wishlist_id));
       if(!empty($res))
       {
       $val= array("status" => "success","message"=>"Deleted successfully");
	            $data= json_encode($val);
	            echo $data;
       
       
        
       }else{
           $val= array("status" => "failed","message"=>"Some thing went wrong");
	            $data= json_encode($val);
	            echo $data;
       }
       
        }else{
                $val= array("status" => "failed","message"=>"<a href='https://taudubrothers.com/web/login' style='color:red;'>Login First!</a>",);
	            $data= json_encode($val);
	            echo $data;
              }
   }
   
  
   
   
   public function get_wishlist()
   {
       
       $user_id = $this->session->userdata('user_id')?$this->session->userdata('user_id'):0;
       $wishlist= $this->db->select('seller_product.*,tbl_wishlish.id as wishlist_id')->where(array('tbl_wishlish.user_id'=>$user_id))->join('seller_product','seller_product.id=tbl_wishlish.product_id','left')->get('tbl_wishlish')->result();
       $b=array();
       foreach($wishlist as $res)
       {

    $offer=$res->discount;
     $product_price=($res->price*$offer)/100;
     $offer1=$res->delivery_charge;
     $offer2=$res->price;
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
      
       
       $total_price=$offer2-$product_price+$value+$offer1;

       $result['product_price']=round($total_price);
       $result['product_name']=$res->product_name;
       $result['image']=$res->image;



        array_push($b,$result);
  
       }



       
        $val= array("status" => "success","message"=>"Successfully","array"=>$b);
        $data= json_encode($val);
        echo $data;
        
   }
   
  
   
   public function add_cart(){
       
      
      $user_id = $this->session->userdata('user_id');
      $product_id = $this->input->post('product_id');
      
      $res = $this->web->selectrow('cart',array("product_id"=>$product_id,"user_id"=>$user_id));
      
      if($user_id){
     if(!empty($res))
     {
           $data = array(
                     'user_id' => $user_id,
			 		'product_id' => $this->input->post('product_id'),
			 		/*'color'=> $this->input->post('color'),
			 		'price'=> $this->input->post('price'),*/
                   );
                   
                   
                    $qty_get= $this->db->where(array('user_id'=> $user_id,'product_id'=>$product_id))->get('cart')->row_array();
                    
                    // print_r($qty_get);
                    // die;
                if(empty($this->input->post('type'))){
                   
                  if(!empty($qty_get)){
                  $qty= $qty_get['quantity']+1;
                   $this->db->set('quantity',$qty, true);
                  }
                    
                     $this->db->where('user_id',$user_id);
                     $this->db->where('product_id',$product_id);
                     $this->db->update('cart',$data);
                     $query = $this->db->get_where('cart', array('user_id'=>$user_id,'product_id'=>$product_id));
            		 if($query->num_rows())
            		 $val= array("status" => "success","message"=>"Added to cart");
            		 $data= json_encode($val);
            	            echo $data;
                
                }else{
                    
                    if(!empty($qty_get)){
                   if(($qty_get['quantity'] > 1)){
                  $qty= $qty_get['quantity']-1;
                   $this->db->set('quantity',$qty, true);
                   
                   
            	            
                  }
                }
                  
                     $this->db->where('user_id',$user_id);
                     $this->db->where('product_id',$product_id);
                     $this->db->update('cart',$data);
                     $query = $this->db->get_where('cart', array('user_id'=>$user_id,'product_id'=>$product_id));
            		if($query->num_rows())
            		 $val= array("status" => "success","message"=>"Remove cart");
            		 $data= json_encode($val);
            	            echo $data;
                     
                }
                
                
                       
     }
     else{
       
      $b=array();
	  $data = array(		
			 		'product_id' => $this->input->post('product_id'),
			 		'user_id' => $user_id,
			 		/*'color'=> $this->input->post('color'),
			 		'price'=> $this->input->post('price'),*/
			 		'date'=>date('d-m-Y'),
			 		'quantity'=>1
			 		 
                   );
                  
 	$member = $this->web->insert('cart',$data);
 	$last_id = $this->db->insert_id();
 	$query = $this->db->get_where('cart', array('id'=>$last_id));
		if($query->num_rows())
		
	           // $query1 = $this->db->get_where('tbl_wishlish', array('user_id'=>$user_id,'product_id'=>$product_id));
            // 		if($query1->num_rows())
            // 		{
            // 		  $this->db->where('user_id',$user_id);
            //          $this->db->where('product_id',$product_id);
            //          $this->db->delete('tbl_wishlish');

            // 		}
            		
         $val= array("status" => "success","message"=>"Added to cart");
		 $data= json_encode($val);
	     echo $data;
     }
      }else{
            $val= array("status" => "failed","message"=>"<a href='https://taudubrothers.com/web/login' style='color:red;'>Login First!</a>",);
            $data= json_encode($val);
            echo $data;
          }
   }
   
   
   
   public function get_cart(){
       
       $user_id = $this->session->userdata('user_id')?$this->session->userdata('user_id'):0;
       
       
          $b=array();
       
     
      $res1 = $this->am->selectres('cart',array("user_id"=>$user_id));
     
   
    if(!empty($res1))
    {
        $amount=0;
        $shipping_amount=0;
        
        
     	$latitude= $this->session->userdata('lat')?$this->session->userdata('lat'):'28.6389057';
    	$longitude=$this->session->userdata('lng')?$this->session->userdata('lng'):'77.4814559';
    	$distance_km=115;
    	  $radius_km = $distance_km; 
    $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
     
    $having = " HAVING (distance <= $radius_km) "; 
     
    $order_by = 'distance ASC '; 
 
 
// Fetch places from the database 
 
        
        //print_r($res1);
        
        $delivery_status_count=0;
        foreach ($res1 as $row)               
        {
    
          $result['id']=$row->id;
          $result['product_id']=$row->product_id;
          
             
    
         $res = $this->am->selectrow('seller_product',array('id'=>$row->product_id));
        //echo $this->db->last_query();
       
         if($res->type==2){
             $users = $this->am->selectrow('user_registeration',array('id'=>$res->user_id));
             
              if($users->kyc_type==2 || $users->kyc_type==3){
              $sql = "SELECT user.*,seller_product.*".$sql_distance." FROM user_registeration  user INNER JOIN seller_product ON seller_product.user_id = user.id where (user.kyc_type=2 ||user.kyc_type=3 ) && (seller_product.type=2 && seller_product.id=$row->product_id) $having ORDER BY $order_by"; 
             
            $num_product=$this->db->query($sql)->num_rows();
            if($num_product){
              $result['delivery_status']=1;
              $result['delivery_message']='';
            }else{
                 $result['delivery_status']=0;
                 $result['delivery_message']='Seller doesnt deliver to this location!';
                 $delivery_status_count +=1;
            }
              
              
              }else{
                  $result['delivery_status']=1;
                  $result['delivery_message']='';
              }
              
              
         } else{
               $result['delivery_status']=1;
               $result['delivery_message']='';
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
          $result['Brand_Name']=$res->brand_name;
          $result['id']=$res->id;
          $result['cart_quantity']=$row->quantity;
          $result['cart_id']=$row->id;
         
          $result['price']=$res->price;
          $result['image']=$res->image;
           
          $result['sale_offer']=$res->discount;
          $sale_offe=$res->discount;
 
     $offer=$res->discount;
     $product_price=($res->price*$offer)/100;
     $offer1=$res->delivery_charge;
     $offer2=$res->price;
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
      
       
       $total_price=$offer2-$product_price+$value+$offer1;
  
      //$result['discount']=$row->discount;
      $result['product_price']="$total_price";
          
          
        //   $product_price=$res->price*$sale_offe/100;
          
          
        //   $sale_offe=$res->price;
          $result['qty']=$row->quantity;
           
        //   $total_price=$sale_offe-$product_price;
          $product_total_price=$row->quantity*$total_price;
          $result['product_price']="$total_price";
          $result['price']=round($total_price);
          $result['product_total_price']=round($product_total_price);
          $amount +=$row->quantity*$total_price;
          $result['sub_total']=round($row->quantity*$total_price);
           
      
              array_push($b,$result);
        }
      
       
          $grand=round($amount)+50;
          $val= array("status" => "success","total"=>"$amount", 'delivery'=>"50",'grand_total'=>"$grand",'delivery_status_count'=>$delivery_status_count, "message"=>"Record found","array" =>$b);
          $data= json_encode($val);
          echo $data;    
          //echo json_encode($result);
      }  else 
      {
            $val= array("status" => "fail","message"=>"Record not found!","data" =>[]);
            $data = json_encode($val);                   
            echo $data; 
      } 
       
       
       
       
       
       exit();
       
       
    
       
       
       $cart= $this->db->select('seller_product.*,cart.id as cart_id, cart.quantity as cart_quantity')->where(array('cart.user_id'=>$user_id))->join('seller_product','seller_product.id=cart.product_id','left')->get('cart')->result();
      $total_price=0;
      $delivery_charge=0;
       foreach($cart as $row){
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
       
       $delivery_charge+=$row->delivery_charge;
       $d=$row->delivery_charge;
       
        $total_price += $row->cart_quantity*($offer-$product_price+$value)+$d;
        
       $row->price= round(($offer-$product_price+$value),2);
           
       }
        $val= array("status" => "success","message"=>"Successfully","array"=>$cart,'delivery'=>$delivery_charge,'total'=>round($total_price,2));
        $data= json_encode($val);
        echo $data;
        
       
   }
   
   public function delete_cart(){
       $cart_id= $this->input->post('cart_id');
       $res = $this->db->delete('cart', array('id'=>$cart_id));
       if(!empty($res))
       {
           
           $val = array("status"=>"success", "message"=>"Delete Successfully!");
           $data= json_encode($val);
           echo $data;

       }
       else{
           $val = array("status"=>"failed", "message"=>"Some thing went wrong");
           $data = json_encode($val);
           echo $data;
       }
       
   }
   
   
   
   public function bloglist()
   {
      $slug= $this->uri->segment(2);
      $data['blog']= $this->web->selectrow('blog', array('slug'=>$slug));

$this->db->order_by('id'); // Order by
$this->db->limit(5); // Limit, 15 entries
$data['recent_blog']= $this->db->get('blog')->result(); 



   if(empty($data['blog'])){
         show_404();
    }
       $this->render('bloglist',$data);
   }
   
   
   
   
   

   
   public function session_location(){
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
            	  $array=array('address'=>$data->results[0]->formatted_address,'lat'=>$lat,'lng'=>$long,'status'=>1);
            // 	$address = $data->results[0]->formatted_address;
              }
              
       $array= array(

           'place'   => $this->input->post('place')?$this->input->post('place'):$array['address'],
           'lat'  => $this->input->post('lat'),                            
           'long' => $this->input->post('lng'),                                                                                   
            

       );
       $this->session->set_userdata($array);
    $user_id=$this->session->userdata('user_id');
      $q=$this->db->get_where("user_registeration",array("id"=>$user_id));

               $row=$q->row();
              $address_details=$this->db->where(array('user_id'=>$row->id))->get('address')->num_rows();
              if($address_details){
                $this->db->where(array('user_id'=>$row->id))->update('address',array('address'=>$array['place'],'lat'=>$array['lat'],'lng'=>$array['long'],'name'=>$row->name,'mobile_no'=>$row->mobile_no,'email'=>$row->email));
              }else{
                    $this->db->insert('address',array('user_id'=>$row->id,'address'=>$array['place'],'lat'=>$array['lat'],'lng'=>$array['long'],'name'=>$row->name,'mobile_no'=>$row->mobile_no,'email'=>$row->email));
              }
            
       
       $val = array("status"=>"success", "message"=>"success",'place'=>word_limiter($array['place'],2));
           $data = json_encode($val);
           echo $data;
       
       
       
   }
   
    public function near_shop(){
        
        $lat='28.617825';
        $long='77.383855';
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
             $result['shop_name']=$res->shop_name;
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
    
    public function near(){
        
         header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        // die();
        $this->load->view('web/near');
       
    }
    
    public function near_location(){
        
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        // die();
        
         $lat=$this->session->userdata('lat')?$this->session->userdata('lat'):'28.617825';
        $long=$this->session->userdata('lng')?$this->session->userdata('lng'):'77.383855';
          $user_id=$this->input->post('user_id');
  	   //$product_id=$this->input->post('product_id');
    // 	$res = $this->am->selectres('seller_product',array('type'=>2));
    	$latitude=$lat;
    	$longitude=$long;
    	$distance_km=1115;
    	$radius_km = $distance_km; 
        $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
         
        $having = " HAVING (distance <= $radius_km) "; 
         
        $order_by = 'distance ASC '; 
     
     
        // Fetch places from the database 
          $sql = "SELECT user.*,seller_registeration.*,user.lat  lati ,user.id as user_id,user.long as longi".$sql_distance." FROM user_registeration  user INNER JOIN seller_registeration
        ON seller_registeration.user_id = user.id where user.kyc_status=1 $having ORDER BY $order_by"; 
    
         $query = $this->db->query($sql)->result(); 
         $arr=array();
         if($query){
         foreach($query as $res){
             if(!empty($res->lat)){
             $result['id']=$res->id;
             $result['user_id']=$res->user_id;
             $result['shop_name']=ucfirst($res->shop_name);
             $result['shop_area']=$res->shop_area;
             $result['lat']=$res->lati;
             $result['long']=$res->longi;
             $result['lat_long']="$res->lat,$res->long";
             $result['shop_town']=$res->shop_town;
             $result['shop_distric']=$res->shop_distric;
             $result['shop_state']=$res->shop_state;
             $result['area_pincode']=$res->area_pincode;
             $result['distance']=number_format((float)$res->distance, 2, '.', '');
             $result['description']=$res->description;
             $result['profile_image']=$res->profile_image?base_url().$res->profile_image:'';
             
               array_push($arr,$result);
             }
         }
         
        
         }  
        
        $data['near_location']=$arr;
        
        
        
        
        
        
        $this->render('near_location',$data);
       
    }
    
    
    public function buy_now(){
       
       
      $user_id = $this->session->userdata('user_id');
      $product_id = $this->input->post('product_id');
      
      $res = $this->web->selectrow('cart',array("product_id"=>$product_id,"user_id"=>$user_id));
      
      if($user_id){
     if(!empty($res))
     {
           $data = array(
                     'user_id' => $user_id,
			 		'product_id' => $this->input->post('product_id'),
			 		/*'color'=> $this->input->post('color'),
			 		'price'=> $this->input->post('price'),*/
                   );
                   
                   
                    $qty_get= $this->db->where(array('user_id'=> $user_id,'product_id'=>$product_id))->get('cart')->row_array();
                    
                
                if(empty($this->input->post('type'))){
                  if(!empty($qty_get)){
                  $qty= $qty_get['quantity']+1;
                   $this->db->set('quantity',$qty, true);
                  }
                  
                     $this->db->where('user_id',$user_id);
                     $this->db->where('product_id',$product_id);
                     $this->db->update('cart',$data);
                }else{
                    if(!empty($qty_get)){
                  $qty= $qty_get['quantity']-1;
                   $this->db->set('quantity',$qty, true);
                  }
                  
                     $this->db->where('user_id',$user_id);
                     $this->db->where('product_id',$product_id);
                     $this->db->update('cart',$data);
                }
                    
                  $query = $this->db->get_where('cart', array('user_id'=>$user_id,'product_id'=>$product_id));
            		if($query->num_rows())
            		 $val= array("status" => "success","message"=>"Buy Successfully!");
            		 $data= json_encode($val);
            	            echo $data;
            	            //print_r($data);
                            
     }
     else{
       
      $b=array();
	  $data = array(		
			 		'product_id' => $this->input->post('product_id'),
			 		'user_id' => $user_id,
			 		/*'color'=> $this->input->post('color'),
			 		'price'=> $this->input->post('price'),*/
			 		'date'=>date('d-m-Y'),
			 		'quantity'=>1
			 		 
                   );
                  
 	$member = $this->web->insert('cart',$data);
 	$last_id = $this->db->insert_id();
 	$query = $this->db->get_where('cart', array('id'=>$last_id));
		if($query->num_rows())
		$val= array("status" => "success","message"=>"Buy Successfully!");
		 $data= json_encode($val);
	            echo $data;
     }

      }else{
                   $val= array("status" => "failed","message"=>"Login First!");
	            $data= json_encode($val);
	            echo $data;
              }
   }
   
   
   public function single_saller_location($id=''){
       
       
         header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        // die();
        
         $lat=$this->session->userdata('lat')?$this->session->userdata('lat'):'28.617825';
        $long=$this->session->userdata('lng')?$this->session->userdata('lng'):'77.383855';
          $user_id=$this->input->post('user_id');
  	   //$product_id=$this->input->post('product_id');
    // 	$res = $this->am->selectres('seller_product',array('type'=>2));
    	$latitude=$lat;
    	$longitude=$long;
    	$distance_km=1115;
    	$radius_km = $distance_km; 
        $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
         
        $having = " HAVING (distance <= $radius_km) "; 
         
        $order_by = 'distance ASC '; 
     
     
        // Fetch places from the database 
          $sql = "SELECT user.*,seller_registeration.*,user.lat  lati ,user.long as longi".$sql_distance." FROM user_registeration  user INNER JOIN seller_registeration
        ON seller_registeration.user_id = user.id where user.kyc_status=1 && seller_registeration.user_id=$id  $having ORDER BY $order_by"; 
    
         $query = $this->db->query($sql)->result(); 
         $arr=array();
         if($query){
         foreach($query as $res){
             if(!empty($res->lat)){
             $result['id']=$res->id;
             $result['user_id']=$res->user_id;
             $result['name']=ucfirst($res->name);
             $result['email']=ucfirst($res->email);
             $result['mobile_no']=ucfirst($res->mobile_no);
             
             $result['shop_name']=ucfirst($res->shop_name);
             $result['shop_area']=$res->shop_area;
             $result['lat']=$res->lati;
             $result['long']=$res->longi;
             $result['lat_long']="$res->lat,$res->long";
             $result['shop_town']=$res->shop_town;
             $result['shop_distric']=$res->shop_distric;
             $result['shop_state']=$res->shop_state;
             $result['area_pincode']=$res->area_pincode;
             $result['distance']=number_format((float)$res->distance, 2, '.', '');
             $result['description']=$res->description;
             $result['profile_image']=$res->profile_image?base_url().$res->profile_image:'';
             
               array_push($arr,$result);
             }
         }
         
        
         }  
        
          $data['seller_profile']=$arr;
       
       $this->render('seller_profile', $data);
   }
   
   
   
   public function seller_shop_list($user_id){
       
       //print_r($user_id);
        
    //     header('Access-Control-Allow-Origin: *');
    //     header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    //     header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    //      //die();
        
    //      $lat=$this->session->userdata('lat')?$this->session->userdata('lat'):'28.617825';
    //      $long=$this->session->userdata('lng')?$this->session->userdata('lng'):'77.383855';
    //      $user_id=$user_id;
  	 //  //$product_id=$this->input->post('product_id');
    // // 	$res = $this->am->selectres('seller_product',array('type'=>2));
    // 	$latitude=$lat;
    // 	$longitude=$long;
    // 	$distance_km=1115;
    // 	$radius_km = $distance_km; 
    //     $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
         
    //     $having = " HAVING (distance <= $radius_km) "; 
         
    //     $order_by = 'distance ASC '; 
     
     
    //     // Fetch places from the database 
    //     $sql = "SELECT user.*,seller_registeration.*, seller_product.*,user.lat  lati ,user.id as user_id,user.long as longi".$sql_distance." FROM user_registeration  user INNER JOIN seller_registeration
    //     ON seller_registeration.user_id = user.id INNER JOIN seller_product ON seller_product.user_id =seller_registeration.user_id where user.kyc_status=1 && seller_product.user_id=$user_id $having ORDER BY $order_by"; 
        
        
    //      $query = $this->db->query($sql)->result(); 
         //echo $this->db->last_query();
       //print_r($query);
       	
       	$query = $this->db->select('seller_product.*')->where(array('seller_product.user_id'=>$user_id))->get('seller_product')->result();
        //print_r($query);
         $arr=array();
         if($query){
         foreach($query as $res){
             
             
            $count=$this->db->where(array('product_id'=>$res->id))->get('product_view');
                   $views_count = $count->num_rows();
                   
                   
            // if(!empty($res->lat)){
             $result['id']=$res->id;
             $result['user_id']=$res->user_id;
             $result['views_count']="$views_count";
             $result['product_name']=ucfirst($res->product_name);
             $result['product_price']=$res->price;
             $result['slug']=$res->slug;
             //$result['shop_area']=$res->shop_area;
            // $result['lat']=$res->lati;
             //$result['long']=$res->longi;
             //$result['lat_long']="$res->lat,$res->long";
            //  $result['shop_town']=$res->shop_town;
            //  $result['shop_distric']=$res->shop_distric;
            //  $result['shop_state']=$res->shop_state;
            //  $result['area_pincode']=$res->area_pincode;
             //$result['distance']=number_format((float)$res->distance, 2, '.', '');
             // $result['description']=$res->description;
               $result['product_image']=$res->image?base_url().$res->image:'';
             
               array_push($arr,$result);
             //}
         }
        
        
        
         }  
        
        $data['seller_shop_list']=$arr;
        
        $this->render('seller_shop_list',$data);
       
    }
    
    public function delivery_enquiry()
    {
        if(!empty($_POST))
        {
           $data= array(
               'name'=>$this->input->post('name'),
               'email'=>$this->input->post('email'),
               'phone'=>$this->input->post('phone'),
               'location'=>$this->input->post('location'),
               'message'=>$this->input->post('message'),
               'delivery_status'=>$this->input->post('delivery_status'),
              
               
               );

               $member = $this->db->insert('enquiry',$data);
        
               if($member)
	       {
	           $this->session->set_flashdata('success', 'Enquiry Save Successfully!');
	           
	       }
	       else
	       {
	           $this->session->set_flashdata('error', 'Some thing went wrong!');
	       }
           
        }
        $this->render('delivery_enquiry_form');
        }
    
    
    
    public function connect_seller()
    {
        if(!empty($_POST))
        {
            $data = array(
                'name'=>$this->input->post('name'),
                'email'=>$this->input->post('email'),
                'phone'=>$this->input->post('phone'),
                'whatsapp'=>$this->input->post('whatsapp'),
                'location'=>$this->input->post('location'),
                'message'=>$this->input->post('message'),
                'status'=>1,
                );
                $member = $this->db->insert('connect_seller',$data);
                if($member){
                    $this->session->set_flashdata('success', 'Your request has been submited successfully! Seller will contact you soon! ');
                }
                else
                {
                    $this->session->set_flashdata('error','Some thing went wrong');
                }
            
        }
        $this->render('contact_to_seller');
    }
    
    
    public function followers()
    
   {
     
              $user_id = $this->session->userdata('user_id');
              $vendor_id = $this->input->post('id');
              
              
               $this->db->where('user_id', $user_id);
               $this->db->where('vendor_id',$vendor_id);
		       $q = $this->db->get('tbl_follower');
               
              if($user_id){
              if ($q->num_rows()>0){
                  
                  $res = $this->db->where( array(		
			 		'user_id' => $user_id,
			 		'vendor_id' => $this->input->post('id')
                    ))->delete('tbl_follower'); 
                      $val= array("status" => "failed","message"=>"Unfollow Successfully");
	            $data= json_encode($val);
	            echo $data;
                  
              
              }
              else{
                   $data = array(		
			 		'user_id' => $user_id,
			 		'vendor_id' => $this->input->post('id'),
			 		'follower_status' =>1
                    );
                   
                   $res1 = $this->db->insert('tbl_follower',$data); 
                   
               
                 $val= array("status" => "success","message"=>"Follow Successfully");
	            $data= json_encode($val);
	            echo $data;
              }
                                                    
       
   }else 
   {
       $val= array("status" => "failed","message"=>"Login First!");
       $data= json_encode($val);
	            echo $data;
   }
   } 
   
   
   
    public function search_shop()
{

      $search = $this->input->post('title');
    
            
         header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        // die();
        
         $lat=$this->session->userdata('lat')?$this->session->userdata('lat'):'28.617825';
        $long=$this->session->userdata('lng')?$this->session->userdata('lng'):'77.383855';
          $user_id=$this->input->post('user_id');
  	   //$product_id=$this->input->post('product_id');
    // 	$res = $this->am->selectres('seller_product',array('type'=>2));
    	$latitude=$lat;
    	$longitude=$long;
    	$distance_km=1115;
    	$radius_km = $distance_km; 
        $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
         
        $having = " HAVING (distance <= $radius_km) "; 
         
        $order_by = 'distance ASC '; 
     
     
        // Fetch places from the database 
          $sql = "SELECT user.*,seller_registeration.*,user.lat  lati ,user.id as user_id,user.long as longi".$sql_distance." FROM user_registeration  user INNER JOIN seller_registeration
        ON seller_registeration.user_id = user.id WHERE shop_name LIKE '%$search%' $having ORDER BY $order_by"; 
    
         $query = $this->db->query($sql)->result();
         
         
         $arr=array();
         if($query){
         foreach($query as $res){
             if(!empty($res->lat)){
             $result['id']=$res->id;
             $result['user_id']=$res->user_id;
             $result['shop_name']=ucfirst($res->shop_name);
             $result['shop_area']=$res->shop_area;
             $result['lat']=$res->lati;
             $result['long']=$res->longi;
             $result['lat_long']="$res->lat,$res->long";
             $result['shop_town']=$res->shop_town;
             $result['shop_distric']=$res->shop_distric;
             $result['shop_state']=$res->shop_state;
             $result['area_pincode']=$res->area_pincode;
             $result['distance']=number_format((float)$res->distance, 2, '.', '');
             $result['description']=$res->description;
             $result['profile_image']=$res->profile_image?base_url().$res->profile_image:'';
             
               array_push($arr,$result);
             }
         }
         
        
         }  
        
        $data['near_location']=$arr;
        
        
    //$data['near_location'] =  $this->web->search($search);
    
    
    //print_r($data['search_shop']);
    $this->render('near_location', $data);
}
   
   
   public function brand_list()
        {
         $brand_id = $this->uri->segment(2);
        
         
        
        
         $data['brand_name']= $this->web->selectrow('brand', array('id'=>$brand_id));
         $data['brand']= $this->db->select('seller_product.*')->where('seller_product.brand_name', $brand_id)->join('brand','brand.id=seller_product.brand_name')->get('seller_product')->result();
        
         $this->render('brand_list',$data);
        
         
        }


    
}



?>