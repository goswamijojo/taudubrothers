  <div class="content-wrapper">
    <section class="content-header"><h1> Dashboard  </h1></section>
     <section class="content">
      <div class="row">
        <div class="box-body">
          <center>
          <?php if($this->session->flashdata('success_msg')): ?>             
              <alert class="alert alert-success"><?=$this->session->flashdata('success_msg')?></alert> 
              <?php header("Refresh:2;"); ?>
            <?php endif ?>
            
             <?php if($this->session->flashdata('pwd_error')): ?>             
              <alert class="alert alert-danger"><?=$this->session->flashdata('pwd_error')?></alert> 
              <?php header("Refresh:2;"); ?>
            <?php endif ?>
            </center>
        <div class="col-xs-12">
          <div class="box col-md-12">
            <div class="box-header">
              <h3 class="box-title col-md-12">User Detail's</h3> 
            </div>

       <!--  <form method="post" action="<?=base_url()?>">    -->
       <form action="<?php echo base_url('user/edit_profile/').$data->id ?>" enctype="multipart/form-data" method="post">   
        <div class="row">
        <input type="hidden" class="form-control" id="id" name="id" value="<?=$this->session->userdata("id")?>">
            <?php  $user_info=get_user_info($this->session->userdata("id"));?>
              
              <div class="col-md-3 form-group">
                <label for="sopnsorName" class="text-primary">User Id:</label>
                <input type="text" class="form-control" id="Userid" name="userid" readonly="" value="<?=$user_info->userid?>">
                </div>
              
              <div class="col-md-3 form-group">
                <label for="sopnsorName" class="text-primary">Fullname:</label>
                <input type="text" class="form-control" id="fullname" name="fullname"  value="<?=ucfirst($user_info->fullname)?>">
              </div>
              <div class="col-md-3 form-group">
                <label for="sopnsorName" class="text-primary">Mobile no:</label>
                <input type="text" class="form-control" id="mobile_no" name="mobile_no"  value="<?=$user_info->mobile_no?>" >
              </div>
              <div class="col-md-3 form-group">
                <label for="sopnsorName" class="text-primary">Password:</label>
                <input type="text" class="form-control" id="password" name="password"  value="<?=$user_info->vpassword?>">
              </div>
              <div class="col-md-3 form-group">
                <label for="sopnsorName" class="text-primary">Email:</label>
                <input type="text" class="form-control" id="state" name="email" value="<?=$user_info->email?>">
              </div>
               <div class="col-md-3 form-group">
                <label for="sopnsorName" class="text-primary">Aadhar Card:</label>
                <input type="text" class="form-control" id="city" name="aadhar_card"  value="<?=$user_info->aadhar_card?>">
              </div>
              <div class="col-md-3 form-group">
                <label for="sopnsorName" class="text-primary">Pan Card: </label>
                <input type="text" class="form-control" id="sponsor_name" name="pan_card" value="<?=$user_info->pan_card?>" >
              </div>
              <div class="col-md-12 form-group">
                  <center>
                    <input type="submit" name="update" class="btn btn-success" value="UPDATE">
                  </center>
              </div>
             </form>
      </div>           
    </div>
  </div>
</div>
</section>
</form>
</div>
</div>
  <!-- /.content-wrapper -->
  
