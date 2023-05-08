<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HtmltoPDF extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->model('htmltopdf_model');
  $this->load->library('pdf');
  $this->load->model('User_Model');
    $this->load->model('Admin_Model','am');
    $this->load->helper('auth_helper');
    $this->load->library('user_agent');
 }

 public function index()
 {
  $data['customer_data'] = $this->htmltopdf_model->fetch();
  $this->load->view('htmltopdf', $data);
 }

 public function details()
 {
  if($this->uri->segment(3))
  {
   $order_id = $this->uri->segment(3);
   $data['customer_details'] = $this->htmltopdf_model->fetch_single_details($order_id);
   $this->load->view('htmltopdf', $data);
  }
 }

 public function pdfdetails()
 {
  if($this->uri->segment(3))
  {
   $order_id = $this->uri->segment(3);
   $invoice_code= 10001;
   //$invoice_code++;
   $number = "$order_id". $invoice_code;
   $invoice_no = $number;
   
   
   $html = '<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title> Invoice </title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family:  "Helvetica Neue",  "Helvetica", Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
				
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
				padding: 15px;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
				padding: 15px;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma,  "Helvetica Neue",  "Helvetica", Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="'.base_url().'web/assets/images/tudulogo.png" />
								</td>
								
		';						

							$html.='	
							<td>
								<h4 style="margin-top: 5px; margin-bottom: 5px">
                                Invoice #'.$invoice_no.'
                            </h4>
								</td>
								
							</tr>
						</table>
					</td>
				</tr>
				
				
	
				<tr class="information">
					<td colspan="2">
						<table>
							<tr>';
                    //auth_checker();
	                //$user_id = $this->session->userdata('user_id');
	                
	                $res2= $this->db->where(array('order_id'=>$order_id))->get('check_out')->row_array();
	                //print_r($res2);die();
	                
                     $res = $this->db->select('user_payment_details.*,check_out.*,user_payment_details.status status')->where(array('user_payment_details.user_id'=>$res2['user_id'],'user_payment_details.order_id'=>$res2['order_id'],'user_payment_details.order_confirm'=>1))->join('user_payment_details','user_payment_details.order_id=check_out.order_id')->limit(1)->get('check_out')->result();
                    
                    //print_r($res); die();
                    
                     $row1 = $this->am->selectrow('user_registeration',array('id'=>$res2['user_id']));
                    
                    //$vendor = $this->am->selectrow('seller_registeration',array('user_id'=>$res2['vendor_id']));
                    
                    $vendor = $this->db->select('seller_registeration.*, user_registeration.mobile_no')->where(array('user_id'=>$res2['vendor_id']))->join('user_registeration','user_registeration.id=seller_registeration.user_id')->get('seller_registeration')->row();
                    //print_r($vendor);die();
                    
                    if(!empty($vendor)){
                    $html.='
                   <td colspan="6">
                        <h4 style="margin: 0">From:</h4>
                        <h3 style="margin:12px 0px">'.ucfirst($vendor->name).'</h3>
                        <p><b>Shop Name:</b> '.ucfirst($vendor->shop_name).'</p>
                        <p>
                            <b>Address:</b> '.$vendor->shop_area.', ' .$vendor->shop_town. ', ' .$vendor->shop_distric. ', ' .$vendor->shop_state.', ' .$vendor->area_pincode.'
                        </p>
                        <p><b>Phone Number:</b> '.$vendor->mobile_no.'</p>
                    </td> ';
                    } 
                    else{
                        
                         $html.='
                        <td colspan="6">
                        <h4 style="margin: 0">From:</h4>
                        <h3 style="margin:12px 0px">Taudu Brothers</h3>
                        <p>Shop Name:Taudu Brothers </p>
                        <p>
                            Address:  Sikeston,New Delhi 110034 <br/>
                        </p>
                        <p>
                        Email:
                        </p>
                        </td>';
                        
                    }
                   
foreach($res as $row)
  {
						
						$html .= ' <td colspan="6" style="width: 300px">
                        <h4 style="margin: 0">To:</h4>
                        <h3 style="margin:12px 0px">'.ucfirst($row->full_name).'</h3>

                        <p>
                            <b>Address:</b> '.$row->house_no.','.$row->colony.'
                            </p>
                            <p>
                            <b>Landmark:</b> '.$row->landmark.', <b>City:</b> '.$row->city.'
                            </p>
                            <p>
                            <b>State:</b> '.$row->state.', <b>Address Type:</b> '.$row->address_type.'
                        </p>
                        <p> <b>Email:</b> '.$row1->email.'<br/>
                         </p>
                        <p>
                            <b>Phone:</b> +91 '.$row->mobile_no.'
                        </p>
                    </td>';
                    
  }
						$html .= ' </tr>
						</table>
					</td>
				</tr>
  
			
				</table>
	<table cellpadding="0" cellspacing="0">
	
	<tr class="heading">
	                <td>Order ID</td>
					<td>Item</td>
					<td>QTY</td>
					<td>Discount</td>
					<td>Price</td>
				</tr>
				';
			 

$res = $this->db->select('user_payment_details.*,check_out.*,user_payment_details.status status')->where(array('user_payment_details.order_id'=>$order_id,'user_payment_details.order_confirm'=>1))->join('user_payment_details','user_payment_details.order_id=check_out.order_id')->get('check_out')->result();



//print_r($res);

			foreach($res as $row)
  {
     
     $total_amount=0;
     
$offer2=$row->discount;
$offer=$row->price;
$product_price=$row->price*$offer2/100;
$comision_price=$offer-$product_price;   
       
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
    //   $offer=$row->discount;
    //   $product_price=($row->price*$offer)/100;
      
    //   $offer=$row->price;
      $offer1=$row->shipping_charge_amount;
      $total_price=$offer-$product_price+$value;
      //$result['discount']=$row->discount;
      $result['product_price']=round($total_price);
      
      $product_res = $this->am->selectres('check_out',array('user_id'=>$row->user_id,'order_id'=>$order_id));
      $count=0;
      foreach($product_res as $pro_res)
      {
          $total_amount = $total_price;
          $count++;
      }
    
    
    $result['total_amount_product']=round($total_amount);
    $result['product_count']="$count";
    $amount=$total_amount*$row->quentity+$offer1;
    
        $html .= '

				<tr class="item">
				<td># '.$row->order_id.'</td>
					<td>'.$row->product_name.'</td>
				
					
					<td>'.$row->quentity.'</td>

					<td> '.$row->discount.' %</td>
					<td> Rs.  '.round($total_amount).'</td>
				</tr>
					<tr class="total">
					   <td colspan="3"> </td>
					<td colspan="2">Shipping Charge: Rs. '.round($offer1).'</td>
				</tr>
				<tr class="total">
					   <td colspan="3"> </td>
					<td colspan="2">Grand Total: Rs. '.round($amount).'</td>
				</tr>

				 ';
  }

	
				
				
				
      $html.= '
			</table>';
		$html.= '	 <hr>

        <table style="width: 100%" cellspacing="0" cellspadding="0" border="0">
            <tr>
                <td>

                    <p>
                        Taudu Brothers <a href="'.base_url().'"  target="_blank">taudubrothers.com</a>, South Block, New delhi
                    </p>
                </td>

            </tr>
        </table>
			
			
		</div>
	</body>
</html>';

			$this->load->library('pdf');
			$options = $this->dompdf->getOptions();
			$options->setisPhpEnabled(true);
			$options->setisRemoteEnabled(true);
			$options->setisJavascriptEnabled(true);
			$options->setisHtml5ParserEnabled(true);
			$this->dompdf->setOptions($options);
			$this->dompdf->loadHtml($html);
			$this->dompdf->render();
			$this->dompdf->stream("".$order_id.".pdf", array("Attachment"=>0));
  }
 }

}

?>
