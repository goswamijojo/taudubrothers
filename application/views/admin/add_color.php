
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<section class="content">

		  <div class="row">
			<div class="col-lg-6 col-12">




			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Add Color</h3>
				</div>

				<center> <?php if($this->session->flashdata('success_msg')): ?>             
              <alert class="alert alert-success msg"><?=$this->session->flashdata('success_msg')?></alert> 
            <?php endif ?></center>

				<form action="<?php echo base_url('Admin/add_color/') ?>" enctype="multipart/form-data" method="post"> 
				<div class="box-body">
				  <div class="form-group">
					<label>Color Name</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <input type="text" class="form-control" name="color_name" >
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
            <h4 class="box-title">Color List</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
               <tr>
                    <th>Sr No.</th>
                    <th>Color Name</th>
                     
                    <th>Action</th>
                   
                </tr>
              </thead>
                    <tbody>
                  <?php if (!empty($data)):?>
                    <?php $i=1; 
                          foreach ($data as $key => $value): ?>
                      <tr>
                        <td><?=$i++?></td>
                       
                        <td><?=$value->color_name?></td>
                        
                        
                        <td><!--<a href="<?php echo base_url('Admin/edit_product/').$value->id ?>" class="btn btn-flat btn-danger rounded-circle" style="background-color:#ef6c00; color:white; border-radius:5px; padding:5px 11px; font-size: 14px;" ><i class="fa fa-edit"></i></a>-->
                        &nbsp; <a href="<?php echo base_url('Admin/delete_brand/').$value->id ?>" class="btn btn-flat btn-danger rounded-circle" style="background-color:#CC0000; color:white; border-radius:5px; padding:5px 11px; font-size: 14px;" ><i class="fa fa-trash"></i></a></td>
                         
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
  
  