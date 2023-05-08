
<!--<div class="page-title-area">-->
<!--    <div class="d-table">-->
<!--        <div class="d-table-cell">-->
<!--            <div class="container">-->
<!--                <div class="title-content">-->
<!--                    <h3>My Profile</h3>-->
<!--                    <ul>-->
<!--                        <li>-->
<!--                            <a href="index.php">Home</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span>My Profile</span>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="title-img">-->
<!--<img src="<?php echo base_url();?>web/assets/images/page-title2.jpg" alt="About">-->
<!-- <img src="<?php echo base_url();?>web/assets/images/shape16.png" alt="Shape">
<!--<img src="<?php echo base_url();?>web/assets/images/shape17.png" alt="Shape"> -->
<!-- <img src="<?php echo base_url();?>web/assets/images/shape18.png" alt="Shape"> -->
<!--</div>-->
<!--</div>-->
<section class="dashboard-overview">
    <div class="">
        <div class="container">
            <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="left-side-tabs">
                    <div class="dashboard-left-links">
                        <a href="<?php echo base_url('dashboard_overview');?>" class="user-item"><i
                                class="uil uil-apps"></i>Overview</a>
                                <a href="<?php echo base_url('user_profile');?>" class="user-item active"><i class="uil uil-box"></i>My Profile</a>
                                
                        <?php if($user->kyc_status==0) { ?>
                         <a href="<?php echo base_url('kyc_vendor');?>" class="user-item"><i class="uil uil-wallet"></i>My KYC</a> <?php } ?>
                         
                         <a href="<?php echo base_url('my_order');?>" class="user-item"><i class="uil uil-box"></i>My Orders</a>
                        
                          <?php if(!empty($user->kyc_status)) { ?>
                         <a href="<?php echo base_url('add_product');?>" class="user-item"><i class="uil uil-wallet"></i>Add Product</a>
                         
                         <a href="<?php echo base_url('view_product');?>" class="user-item"><i class="uil uil-wallet"></i>View Product List</a>
                          <?php } ?>
                           <?php if($user->kyc_type > 0 ) { ?>
                           <a href="<?php echo base_url('seller_order');?>" class="user-item"><i class="uil uil-wallet"></i>Seller Order</a>
                          <?php } ?>
                          
                        <a href="<?php echo base_url('wishlist');?>" class="user-item"><i class="uil uil-heart"></i>Shopping Wishlist</a>
                        <!--<a href="<?php echo base_url('add_address');?>" class="user-item"><i class="uil uil-location-point"></i>My-->
                        <!--    Address</a>-->
                        <a href="<?php echo base_url();?>logout" class="user-item"><i class="uil uil-exit"></i>Logout</a>
                    </div>
                </div>
            </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-right">
                        <div class="row">
                            <!-- <div class="col-md-12">
                                <div class="main-title-tab">
                                    <h4><i class="uil uil-box"></i>My Profile</h4>
                                    
                                </div>
                            </div> -->
            <?php if(!empty($this->session->flashdata('success'))){?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Success!</strong><?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } ?>
            
            <?php if(!empty($this->session->flashdata('error'))){?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Error!</strong><?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php } ?>
                            <div class="col-lg-12 col-md-12">
                                <div class="pdpt-bg">
                                    <div class="pdpt-title">
                                    </div>
                                    <div class="order-body10">
                                    <div class="main-title-tab pt-3">
                                    <h4><i class="uil uil-box"></i>My Profile</h4>
                                    
                                </div>
                                <hr>
                                        <ul class="order-dtsll">
                                            <?php if(!empty($user->image)) { ?>
                                            <li>
                                                <div class="order-dt-img">

                                                    <img src="<?php echo ($user->image);?>" alt="">

                                                </div>
                                            </li>
                                            <?php } ?>
                                            <li>
                                                <!--<div class="order-dt47">-->
                                                <!--    <h4><?php echo ucfirst($user->name) ?></h4>-->
                                                    <!--<p><i class="flaticon-email"></i> &nbsp;<?php echo $user->email?></p>-->
                                                <!--    <p><i class="flaticon-phone-call"></i> &nbsp;<?php echo $user->mobile_no?></p>-->
                                             
                                                <!--</div>-->
                                            </li>
                                        </ul>

                                                    <form action="">
                                                      
                                                     <fieldset>
                                                      <div class="grid-35">
                                                        <label for="name"> Name:- </label>
                                                      </div>
                                                      <div class="grid-65">
                                                        <label><p> &nbsp;<?php echo ucfirst($user->name) ?></p></label>
                                                      </div>
                                                    </fieldset>
                                                    <fieldset>
                                                      <div class="grid-35">
                                                        <label for="Mobile-number"> Mobile Number:-  </label>
                                                      </div>
                                                      <div class="grid-65">
                                                        <label><p> &nbsp;<?php echo $user->mobile_no?></p></label>
                                                      </div>
                                                    </fieldset>
                                                     <fieldset>
                                                      <div class="grid-35">
                                                        <label for="Email-id"> Email:-</label>
                                                      </div>
                                                      <div class="grid-65">
                                                        <label><p> &nbsp;<?php echo $user->email ?></p></label>
                                                      </div>
                                                    </fieldset>
                                                    
                                                    <!-- <fieldset>-->
                                                    <!--  <div class="grid-35">-->
                                                    <!--    <label for="Address"> Address(optional)</label>-->
                                                    <!--  </div>-->
                                                    <!--  <div class="grid-65">-->
                                                    <!--    <label></label>-->
                                                    <!--  </div>-->
                                                    <!--</fieldset>-->
                                                    
                                            <div class="call-bill">
                                            <div class="order-bill-slip">
                                                <a href="#" class="bill-btn5 hover-btn" target="_blank" style="color:white;" data-toggle="modal" data-target="#exampleModalCenter">Edit Profile</a>
                                            </div>
                                        </div>
                                                    </form>
                                                    <!--<div class="row">-->
                                                    <!--     <div class="col-lg-6 col-md-4">-->
                                                    <!--         <label>Name</label>-->
                                                    <!--     </div>-->
                                                    <!--       <div class="col-lg-6 col-md-12">-->
                                                    <!--         <label>Name</label>-->
                                                    <!--     </div>-->
                                                    <!--</div>-->
                                       
                                      
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


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h2 class="modal-title m-auto" id="exampleModalLongTitle">Update Your Profile</h2>
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
        <!--  <span aria-hidden="true">&times;</span>-->
        <!--</button>-->
      </div>
      <div class="modal-body">
       	<form action="<?php echo base_url('update_profile')?>"  method="POST" enctype="multipart/form-data">	
			
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="profile_details_text"> Name:</label>
							<input type="text" name="name" class="form-control" value="" required >
							<input type="hidden" name="user_id" class="form-control" value="<?php echo $user->id?>" >
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="profile_details_text">Email Address:</label>
							<input type="email" name="email" class="form-control" value="" required >
							
						</div>
					</div>
				  <!--   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">-->
					<!--	<div class="form-group">-->
					<!--		<label class="profile_details_text">Address:</label>-->
					<!--		<textarea class="form-control" row="5"></textarea>-->
					<!--	</div>-->
					<!--</div>-->
					
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="profile_details_text">Profile Image: <span style="color:red;">Max size 1Mb </span></label>
              <div id="feedback"></div>
              <br>
							<input type="file" class="form-control" name="image" id="file-uploader">
						</div>
					</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                			
                        <input type="submit" class="btn btn-secondary" id="myBtn">
                        
                        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                     
                       </div>
					<!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 submit">-->
					<!--	<div class="form-group">-->
					<!--		<input type="submit" class="btn btn-secondary" value="Submit">-->
					<!--	</div>-->
					<!--</div>-->
				</div>
			</form>
      </div>
     
    </div>
  </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript">
  const fileUploader = document.getElementById('file-uploader');
const feedback = document.getElementById('feedback');

fileUploader.addEventListener('change', (event) => {
  const file = event.target.files[0];
  console.log('file', file);
  
  const size = file.size;
  console.log('size', size);
  let msg = '';
  
  if (size > 1024 * 1024) {
    msg = `<span style="color:red;">The allowed file size is 1MB. </span>`;
    document.getElementById("myBtn").disabled = true;
  } else {
    msg = `<span style="color:green;"> File has been uploaded successfully. </span>`;
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





