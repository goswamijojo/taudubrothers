
  
  
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
        <!--    <li class="breadcrumb-item active">Buy History</li>-->
        <!--</ol>-->
    </div>
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-12">
         <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Buy History</h4>
           
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
         <tr>
                    <th>Sr No.</th>
                    <th>Elite</th>
                    <th>Binance Value</th>
                    <th>Transaction_id</th>
                    <!-- <th>Available Balance </th> -->
                     
                    <!--<th>Status</th> -->
                    <th>Date</th> 
                </tr>
                </thead>
                <tbody>
                  <?php
                   if (!empty($data)):?>
                    <?php $i=1; 
                          foreach ($data as $key => $value): ?>
                      <tr>
                        <td><?=$i++?></td>
                        <td><?=@$value->elite_coin?></td>
                        <td><?=@$value->binance_price_in_usd?></td>
                        
                       
                        <td><?=@$value->transaction_id?></td>
                        <!--<td><?=@$value->payment_amount?></td>-->
                        <!--<td><?=@$value->status?></td>-->
                        <td><?=@$value->payment_date ?></td>
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
  
  