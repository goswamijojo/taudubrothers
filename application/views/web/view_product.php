<div class="page-title-area">
   <div class="d-table">
      <div class="d-table-cell">
         <div class="container">
            <div class="title-content">
               <h2>Product List</h2>
               <ul>
                  <li>
                     <a href="<?php echo base_url();?>">Home</a>
                  </li>
                  <li>
                     <span>Product List</span>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="title-img">
      <img src="<?php echo base_url();?>web/assets/images/page-title2.jpg" alt="About">
      <img src="<?php echo base_url();?>web/assets/images/shape16.png" alt="Shape">
      <img src="<?php echo base_url();?>web/assets/images/shape17.png" alt="Shape">
      <img src="<?php echo base_url();?>web/assets/images/shape18.png" alt="Shape">
   </div>
</div>
<section class="dashboard-overview">
   <div class="">
      <div class="container">
         <div class="row">
            <div class="col-lg-3 col-md-4">
               <div class="left-side-tabs">
                  <div class="dashboard-left-links">
                     <a href="<?php echo base_url('dashboard_overview');?>" class="user-item"><i
                        class="uil uil-apps"></i>Overview</a>
                        
                        <a href="<?php echo base_url('user_profile');?>" class="user-item"><i class="uil uil-box"></i>My Profile</a>
                        
                        <?php if($user->kyc_status==0) { ?>
                         <a href="<?php echo base_url('kyc_vendor');?>" class="user-item"><i class="uil uil-wallet"></i>My KYC</a>
                         <?php } ?>
                         
                     <a href="<?php echo base_url('my_order');?>" class="user-item"><i class="uil uil-box"></i>My Orders</a>
                     
                     
                     
                     <?php if(!empty($user->kyc_status)) { ?>
                         <a href="<?php echo base_url('add_product');?>" class="user-item"><i class="uil uil-wallet"></i>Add Product</a>
                         
                         
                        
                         <a href="<?php echo base_url('view_product');?>" class="user-item active"><i class="uil uil-wallet"></i>View Product List</a>
                          <?php } ?>
                      
                      
                       <?php if($user->kyc_type > 0 ) { ?>
                           <a href="<?php echo base_url('seller_order');?>" class="user-item"><i class="uil uil-wallet"></i>Seller Order</a>
                          
                          <?php } ?>
                          
                     <a href="<?php echo base_url('wishlist');?>" class="user-item"><i class="uil uil-heart"></i>Shopping
                     Wishlist</a>
                     <!--<a href="<?php echo base_url('add_address');?>" class="user-item"><i class="uil uil-location-point"></i>My
                     Address</a>-->
                     <a href="<?php echo base_url();?>logout" class="user-item"><i class="uil uil-exit"></i>Logout</a>
                  </div>
               </div>
            </div>
            
            <div class="col-lg-9 col-md-8">
               <div class="dashboard-right">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="main-title-tab">
                           <h4><i class="uil uil-heart"></i>Product List</h4>
                           <?php if(!empty($this->session->flashdata('error'))){?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Error!</strong><?php echo $this->session->flashdata('error'); ?>
                                        </div>
                                        <?php } ?>
                                         <?php if(!empty($this->session->flashdata('success'))){?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>Success!</strong><?php echo $this->session->flashdata('success'); ?>
                                        </div>
                                        <?php } ?>
                        </div>
                     </div>
                     
                    
                     <div class="col-lg-12 col-md-12">
                        <div class="pdpt-bg">
                           <div class="wishlist-body-dtt">
                               
                             
                              <?php foreach($viewproduct as $row) { 
                             
                            $product_id = $row->id;
                            $query=$this->db->where(array('product_id'=>$product_id))->get('product_view');
                            
                            $views_count = $query->num_rows();
                            
                            //print_r($views_count);
                           ?>
                             
                             <?php } ?>
                             
                              <?php 
                            
                            
                            
                            //$views_count = $query->num_rows();
                            
                              foreach ($viewproduct as $res) 
                              { 
                             
                              ?>
                              
<?php 
                        
$offer2=$res->discount;
$offer=$res->price;
$product_price=$res->price*$offer2/100;
$comision_price=$offer-$product_price;               
 //print_r($comision_price);                 
                         
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
    $total_price=$offer-$product_price+$value;
?>

                              <div class="cart-item">
                                 <div class="cart-product-img">
                                     <a href="<?php echo base_url('product_details/').$res->slug ?>">
                                    <img src="<?php echo base_url($res->image);?>" alt=""></a>
                                    <?php if($res->discount>0) {?>
                                    <div class="offer-badge"><?= $res->discount ?>% OFF</div>
                                    <?php } ?>
                                    
                                 </div>
                                 
                                 <div class="cart-text">
                                <a href="<?php echo base_url('product_details/').$res->slug ?>"><h4><?= ucfirst($res-> product_name) ?></h4></a>
                                   
                                 <div class="cart-item-price">₹ <?= round($total_price) ?> <span>₹ <?= $res-> price ?></span></div>
                                   
        <button type="button" class="cart-close-btn"><a href="<?php echo base_url() ?>delete_product/<?= $res->id ?>" class="action-btn"> <img class="uil uil-home-alt" src="<?php echo base_url() ?>web/assets/images/delete.png"/></a></button>
        <button type="button" class="btn btn-sm" style="float:right; padding-right:0px;"><a href="<?php echo base_url() ?>edit_seller_product/<?= $res->id ?>" class="action-btn"> <img class="uil uil-home-alt" src="<?php echo base_url() ?>web/assets/images/edit.png"/></a></button>
               
               
                
                              

                                 </div>
                                 
                                 
                              </div>
                              <?php  } ?>
                             
                           
                             
                             
  
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
</section>