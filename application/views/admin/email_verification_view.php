<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Taudu Brothers</title>
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

                                  <?php if ($this->session->flashdata('forgot')) { ?>

                                    <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                      <strong><?php echo $this->session->flashdata('forgot'); ?></strong>
                                     </div>

                                     <?php } ?>
                  <div class="text-center mb-3">
                    <!-- <img src="<?php echo base_url();?>home/theme-assets/images-3d-animation/logo.png" alt=""> -->
                  </div>
                                    <h4 class="text-center mb-4">Email Varification</h4>
                                    <form action="<?=base_url()?>admin/otp_varification" method="post">
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email Id</strong></label>
                                            <input type="text" name="email"  placeholder="Email" class="form-control" value="">
                                        </div>
                                        <div class="text-center">
                                            <input type="submit" name="forgot" value="Varify" class="btn btn-primary btn-block">
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