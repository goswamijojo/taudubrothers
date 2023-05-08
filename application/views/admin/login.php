<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Taudu Brothers | Admin Panel</title>
    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo base_url();?>Admin_dashborad/images/favicon/Fevicon-tb-icon.png">
  <link href="<?php echo base_url();?>home/admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>home/admin/css/style.css" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">

                                  <?php
              if($this->session->flashdata('logmsg'))
              {
                ?>
                      <div class="alert alert-success" id="logmsg">
          <?php echo $this->session->flashdata('logmsg'); ?><span style="float:right" id="sphide">&times;</span>
            </div>
                <?php }  ?>
                  <div class="text-center mb-3">
                    <!-- <img src="<?php echo base_url();?>home/theme-assets/images-3d-animation/logo.png" alt=""> -->
                  </div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form action="<?=base_url()?>admin/index" method="post">
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email Id</strong></label>
                                            <input type="text" name="email"  placeholder="Email" class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" name="password" placeholder="Password" class="form-control" value="">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                               <div class="custom-control custom-checkbox ml-1">
                          <input type="checkbox" class="custom-control-input" id="basic_checkbox_1">
                         <!--  <label class="custom-control-label" for="basic_checkbox_1">Remember my preference</label> -->
                        </div>
                                            </div>
                                            <div class="form-group">
                                                <a href="<?php echo base_url('Admin/email_verification'); ?>">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
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


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="<?php echo base_url();?>home/admin/vendor/global/global.min.js"></script>
  <script src="<?php echo base_url();?>home/admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="<?php echo base_url();?>home/admin/js/custom.min.js"></script>
  <script src="<?php echo base_url();?>home/admin/js/deznav-init.js"></script>
    
    
</body>
</html>