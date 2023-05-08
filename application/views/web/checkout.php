<style>
   
.flex-content {
    display: flex;
    justify-content: space-around;
    align-items: center;
}

.checkout-area .checkout-order ul li:nth-child(2) {
    /* flex: 0 0 35%; */
    max-width: 45%;
    margin-left: 5px;
}
.checkout-area .checkout-order ul li h4 {
    margin-bottom: 0;
    font-size: 16px;
    / width: 50%; /
}

.checkout-area .checkout-order ul li:nth-child(3) {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 15%;
    flex: 0 0 25%;
    max-width: 30%;
    margin-left: 5px;
}

</style>

<!--<div class="page-title-area">-->
<!--   <div class="d-table">-->
<!--      <div class="d-table-cell">-->
<!--         <div class="container">-->
<!--            <div class="title-content">-->
<!--               <h2>Checkout</h2>-->
<!--               <ul>-->
<!--                  <li>-->
<!--                     <a href="<?php echo base_url();?>">Home</a>-->
<!--                  </li>-->
<!--                  <li>-->
<!--                     <a href="<?php echo base_url('dashboard_overview')?>"><span>Dashboard</span></a>-->
<!--                  </li>-->
<!--               </ul>-->
<!--            </div>-->
<!--         </div>-->
<!--      </div>-->
<!--   </div>-->
<!--   <div class="title-img">-->
<!--      <img src="<?php echo base_url();?>web/assets/images/page-title1.jpg" alt="About">-->
<!--      <img src="<?php echo base_url();?>web/assets/images/shape16.png" alt="Shape">-->
<!--      <img src="<?php echo base_url();?>web/assets/images/shape17.png" alt="Shape">-->
<!--      <img src="<?php echo base_url();?>web/assets/images/shape18.png" alt="Shape">-->
<!--   </div>-->
<!--</div>-->
<div class="checkout-area  py-5">
   <div class="container">
      <div class="section-title">
         <h2>Billing Details</h2>
      </div>
      <form action="<?php echo base_url() ?>place_order" method="post">
         <div class="row">
            <div class="col-lg-6">
                 <?php if(!empty($this->session->flashdata('error'))){?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php } ?>
                 <?php if(!empty($this->session->flashdata('success'))){?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                <div class="checkout-method" >
                  <h3>Select Billing Address:</h3>
                 
                                        
                  <div class="form-check">
                    
                     <?php if($address){
                     foreach($address as $res){ ?>
                     
                        <div class="address-item">
                            <div class="address-icon1">
                            <input class="form-check-input" type="radio" name="address_id" id="exampleRadios1" value="<?php echo $res->address_id;?>" checked>
                            <input class="form-check-input" type="radio" name="user_id" id="exampleRadios1" value="<?php echo $this->session->userdata('user_id');?>" checked>
                                <img class="uil uil-home-alt" src="<?php echo base_url() ?>web/assets/images/home.png"/> 
                            </div>
                            <div class="address-dt-all">
                                <h4><?php echo $res->address_type ?></h4>
                                
                               <p><?php echo $res->area_street .' , ' . $res->town_village.' , '.$res->city .' , '. $res->state  ?>  Land Mark-<?= $res->landmark ?> , <?= $res->pin_code ?></p>
                                
                            </div>
                            
                             <ul><a href="<?php echo base_url()?>delete_address/<?= $res->address_id ?>"><i class="fa fa-trash" aria-hidden="true" style="color:#980000;"></i></a></ul>
                                
                        </div>
                        
                        <?php }}else{?>
                        <!--<li><a   data-bs-toggle="modal" data-bs-target="#myModal" class="action-btn" ><button class="btn btn-primary">Set Location</button> </a></li>  -->
                       <?php } ?>
                    </div>
                 <div class="address-body">
                        <a href="#" class="add-address hover-btn" data-bs-toggle="modal"
                        data-bs-target="#address_model1">
                        Add New Address
                    </a>
                </div>
              
               <div class="checkout-billing">
                  <!--<style>-->
                  <!--    .place_order{-->
                  <!--        background: #c9bfbf;-->
                  <!--    }-->
                  <!--</style>-->
                  <div class="text-center">
                      <!--<a href="<?php site_url()?>checkout/<?php print $element['product_id'];?>" class="add-to-cart btn-success btn btn-sm" -->
                      <!--data-productid="<?php print $element['product_id'];?>" title="Add to Cart"><i class="fa fa-shopping-cart fa-fw"></i> Buy Now</a>-->
                    <button type="submit" class="btn common-btn" id="place_order">Place Order
                     <img src="<?php echo base_url();?>web/assets/images/shape1.png" alt="Shape">
                     <img src="<?php echo base_url();?>web/assets/images/shape2.png" alt="Shape">
                     </button>
                  </div>
               </div>
            </div>
             </div>
           
            <div class="col-lg-6">
                  <div class="checkout-method mb-3">
                  <h3>Payment Method:</h3>
                  <!--<div class="form-check">
                     <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                     <label class="form-check-label" for="exampleRadios1">
                     Direct Bank Transfer
                     </label>
                     <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in your account.</p>
                  </div>-->
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="checkout_type" id="exampleRadios2"  value="cart" required>
                     <label class="form-check-label" for="exampleRadios2" >
                     Cash On Delivery
                     </label>
                     
                  </div>
                  <!--<div class="form-check">-->
                  <!--   <input class="form-check-input" type="radio" name="checkout_type" id="exampleRadios3" value="online_payment">-->
                  <!--   <label class="form-check-label" for="exampleRadios3">-->
                  <!--   Pay online-->
                  <!--   </label>-->
                  <!--</div>-->
                  <div class="form-check two">
                     <input class="form-check-input" type="checkbox"  name="terms_conditions" id="flexCheckDefault2" required>
                     <label class="form-check-label" for="flexCheckDefault2">
                     I've read and accept <a href="<?php echo base_url() ?>">terms & conditions*</a>
                     </label>
                  </div>
               </div>
               <div class="checkout-order">
                  <h3>Your Order:</h3>
                  <ul class="CartItemHtml2">
                   
                  </ul>
                  
                  <div class="inner">
                     <h3>Shipping: <span class="Delivery">0</span></h3>
                     <h4>Total: <span class="CartTotal"></span></h4>
                  </div>

               </div>
             
            </div>
         </div>
      </form>
      
    <div class="modal fade" id="address_model1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="cate-header">
                    <h4>Add New Address</h4>
                </div>
                <div class="add-address-form">
                    <div class="checout-address-step">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="" action="<?php echo base_url(); ?>add_address_user" method="post">

                                    <div class="form-group">
                                        <div class="product-radio">
                                            <ul class="product-now">
                                                <li>
                                                    <input type="radio" id="ad1" name="address_type" value="Home" checked>
                                                    <label for="ad1">Home</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="ad2" name="address_type" value="Office">
                                                    <label for="ad2">Office</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="ad3" name="address_type" value="other">
                                                    <label for="ad3">Other</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="address-fieldset">
                                        <div class="row">
                                           
                                           
                                             <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Name*</strong></label>
                                                    <input id="street" name="name" type="text"
                                                        placeholder="Name" class="form-control input-md name" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Mobile Number*</strong></label>
                                                    <input name="mobile_no" type="text" placeholder="Mobile Number"
                                                        class="form-control input-md mobile_number" required="">
                                                        <span id="status" style="color:red;"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Email ID *</strong></label>
                                                    <input name="email" type="email" placeholder="Email ID"
                                                        class="form-control input-md" required="">
                                                        <span id="status" style="color:red;"></span>
                                                </div>
                                            </div>
                                            
                                              <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>State*</strong></label>
                                                    <input id="flat" name="state" type="text" placeholder="State"
                                                        class="form-control input-md state" required="">
                                                </div>
                                            </div>
                                             <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Society / Area /Street / Block.*</strong></label>
                                                    <input id="flat" name="area_street" type="text" placeholder="Society / Area / Street / Block."
                                                        class="form-control input-md" required="">
                                                </div>
                                            </div>
                                             <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>District/City*</strong></label>
                                                    <input id="flat" name="city" type="text" placeholder="District/City"
                                                        class="form-control input-md city" required="">
                                                </div>
                                            </div>
                                           
                                           
                                           <!--<div class="col-lg-6 col-md-6">-->
                                           <!--     <div class="form-group">-->
                                           <!--         <label class="control-label">Town / Village*</label>-->
                                           <!--         <input id="flat" name="town_village" type="text" placeholder="Town / Village"-->
                                           <!--             class="form-control input-md" required="">-->
                                           <!--     </div>-->
                                           <!-- </div>-->
                                          
                                          
                                            
                                             <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Pincode*</strong></label>
                                                    <input id="pincode" name="pin_code" type="number" placeholder="Pincode"
                                                        class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            
                                            <!-- <div class="col-lg-6 col-md-6">-->
                                            <!--    <div class="form-group">-->
                                            <!--        <label class="control-label"><strong>Post Office</strong></label>-->
                                            <!--        <input   type="text" placeholder="Post Office"-->
                                            <!--            class="form-control input-md" required="">-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <!--<div class="col-lg-6 col-md-6">-->
                                            <!--    <div class="form-group">-->
                                            <!--        <label class="control-label">Locality/Land mark*</label>-->
                                            <!--        <input id="Locality" name="landmark" type="text"-->
                                            <!--            placeholder="Locality/Land mark" class="form-control input-md"-->
                                            <!--            required="">-->
                                            <!--    </div>-->
                                            <!--</div>-->

                                            <div class="address-btns">
                                                <button type="submit" class="save-btn14 hover-btn"
                                                   >Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
function testInput(event) {
   var value = String.fromCharCode(event.which);
   var pattern = new RegExp(/[a-zåäö ]/i);
   return pattern.test(value);
}

    $('.name').bind('keypress', testInput);
    $('.city').bind('keypress', testInput);
    $('.shop_town').bind('keypress', testInput);
    $('.shop_district').bind('keypress', testInput);
    $('.state').bind('keypress', testInput);
    $('.landmark').bind('keypress', testInput);

</script>

<script type="text/javascript">    
$(document).ready(function(){     
        
$(".mobile_number").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;    
  if(!regex.test(inputvalues)){      
  $(".mobile_number").val("");    
   //alert("invalid Mobile no");    
document.getElementById("status").innerHTML = "Invalid Mobile No";
  return regex.test(inputvalues);    
  }
  else{
      document.getElementById("status").innerHTML = "";
  }
});      
    
});    
</script>

