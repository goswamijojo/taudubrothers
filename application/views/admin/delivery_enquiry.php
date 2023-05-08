
  <style>
      #font{
          font-size:15px;
          color:white;
      }
  </style>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <h3>
       
        </h3>
       <!--  <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Tables</li>
            <li class="breadcrumb-item active">Executive</li>
        </ol> -->
    </div>
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-12">
         <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Delivery Enquiry List</h4>
          </div>
          <center><?php if($this->session->flashdata('success')) { ?>     
              <alert class="alert alert-success msg"><?=$this->session->flashdata('success')?></alert> 
            <?php } ?></center>
          <!-- /.box-header -->
          <div class="box-body">
          <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
               <tr>
                     <th>Sr No.</th>
                    <th>Name</th>
                    <th>Mobile No</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Message</th>
                    
                    <th>Action</th>
                   
                </tr>
              </thead>
                   <tbody>
                  <?php if (!empty($data)):?>
                    <?php $i=1; 
                          foreach ($data as $key => $value): ?>
                      <tr>
                        <td><?=$i++?></td>
                        <td><?=ucfirst($value->name)?></td>
                        <td><?=@$value->phone?></td>
                        <td><?=$value->email?></td>
                        <td><?=$value->location?></td>
                        <td><?=$value->message?></td>
                    
                         <!--<td><a class="btn btn-sm btn-primary" href="<?php echo $value->image ?>" title="View Image"><i class="fa fa-image"></i></a></td>-->
                         
                        
                        
                        
                        <td>
                        	<a href="<?php echo base_url('Admin/delete_enquiry/').$value->id ?>" class="btn btn-flat btn-danger rounded-circle" style="background-color:#CC0000; color:white; border-radius:5px; padding:5px 11px; font-size: 14px;" ><i class="fa fa-trash"></i></a></td>
                      </tr>
                     
               
                                   <!-- <div class="modal fade" id="packageModel9<?= $value->id ?>" role="dialog"aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">KYC Details</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                           </div>
                             <div class="modal-body">
                              <div class="form-group">
                                
                               <p id="font">Pan No   : <span class="badge"><?php
                                 echo  $kyc_check->pan_no;  ?></span>
                               </p>
                               <p id="font">Aadhar No : <span class="badge"><?php
                                 echo  $kyc_check->adhar_no;  ?></span>
                               </p>
                               
                               <p id="font">Pan Image : <img style="border-radius: 15px; border: 2px solid white;" src="<?php echo base_url().$kyc_check->pan_image; ?>" alt="" width="80" height="60">

                               </p>
                               <p id="font">Aadhar Image : <img style="border-radius: 15px; border: 2px solid white;" src="<?php echo base_url().$kyc_check->adhar_image; ?>" alt="" width="80" height="60">

                               </p>
                               <p id="font">Shop Area : <span class="badge"><?php
                                 echo  $kyc_check->shop_area;  ?></span>
                               </p>
                               
                               <p id="font">Shop state : <span class="badge"><?php
                                 echo  $kyc_check->shop_state;  ?></span>
                               </p>
                               
                               <p id="font">Gst No : <span class="badge"><?php
                                 echo  $kyc_check->gst_no;  ?></span>
                               </p>
                               
                               <p id="font">Pin Code : <span class="badge"><?php
                                 echo  $kyc_check->area_pincode;  ?></span>
                               </p>
                               
                               <p id="font">Gst No : <span class="badge"><?php
                                 echo  $kyc_check->gst_no;  ?></span>
                               </p>
                               
                               <p id="font">Shop Pin : <span class="badge"><?php
                                 echo  $kyc_check->shop_pincode;  ?></span>
                               </p>
                          </div>
                              <input type="hidden" name="user_id" id="uid" value="<?=$value->id?>">
                             
                          </div>
                          <div class="modal-footer">
                            
                        </form>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close KYC Details</button>
                          </div>
                        </div>
                      </div>
                    </div>-->
               
               
                     
                     
                      
                     <div class="modal fade" id="packageModel<?= $value->id ?>" role="dialog"aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Confirm Box</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                           </div>
                             <div class="modal-body">
                              <div class="form-group">
                                <form action="<?=base_url()?>admin/changestatus" method="post">
                              </div>
                              <input type="hidden" name="user_id" id="uid" value="<?=$value->id?>">
                             
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Confirm Active</button>
                        </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div> 
                    
                     <div class="modal fade" id="packageModel1<?= $value->id ?>" role="dialog"aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Confirm Box</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                           </div>
                             <div class="modal-body">
                              <div class="form-group">
                                <form action="<?=base_url()?>admin/changestatus1" method="post">
                              </div>
                              <input type="hidden" name="user_id" id="uid" value="<?=$value->id?>">
                             
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Confirm Deactive</button>
                        </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div> 
                    <?php endforeach ?>
                  <?php endif ?>
                </tbody>
             
            </table>
            </div>              
          </div>
          <!-- /.box-body -->
         </div>
         
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    
    </div>
  </div>
  <!-- /.content-wrapper -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
<script>
jQuery(document).ready(function($) {
    
    $('#example').dataTable( {
  "lengthMenu": [ [10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "All"] ]
} );
} );
</script>
  