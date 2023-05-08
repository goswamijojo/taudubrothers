
  
  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<section class="content">

		  <div class="row">
			<div class="col-lg-12 col-12">


			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Product</h3>
				</div>

				<center> <?php if($this->session->flashdata('success_msg')): ?>             
              <alert class="alert alert-success msg"><?=$this->session->flashdata('success_msg')?></alert> 
            <?php endif ?></center>

				 <form action="<?php echo base_url('Admin/edit_product/'.$data->id) ?>" enctype="multipart/form-data" method="post"> 
				 <div class="box-body">
				 	<div class="row">
					<div class="form-group col-lg-6" >
					<label>Category Name</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					   <select name="category" class="form-control" id="category" >
                           <option value="">Select Category</option>
                             <?php  foreach ($cat as $row)
                                { ?>
                          <option value="<?php echo $row->id;?>" <?php echo ($data->category == $row->id)?'selected="selected"':''; ?>> <?php echo $row->name; ?></option>
                                     <?php  } ?>
                  </select>
					</div>
					<!-- /.input group -->
				  </div>

				  <div class="form-group col-lg-6">
					<label>SubCategory Name</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					 <select name="subcategory" class="form-control" id="subcategory" >
                           <option value="">Select Category</option>
                           <?php  foreach ($subcat as $row)
                                { ?>
                          <option value="<?php echo $row->id;?>" <?php echo ($data->subcategory == $row->id)?'selected="selected"':''; ?>> <?php echo $row->sub_category; ?></option>
                                     <?php  } ?>
                  </select>
					</div>
					<!-- /.input group -->
				  </div>
				</div>
				<div class="row">
				  <!--<div class="form-group col-lg-6">
					<label>Sub Subcategory</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					    <select name="sub_subcategory" class="form-control" id="sub_subcategory" >
                           <option value="">Select Sub Sub Category</option>
                            <?php  foreach ($sub_subcat as $row)
                                { ?>
                          <option value="<?php echo $row->id;?>" <?php echo ($data->sub_subcategory == $row->id)?'selected="selected"':''; ?>> <?php echo $row->sub_subcategory; ?></option>
                                     <?php  } ?>
                  </select>
					</div>
					
				  </div>-->
				   <div class="form-group col-lg-6">
					<label>Product Name</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <input type="text" class="form-control" name="product_name" value="<?php echo $data->product_name ?>" >
					</div>
					<!-- /.input group -->
				  </div>
				  <div class="form-group col-lg-6">
					<label>Quantity</label>
					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <input type="text" class="form-control" name="quantity" value="<?php echo $data->quantity ?>" >
					</div>
					<!-- /.input group -->
				  </div>
				</div>

				<div class="row">
				  <div class="form-group col-lg-6">
					<label>First Price</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <input type="text" class="form-control" name="price" value="<?php echo $data->price ?>" >
					</div>
					<!-- /.input group -->
				  </div>
				  <div class="form-group col-lg-6">
					<label>Brand</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					   <select name="brand_name" class="form-control" required="" id="brand_name" >
                           <option value="">Select Brand Name</option>
                            <?php  foreach ($brand as $row)
                                { ?>
                          <option value="<?php echo $row->id;?>" <?php echo ($data->brand_name == $row->id)?'selected="selected"':''; ?>> <?php echo $row->brand_name; ?></option>
                                     <?php  } ?>
                  </select>
					</div>
					
				  </div>
				</div>

				<div class="row">
				  <div class="form-group col-lg-6">
					<label>Upload Image 1</label>

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
				   <div class="form-group col-lg-6">
					<label>Upload Image 2</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <input type="file" class="form-control" name="image1" >
					</div>
					<!-- /.input group -->
				  </div>
				</div>

				<div class="row">
				  <div class="form-group col-lg-6">
					<label>Upload Image 3</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <input type="file" class="form-control" name="image2" >
					</div>
					<!-- /.input group -->
				  </div>
				   <div class="form-group col-lg-6">
					<label>Upload Image 4</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <input type="file" class="form-control" name="image3" >
					</div>
					<!-- /.input group -->
				  </div>
				</div>

				<div class="row">
				  <div class="form-group col-lg-6">
					<label>Upload Video</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <input type="file" class="form-control" name="video" >
					</div>
					<!-- /.input group -->
				  </div>
				   <div class="form-group col-lg-6">
					<label>Description</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					   <textarea class="form-control" name="description" rows="2"><?php echo $data->description ?></textarea>
                      <script>
                        CKEDITOR.replace( 'description' );
                </script>
					</div>
					<!-- /.input group -->
				  </div>
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
	  </div>
  </div>
  <!-- /.content-wrapper -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    //alert('test');
$('#category').bind('change keyup',function() {
  var cid = $('#category').val();
  //alert(cid);
    $.ajax({
        url: '<?php echo base_url(); ?>/Admin/subcategoryget',
        type: 'POST',
        data: {
            cid: cid
        },
        dataType: 'html',
        success: function(data) {
          //alert(data);die;

          $("#subcategory").html(data);
        }
    });
});
});
</script>
<script type="text/javascript">
$(document).ready(function(){
$('#subcategory').bind('change keyup',function() {
  var scid = $('#subcategory').val();
  //alert(scid);
    $.ajax({
        url: '<?php echo base_url(); ?>/Admin/sub_subcategoryget',
        type: 'POST',
        data: {
            scid: scid
        },
        dataType: 'html',
        success: function(data) {
          //alert(data);die;

          $("#sub_subcategory").html(data);
        }
    });
});
});
</script>
<!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
<!--  <script>
   $(document).ready(function() {
    $('#example').DataTable();
} );
</script> -->

  