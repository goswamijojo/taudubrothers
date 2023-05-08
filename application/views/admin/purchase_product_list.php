
  
  
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
            <h4 class="box-title">Product List </h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
               <tr>
                    <th>Sr No.</th>
                     <th>Order ID</th>
                    <th>Product Name</th>
                     <th>Quantity</th>
                     <th>Price</th>
                     <th>Discount</th>
                     <th>Shipping Charge</th>
                     <th>Applied Coupan Code</th>
                     <th>Coupon(%)</th>
                     <th>Coupon Amount</th>
                     <th>Product Price</th>
                     <th>Total Price</th>
                </tr>
              </thead>
                   <tbody>
                  <?php if (!empty($data)):
                      
                  ?>
                  
                    <?php 
                    
                   //print_r($data); die();
                    $i=1; 
                          foreach ($data as $key => $value):
                            $percent_val = $value->price*$value->discount/100; 
                            $dicount_val = $value->price-$percent_val;
                           $product_price = $dicount_val+
                             $value->shipping_charge_amount;
                           $total_price= $product_price*$value->quentity;

                          ?>
                      <tr>
                        <td><?=$i++?></td>
                        <td>#<?=$value->order_id?></td>
                        <td><?=$value->product_name?></td>
                        <!--<td><?=$value->quentity?></td>-->
                        <td><?=$value->quentity?></td>
                        <td><?=$value->price?></td>
                        <td><?=$value->discount."%"?></td>
                        <td><?=$value->shipping_charge_amount?></td>
                        <td><?=$value->coupan_code?></td>
                         <td><?=$value->coupon_per_amount?>%</td>
                         <td><?=$value->coupn_amount?></td>
                        <td><?php echo $product_price ;?></td>
                        <td><?php echo $total_price; ?></td>
            
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
  
  