
  
  
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
            <h4 class="box-title">Profit Share Details </h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
               <tr>
                     <th>Sr No.</th>
                    <!-- <th colspan="2"><center>From</center></th>
                    <th>Package</th> -->
                    <th>Amount</th>
                    <th>Recive Date</th>
                   
                </tr>
              </thead>
                   <tbody>
                  <?php if (!empty($record)):?>
                    <?php $i=1; 
                          foreach ($record as $key => $value): ?>
                      <tr>
                        <td><?=$i++?></td>
                        <?php $info=get_user_info($value->from)?>
                        <!-- <td><?=ucfirst(@$info->fullname)?></td>
                        <td><?=@$info->userid?></td>
                        <td><?=$value->package?></td> -->
                        <td><?=$value->amount?></td>
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
  
  