<div class="progress" id="PreLoaderBar">
        <div class="indeterminate"></div>
    </div>
    <style>
        .progress {
      position: relative;
      height: 2px;
      display: block;
      width: 100%;
      background-color: white;
      border-radius: 2px;
      background-clip: padding-box;
      /*margin: 0.5rem 0 1rem 0;*/
      overflow: hidden;

    }
    .progress .indeterminate {
background-color:black; }
    .progress .indeterminate:before {
      content: '';
      position: absolute;
      background-color: #2C67B1;
      top: 0;
      left: 0;
      bottom: 0;
      will-change: left, right;
      -webkit-animation: indeterminate 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
              animation: indeterminate 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite; }
    .progress .indeterminate:after {
      content: '';
      position: absolute;
      background-color: #2C67B1;
      top: 0;
      left: 0;
      bottom: 0;
      will-change: left, right;
      -webkit-animation: indeterminate-short 2.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
              animation: indeterminate-short 2.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
      -webkit-animation-delay: 1.15s;
              animation-delay: 1.15s; }

    @-webkit-keyframes indeterminate {
      0% {
        left: -35%;
        right: 100%; }
      60% {
        left: 100%;
        right: -90%; }
      100% {
        left: 100%;
        right: -90%; } }
    @keyframes indeterminate {
      0% {
        left: -35%;
        right: 100%; }
      60% {
        left: 100%;
        right: -90%; }
      100% {
        left: 100%;
        right: -90%; } }
    @-webkit-keyframes indeterminate-short {
      0% {
        left: -200%;
        right: 100%; }
      60% {
        left: 107%;
        right: -8%; }
      100% {
        left: 107%;
        right: -8%; } }
    @keyframes indeterminate-short {
      0% {
        left: -200%;
        right: 100%; }
      60% {
        left: 107%;
        right: -8%; }
      100% {
        left: 107%;
        right: -8%; } }
    </style>





<div class="page-title-area" id="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-content">
                    <h2>Update Product</h2>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>
                            <span>Update Product</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="title-img">
        <img src="<?php echo base_url();?>web/assets/images/page-title1.jpg" alt="About">
        <img src="<?php echo base_url();?>web/assets/images/shape16.png" alt="Shape">
        <img src="<?php echo base_url();?>web/assets/images/shape17.png" alt="Shape">
        <img src="<?php echo base_url();?>web/assets/images/shape18.png" alt="Shape">
    </div>
</div>

<div class="preloader-wrap">
  <div class="percentage" id="precent"></div>
  <div class="loader">
    <div class="trackbar">
      <div class="loadbar"></div>
    </div>
    <div class="glow"></div>
  </div>
</div>

 <style>
 

.preloader-wrap {
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0; 
  bottom: 0;
  background: rgba(0,0,0,1);
  z-index : 2; 
}

.percentage {
  z-index: 100;
  border: 1px solid #ccc;
  text-align:center;
  color: #fff;
  line-height: 30px;
  font-size : 15px;
}

.loader,
.percentage{
  height: 30px;
  max-width: 500px; 
  border: 2px solid #69AF23;
  border-radius: 20px;
  font-weight: 300;
  position: absolute; 
  top: 0; 
  bottom: 0; 
  left: 0; 
  right: 0;
  margin : auto; 
}
.loader:after,
.percentage:after {
  content: "";
  display: block;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
}

.trackbar {
  width: 100%;
  height: 100%;
  border-radius: 20px;
  color: #fff;
  text-align: center;
  line-height: 30px;
  overflow: hidden;
  position: relative;
  opacity: 0.99;
}

.loadbar {
  width: 0%;
  height: 100%;
  background: repeating-linear-gradient(
  45deg, 
    #008737, 
    #008737 10px, 
    #69AF23 10px,
    #69AF23 20px
  ); /* Stripes Background Gradient */
  box-shadow: 0px 0px 14px 1px #008737; 
  position: absolute;
  top: 0;
  left: 0;
  animation: flicker 5s infinite;
  overflow: hidden;
}

.glow {
  width: 0%;
  height: 0%;
  border-radius: 20px;
  box-shadow: 0px 0px 60px 10px #008737;
  position: absolute;
  bottom: -5px;
  animation: animation 5s infinite;
}

@keyframes animation {
  10% {
    opacity: 0.9;
  }
  30% {
    opacity: 0.86;
  }
  60% {
    opacity: 0.8;
  }
  80% {
    opacity: 0.75;
  }
}

.wrap { 
  background-image : url(http://wallpaperfx.com/view_image/little-girls-1600x900-wallpaper-5569.jpg);
  background-position: left top; 
  background-repeat: no-repeat; 
  -webkit-background-size: cover; 
  -moz-background-size: cover; 
  -o-background-size: cover; 
  background-size: cover; 
  width: 100%; 
  height: 100%; 
  position: relative;  
  z-index : 1; 
}

.copyrights { 
  position: fixed;
  right: 20px;
  bottom: 20px;
  font-size: 14px;
  color: #fff;
  display: block;
}

.copyrights a { color: orange; text-decoration: none; }
.copyrights a:hover { color : #fff; text-decoration: underline; }
 </style>
<div class="user-area " id="page-title-area1">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="left-side-tabs">
                    <div class="dashboard-left-links">
                        <a href="<?php echo base_url('dashboard_overview');?>" class="user-item"><i class="uil uil-apps"></i>Overview</a>
                         <a href="<?php echo base_url('user_profile');?>" class="user-item"><i class="uil uil-box"></i>My Profile</a>
                         
                         <?php if($user->kyc_status==0) { ?>
                         <a href="<?php echo base_url('kyc_vendor');?>" class="user-item"><i class="uil uil-wallet"></i>My KYC</a>
                         <?php } ?>
                        
                        <a href="<?php echo base_url('my_order');?>" class="user-item"><i class="uil uil-box"></i>My Orders</a>
                        
                        
                       <?php if(!empty($user->kyc_status)) { ?>
                         <a href="<?php echo base_url('add_product');?>" class="user-item "><i class="uil uil-wallet"></i>Add Product</a>
                         
                         
                        
                         <a href="<?php echo base_url('view_product');?>" class="user-item"><i class="uil uil-wallet"></i>View Product List</a>
                         
                         <a href="<?php echo base_url('edit_seller_product');?>" class="user-item active"><i class="uil uil-wallet"></i>Edit Product</a>
                         
                          <?php } ?>
                          
                        
                        <?php if($user->kyc_type > 0 ) { ?>
                           <a href="<?php echo base_url('seller_order');?>" class="user-item"><i class="uil uil-wallet"></i>Seller Order</a>
                          
                          <?php } ?>
                        <a href="<?php echo base_url('wishlist');?>" class="user-item"><i class="uil uil-heart"></i>Shopping
                            Wishlist</a>
                       <!-- <a href="<?php echo base_url('add_address');?>" class="user-item "><i
                                class="uil uil-location-point"></i>My
                            Address</a>-->
                        <a href="<?php echo base_url();?>logout" class="user-item"><i class="uil uil-exit"></i>Logout</a>
                    </div>
                </div>
            </div>
            <style>
               .nice-select {
                        width: 100% !important;
                }
                .user-area .user-item ul li{
                    margin-bottom: 0px;
                }
            </style>
            <div class="col-lg-9 col-md-9">
            <div class=" pt-5 pb-5">
                
                    <div class=" ">
                        <div class="user-item">
                            <form method="post" action="<?php echo base_url('edit_seller_product/').$data->id; ?>" enctype="multipart/form-data">
                            
                            
                                <h2>Update Your Product Details</h2>
                                 <?php if(!empty($this->session->flashdata('error'))) { ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Error!</strong><?php echo $this->session->flashdata('error'); ?>
                                        </div>
                                        <?php } ?>
                                        <?php if(!empty($this->session->flashdata('success'))){?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>Success!</strong><?php echo $this->session->flashdata('success'); ?>
                                        </div>
                                        <?php } ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Product Name*</label>
                                            <input type="text" class="form-control" placeholder="Product Name:" name="product_name" value="<?php echo $data->product_name?>">
                                        </div>
                                    </div>
                                    <!--<div class="col-md-6">
                                        <label for="" class="form-label">Product Image</label>
                                        <input type="file" class="custom-file-input" id="" aria-describedby="">
                                    </div>-->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Product Price*</label>
                                            <input type="number" class="form-control" placeholder="Product Price:" name="price" value="<?php echo $data->price?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Discount</label>
                                            <input type="text" class="form-control" placeholder="Discount:" name="discount" value="<?php echo $data->discount?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Other Offer</label>
                                            <input type="text" class="form-control" placeholder="Other Offer:" name="other_offer" value="<?php echo $data->other_offer?>">
                                        </div>
                                    </div>
                                    
                                <?php if($user->kyc_type==1) { ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Specialisation</label>
                                            <input type="text" class="form-control" placeholder="specialisation:" name="specialisation" value="<?php echo $data->speciality?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Add color your product</label>
                                            <input type="text" class="form-control" placeholder="color product:" name="color" value="<?php echo $data->color?>">
                                        </div>
                                    </div>
<?php } ?>
                                    <div class="col-md-<?php if($user->kyc_type !=1) { ?>12
                                    <?php } else { echo '4'; } ?>">
                                        <div class="form-group">
                                             <select style="" name="category" required="">
                                        <option value=''>Select Category</option>
                                        <?php foreach($category as $row){?>
                                        <option value="<?= $row->id ?>" <?php echo ($data->category == $row->name)?'selected="selected"':''; ?>><?= ucfirst($row->name) ?></option>
                                        <?php } ?>
                                         
                                    </select>
                                    </div>
                                        
                                    </div>
                                    <?php if($user->kyc_type==1) { ?> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            
                                            <!--<label for="exampleFormControlSelect1">Categories</label>-->
                                            <!--<input type="text" class="form-control" placeholder="Categories:">-->
                                             <select style="" name="brand" required="">
                                        <option value=''>Select Brand</option>
                                        <?php if(!empty($brand)) { ?>
                                        <?php foreach($brand as $row){?>
                                       
                                        <option value="<?= $row->id ?>" <?php echo ($data->brand_name == $row->brand_name)?'selected="selected"':''; ?> ><?= ucfirst($row->brand_name) ?></option>
                                        <?php } }?>
                                         
                                    </select>
                                    </div>
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            
                                            <!--<label for="exampleFormControlSelect1">Categories</label>-->
                                            <!--<input type="text" class="form-control" placeholder="Categories:">-->
                                             <select style="" name="country" required="">
                                        <option value=''>Select Country</option>
                                        <?php if(!empty($countries)) { ?>
                                        <?php foreach($countries as $row){?>
                                        <option value="<?= $row->id ?>" <?php echo ($data->country_name == $row->country_name)?'selected="selected"':''; ?>><?= ucfirst($row->country_name) ?></option>
                                        <?php } } ?>
                                         
                                    </select>
                                    </div>
                                        
                                    </div>
                                    <?php } ?>
                                 <?php if($user->kyc_type==1) { ?> 
                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Height*</label>
                                            <input type="number" class="form-control" placeholder="height:" name="height" value="<?php echo $data->height?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Width*</label>
                                            <input type="number" class="form-control" placeholder="width:" name="width" value="<?php echo $data->width?>">
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Length*</label>
                                            <input type="number" class="form-control" placeholder="length:" name="length" value="<?php echo $data->length?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Weigth*</label>
                                            <input type="number" class="form-control" placeholder="weight:" name="weight" value="<?php echo $data->weight?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Size*</label>
                                            <input type="number" class="form-control" placeholder="Size:" name="size" value="<?php echo $data->size?>">
                                        </div>
                                    </div>
                                    
                                    <?php } ?>

                                    
                               <div class="col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Description" id=""
                                                style="height: 100px" name="description" required=""><?php echo $data->description?></textarea>
                                            <label for="floatingTextarea2">Description</label>
                                        </div>
                                    </div>


                                    <div class="col-md-6">

                                        <label for="exampleInputEmail1" class="form-label">Image1</label>
                                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                                            aria-describedby="inputGroupFileAddon01" name="image" accept="image/*">
                                    </div>
                                    <div class="col-md-6">

                                        <label for="exampleInputEmail1" class="form-label">Image2</label>
                                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                                            aria-describedby="inputGroupFileAddon01" name="image1" accept="image/*">
                                    </div>
                                    <div class="col-md-6">

                                        <label for="exampleInputEmail1" class="form-label">Image3</label>
                                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                                            aria-describedby="inputGroupFileAddon01" name="image2"accept="image/*">
                                    </div>
                                    
                                    <div class="col-md-6">

                                        <label for="" class="form-label">Video</label>
                                        <input type="file" class="custom-file-input"  name="video" accept="video/mp4,video/x-m4v,video/*">
                                    </div>


                                    <button type="submit" class="btn common-btn mt-3">
                                        Submit
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
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var width = 100,
    perfData = window.performance.timing, // The PerformanceTiming interface represents timing-related performance information for the given page.
    EstimatedTime = -(perfData.loadEventEnd - perfData.navigationStart),
    time = parseInt((EstimatedTime/1000)%60)*100;

// Loadbar Animation
$(".loadbar").animate({
  width: width + "%"
}, time);

// Loadbar Glow Animation
$(".glow").animate({
  width: width + "%"
}, time);

// Percentage Increment Animation
var PercentageID = $("#precent"),
    start = 0,
    end = 100,
    durataion = time;
    animateValue(PercentageID, start, end, durataion);
    
function animateValue(id, start, end, duration) {
  
  var range = end - start,
      current = start,
      increment = end > start? 1 : -1,
      stepTime = Math.abs(Math.floor(duration / range)),
      obj = $(id);
    
  var timer = setInterval(function() {
    current += increment;
    $(obj).text(current + "%");
      //obj.innerHTML = current;
    if (current == end) {
      clearInterval(timer);
    }
  }, stepTime);
}

// Fading Out Loadbar on Finised
setTimeout(function(){
  $('.preloader-wrap').fadeOut(300);
}, time);
</script>
<script>
    document.onreadystatechange = function () {
            if (document.readyState === "complete") {
                console.log(document.readyState);
                document.getElementById("PreLoaderBar").style.display = "none";
                document.getElementById("page-title-area").style.display = "block";
                document.getElementById("page-title-area1").style.display = "block";
            }else{
                document.getElementById("page-title-area").style.display = "none";
                document.getElementById("page-title-area1").style.display = "none";
            }
        }
</script>
