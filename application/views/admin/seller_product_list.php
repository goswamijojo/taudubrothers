
  
  
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
            <h4 class="box-title">Seller Product List </h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
               <tr>
                     <th>Sr No.</th>
                     <th>Seller Name</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Other Offer</th>
                     <th>Image</th>
                    
                    
                    <th>Description</th>
                     <th>Action</th>
                   
                </tr>
              </thead>
                   <tbody>
                       
                  <?php if (!empty($product)):?>
                    <?php $i=1; 
                          foreach ($product as $key => $value): ?>
                      <tr>
                        <td><?=$i++?></td>
                         <?php $res1 = $this->am->selectrow('seller_registeration',array('id'=>$value->user_id));?>
                        <?php if(!empty($res1))
                        {
                          ?>
                          <td><?=$res1->name?></td>
                          <?php 
                        }
                       else
                       {
                           ?>
                           <td></td>
                           <?php
                       }
                       ?>
                       
                    
                        <td><?=$value->product_name?></td>
                        <td><?=$value->price?></td>
                        <td><?=$value->discount?>%</td>
                        <td><?=$value->other_offer?>%</td>
                        <?php if(!empty($value->image))
                        {
                            echo'<td><img class="rounded-circle" src="'.base_url().'uploads/'.$value->image.'" height="80" width="100"></td>';}
                            else
                            {
                                echo '<td> No Image</td>';
                            }
                        
                        ?>
                         
                          
                           <td><?=$value->description?></td>
                           <td>
                          <!--<a href="<?php echo base_url('Admin/edit_product/').$value->id ?>" class="btn btn-flat btn-danger rounded-circle" style="background-color:#ef6c00; color:white; border-radius:5px; padding:5px 11px; font-size: 14px;" ><i class="fa fa-edit"></i></a>-->
                          <a href="<?php echo base_url('Admin/delete_product/').$value->id ?>" class="btn btn-flat btn-danger rounded-circle" style="background-color:#CC0000; color:white; border-radius:5px; padding:5px 11px; font-size: 14px;" ><i class="fa fa-trash"></i></a></td>
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
    
    $('#example').dataTable( {
  "lengthMenu": [ [10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "All"] ]
} );
} );
</script>
  