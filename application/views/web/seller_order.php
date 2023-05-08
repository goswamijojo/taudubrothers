<div class="page-title-area">
   <div class="d-table">
      <div class="d-table-cell">
         <div class="container">
            <div class="title-content">
               <h2>My Orders</h2>
               <ul>
                  <li>
                     <a href="index.php">Home</a>
                  </li>
                  <li>
                     <span>My Orders</span>
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
                        
                        <a href="dashboard_my_profile.php" class="user-item"><i class="uil uil-box"></i>My Profile</a>
                        
                         <?php if($user->kyc_status==0) { ?>
                         <a href="<?php echo base_url('kyc_vendor');?>" class="user-item"><i class="uil uil-wallet"></i>My KYC</a>
                         <?php } ?>
                        
                     <a href="<?php echo base_url('my_order');?>" class="user-item"><i class="uil uil-box"></i>My Orders</a>
                     
                   
                     
                    <?php if(!empty($user->kyc_status)) { ?>
                         <a href="<?php echo base_url('add_product');?>" class="user-item"><i class="uil uil-wallet"></i>Add Product</a>
                         
                         
                        
                         <a href="<?php echo base_url('view_product');?>" class="user-item"><i class="uil uil-wallet"></i>View Product List</a>
                          <?php } ?>
                           <?php if($user->kyc_type > 0 ) { ?>
                           <a href="<?php echo base_url('seller_order');?>" class="user-item active"><i class="uil uil-wallet"></i>Seller Order</a>
                          
                          <?php } ?>
                          
                        <a href="<?php echo base_url('wishlist');?>" class="user-item"><i class="uil uil-heart"></i>Shopping
                            Wishlist</a>
                        <!--<a href="<?php echo base_url('add_address');?>" class="user-item"><i class="uil uil-location-point"></i>My-->
                        <!--    Address</a>-->
                        <a href="<?php echo base_url();?>logout" class="user-item"><i class="uil uil-exit"></i>Logout</a>
                  </div>
               </div>
            </div>
            <div class="col-lg-9 col-md-8">
               <div class="dashboard-right">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="main-title-tab">
                           
                           <h4><i class="uil uil-box"></i>Seller Orders</h4>
                        </div>
                     </div>
                     <div class="col-lg-12 col-md-12">
                       
                         <?php foreach($seller_order  as $res) { ?>
                        <div class="pdpt-bg">
                           <div class="pdpt-title">
                              <h6>Delivery Date <?php echo $res['order_delivered_date']?> </h6>
                           </div>
                           <div class="order-body10">
                              <ul class="order-dtsll">
                                 <li>
                                    <div class="order-dt-img">
                                       <img src="<?php echo $res ['product_image'];?>" alt="">
                                    </div>
                                 </li>
                                 <li>
                                    <div class="order-dt47">
                                       <h4>#order Id  <?php echo $res['order_id']?> <br><?php echo $res['product_name']?></h4>
                                       <p></p>
                                       <div class="order-title"><?php echo $res['quentity']?> Items <span data-inverted=""
                                          data-tooltip="2kg broccoli, 1kg Apple"
                                          data-position="top center">?</span></div>
                                    </div>
                                 </li>
                              </ul>
                              <div class="total-dt">
                                 <div class="total-checkout-group">
                                    <div class="cart-total-dil">
                                       <h4>Sub Total</h4>
                                       
                                      <span><?php echo $res['quentity']?> ✖ <?php echo $res['total_amount_product']?></span>
                                       
                                    </div>
                                    <div class="cart-total-dil pt-3">
                                       <h4>Delivery Charges</h4>
                                       <span><?php echo $res['delivery_charge']?></span>
                                    </div>
                                 </div>
                                 <div class="main-total-cart">
                                    <h2>Total</h2>
                                    <span><?php echo $res['total_amount_product']*$res['quentity']+$res['delivery_charge'];?></span>
                                 </div>
                              </div>
                              <div class="track-order">
                                 <h4>Track Order</h4>
                                 <div class="bs-wizard" style="border-bottom:0;">
                                    <div class="bs-wizard-step <?php if($res['order_status']>=1){ ?>complete <?php }else{ echo 'active'; } ?>">
                                       <div class="text-center bs-wizard-stepnum">Placed</div>
                                       <div class="progress">
                                          <div class="progress-bar"></div>
                                       </div>
                                       <a href="#" class="bs-wizard-dot"></a>
                                    </div>
                                    <div class="bs-wizard-step <?php if($res['order_status']>=2){ ?>complete <?php }else{ echo ''; } ?>">
                                       <div class="text-center bs-wizard-stepnum">Shipped</div>
                                       <div class="progress">
                                          <div class="progress-bar"></div>
                                       </div>
                                       <a href="#" class="bs-wizard-dot"></a>
                                    </div>
                                    <div class="bs-wizard-step <?php if($res['order_status']>=3){ ?>complete <?php }else{ echo ''; } ?>">
                                       <div class="text-center bs-wizard-stepnum">On the way</div>
                                       <div class="progress">
                                          <div class="progress-bar"></div>
                                       </div>
                                       <a href="#" class="bs-wizard-dot"></a>
                                    </div>
                                    <div class="bs-wizard-step <?php if($res['order_status']>=4){ ?>complete <?php }else{ echo ''; } ?>">
                                       <div class="text-center bs-wizard-stepnum">Delivered</div>
                                       <div class="progress">
                                          <div class="progress-bar"></div>
                                       </div>
                                       <a href="#" class="bs-wizard-dot"></a>
                                    </div>
                                 </div>
                              </div>
                              <!--<div class="alert-offer">
                                 <img src="<?php echo base_url();?>web/assets/images/ribbon.svg" alt="">
                                 Cashback of $2 will be credit to Gambo Super Market wallet 6-12 hours of
                                 delivery.
                              </div>-->
                              <div class="call-bill">
                                 <!--<div class="delivery-man">
                                    Delivery Boy - <a href="#"><i class="uil uil-phone"></i> Call Us</a>
                                 </div>-->
                                 <div class="order-bill-slip">
                                    <a href="<?php echo base_url('HtmltoPDF/pdfdetails/').$res['order_id'];?>" class="bill-btn5 hover-btn" target="_blank">View Bill</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php } ?>
                        
                       <!-- <div class="pdpt-bg">
                           <div class="pdpt-title">
                              <h6>Delivery Timing 10 May, 3.00PM - 6.00PM</h6>
                           </div>
                           <div class="order-body10">
                              <ul class="order-dtsll">
                                 <li>
                                    <div class="order-dt-img">
                                       <img src="<?php echo base_url();?>web/assets/images/groceries.svg" alt="">
                                    </div>
                                 </li>
                                 <li>
                                    <div class="order-dt47">
                                       <h4>Gambo - Ludhiana</h4>
                                       <p>Delivered - Gambo</p>
                                       <div class="order-title">2 Items <span data-inverted=""
                                          data-tooltip="2kg broccoli, 1kg Apple"
                                          data-position="top center">?</span></div>
                                    </div>
                                 </li>
                              </ul>
                              <div class="total-dt">
                                 <div class="total-checkout-group">
                                    <div class="cart-total-dil">
                                       <h4>Sub Total</h4>
                                       <span>$25</span>
                                    </div>
                                    <div class="cart-total-dil pt-3">
                                       <h4>Delivery Charges</h4>
                                       <span>Free</span>
                                    </div>
                                 </div>
                                 <div class="main-total-cart">
                                    <h2>Total</h2>
                                    <span>$25</span>
                                 </div>
                              </div>
                              <div class="track-order">
                                 <h4>Track Order</h4>
                                 <div class="bs-wizard" style="border-bottom:0;">
                                    <div class="bs-wizard-step complete">
                                       <div class="text-center bs-wizard-stepnum">Placed</div>
                                       <div class="progress">
                                          <div class="progress-bar"></div>
                                       </div>
                                       <a href="#" class="bs-wizard-dot"></a>
                                    </div>
                                    <div class="bs-wizard-step complete">
                                       <div class="text-center bs-wizard-stepnum">Packed</div>
                                       <div class="progress">
                                          <div class="progress-bar"></div>
                                       </div>
                                       <a href="#" class="bs-wizard-dot"></a>
                                    </div>
                                    <div class="bs-wizard-step complete">
                                       <div class="text-center bs-wizard-stepnum">Arrived</div>
                                       <div class="progress">
                                          <div class="progress-bar"></div>
                                       </div>
                                       <a href="#" class="bs-wizard-dot"></a>
                                    </div>
                                    <div class="bs-wizard-step complete">
                                       <div class="text-center bs-wizard-stepnum">Delivered</div>
                                       <div class="progress">
                                          <div class="progress-bar"></div>
                                       </div>
                                       <a href="#" class="bs-wizard-dot"></a>
                                    </div>
                                 </div>
                              </div>
                              <div class="call-bill">
                                 <div class="delivery-man">
                                    <a href="#"><i class="uil uil-rss"></i>Feedback</a>
                                 </div>
                                 <div class="order-bill-slip">
                                    <a href="#" class="bill-btn5 hover-btn">View Bill</a>
                                 </div>
                              </div>
                           </div>
                        </div>-->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
</section>