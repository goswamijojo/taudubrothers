<div class="content-wrapper">
<section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box">
            <div class="box-header with-border">
              <h3 class="box-title">Change Password</h3>
           <?php if($this->session->flashdata('success_msg')): ?>             
              <alert class="alert alert-success msg"><?=$this->session->flashdata('success_msg')?></alert> 
            <?php endif ?>
            </div>
   
            <form role="form" method="post" action="<?=base_url()?>user/changepassword">
              <input type="hidden" name="id" value="<?=$this->session->userdata('id')?>">
              <div class="box-body">
                <div class="form-group">
                  <label>Old Password</label>
                  <input type="text" class="form-control" name="password" placeholder="Old Password" value="">
                </div>
                <div class="form-group">
                  <label>New Password</label>
                  <input type="password" class="form-control" name="newpass" placeholder="New Password" value="">
                </div>
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="password" class="form-control" name="confpassword" placeholder="Confirm Password" value="">
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
  </div>