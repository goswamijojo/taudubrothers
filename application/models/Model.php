<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function admin_login($email,$password)
	{
	    $this->db->select('*');
		$this->db->limit(1);
		$query = $this->db->where("(register.email= '$email' OR register.phone = '$email')")->where("password = '$password'")->get('register');
		//echo $this->db->last_query();die;
		if($query->num_rows())
		{
		return $query->row();
		}
	}
	public function data_insert($tbl,$data)
	{
		$this->db->insert($tbl,$data);
		return 1;

	}


}