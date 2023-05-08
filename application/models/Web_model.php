<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Web_model extends CI_Model {
	public function __construct()
    {
       
    } 
	
	
	public function selectrow($tbl,$con='')
  {
    $this->db->select('*');
    $this->db->from($tbl);

    if ($con)
      $this->db->where($con);

    $q = $this->db->get();
    return $q->row();

  }
  public function selectres($tbl,$con='')
  {
    $this->db->select('*');
    $this->db->from($tbl);

    if ($con)
      $this->db->where($con);

    $q = $this->db->get();
    return $q->result();
  }
  
   public function get_count_product($tbl,$con='')
  {
    $this->db->select('*');
    $this->db->from($tbl);

    if ($con)
      $this->db->where($con);

    $q = $this->db->get();
    return $q->num_rows();
  }
  
  
 public function get_home_product($tbl,$con='',$limit,$start='0')
  {
    $this->db->select('*');
    $this->db->from($tbl);

    if ($con)
      $this->db->where($con);
      
 $this->db->limit($limit, $start);
 $this->db->order_by('id','desc');
    $q = $this->db->get();
    return $q->result();
  }
  
  
  
  
  
  public function get_product($tbl, $con='', $limit,$start)
  {
    $this->db->select('*');
    $this->db->from($tbl);

    if ($con)
    
    $this->db->where($con);
    $this->db->limit($limit, $start);
    $q = $this->db->get();
    return $q->result();
  }
  
  
  
   public function get_count_product_search($tbl,$con='')
  {
    $this->db->select('*');
    $this->db->from($tbl);

    if ($con)
      $this->db->where($con);
      
      if(!empty($this->input->get('category'))){
                $this->db->where('category',$this->input->get('category'));
      }
       if(!empty($this->input->get('title'))){
                $this->db->like('product_name',$this->input->get('title'));
      }

    $q = $this->db->get();
    return $q->num_rows();
  }
  
  public function get_product_search($tbl,$con='',$limit,$start)
  {
 
    $this->db->select('*');
    $this->db->from($tbl);
 
    if ($con)
      $this->db->where($con);
      
      if(!empty($this->input->get('category'))){
                $this->db->where('category',$this->input->get('category'));
      }
       if(!empty($this->input->get('title'))){
                $this->db->like('product_name',$this->input->get('title'));
      }

     $this->db->limit($limit, $start);
    $q = $this->db->get();
    return $q->result();
  }
  
  
   public function update($tbl,$data,$con='')
  {
    $this->db->where($con);
    $this->db->update($tbl,$data);
    return $this->db->affected_rows();
  }
  
  public function insert($tbl, $data)
  {
    return $this->db->insert($tbl, $data);
  }
  
  
   public function get_home_blog($tbl,$con='',$limit,$start='0')
  {
    $this->db->select('*');
    $this->db->from($tbl);

    if ($con)
      $this->db->where($con);
      
 $this->db->limit($limit, $start);
    $q = $this->db->get();
    /*echo $q = $this->db->last_query();
   die();*/
    return $q->result();
  }
  
  public function get_blog($tbl,$con='',$limit,$start)
  {
    $this->db->select('*');
    $this->db->from($tbl);

    if ($con)
      $this->db->where($con);
      
 $this->db->limit($limit, $start);
    $q = $this->db->get();
    
   /*echo $q = $this->db->last_query();
   die();*/
    return $q->result();
  }
  
    public function get_count_blog()
  {
        $this->db->select('*');
        $q=$this->db->get('blog');

        if($q)
        {
            return $q->num_rows();
        }
        else
        {
            return false;
        }
  }
  
  
  public function count()
    {
        $this->db->select('*');
        $this->db->where('type',0);
        $q=$this->db->get('banner');

        if($q)
        {
            return $q->num_rows();
        }
        else
        {
            return false;
        }
    }

public function gallery()
    {
        $this->db->select('*');
        $this->db->where('type',0);
        $q= $this->db->get('banner');


        if($q->num_rows()>0)
        {
            return $q->result();
        }
        else
        {
            return false;
        }
    }
    
    
    public function pagination_count() 
    {
       $this->db->select('*');
       $this->db->where('kyc_type',2);
        $this->db->order_by('id','desc');
       $q=$this->db->get('seller_product');
        if($q)
        {
            return $q->num_rows();
        }
        else
        {
            return false;
        }
    }
    
    public function index_count() 
    {
       $this->db->select('*');
       $this->db->where('kyc_type',1);
       $this->db->order_by('id','desc');
       $q=$this->db->get('seller_product');

        if($q)
        {
            return $q->num_rows();
        }
        else
        {
            return false;
        }
    }






public function fetch_data($limit, $start) {
        $this->db->limit($limit, $start);
        
        $this->db->where('type',2);
        $this->db->order_by('id','desc');
        $query = $this->db->get("seller_product");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   
   public function fetch_fresh_data($limit, $start) {
        
        $latitude='28.6389057';
    	$longitude='77.4814559';
    	$distance_km=115;
        $radius_km = $distance_km; 
        $sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`user`.`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`user`.`lat`*pi()/180)) * cos(((".$longitude."-`user`.`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
        $having = " HAVING (distance <= $radius_km) "; 
        $order_by = 'distance ASC '; 
 
 
// Fetch places from the database 
      $sql = "SELECT user.*,seller_product.* ".$sql_distance." FROM user_registeration  user INNER JOIN seller_product
        ON seller_product.user_id = user.id  JOIN category
        ON category.id = seller_product.category where user.kyc_type=3 &&  category.type=3 $having ORDER BY $order_by "; 

     
      $query = $this->db->query($sql); 
      
     

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   
   public function fetch_ecommerce_data($limit, $start) {

        $this->db->limit($limit, $start);
        $this->db->where('kyc_type',1);
        $this->db->order_by('id','desc');
        $query = $this->db->get("seller_product");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
        
        
   }
   
//       public function fetch_grocery_data($limit, $start) {

//         $this->db->limit($limit, $start);
        
//         $this->db->where('kyc_type',2);
//         $this->db->order_by('id','desc');
//         $query = $this->db->get("seller_product");

//         if ($query->num_rows() > 0) {
//             foreach ($query->result() as $row) {
//                 $data[] = $row;
//             }
//             return $data;
//         }
//         return false;
        
        
//   }
   
   
   
   public function marketplace_count() 
    {
       $this->db->select('*');
       $this->db->where('type',1);
       $q=$this->db->get('seller_product');

        if($q)
        {
            return $q->num_rows();
        }
        else
        {
            return false;
        }
}


public function marketplace_fetch_data($limit, $start) 
{
        $this->db->limit($limit, $start);
        
        $this->db->where('type',1);
        $this->db->order_by('id','desc');
        $query = $this->db->get("seller_product");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
    public function search($search)
{
    $this->db->select('*');
    $this->db->from('seller_registeration');
    $this->db->like('shop_name',$search);
    /*$this->db->or_like('fname',$search);
    $this->db->or_like('lname',$search);
    $this->db->or_like('mname',$search);*/
    $query = $this->db->get();
    return $query->result_array();
}

    
}
 
	