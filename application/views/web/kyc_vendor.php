<!--<div class="page-title-area">-->
<!--   <div class="d-table">-->
<!--      <div class="d-table-cell">-->
<!--         <div class="container">-->
<!--            <div class="title-content">-->
<!--               <h3>KYC</h3>-->
<!--               <ul>-->
<!--                  <li>-->
<!--                     <a href="<?php echo base_url();?>">Home</a>-->
<!--                  </li>-->
<!--                  <li>-->
<!--                     <span>kyc</span>-->
<!--                  </li>-->
<!--               </ul>-->
<!--            </div>-->
<!--         </div>-->
<!--      </div>-->
<!--   </div>-->
<!--   <div class="title-img">-->
<!--      <img src="<?php echo base_url();?>web/assets/images/page-title1.jpg" alt="About">-->
     
<!--   </div>-->
<!--</div>-->
<div class="user-area ptb-100">
   <div class="container">
      <div class="row">
         <div class="col-md-3">
            <div class="left-side-tabs">
               <div class="dashboard-left-links">
                  <a href="<?php echo base_url('dashboard_overview');?>" class="user-item"><i class="uil uil-apps"></i>Overview</a>
                  <a href="<?php echo base_url('user_profile');?>" class="user-item"><i class="uil uil-box"></i>My Profile</a>
                  <a href="<?php echo base_url('my_order');?>" class="user-item"><i class="uil uil-box"></i>My Orders</a>
                  <?php if(empty($user->kyc_status)) { ?>
                  <a href="<?php echo base_url('kyc_vendor');?>" class="user-item active"><i class="uil uil-wallet"></i>My KYC</a>
                  <?php } ?>
                   <?php if(!empty($user->kyc_status)) { ?>
                         <a href="<?php echo base_url('add_product');?>" class="user-item"><i class="uil uil-wallet"></i>Add Product</a>
                         
                         
                        
                         <a href="<?php echo base_url('view_product');?>" class="user-item"><i class="uil uil-wallet"></i>View Product List</a>
                          <?php } ?>
                           <?php if($user->kyc_type > 0 ) { ?>
                           <a href="<?php echo base_url('seller_order');?>" class="user-item"><i class="uil uil-wallet"></i>Seller Order</a>
                          
                          <?php } ?>
                  
                  
                  
                  <a href="<?php echo base_url('wishlist');?>" class="user-item"><i class="uil uil-heart"></i>Shopping
                  Wishlist</a>
                  <!--<a href="<?php echo base_url('add_address');?>" class="user-item "><i
                     class="uil uil-location-point"></i>My
                  Address</a>-->
                  <a href="<?php echo base_url('logout');?>" class="user-item"><i class="uil uil-exit"></i>Logout</a>
               </div>
            </div>
         </div>
         <div class="col-lg-9 col-md-9">
            <div class="user-item-form">
               <form method="post" action="<?php echo base_url(); ?>add_kyc_details" ecntype="multipart/form-data">
                  <h2>Vendor KYC Form</h2>
                  <?php if(!empty($this->session->flashdata('error'))){?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     <strong>Error!</strong><?php echo $this->session->flashdata('error'); ?>
                  </div>
                  <?php } ?>
                 <?php if(!empty($this->session->flashdata('success'))) { ?>
                 
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success!</strong><?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>
                                        
                                        
                  <div class="row">
                      <div class="col-md-6">
                      <div class="form-group">
                           <label for="exampleInputEmail1" class="form-label">Select KYC Type*</label>
                                        <div class="product-radio">
                                            <ul class="product-now">
                                                <li>
                                                    <input type="radio" id="ad11" name="kyc_type" value="1" checked onclick="return toggleStatus(1)"  >
                                                    <label for="ad11">E-commerce</label>
                                                </li>
                                        
                                                <li>
                                                    <input type="radio" id="kyc2" name="kyc_type" value="2"   onclick="return toggleStatus(2)">
                                                    <label for="kyc2">Grocery</label>
                                                </li>
                                                <li>
                                                  <input type="radio" id="kyc3" name="kyc_type" value="3"    onclick="return toggleStatus(3)">
                                                  <label for="kyc3">Fresh</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                       <div class="col-md-6">
                          <div class="form-group">
                           <label for="exampleInputEmail1" class="form-label">Select Delivery Type*</label>
                                        <div class="product-radio">
                                            <ul class="product-now">
                                                <li>
                                                    <input type="radio" id="kyc_type" name="d_type" value="1"  checked>
                                                    <label for="kyc_type">Self Delivery</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="ad2" name="d_type" value="2" checked>
                                                    <label for="ad2">Admin</label>
                                                </li>
                                                <!--<li>
                                                  <input type="radio" id="ad3" name="kyc_type" value="fresh">
                                                  <label for="ad3">Fresh</label>
                                                </li>-->
                                            </ul>
                                        </div>
                                    </div>
                            </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="exampleInputEmail1" class="form-label">Enter Your Name*</label>
                           <input type="text" class="form-control name" placeholder="Name:" name="name" required="">
                        </div>
                     </div>
                      <div class="col-md-6">
                        <div class="form-group">
                           <label for="exampleInputEmail1" class="form-label">Enter Mobile Number*</label>
                           <input type="text" class="form-control name" placeholder="Mobile Number:"  required="">
                        </div>
                     </div>
                     
                      <div class="col-md-6">
                        <div class="form-group">
                           <label for="exampleInputEmail1" class="form-label">Enter Email-Id*</label>
                           <input type="email" class="form-control name" placeholder="Email-Id:"  required="">
                        </div>
                     </div>
                       <div class="col-md-6">
                        <label for="exampleInputEmail1" class="form-label">State*</label>
                        <div class="form-group">
                           <input type="text" class="form-control " placeholder="Shop State:"  required="" id="">
                        </div>
                     </div>
                     
                     <div class="col-md-6">
                        <label for="exampleInputEmail1" class="form-label">City*</label>
                        <div class="form-group">
                           <input type="text" class="form-control " placeholder="Shop Town:"  required="" id="">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <label for="" class="form-label"> District*</label>
                        <div class="form-group">
                           <input type="text" class="form-control " placeholder="Shop District:"  required="" id="">
                        </div>
                     </div>
                   
                     <!--<div class="col-md-6">-->
                     <!--   <label for="exampleInputEmail1" class="form-label">Profile Image <span style="color:red;"> (Max size 1Mb) </span></label>-->
                     <!--   <input type="file" class="custom-file-input" id="profile_image" aria-describedby="inputGroupFileAddon01" name="profile_image" required="">-->
                     <!--   <br><div id="profile_img_feedback"></div>-->
                     <!--</div>-->
                     </div>
                        <div class="row kyc_none">
                     <!--<div class="col-md-6" id="elementsToOperateOn">-->
                     <!--   <label for="exampleInputEmail1" class="form-label">Pan Number*</label>-->
                     <!--   <div class="form-group">-->
    
                     <!--      <input type="text"  id="pan_number" name="pan_number" class="form-control pan" placeholder="Pan Number:" maxlength="10" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" title="Please enter valid PAN number. E.g. AAAAA9999A" required="" />-->
                     <!--      <span id="status" style="color:red;"></span>-->
                     <!--   </div>-->
                     <!--</div>-->
                     
                     
                     <!--<div class="col-md-6">-->
                     <!--   <label for="exampleInputEmail1" class="form-label">Pan card Image <span style="color:red;"> (Max size 1Mb) </span> </label>-->
                     <!--   <input type="file" class="custom-file-input"-->
                     <!--      aria-describedby="inputGroupFileAddon01" name="pan_image" required="" id="pan_image">-->
                     <!--      <br><div id="feedback"></div>-->
                     <!--</div>-->
                     <!--<div class="col-md-6">-->
                     <!--   <label for="exampleInputEmail1" class="form-label">Aadhaar Number*</label>-->
                     <!--   <div class="form-group">-->
                     <!--    <input type="text" id="aadhar_number" class="form-control aadhaar" placeholder="78XX 45XX 97XX" name="adhar_no" required="" >-->
                     <!--    <span id="aadhar_status" style="color:red;"></span>-->
                     <!--   </div>-->
                     <!--</div>-->
                     <!--<div class="col-md-6">-->
                     <!--   <label for="" class="form-label">Aadhaar card Image <span style="color:red;"> (Max size 1Mb) </span></label>-->
                     <!--   <input type="file" class="custom-file-input" id="adhar_image" aria-describedby="inputGroupFileAddon01" name="adhar_image" required="">-->
                     <!--   <br><div id="adhar_image_feedback"></div>-->
                     <!--</div>-->
                     <!--<div class="col-md-6">-->
                     <!--   <label for="exampleInputEmail1" class="form-label">GST Number*</label>-->
                     <!--   <div class="form-group">-->
                     <!--       <input type="text" id="gst_no" class="form-control gst" placeholder="06BZAHM6385P6Z2" name="gst_no" required=""/>-->
                     <!--       <span id="gst_status" style="color:red;"></span>-->

                     <!--   </div>-->
                     <!--</div>-->
                     <!--<div class="col-md-6">-->
                     <!--   <label for="" class="form-label">GST Image <span style="color:red;"> (Max size 1Mb) </span> </label>-->
                     <!--   <div class="input-group">-->
                     <!--      <div class="custom-file">-->
                     <!--         <input type="file" id="gst_image" class="custom-file-input" id="gst_image" aria-describedby="inputGroupFileAddon01" name="gst_image" required="">-->
                     <!--          <br><div id="gst_image_feedback"></div>-->
                     <!--      </div>-->
                     <!--   </div>-->
                     <!--</div>-->
                </div>
                     
                     
                      <div class="row">
                     <!--     <div class="col-md-6">-->
                     <!--   <div class="form-group">-->
                     <!--      <label for="exampleInputEmail1" class="form-label">Enter Your Shop Name*</label>-->
                     <!--      <input type="text" class="form-control shop_name" placeholder="Shop Name:" name="shop_name" required="" id="">-->
                     <!--   </div>-->
                     <!--</div>-->
                     <!--<div class="col-md-6">-->
                     <!--   <label for="" class="form-label">Shop Area*</label>-->
                     <!--   <div class="form-group">-->
                     <!--      <input type="text" class="form-control shop_area" placeholder="Shop Area:" name="shop_area" required="" id="">-->
                     <!--   </div>-->
                     <!--</div>-->
                     <!--<div class="col-md-6">-->
                     <!--   <label for="exampleInputEmail1" class="form-label">Shop Landmark*</label>-->
                     <!--   <div class="form-group">-->
                     <!--      <input type="text" class="form-control landmark" placeholder="Shop Landmark:" name="landmark" required="" id="">-->
                     <!--   </div>-->
                     <!--</div>-->
                     
                     <!--<div class="col-md-6">-->
                     <!--   <label for="exampleInputEmail1" class="form-label">Shop Town/City*</label>-->
                     <!--   <div class="form-group">-->
                     <!--      <input type="text" class="form-control shop_town" placeholder="Shop Town:" name="shop_town" required="" id="">-->
                     <!--   </div>-->
                     <!--</div>-->
                     <!--<div class="col-md-6">-->
                     <!--   <label for="" class="form-label">Shop District*</label>-->
                     <!--   <div class="form-group">-->
                     <!--      <input type="text" class="form-control shop_district" placeholder="Shop District:" name="shop_dis" required="" id="">-->
                     <!--   </div>-->
                     <!--</div>-->
                     <!--<div class="col-md-6">-->
                     <!--   <label for="exampleInputEmail1" class="form-label">Shop State*</label>-->
                     <!--   <div class="form-group">-->
                     <!--      <input type="text" class="form-control state" placeholder="Shop State:" name="shop_state" required="" id="">-->
                     <!--   </div>-->
                     <!--</div>-->
                     <div class="col-md-6">
                        <label for="" class="form-label">Shop Pincode*</label>
                        <div class="form-group">
                           <input type="number" class="form-control" placeholder="Shop Pincode:" name="pincode" required="" >
                        </div>
                     </div>
                     <div class="col-md-6">
                        <label for="" class="form-label">Country *</label>
                        <div class="form-group">
                           <input type="text" class="form-control" placeholder="India" name="pincode" required="" >
                        </div>
                     </div>
                     
                     <!--<div class="col-md-6">-->
                     <!--   <label for="" class="form-label">Landmark Image</label>-->
                     <!--   <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="landmark_image">-->
                     <!--</div>-->
                     <div class="col-md-12 my-2">
                      <label for="" class="form-label">Description </label>
                        <div class="form-floating">

                           <textarea class="form-control" placeholder="Description" id="" style="height: 100px" name="description" required=""></textarea>
                           <label for="floatingTextarea2">Description</label>
                        </div>
                     </div>
                     <br>
                     <button type="submit" class="btn common-btn mt-3" id="myBtn">Submit
                     <img src="<?php echo base_url();?>web/assets/images/shape1.png" alt="Shape">
                     <img src="<?php echo base_url();?>web/assets/images/shape2.png" alt="Shape">
                     </button>
                  </div>
               </form>
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
    $('.shop_area').bind('keypress', testInput);
    $('.shop_town').bind('keypress', testInput);
    $('.shop_district').bind('keypress', testInput);
    $('.state').bind('keypress', testInput);
    $('.landmark').bind('keypress', testInput);

</script>

<script type="text/javascript">    
$(document).ready(function(){     
        
$(".pan").change(function () {      
var inputvalues = $(this).val();      
  var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;    
  if(!regex.test(inputvalues)){      
  $(".pan").val("");    
//   alert("invalid PAN no");    
document.getElementById("status").innerHTML = "Invalid PAN No";
  return regex.test(inputvalues);    
  }
  else{
      document.getElementById("status").innerHTML = "";
  }
});      
    
});    
</script>


<script type="text/javascript">    
$(document).ready(function(){     
        
$(".aadhaar").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^[2-9]{1}[0-9]{3}\s{1}[0-9]{4}\s{1}[0-9]{4}$/;    
  if(!regex.test(inputvalues)){      
  $(".aadhaar").val("");    
 //alert("invalid Aadhar No");    
  document.getElementById("aadhar_status").innerHTML = "Invalid Aadhar No";
  return regex.test(inputvalues);    
  }
  else{
      document.getElementById("aadhar_status").innerHTML = "";
  }
});      
    
});    
</script>

<script type="text/javascript">    
$(document).ready(function(){     
        
$(".gst").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;    
  if(!regex.test(inputvalues)){      
  $(".gst").val("");    
 alert("invalid GST No");    
  document.getElementById("gst_status").innerHTML = "Invalid GST No";
  return regex.test(inputvalues);    
  }
  else{
      document.getElementById("gst_status").innerHTML = "";
  }
});      
    
});    
</script>

<script type="text/javascript">
const fileUploader = document.getElementById('pan_image');
const feedback = document.getElementById('feedback');

fileUploader.addEventListener('change', (event) => {
  const file = event.target.files[0];
  console.log('file', file);
  
  const size = file.size;
  console.log('size', size);
  let msg = '';
  
  if (size > 1024 * 1024) {
    msg = `<span style="color:red; font-size:12px;">The allowed file size is 1MB.</span>`;

    document.getElementById("myBtn").disabled = true;

  } else {
    msg = `<span style="color:green; font-size:12px;"> File has been uploaded successfully. </span>`;
    document.getElementById("myBtn").disabled = false;

  }
  feedback.innerHTML = msg;
});

function returnFileSize(number) {
  if(number < 1024) {
    return number + 'bytes';
  } else if(number >= 1024 && number < 1048576) {
    return (number/1024).toFixed(2) + 'KB';
  } else if(number >= 1048576) {
    return (number/1048576).toFixed(2) + 'MB';
  }
}
</script>

<script type="text/javascript">
const fileUploader2 = document.getElementById('profile_image');
const feedback2 = document.getElementById('profile_img_feedback');

fileUploader2.addEventListener('change', (event) => {
  const file = event.target.files[0];
  console.log('file', file);
  
  const size = file.size;
  console.log('size', size);
  let msg = '';
  
  if (size > 1024 * 1024) {
    msg = `<span style="color:red;font-size:12px;">The allowed file size is 1MB.</span>`;

    document.getElementById("myBtn").disabled = true;

  } else {
    msg = `<span style="color:green; font-size:12px;"> File has been uploaded successfully. </span>`;
    document.getElementById("myBtn").disabled = false;

  }
  feedback2.innerHTML = msg;
});

function returnFileSize(number) {
  if(number < 1024) {
    return number + 'bytes';
  } else if(number >= 1024 && number < 1048576) {
    return (number/1024).toFixed(2) + 'KB';
  } else if(number >= 1048576) {
    return (number/1048576).toFixed(2) + 'MB';
  }
}
</script>

<script type="text/javascript">
const fileUploader3 = document.getElementById('adhar_image');
const feedback3 = document.getElementById('adhar_image_feedback');

fileUploader3.addEventListener('change', (event) => {
  const file = event.target.files[0];
  console.log('file', file);
  
  const size = file.size;
  console.log('size', size);
  let msg = '';
  
  if (size > 1024 * 1024) {
    msg = `<span style="color:red;font-size:12px;">The allowed file size is 1MB.</span>`;

    document.getElementById("myBtn").disabled = true;

  } else {
    msg = `<span style="color:green; font-size:12px;"> File has been uploaded successfully. </span>`;
    document.getElementById("myBtn").disabled = false;

  }
  feedback3.innerHTML = msg;
});

function returnFileSize(number) {
  if(number < 1024) {
    return number + 'bytes';
  } else if(number >= 1024 && number < 1048576) {
    return (number/1024).toFixed(2) + 'KB';
  } else if(number >= 1048576) {
    return (number/1048576).toFixed(2) + 'MB';
  }
}
</script>

<script type="text/javascript">
const fileUploader4 = document.getElementById('gst_image');
const feedback4 = document.getElementById('gst_image_feedback');

fileUploader4.addEventListener('change', (event) => {
  const file = event.target.files[0];
  console.log('file', file);
  
  const size = file.size;
  console.log('size', size);
  let msg = '';
  
  if (size > 1024 * 1024) {
    msg = `<span style="color:red;font-size:12px;">The allowed file size is 1MB.</span>`;

    document.getElementById("myBtn").disabled = true;

  } else {
    msg = `<span style="color:green; font-size:12px;"> File has been uploaded successfully. </span>`;
    document.getElementById("myBtn").disabled = false;

  }
  feedback4.innerHTML = msg;
});

function returnFileSize(number) {
  if(number < 1024) {
    return number + 'bytes';
  } else if(number >= 1024 && number < 1048576) {
    return (number/1024).toFixed(2) + 'KB';
  } else if(number >= 1048576) {
    return (number/1048576).toFixed(2) + 'MB';
  }
}
</script>




