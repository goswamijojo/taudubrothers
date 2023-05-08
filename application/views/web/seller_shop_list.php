    <div class="container">
    <div class="col-lg-12 col-md-12">
               <div class="dashboard-right">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="main-title-tab">
                           
                          <h4><i class="uil uil-box"></i>Product List</h4>
                        </div>
                     </div>
                      
                     <div class="col-lg-12 col-md-12">
                       <div class="row">
                           <?php if(!empty($seller_shop_list)) { ?>
                     <?php foreach($seller_shop_list as $result){
                        
                         
                     ?>  
                     <div class="pdpt-bg col-lg-6 col-md-12">
                           <div class="pdpt-title">
                             
                           </div>
                           <div class="order-body10">
                              <ul class="order-dtsll">
                                 <li>
                                    <div class="order-dt-img" style="border-radius: 50%;">
                                       <img src="<?php echo $result['product_image'];?>" alt="" style="border-radius: 50%;" >
                                    </div>
                                 </li>
                                 <li>
                                    <div class="order-dt47">
                                        <a href="<?php echo base_url('product_details/').$result['slug'];?>" target="_blank">
                                       <h4><?php echo $result['product_name'];?></h4>
                                       <p>₹ <?php echo $result['product_price'];?></p>
                                      <p>Product View: <?php echo $result['views_count'];?></p>
                                       <!--<div class="order-title"><?php echo $result['shop_area'];?> , <?php echo $result['shop_area'];?>, <br><?php echo $result['shop_town'];?> , <?php echo $result['shop_distric'];?>,<?php echo $result['area_pincode'];?><span data-inverted="" data-tooltip="<?php echo $result['distance'];?>" data-position="top center">?</span></div>
                                        <h4>Distance : <?php echo $result['distance'];?> KM</h4>-->
                                        </a>
                                    </div>
                                    
                                 </li>
                              </ul>
                          
                              
                           </div>
                        </div>
                                                 
                         <?php } } else {?>
                         
      <div class="text-center">                   
      <a class="common-btn two" href="#">
        Products Not Found!
    </a>
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
                                       <img src="https://pay2pal.in/humble_demo/web/assets/images/groceries.svg" alt="">
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