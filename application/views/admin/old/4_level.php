
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <h3>
        Data Tables
        </h3>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Tables</li>
            <li class="breadcrumb-item active">Project Director</li>
        </ol>
    </div>
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-12">
         <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Project Director</h4>
           
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
               <tr>
                    <th>Sr No.</th>
                    <th>User ID</th>
                    <th>Name</th>
                     <th>Mobile no</th>
                     <th>Email</th>
                     <th>Total Investment</th>
                    <th>Registration Date</th>
                   
                </tr>
              </thead>
                    <tbody>
                  <?php if (!empty($record)):?>
                    <?php $i=1; 
                          foreach ($record as $key => $value): ?>
                      <tr>
                        <td><?=$i++?></td>
                        <td><?=$value->userid?></td>
                        <td><?=ucfirst($value->fullname)?></td>
                         <td><?=ucfirst($value->mobile_no)?></td>
                         <td><?=ucfirst($value->email)?></td>
                         <?php  $res = $this->um->select('user_transactions',array('user_id'=>$value->id));
                         
                         //echo $this->db->last_query();die;
                         ?>
                         
                         <?php if(!empty($res))
                         {
                             ?>
                             <td><?=$res->payment_amount?></td>
                             <?php
                         }
                         
                             else
                             {
                                 ?>
                                 <td></td>
                                 
                                 <?php
                             
                             }
                             
                         ?>
                         
                         
                        
                        
                        <td><?=$value->receive_date?></td>
                         
                        

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
                                <form action="<?=base_url()?>user/change_status_byuser" method="post">
                               <!--  <label for="recipient-name" class="col-form-label">Packages:</label> -->
                               <!--  <select class="form-control" name="package" required="">
                                  <option value="">--Select--</option>
                                  <option value="500">500</option>
                                  <option value="1000">1000</option>
                                  <option value="2000">2000</option>
                                  <option value="5000">5000</option>
                                  <option value="10000">10000</option>
                                </select> -->
                              </div>
                              <input type="hidden" name="uid" id="uid" value="<?=$value->id?>">
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Confirm Active</button>
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
  
  