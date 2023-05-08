
  
  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<section class="content">

		  <div class="row">
			<div class="col-lg-9 col-6">


			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Testimonials</h3>
				</div>

				<center> <?php if($this->session->flashdata('success_msg')): ?>             
              <alert class="alert alert-success msg"><?=$this->session->flashdata('success_msg')?></alert> 
            <?php endif ?></center>

				<form action="<?php echo base_url('Admin/edit_testimonial/'.$data->id) ?>" enctype="multipart/form-data" method="post"> 
				 <div class="box-body">

				<div class="row">
				  <div class="form-group col-lg-12">
					<label>Title</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <input type="text" class="form-control" value="<?php echo $data->title ?>" name="title" >
					</div>
					<!-- /.input group -->
				  </div>
				   
				</div>
				
				<div class="row">
				  <div class="form-group col-lg-12">
					<label>Designation</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <input type="text" class="form-control" value="<?php echo $data->designation ?>" name="designation" >
					</div>
					<!-- /.input group -->
				  </div>
				   
				</div>

				<div class="row">
				  <div class="form-group col-lg-12">
					<label>Description</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <textarea class="form-control" name="description" value="" rows="2"><?php echo $data->description; ?></textarea>
                     <script>
                        CKEDITOR.replace('description');
                </script>
					</div>
					<!-- /.input group -->
				  </div>
				  <div class="form-group col-lg-6">
					<label>Upload Image 1</label>

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
				  <div class="form-group col-lg-4">
				     <?php if(!empty($data->image)){?>
				      <img style="border-radius: 15px; border: 2px solid white;" src="<?php echo base_url('uploads/').$data->image; ?>" alt="blog" height="80" width="100"/>
				      
				      <?php
				     }
				     else{
				         echo"No Image";
				     }?>
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

  