
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<section class="content">

		  <div class="row">
			<div class="col-lg-9 col-12">




			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Sub Category</h3>
				</div>

				<center> <?php if($this->session->flashdata('success_msg')): ?>             
              <alert class="alert alert-success msg"><?=$this->session->flashdata('success_msg')?></alert> 
            <?php endif ?></center>

				<form action="<?php echo base_url('Admin/edit_subcategory/'.$data->id) ?>" enctype="multipart/form-data" method="post"> 
				<div class="box-body">



					<div class="form-group">
					<label>Category Name</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					   <select name="category" class="form-control" required="" id="category" >
                           <option value="">Select Category</option>
                             <?php  foreach ($cat as $row)
                                { ?>
                          <option value="<?php echo $row->id;?>" <?php echo ($data->category_name == $row->id)?'selected="selected"':''; ?>> <?php echo $row->name; ?></option>
                                     <?php  } ?>
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
					  <input type="text" class="form-control" name="sub_category" required="" value="<?php echo $data->sub_category ?>" >
					</div>
					<!-- /.input group -->
				  </div>
				  
		<!-- <div class="form-group">-->
		<!--<label>First Price</label>-->
  <!--        <div class="input-group">-->
  <!--          <div class="input-group-prepend">-->
  <!--            <div class="input-group-text">-->
  <!--            <i class="fa fa-file"></i>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--          <input type="text" class="form-control" name="price" value="<?php echo $data->price ?>"  >-->
  <!--        </div>-->
					<!-- /.input group -->
		<!--		  </div>-->
				  
		<!--		  	 <div class="form-group">-->
		<!--<label>Second Price</label>-->
  <!--        <div class="input-group">-->
  <!--          <div class="input-group-prepend">-->
  <!--            <div class="input-group-text">-->
  <!--            <i class="fa fa-file"></i>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--          <input type="text" class="form-control" name="price2" value="<?php echo $data->price2 ?>"  >-->
  <!--        </div>-->
					<!-- /.input group -->
		<!--		  </div>-->
				  
		<!--		    <div class="form-group">-->
		<!--		  <label>Weight</label>-->

  <!--        <div class="input-group">-->
  <!--          <div class="input-group-prepend">-->
  <!--            <div class="input-group-text">-->
  <!--            <i class="fa fa-file"></i>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--          <input type="text" class="form-control" name="weight" value="<?php echo $data->weight ?>" >-->
  <!--        </div>-->
					<!-- /.input group -->
		<!--		  </div>-->
				  <div class="form-group">
					<label>Uploade Image</label>

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
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
  