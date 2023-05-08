
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<section class="content">

		  <div class="row">
			<div class="col-lg-6 col-12">




			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Sub Category</h3>
				</div>

				<center> <?php if($this->session->flashdata('success_msg')): ?>             
              <alert class="alert alert-success msg"><?=$this->session->flashdata('success_msg')?></alert> 
            <?php endif ?></center>

				<form action="<?php echo base_url('Admin/add_subcategory/') ?>" enctype="multipart/form-data" method="post"> 
				<div class="box-body">


					<div class="form-group">
					<label>Category Name</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <select name="category_name" class="form-control" required="">
                           <option value="">Select Category</option>
                            <?php  
                                foreach ($data as $row)
                                {    
                                  ?>
                                 <option value="<?php echo $row->id;?>"> <?php echo $row->name; ?>
                                      <?php  
                                       } 
                                       ?>    
                                     </option>
                  </select>
					</div>
					<!-- /.input group -->
				  </div>

				  <div class="form-group">
					<label>SubCategory Name</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <input type="text" class="form-control" name="sub_category" required="">
					</div>
					<!-- /.input group -->
				  </div>
				  
				 <!-- <div class="form-group">-->
					<!--<label>First Price</label>-->

     <!--     <div class="input-group">-->
     <!--       <div class="input-group-prepend">-->
     <!--         <div class="input-group-text">-->
     <!--         <i class="fa fa-file"></i>-->
     <!--         </div>-->
     <!--       </div>-->
     <!--       <input type="text" class="form-control" name="price" required="">-->
     <!--     </div>-->
					<!-- /.input group -->
				 <!-- </div>-->
				  
				 <!--   <div class="form-group">-->
					<!--<label>Second Price</label>-->

     <!--     <div class="input-group">-->
     <!--       <div class="input-group-prepend">-->
     <!--         <div class="input-group-text">-->
     <!--         <i class="fa fa-file"></i>-->
     <!--         </div>-->
     <!--       </div>-->
     <!--       <input type="text" class="form-control" name="price2" required="">-->
     <!--     </div>-->
					<!-- /.input group -->
				 <!-- </div>-->
				  
				 <!--   <div class="form-group">-->
				 <!-- <label>Weight</label>-->

     <!--     <div class="input-group">-->
     <!--       <div class="input-group-prepend">-->
     <!--         <div class="input-group-text">-->
     <!--         <i class="fa fa-file"></i>-->
     <!--         </div>-->
     <!--       </div>-->
     <!--       <input type="text" class="form-control" name="weight" required="">-->
     <!--     </div>-->
					<!-- /.input group -->
				 <!-- </div>-->
				  
				 
				  <div class="form-group">
					<label>Upload Image</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <input type="file" class="form-control" name="image">
					</div>
					<!-- /.input group -->
				  </div>
				   <div class="col-12 text-center">
				  <button type="submit"  class="btn btn-rounded my-20 btn-success">Save</button>
				</div>
				  <!-- /.form group -->
				</div>
				<!-- /.box-body -->
			  </div>


			  <!-- /.box -->

			 
			</div>
			
		  </div>
		  <!-- /.row -->

		  

		  

		</section>


		    <section class="content">
      <div class="row">
      <div class="col-12">
         <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Sub Category List</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
               <tr>
                    <th>Sr No.</th>
                    <th>Category Name</th>
                     <th>SubCategory Name</th>.
                    <th>Image</th>
                    <th>Action</th>
                   
                </tr>
              </thead>
                    <tbody>
                  <?php if (!empty($data1)):?>
                    <?php $i=1; 
                          foreach ($data1 as $key => $value): ?>
                      <tr>
                        <td><?=$i++?></td>
                        <?php $res = $this->am->selectrow('category',array('id'=>$value->category_name)); ?>
                        <td><?=$res->name?></td>
                           <td><?=$value->sub_category?></td>
                           <?php 
                           if($value->image){
                             echo '<td><img class="rounded-circle" src="'.base_url().$value->image.'" height="100" width="120"></td>';
                           }else{
                               echo '<td>no image</td>';
                           }
                           
                           ?>
                        
                        
                        
                        <td>
                        	<a href="<?php echo base_url('Admin/edit_subcategory/').$value->id ?>" class="btn btn-flat btn-danger rounded-circle" style="background-color:#ef6c00; color:white; border-radius:5px; padding:5px 11px; font-size: 14px;" ><i class="fa fa-edit"></i></a>
                        	<a href="<?php echo base_url('Admin/delete_subcategory/').$value->id ?>" class="btn btn-flat btn-danger rounded-circle" style="background-color:#CC0000; color:white; border-radius:5px; padding:5px 11px; font-size: 14px;" ><i class="fa fa-trash"></i></a></td>
                         
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
  