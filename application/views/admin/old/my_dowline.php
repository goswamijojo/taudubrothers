
  
  
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
            <h4 class="box-title">My Team</h4>
           
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
               <tr>
                   
                    <th>User ID</th>
                    <!--<th>Name</th>-->
                    <!-- <th>Mobile no</th>-->
                     <th>Email</th>
                     <th>Total Investment</th>
                    <th>Registration Date</th>
                </tr>
              </thead>
           <tbody>
               
               
                   <?php if (!empty($data)):?>
                    <?php $i=1; 
                          foreach ($data as $key): ?>
                            <tr>
                          <td><?=$key->userid?></td>
                         <!--<td><?=ucfirst($key->fullname)?></td>-->
                         <!--<td><?=ucfirst($key->mobile_no)?></td>-->
                         <td><?=ucfirst($key->email)?></td>
                      <?php  $res = $this->um->select('user_transactions',array('user_id'=>$key->id));
                         
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
                         
                          <td><?=$key->receive_date?></td>
                       </tr>
                      <?php endforeach ?>
                     <?php endif ?>
                  
                  <?php if (!empty($data1)):?>
                    <?php $i=1; 
                          foreach ($data1 as $key): ?>
                            <tr>
                          <td><?=$key->userid?></td>
                         <!--<td><?=ucfirst($key->fullname)?></td>-->
                         <!--<td><?=ucfirst($key->mobile_no)?></td>-->
                         <td><?=ucfirst($key->email)?></td>
                      <?php  $res = $this->um->select('user_transactions',array('user_id'=>$key->id));
                         
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
                         
                          <td><?=$key->receive_date?></td>
                       </tr>
                      <?php endforeach ?>
                     <?php endif ?>
                     <?php if (!empty($data2)):?>
                    <?php $i=1; 
                          foreach ($data2 as $k): ?>
                            <tr>
                    
                         <td><?=$k->userid?></td>
                         <!--<td><?=ucfirst($k->fullname)?></td>-->
                         <!--<td><?=ucfirst($k->mobile_no)?></td>-->
                         <td><?=ucfirst($k->email)?></td>
                      <?php  $res = $this->um->select('user_transactions',array('user_id'=>$k->id));
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
                          <td><?=$k->receive_date?></td>
                       </tr>
                      <?php endforeach ?>
                     <?php endif ?>
                     <?php if (!empty($data3)):?>
                    <?php $i=1; 
                          foreach ($data3 as $val1): ?>
                            <tr>
                        <td><?=$val1->userid?></td>
                         <!--<td><?=ucfirst($val1->fullname)?></td>-->
                         <!--<td><?=ucfirst($val1->mobile_no)?></td>-->
                         <td><?=ucfirst($val1->email)?></td>
                      <?php  $res = $this->um->select('user_transactions',array('user_id'=>$val1->id));
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
                          <td><?=$val1->receive_date?></td>
                       </tr>
                      <?php endforeach ?>
                     <?php endif ?>
                     <?php if (!empty($data4)):?>
                    <?php $i=1; 
                          foreach ($data4 as $val2): ?>
                            <tr>
                        <td><?=$val2->userid?></td>
                         <!--<td><?=ucfirst($val2->fullname)?></td>-->
                         <!--<td><?=ucfirst($val2->mobile_no)?></td>-->
                         <td><?=ucfirst($val2->email)?></td>
                      <?php  $res = $this->um->select('user_transactions',array('user_id'=>$val2->id));
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
                          <td><?=$val2->receive_date?></td>
                       </tr>
                      <?php endforeach ?>
                     <?php endif ?>
                     <?php if (!empty($data5)):?>
                    <?php $i=1; 
                          foreach ($data5 as $val3): ?>
                            <tr>
                           <td><?=$val3->userid?></td>
                         <!--<td><?=ucfirst($val3->fullname)?></td>-->
                         <!--<td><?=ucfirst($val3->mobile_no)?></td>-->
                         <td><?=ucfirst($val3->email)?></td>
                      <?php  $res = $this->um->select('user_transactions',array('user_id'=>$val3->id));
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
                          <td><?=$val3->receive_date?></td>
                       </tr>
                      <?php endforeach ?>
                     <?php endif ?>
                     <?php if (!empty($data6)):?>
                    <?php $i=1; 
                          foreach ($data6 as $val4): ?>
                            <tr>
                          <td><?=$val4->userid?></td>
                         <!--<td><?=ucfirst($val4->fullname)?></td>-->
                         <!--<td><?=ucfirst($val4->mobile_no)?></td>-->
                         <td><?=ucfirst($val4->email)?></td>
                      <?php  $res = $this->um->select('user_transactions',array('user_id'=>$val4->id));
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
                          <td><?=$val4->receive_date?></td>
                       </tr>
                      <?php endforeach ?>
                     <?php endif ?>
                     <?php if (!empty($data7)):?>
                    <?php $i=1; 
                          foreach ($data7 as $val5): ?>
                            <tr>
                          <td><?=$val5->userid?></td>
                         <!--<td><?=ucfirst($val5->fullname)?></td>-->
                         <!--<td><?=ucfirst($val5->mobile_no)?></td>-->
                         <td><?=ucfirst($val5->email)?></td>
                      <?php  $res = $this->um->select('user_transactions',array('user_id'=>$val5->id));
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
                          <td><?=$val5->receive_date?></td>
                       </tr>
                      <?php endforeach ?>
                     <?php endif ?>
                     <?php if (!empty($data8)):?>
                     <?php $i=1; 
                          foreach ($data8 as $val6): ?>
                            <tr>
                           <td><?=$val6->userid?></td>
                         <!--<td><?=ucfirst($val6->fullname)?></td>-->
                         <!--<td><?=ucfirst($val6->mobile_no)?></td>-->
                         <td><?=ucfirst($val6->email)?></td>
                      <?php  $res = $this->um->select('user_transactions',array('user_id'=>$val6->id));
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
                         <td><?=$val6->receive_date?></td>
                       </tr>
                      <?php endforeach ?>
                     <?php endif ?>
                     
                     <?php if (!empty($data9)):?>
                     <?php $i=1; 
                          foreach ($data9 as $val7): ?>
                            <tr>
                           <td><?=$val7->userid?></td>
                         <!--<td><?=ucfirst($val7->fullname)?></td>-->
                         <!--<td><?=ucfirst($val7->mobile_no)?></td>-->
                         <td><?=ucfirst($val7->email)?></td>
                      <?php  $res = $this->um->select('user_transactions',array('user_id'=>$val7->id));
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
                          <td><?=$val7->receive_date?></td>
                       </tr>
                      <?php endforeach ?>
                     <?php endif ?>
                     
                     <?php if (!empty($data10)):?>
                     <?php $i=1; 
                          foreach ($data10 as $val8): ?>
                            <tr>
                           <td><?=$val8->userid?></td>
                         <!--<td><?=ucfirst($val8->fullname)?></td>-->
                         <!--<td><?=ucfirst($val8->mobile_no)?></td>-->
                         <td><?=ucfirst($val8->email)?></td>
                      <?php  $res = $this->um->select('user_transactions',array('user_id'=>$val8->id));
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
                          <td><?=$val8->receive_date?></td>
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
  
  