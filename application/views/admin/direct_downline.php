
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <h3>
        <!--Data Tables-->
        </h3>
        <!--<ol class="breadcrumb">-->
        <!--<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>-->
        <!--<li class="breadcrumb-item" aria-current="page">Tables</li>-->
        <!--    <li class="breadcrumb-item active">Downline</li>-->
        <!--</ol>-->
    </div>
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-12">
         <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">My Referal</h4>
           
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
               <tr>
                    <th>Sr No.</th>
                    <th>User ID</th>
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
                        <!--<td><?=ucfirst($value->fullname)?></td>-->
                        <!-- <td><?=ucfirst($value->mobile_no)?></td>-->
                         <td><?=ucfirst($value->email)?></td>
                         <?php  $res = $this->um->select('user_transactions',array('user_id'=>$value->id));
                         
                         //echo $this->db->last_query();die;
                         ?>
                         
                         <?php if(!empty($res))
                         {
                             ?>
                             <td>USD <?=$res->payment_amount?></td>
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
  
  