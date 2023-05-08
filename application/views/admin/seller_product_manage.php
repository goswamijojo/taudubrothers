
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <h3>
       
        </h3>

    </div>
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-12">
         <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Seller Product List </h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="table_id" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
               <tr>
                     <th>Sr No.</th>
                    <th>Product Name</th>
                    <th>height</th>
                    <th>Weight</th>
                    <th>Width</th>
                    <th>Length</th>
                    <th>Color</th>
                    <th>Speciality</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Comission Price</th>
                    
                     <th>Other Offer</th>
                     <th>Delivery Charge</th>
                     <th>Total Price</th>
                     <th>Quantity</th>
                     <th>Brand Name</th>
                     <th>category</th>
                     <th>Subcategory</th>
                     <th>Description</th>
                     <th>Image</th>
                     <th>Image1</th>
                     <th>Image2</th>
                    <!-- <th>video</th>    -->

                   <th>Action</th>
                </tr>
              </thead>
                   <tbody>
                  <?php if (!empty($data)):
                  
                  ?>
                  
                    <?php $i=1; 
                          foreach ($data as $key => $value): ?>
                      <tr>
                        <td><?=$i++?></td>
                        <td><?=$value->product_name?></td>
                        <td><?=$value->height?></td>
                        <td><?=$value->weight?></td>
                        <td><?=$value->width?></td>
                        <td><?=$value->length?></td>
                        <td><?=$value->color?></td>
                        <td><?=$value->speciality?></td>
                        <td><?=$value->price?></td>
                        <td><?=$value->discount?></td>
                        
                        <?php 
                        
$offer2=$value->discount;
$offer=$value->price;
 $product_price=$value->price*$offer2/100; 

$comision_price=$offer-$product_price;               
 //print_r($comision_price);                 
                         
    $val=round($comision_price);
    
    if ($val >'0' && $val <= '500')
{
    $value1= $val*0/100;
    //echo $value;
}

elseif ($val >='501' && $val <= '799') {
    $value1= $val*5/100;
    //echo $value;
 }
 
 elseif ($val >='800' && $val <= '999') {
    $value1= $val*6/100;
    //echo $value;
 }
 elseif ($val >='1000' && $val <= '1499') {
    $value1= $val*8/100;
    //echo $value;
 }
 elseif ($val >='1500' && $val <= '1999') {
    $value1= $val*10/100;
    //echo $value;
 }
 elseif ($val >='2000' && $val <= '2499') {
    $value1= $val*15/100;
    //echo $value;
 }
 elseif ($val >='2500' && $val <= '2999') {
    $value1= $val*20/100;
    //echo $value;
 }
 elseif ($val >='3000' && $val <= '3400') {
    $value1= $val*25/100;
    //echo $value;
 }
 else {
     $value1= $val*30/100;
     //echo $value;
     
 }
                         
                        
                         
                         $total_price=$offer-$product_price+$value1;
                         
                        ?>
                        
                        
                        <td><?=round($value1)?></td>
   
   
                        
                        
                        <td><?=$value->other_offer?></td>
                        <td><?=$value->delivery_charge?></td>
                        <td><?=round($total_price)?></td>
                        <td><?=$value->quantity?></td>
                        <td><?=$value->brand_name?></td>
                        <td><?=$value->category?></td>
                        <td><?=$value->subcategory?></td>
                        <td><?= word_limiter($value->description,20)?></td>
                       
                        
                        <?php
                        if(!empty($value->image)){
                          ?>
                               <td><img src="<?php echo base_url().$value->image?>" alt="" width="50" height="40"></td>                          
                          <?php
                        }
                        else{
                            echo "<td>No Images</td>";
                        }
                        ?>
                       <!-- <td><img src="<?php echo base_url().$value->image?>" alt="" width="50" height="40"></td>   -->
                       
                       <?php
                        if(!empty($value->image)){
                          ?>
                               <td><img src="<?php echo base_url().$value->image1?>" alt="" width="50" height="40"></td>                          
                          <?php
                        }
                        else{
                            echo "<td>No Images</td>";
                        }
                        ?>
                       
                  <!--      <td><img src="<?php echo base_url().$value->image1?>" alt="" width="50" height="40"></td>     -->
                  
                  
                  
                  <?php
                        if(!empty($value->image)){
                          ?>
                               <td><img src="<?php echo base_url().$value->image2?>" alt="" width="50" height="40"></td>                          
                          <?php
                        }
                        else{
                            echo "<td>No Images</td>";
                        }
                        ?>
                   <!--      <td><img src="<?php echo base_url().$value->image2?>" alt="" width="50" height="40"></td>  -->
                  <!--      <td><img src="<?php echo base_url().$value->video?>" alt="" width="50" height="40"></td>   -->

                        <? /*php if(!empty($value->image))
                        {
                            echo'<td><img class="rounded-circle" src="'.base_url().'uploads/'.$value->image.'" height="80" width="100"></td>';}
                            else
                            {
                                echo '<td> No Image</td>';
                            }
                        */
                        ?>
                         
                          
                           <td>
                          <a href="<?php echo base_url('Admin/seller_delete_product/').$value->id ?>" class="btn btn-flat btn-danger rounded-circle" style="background-color:#CC0000; color:white; border-radius:5px; padding:5px 11px; font-size: 14px;" ><i class="fa fa-trash"></i></a></td>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
<script>
jQuery(document).ready(function($) {
    
    $('#table_id').dataTable( {
  "lengthMenu": [ [10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "All"] ]
} );
} );
</script>
  
  