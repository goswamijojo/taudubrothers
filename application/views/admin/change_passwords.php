<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Ahiraat Tiles</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>home/fevicon.png">
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

                            <?php if ($this->session->flashdata('notmatch_pass')) { ?>

                                    <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                      <strong><?php echo $this->session->flashdata('notmatch_pass'); ?></strong>
                                     </div>

                                     <?php } ?>
                                     
                                     <?php if ($this->session->flashdata('password_change')) { ?>

                                    <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                      <strong><?php echo $this->session->flashdata('password_change'); ?></strong>
                                     </div>

                                     <?php } ?>
                  <div class="text-center mb-3">
                    <!-- <img src="<?php echo base_url();?>home/theme-assets/images-3d-animation/logo.png" alt=""> -->
                  </div>
                                    <h4 class="text-center mb-4">Change Password</h4>
                                    <form action="<?=base_url()?>admin/change_password_process" method="post">
                                       <div class="form-group">
                                            <label class="mb-1"><strong>New Password :</strong></label>
                                            <input type="text" name="new"  placeholder="New" class="form-control" value="">
                                        </div>
										<div class="form-group">
                                            <label class="mb-1"><strong>Confirm Password :</strong></label>
                                            <input type="text" name="conform"  placeholder="Conform" class="form-control" value="">
                                        </div>
                                    <div class="text-center">
                                            <input type="submit" name="change" value="change" class="btn btn-primary btn-block">
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