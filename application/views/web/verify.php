<!--<div class="page-title-area">-->
<!--   <div class="d-table">-->
<!--      <div class="d-table-cell">-->
<!--         <div class="container">-->
<!--            <div class="title-content">-->
<!--               <h2>Verify</h2>-->
<!--               <ul>-->
<!--                  <li>-->
<!--                     <a href="<?php echo base_url();?> index">Home</a>-->
<!--                  </li>-->
<!--                  <li>-->
<!--                     <span>Verify</span>-->
<!--                  </li>-->
<!--               </ul>-->
<!--            </div>-->
<!--         </div>-->
<!--      </div>-->
<!--   </div>-->
<!--   <div class="title-img">-->
<!--      <img src="<?php echo base_url('web/assets');?>/images/page-title1.jpg" alt="About">-->
<!--      <img src="<?php echo base_url('web/assets');?>/images/shape16.png" alt="Shape">-->
<!--      <img src="<?php echo base_url('web/assets');?>/images/shape17.png" alt="Shape">-->
<!--      <img src="<?php echo base_url('web/assets');?>/images/shape18.png" alt="Shape">-->
<!--   </div>-->
<!--</div>-->
<!--<div class="user-area ptb-100">-->
<!--   <div class="container">-->
     
<!--      <div class="user-item">-->
<!--         <form method="post" action="<?php echo base_url('verification'); ?>">-->
<!--            <h2>Verify OTP</h2>-->
<!--             <?php if(!empty($this->session->flashdata('error'))){?>-->
<!--            <div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert"></button>-->
<!--              <strong>Error!</strong><?php echo $this->session->flashdata('error'); ?>-->
<!--            </div>-->
<!--            <?php } ?>-->
<!--             <?php if(!empty($this->session->flashdata('success'))){?>-->
<!--            <div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert"></button>-->
<!--              <strong>Success!</strong><?php echo $this->session->flashdata('success'); ?>-->
<!--            </div>-->
<!--            <?php } ?>-->
<!--            <div class="form-group d-flex align-items-center">-->
<!--               <input type="text" class="form-control d-block" name="otp" placeholder="OTP">-->
<!--               <a href="<?php echo base_url('resend_otp/'.$mobile)?>"class="resend_btn">Resend</a>-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--               <input type="hidden" class="form-control" name="mobile_no" value="<?php echo $mobile ?>" placeholder="Mobile No">-->
<!--            </div>-->
           <!--<a href="<?php echo base_url('resend_otp/'.$mobile)?>"class="btn common-btn">Resend</a>-->
<!--            <button type="submit" class="btn common-btn">-->
<!--            verify-->
<!--            <img src="<?php echo base_url('web/assets');?>/images/shape1.png" alt="Shape">-->
<!--            <img src="<?php echo base_url('web/assets');?>/images/shape2.png" alt="Shape">-->
<!--            </button>-->
           
<!--         </form>-->
<!--      </div>-->
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

                 <form method="post" action="<?php echo base_url('verification'); ?>">
                    
                    
                  <div class="text-center p-4 ">
                   
                    <span class="h1 fw-bold mb-0">Verify OTP</span>
                  </div>
                    
                  <!--<h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;"></h5>-->
                    
                    <?php if(!empty($this->session->flashdata('error'))){?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Error!</strong><?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php } ?>
             <?php if(!empty($this->session->flashdata('success'))){?>
            <div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Success!</strong><?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } ?>
            
                  <div class="form-outline mb-4 d-flex align-items-center">
                   <input type="text" class="form-control d-block" name="otp" placeholder="OTP">
               <a href="<?php echo base_url('resend_otp/'.$mobile)?>"class="resend_btn">Resend</a>
                  </div>
                  
                   <div class="form-outline mb-4">
               <input type="hidden" class="form-control" name="mobile_no" value="<?php echo $mobile ?>" placeholder="Mobile No">
            </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block common-btn w-100" type="submit"> verify
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