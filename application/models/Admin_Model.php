<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin_Model extends CI_Model {
	public function __construct()
    {
      parent::__construct(); 
    }//__construct method close
	
	public function login($email,$pass)
    {
       $q=$this->db->where(["email"=>$email,"password"=>$pass])->get("admin");
       //echo $this->db->last_query();die;
       if($q->num_rows())
       {
        return $q->row();
       }

    }//login method close

function delete($tbl,$id)
  {
    $this->db->where('id',$id);
    $this->db->delete($tbl);

  }
  public function fetch_all_un_assigned_pins()
   {
    $q=$this->db->where("assigned_to",0)->where("status",0)->get("pins");
    if($q->num_rows())
    {
     return $q->result();
    }//if close 
   }

public function fetch_all_pin_limit()
   {
    $q=$this->db->get("pin_limit");
    if($q->num_rows())
    {
     return $q->row();
    }//if close 
   }
public function fetch_all_user()
   {
    $q=$this->db->get("user_registeration");
    
     return $q->result();
    
   }


   public function selectres($tbl,$con='',$con1='',$con2='',$con3='')
  {
    $this->db->select('*');
    $this->db->from($tbl);

    if ($con)
      $this->db->where($con);

      if ($con1)
        $this->db->where($con1);

        if ($con2)
          $this->db->where($con2);

          if ($con3)
            $this->db->where($con3);
    $q = $this->db->get();
    //echo $this->db->last_query();
    //die;
    return $q->result();
  }

    public function selectrow($tbl,$con='',$con1='',$con2='',$con3='')
  {
    $this->db->select('*');
    $this->db->from($tbl);

    if ($con)
      $this->db->where($con);

      if ($con1)
        $this->db->where($con1);

        if ($con2)
          $this->db->where($con2);

          if ($con3)
            $this->db->where($con3);



    $q = $this->db->get();
    return $q->row();

  }
  
  
   public function get_product($tbl,$con='',$con1='',$con2='',$con3='')
  {
    $this->db->select('*');
    $this->db->from($tbl);

    if ($con)
      $this->db->where($con);

      if ($con1)
        $this->db->where($con1);

        if ($con2)
          $this->db->where($con2);

          if ($con3)
            $this->db->where($con3);
            $this->db->order_by("id", "DESC");



    $q = $this->db->get();
    return $q->row();

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
  
    

  public function updated_pin_limit($data)
   {
    $q=$this->db->update("pin_limit",$data);
    return $q;
   }

  public function getCurrPassword($id)
    {
      $query = $this->db->where(['id'=>$id])->get('user_registeration');
        if($query->num_rows() > 0)
        {
            return $query->row();
        } 
     }  
             
    public function updatePassword($new_password, $id)
    {
      $pass= md5($new_password);
      $data= array(
            'vpassword'=> $new_password,
            'password'=> $pass
          );
      return $this->db->where('id',$id)->update('user_registeration', $data); 
    }         
             

 

   public function fetch_all_pins()
   {
    $q=$this->db->where("status",0)->get("pins");
    if($q->num_rows())
    {
     return $q->result();
    }//if close 
   }

  public function fetch_all_users()
   {
    $q=$this->db->where("role",0)->get("user_registeration");
    if($q->num_rows())
    {
     return $q->result();
    }//if close 
   }//alluser_method close

    public function change_status($id,$data)
    {
      $qry= $this->db->where(["id"=>$id,"status"=>0])->update("user_registeration",$data);
      return $qry;

    }//login method close
    
      public function get_order_list($value='')
	{
             $this->db->distinct();
            $this->db->select('user_id');
             $this->db->from('cart');
            $query = $this->db->get();
            return $query->result();
	}
	
	public function get_count($table) {
        return $this->db->count_all($table);
    }
    
    public function otp_varify_model($email) {
        $change_pass = $this->db->where(["email"=>$email,"status"=>1])->get("admin");
	     return $change_pass;
    }
    
    public function setpass($new,$conform)
	{
		$emails = $this->session->userdata("check_email");
		$data = $this->db->where(["email"=>$emails,"status"=>1])->get('admin');
		if($data->num_rows())
       {
        return $data->row();
       }
	}
	
	public function update_password($new,$conform,$id_data)
	{
		$query = "UPDATE admin SET password='$new' WHERE id=$id_data";
		$this->db->query($query);
	}
}
?>