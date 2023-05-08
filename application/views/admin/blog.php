
  
  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<section class="content">

		  <div class="row">
			<div class="col-lg-6 col-6">


			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Blog</h3>
				</div>

				<center> <?php if($this->session->flashdata('success_msg')): ?>             
              <alert class="alert alert-success msg"><?=$this->session->flashdata('success_msg')?></alert> 
            <?php endif ?></center>

				<form action="<?php echo base_url('Admin/add_blog/') ?>" enctype="multipart/form-data" method="post"> 
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
					  <input type="text" class="form-control" required="" name="title" >
					</div>
					<!-- /.input group -->
				  </div>
				</div>
				
				<div class="row">
				  <div class="form-group col-lg-12">
					<label>Date</label>
					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <input type="date" class="form-control" required="" name="date" >
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
					  <textarea class="form-control" name="discription" rows="2"></textarea>
                     <script>
                        CKEDITOR.replace( 'description' );
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
            <h4 class="box-title">Blog List</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
               <tr>
                    <th>Sr No.</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Images</th>
                    <th>Action</th>
                   
                </tr>
              </thead>
                    <tbody>
                  <?php if (!empty($data)):?>
                    <?php $i=1; 
                          foreach ($data as $key => $value): ?>
                      <tr>
                        <td><?=$i++?></td>
                        <td><?=$value->title?></td>
                        <td><?=$value->date?></td>
                        <td><?=$value->discription?></td>
                         <?php
                        if(!empty($value->image)){
                          ?>
                               <td><img src="<?php echo base_url('uploads/').$value->image?>" alt="" width="50" height="40"></td>                          
                          <?php
                        }
                        else{
                            echo "<td>No Images</td>";
                        }
                        ?>

                           <td>
                          <a href="<?php echo base_url('Admin/edit_blog/').$value->id ?>" class="btn btn-flat btn-danger rounded-circle" style="background-color:#ef6c00; color:white; border-radius:5px; padding:5px 11px; font-size: 14px;" ><i class="fa fa-edit"></i></a>
                          
                          
                          
                          <a href="<?php echo base_url('Admin/delete_blog/').$value->id ?>" class="btn btn-flat btn-danger rounded-circle" style="background-color:#CC0000; color:white; border-radius:5px; padding:5px 11px; font-size: 14px;" ><i class="fa fa-trash"></i></a></td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
<script>
jQuery(document).ready(function($) {
    
    $('#example').dataTable( {
  "lengthMenu": [ [10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "All"] ]
} );
} );
</script>
  

  