<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Web_model', 'web');
        
    }
    
    public function render($view,$data=''){
        
        if($this->uri->segment('1')=='grocery'){
            $this->db->where('type','2');
        }else if($this->uri->segment('1')=='fresh'){
            $this->db->where('type','3');
        }else{
            $this->db->where('type','1');
        }
        $head['category']=$this->db->get('category')->result();
        $this->load->view('web/header',$head);
        $this->load->view('web/'.$view, $data);
        $this->load->view('web/footer');
    }
}    
    