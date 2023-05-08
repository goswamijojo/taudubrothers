
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
            <h4 class="box-title">Order Details</h4>
          </div>
          <center> <?php if($this->session->flashdata('success_msg')): ?>             
              <alert class="alert alert-success msg"><?=$this->session->flashdata('success_msg')?></alert> 
            <?php endif ?></center>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table   class="table table-bordered  nowrap margin-top-10 w-p100" id="table_id">
              <thead>
               <tr>
                     <th>Sr No.</th>
                   <!--  <th>User Name</th>  -->
                     <th>Order_Id</th>
                   <!--  <th>City</th> -->
                    <!--<th>Product Name</th>-->
                   <!-- <th>Amount</th>  -->
                    <th>Recive Date</th> 
                     <th>Product List</th>
                    <!---<th>Action</th>    -->
                     <th>Payment Method</th>
                    <th>Order Status</th>
                    <th>Change Order Status</th>
                   <!-- <th>Order Assign Vendor Name</th>   -->
                   <!-- <th>Assign Order</th>   -->

                    
                   
                </tr>
              </thead>
                   <tbody>
                  <?php if (!empty($data)):?>
                    <?php $i=1; 
                          foreach ($data as $key => $value):
                       // echo "<pre>";
                        //   print_r($data); die('In Construction Mode Activate');
                          ?>
                      <tr>
                        <td><?=$i++?></td>
                        
                         <?php   $product = $this->am->selectrow('user_payment_details',array('user_id'=>$value->user_id));
 ?>
                        <?php $res1 = $this->am->selectrow('user_registeration',array('id'=>$value->user_id));?>
                        <?php if(!empty($res1))
                        {
                          ?>
                         <!-- <td><?=$res1->name?></td> -->
                          <?php 
                        }
                       else
                       {
                           ?>
                          <!-- <td></td> -->
                           <?php
                       }
                       ?>
                       
                        <?php if(!empty($value->order_id))
                        {
                          ?>
                          <td><?=$value->order_id?></td>
                          <?php 
                        }
                       else
                       {
                          ?>
                           <td></td>
                           <?php
                       }
                       ?>
                      
                       <?php if(!empty($value->city))
                        {
                          ?>
                          <!-- <td><?=$value->city?></td> -->
                          <?php 
                        }
                       else
                       {
                          ?>
                         <!--  <td></td>     -->
                           <?php
                       }
                       ?>
                       <?php if(!empty($value->amount))
                        {
                          ?>
                        <!--  <td><?=$value->amount;?></td>  -->
                          <?php 
                        }
                       else
                       {
                          ?>
                         <!--  <td></td>    -->
                           <?php
                       }
                       ?>

                       <?php 
                       
                       $product_id=$value->product_id;
                       $date=$value->date;
                       
                       $res = $this->am->selectrow('product',array('id'=>$product_id));?>
                        <!--<td><?=ucfirst(@$res->product_name)?></td>-->
                       <?php  
                       $this->db->select_sum('total_price');
                    $this->db->from('cart');
                    $this->db->where('user_id',$value->user_id);
                     $this->db->where('status','1');
                    $query=$this->db->get();
                    $amount=$query->row()->total_price; ?>
                        <td><?=$date?></td>
                        <td>
                         <!--<td><span class="btn btn-danger btn-sm" data-toggle="modal" data-target="#packageModel1<?= $value->user_id ?>" id="status">Total Product</span></td>-->
                          <a href="<?php echo base_url('Admin/purchase_product_list/').$value->order_id ?>" class="btn btn-flat btn-danger rounded-circle" style="background-color:#ef6c00; color:white; border-radius:5px; padding:5px 11px; font-size: 14px;" >Total Product</a>
                        <!-- <td><span class="btn btn-danger btn-sm" data-toggle="modal" data-target="#packageModel<?= $value->user_id ?>" id="status">Order Place</span></td> -->
                         <td><?php
                    if($product->payment_type==1)
                    {
                    ?>
                      <h4><span class="badge badge-success">Online Payment</span></h4>
                      <?php
                    }
                    
                    else
                    {
                      ?><h4><span class="badge badge-primary">Cash On Delivery</span></h4><?php
                    }
                    ?></td>
                       
                     <td>
                             
                             <?php
                    if($value->status==1)
                    {
                    ?>
                      <h4><span class="badge badge-success">Order Pending</span></h4>
                      <?php
                    }
                    elseif($value->status == '2')
                    {
                    ?>
                      <h4><span class="badge badge-primary">Order Shiped</span></h4>
                    <?php
                    }
                    elseif($value->status == '3') 
                    {
                    ?>
                      <h4><span class="badge badge-danger">Out of Delivery</span></h4>
                    <?php
                    }
                    
                    elseif($value->status == '4')
                    {
                        ?><h4><span class="badge badge-success">Delivered</span></h4>
                        <?php
                    }
                    else
                    {
                      ?><h4><span class="badge badge-danger">Cancelled</span></h4><?php
                    }
                    ?>
                    </td> 
                    <td><center><span class="btn btn-info btn-sm" data-toggle="modal" data-target="#packageModel2<?= $value->order_id ?>" id="status"><i class="fa fa-edit"></i></span></center></td>
                     <?php $res2 = $this->am->selectrow('user_payment_details',array('order_id'=>$value->order_id));?>
                         
                         <?php if(!empty($res2))
                        {
                          ?>
                        <!--  <td><?php echo $value->full_name; ?></td>   -->
                          <?php 
                        }
                       else
                       {
                           ?>
                            <td></td>
                           <?php
                       }
                       ?>
                       
                <!--        <td><span class="btn btn-danger btn-sm" data-toggle="modal" data-target="#packageModel1<?= $value->order_id ?>" >Assign Ordder</span></td>   -->

                      </tr>
                      
                      
                    <div class="modal fade" id="packageModel2<?= $value->order_id ?>" role="dialog"aria-hidden="true">
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
                                <form action="<?=base_url()?>admin/change_status" method="post">
                              </div>

                              <input type="hidden" name="order_id" value="<?=$value->order_id?>">
                              
                              <select name="status" class="form-control" id="name">
                                                <option value="">Select Status</option>
                                                <option value="Pending">Pending</option>
                                                <option value="order_shiped">Order Shiped</option>
                                                <option value="out_of_delivery"> Out of Delivery</option>
                                                <option value="Delivered">Delivered</option>
                                                <option value="Cancelled">Cancelled</option>
                                            </select>
                             
                             
                             
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Confirm Active</button>
                        </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div> 
                    
                    
                    <div class="modal fade" id="packageModel1<?= $value->order_id ?>" role="dialog"aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Vendor List</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                           </div>
                             <div class="modal-body">
                              <div class="form-group">
                                  hgvfvgd
                                <form action="<?=base_url()?>admin/assign_order" method="post">
                              </div>
                              <input type="hidden" name="order_id" id="uid" value="<?=$value->order_id?>">
                            <select name="name" class="form-control" >
                           <option value="">Select user</option>
                            <?php  
                                foreach ($data as $row)
                                {    
                                  ?>
                                 <option value="<?php echo $row->id;?>"> <?php echo $row->full_name; ?>
                                      <?php  
                                       } 
                                       ?>    
                                     </option>
                  </select>
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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
<script>
jQuery(document).ready(function($) {
    
    $('#table_id').dataTable( {
  "lengthMenu": [ [10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "All"] ]
} );
} );
</script>