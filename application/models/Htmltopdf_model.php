<?php
class Htmltopdf_model extends CI_Model
{
 function fetch()
 {
  $this->db->order_by('order_id', 'DESC');
  return $this->db->get('user_payment_details');
 }
 function fetch_single_details($order_id)
 {
  /*$this->db->where('order_id', $order_id);
  $data = $this->db->get('user_payment_details');*/
  //auth_checker();
	$user_id = $this->session->userdata('user_id');
  
   $res = $this->db->select('user_payment_details.*,check_out.*,user_payment_details.status status')->where(array('user_payment_details.order_id'=>$order_id,'user_payment_details.order_confirm'=>1))->join('user_payment_details','user_payment_details.order_id=check_out.order_id')->get('check_out')->result(); 
   
   
   //print_r($res);
  $output = '<table width="100%" cellspacing="5" cellpadding="5">';
  foreach($res as $row)
  {
      
   $output .= '
   <tr>

    <td width="75%">
    <p><b>Product Name : </b>'.$row->product_name.'</p>
     <p><b>Name : </b>'.$row->full_name.'</p>
     <p><b>Address : </b>'.$row->full_address.'</p>
     <p><b>Transaction ID : </b>'.$row->transaction_id.'</p>
     
     
     
    </td>
   </tr>
   ';
   
  
      
  }
  $output .= '
  <tr>
   <td colspan="2" align="center"><a href="'.base_url().'my_order" class="btn btn-primary">Back</a></td>
  </tr>
  ';
  $output .= '</table>';
  return $output;
 }
}

?>
