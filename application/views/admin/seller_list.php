
  
  
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
            <h4 class="box-title">Seller List</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
               <tr>
                     <th>Sr No.</th>
                    <th>Seller Name</th>
                    <th>Shop Name</th>
                    <th>Pan No.</th>
                    <th>Adhar No.</th>
                    <th>GST No.</th>
                    <th>Pan Image</th>
                    <th>Adhar Image</th>
                    <th>GST Image</th>
                     <th>Status</th>
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
                      <td><?=ucfirst($value->shop_name)?></td>
                        <td><?=$value->pan_no?></td>
                        <td><?=$value->adhar_no?></td>
                        <td><?=$value->gst_no?></td>
                        
                        
                         <td><a class="btn btn-sm btn-primary" href="<?php echo $value->pan_image ?>" target="_blank" title="View Image"><i class="fa fa-image"></i></a></td>
                         <td><a class="btn btn-sm btn-primary" href="<?=base_url().'uploads/'.$value->adhar_image; ?>" target="_blank" title="View Image"><i class="fa fa-image"></i></a></td>
                         <td><a class="btn btn-sm btn-primary" href="<?=base_url().'uploads/'.$value->gst_image; ?>" target="_blank" title="View Image"><i class="fa fa-image"></i></a></td>
                         
                        
                        
                         <td><?php 
                        if($value->status==0){ ?>
                              <span class="btn btn-danger btn-sm" data-toggle="modal" data-target="#packageModel<?= $value->id ?>" id="status">Inactive</span>
                             <?php }
                            else{ ?> 
                              <span style="cursor: pointer;" data-toggle="modal" data-target="#packageModel1<?= $value->id ?>" class="btn btn-success btn-sm">Active</span>
                            <?php } ?>
                        </td>
                        
                        <td>
                        	<a href="<?php echo base_url('Admin/delete_seller/').$value->id ?>" class="btn btn-flat btn-danger rounded-circle" style="background-color:#CC0000; color:white; border-radius:5px; padding:5px 11px; font-size: 14px;" ><i class="fa fa-trash"></i></a></td>
                      </tr>
                      
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
                                <form action="<?=base_url()?>admin/sellerchangestatus" method="post">
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
                                <form action="<?=base_url()?>admin/sellerchangestatus1" method="post">
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
  
  