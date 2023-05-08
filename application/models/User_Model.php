<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class User_Model extends CI_Model {
   	 public function insert($tbl, $data)
  {
    return $this->db->insert($tbl, $data);
  }
   function fetchtable()  
        {  
            $query = $this->db->get('user_registeration');  
            return $query->result();  
        }  
   
   public function regiter_model($data,$mobile)
   {
            $query="select * from user_registeration where mobile_no='".$mobile."'";       
            $check=$this->db->query($query);   
            $row = $check->num_rows();
            if($row)
            {
               	$this->session->set_flashdata('error','This Mobile Number already exists');
               	
               	redirect('register');
                }
                
            else
            {
            $this->db->insert('user_registeration',$data);
            }
   }
   
   
  public function check_mobile($mobile) {
		$this->db->where(['mobile_no' => $mobile]);
		$query 	= $this->db->get('user_registeration');
		$result = $query->num_rows();
		return $result;
	}
	
	
 public function update_otp($mobile, $data) {
 		return $this->db->update('user_registeration', $data, ["mobile_no"=>$mobile]);
 	}	
   
  public function verify($mobile, $otp) {
		
		
		$this->db->where(['mobile_no' => $mobile, 'otp' => $otp]);
		$query = $this->db->get('user_registeration');
		$result = $query->row();
		if($result) {
			$data = [
				'user_id'=> $result->id,
				'name' 	=> $result->name,
				'mobile_no' 	=> $result->mobile_no,
				'login_status' 	=> TRUE,
			];
			return $data;
		}
		return false;
		
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
   
 }
 ?>