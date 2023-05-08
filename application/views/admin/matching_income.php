
  
  
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
            <h4 class="box-title">Matching Income Details </h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
               <tr>
                     <th>Sr No.</th>
                    <th>User ID</th>
                    <th>Matching Amount</th>
                    <th>Amount</th>
                    <th>Available Balance</th>
                   <!--  <th>Carry Fwd</th> -->
                    <!-- <th>Carry Side</th> -->
                    <th>Recive Date</th>
                   
                </tr>
              </thead>
                   <tbody>
                  <?php if (!empty($record)):?>
                    <?php $i=1; 
                          foreach ($record as $key => $value): ?>
                      <tr>
                        <td><?=$i++?></td>
                        <td>
                          <?php $from=explode(',', $value->from); 
                                echo "<b>UserId".'&nbsp | &nbsp'."Fullname".'&nbsp | &nbsp'."Package</b>"."<br>";
                             foreach ($from as $key) { 
                                $info=get_user_info($key);
                                echo @$info->userid.' | '.ucfirst(@$info->fullname).' | '.@$info->payment_amount.'<br>';
                              }?>
                        </td>
                        <td><?=$value->amount?></td>
                        <td><?=$value->amount?></td>
                        <td><?=$value->available_balance?></td>
                       <!--  <td><?=$value->carry_fwd?></td>
                        <td><?=$value->position?></td> -->
                        <td><?=$value->created_at?></td>
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
  
  