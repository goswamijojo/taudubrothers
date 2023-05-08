
<div class="page-title-area">
<div class="d-table">
<div class="d-table-cell">
<div class="container">
<div class="title-content">
<h2>Register</h2>
<ul>
<li>
<a href="<?php echo base_url();?>web/index">Home</a>
</li>
<li>
<span>Register</span>
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


<div class="user-area ptb-100">
<div class="container">
<div class="user-item">
<form method="post" action="<?php echo base_url('user_signup') ?>" enctype="multipart/form-data">
<h2>Register</h2>
<?php if(!empty($this->session->flashdata('error'))){?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Error!</strong><?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php } ?>
<!--<div class="form-group">
<input type="text" class="form-control" name="name" placeholder="User Name:">
</div>
<div class="form-group">
<input type="file" class="form-control" name="image" placeholder="Image:">
</div>-->
<div class="form-group">
<input type="text" class="form-control" name="mobile_no" required="" placeholder="Moble No:">
</div>
<!--<div class="form-group">
<input type="email" class="form-control" name="email" required="" placeholder="Email:">
</div>-->
<div class="form-group">
<div class="form-check">
<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault4">
<label class="form-check-label" for="flexCheckDefault4">
I accept all <a href="<?php echo base_url();?>term_condition">Terms & Conditions</a>
</label>
</div>
</div>
<input type="submit" name="register" class="btn common-btn" >
<!-- <button type="submit" class="btn common-btn"> -->

<!-- <img src="<?php echo base_url();?>web/assets/images/shape1.png" alt="Shape">
<img src="<?php echo base_url();?>web/assets/images/shape2.png" alt="Shape"> -->
<!-- </button> 
<h4>Or</h4>
<ul>
<li>
<a href="<?php echo base_url();?>web/#">
<i class='bx bxl-facebook'></i>
Register With Facebook
</a>
</li>
<li>
<a href="<?php echo base_url();?>web/#">
<i class='bx bxl-google'></i>
Register With Google
</a>
</li>
</ul>
-->
<h5>Already Have An Account? <a href="<?php echo base_url('login');?>">Login</a></h5>
</form>
</div>
</div>
</div>


