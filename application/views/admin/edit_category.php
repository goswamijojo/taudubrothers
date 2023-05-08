
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<section class="content">

		  <div class="row">
			<div class="col-lg-6 col-12">




			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Category</h3>
				</div>

				<center> <?php if($this->session->flashdata('success_msg')): ?>             
              <alert class="alert alert-success msg"><?=$this->session->flashdata('success_msg')?></alert> 
            <?php endif ?></center>

				<form action="<?php echo base_url('Admin/edit_category/'.$data->id) ?>" enctype="multipart/form-data" method="post"> 
				<div class="box-body">
                   <div class="form-group">
                   <label>Category Type</label>
				   <select name="type" class="form-control" id="category" >
                        <option value="<?php echo $data->type;?>"><?php 
                        if($data->type==1){
                            echo"E-commerce";
                        }
                        if($data->type==2){
                            echo"Grocery";
                        }
                        if($data->type==3){
                            echo"Fresh";
                        }
                        ?></option>
                           <option value="1">E-commerce</option>
                           <option value="2">Grocery</option>
                           <option value="3">Fresh</option>
                      </select>
				  </div>
					<div class="form-group">
					<label>Name</label>
					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <input type="text" class="form-control" name="name" value="<?php echo $data->name ?>" >
					</div>
					<!-- /.input group -->
				  </div>
				  <div class="form-group">
					<label>Upload Image</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <input type="file" class="form-control" name="image" >
					</div>
					<!-- /.input group -->
				  </div>
				  	<?php if(!empty($data->image)){?>
				      <img style="border-radius: 15px; border: 2px solid white;" src="<?php echo base_url('uploads/').$data->image; ?>" alt="blog" height="80" width="100"/>
				      
				      <?php
				     }
				     else{
				         echo"No Image";
				     }?>
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
            <h4 class="box-title">Category List</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
               <tr>
                    <th>Sr No.</th>
                    <th>Name</th>
                    <th>Type</th>
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
                        <td><?=$value->name?></td>
                        <td><?php
                             if($value->type==1){
                            echo"E-commerce";
                        }
                        if($value->type==2){
                            echo"Grocery";
                        }
                        if($value->type==3){
                            echo"Fresh";
                        }
                        ?></td>
                        <?php echo '<td><img class="rounded-circle" src="'.base_url().'uploads/'.$value->image.'" height="100" width="120"></td>'?>
                        <td>
                        	<a href="<?php echo base_url('Admin/edit_category/').$value->id ?>" class="btn btn-flat btn-danger rounded-circle" style="background-color:#ef6c00; color:white; border-radius:5px; padding:5px 11px; font-size: 14px;" ><i class="fa fa-edit"></i></a>
                        	<a href="<?php echo base_url('Admin/delete_category/').$value->id ?>" class="btn btn-flat btn-danger rounded-circle" style="background-color:#CC0000; color:white; border-radius:5px; padding:5px 11px; font-size: 14px;" ><i class="fa fa-trash"></i></a></td>
                         
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
    <script type="text/javascript">
        $(document).ready(function(){
            
            $('#category').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo base_url('admin/edit_category');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].type+'>'+data[i].type+'</option>';
                        }
                        $('#category').html(html);
 
                    }
                });
                return false;
            }); 
             
        });
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
<script>
jQuery(document).ready(function($) {
    
    $('#example').dataTable( {
  "lengthMenu": [ [10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "All"] ]
} );
} );
</script>
  