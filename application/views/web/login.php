<!--<div class="page-title-area">-->
<!--   <div class="d-table">-->
<!--      <div class="d-table-cell">-->
<!--         <div class="container">-->
<!--            <div class="title-content">-->
<!--               <h3>Login/Signup</h3>-->
<!--               <ul>-->
<!--                  <li>-->
<!--                     <a href="<?php echo base_url();?>">Home</a>-->
<!--                  </li>-->
<!--                  <li>-->
<!--                     <span class="pb-3">Login/Signup</span>-->
<!--                  </li>-->
<!--               </ul>-->
<!--            </div>-->
<!--         </div>-->
<!--      </div>-->
<!--   </div>-->
<!--   <div class="title-img">-->
<!--      <img src="<?php echo base_url('web/assets');?>/images/page-title1.jpg" alt="About">-->
      <!--<img src="<?php echo base_url('web/assets');?>/images/shape16.png" alt="Shape">-->
      <!--<img src="<?php echo base_url('web/assets');?>/images/shape17.png" alt="Shape">-->
      <!--<img src="<?php echo base_url('web/assets');?>/images/shape18.png" alt="Shape">-->
<!--   </div>-->
<!--</div>-->





<section class="vh-50">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://images.pexels.com/photos/5076516/pexels-photo-5076516.jpeg"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center" style="background-color:#f5f5f5">
              <div class="card-body p-lg-5 text-black">

                 <form method="post" action="<?php echo base_url('login_check') ?>">
                    
                    
                  <div class="text-center p-4 ">
                   
                    <span class="h1 fw-bold mb-0">Login/Signup</span>
                    <p>Get access to your Orders, Wishlist and Recommendations</p>
                  </div>
                    
                  <!--<h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;"></h5>-->
                    
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
             
                  <div class="form-outline mb-4">
                   <input type="number" class="form-control form-control-lg" name="mobile_no" placeholder="Mobile No" pattern="[6789][0-9]{9}" title="Please enter valid phone number">
              
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block common-btn w-100" type="submit">Login
                    <img src="<?php echo base_url('web/assets');?>/images/shape1.png" alt="Shape">
             <img src="<?php echo base_url('web/assets');?>/images/shape2.png" alt="Shape">
                    </button>
                  </div>

                  <!--<a class="small text-muted" href="#!"> Login With Facebook</a>-->
                  <!-- <a class="small text-muted" href="#!"> Login With Google</a>-->
                  <!--<p class="mb-5 pb-lg-2" style="color: #393f81;">Didn't Have An Account? <a href="<?php echo base_url();?>register"-->
                  <!--    style="color: #393f81;">Register</a></p>-->
                
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>