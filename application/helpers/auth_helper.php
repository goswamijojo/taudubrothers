<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
function auth_checker()
{
      $ci =& get_instance();
        if(empty($ci->session->userdata('login_status'))){
            redirect('login');
        }
        return true;
}