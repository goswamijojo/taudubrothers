
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<section class="content">

		  <div class="row">
			<div class="col-lg-12 col-12">




			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Sub SubCategory</h3>
				</div>

				<center> <?php if($this->session->flashdata('success_msg')): ?>             
              <alert class="alert alert-success msg"><?=$this->session->flashdata('success_msg')?></alert> 
            <?php endif ?></center>

				<form action="<?php echo base_url('Admin/add_sub_subcategory/') ?>" enctype="multipart/form-data" method="post"> 
				<div class="box-body">


          <div class="row">
					<div class="form-group col-lg-6">
					<label>Category Name</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <select name="category" class="form-control" id="category" >
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

				  <div class="form-group col-lg-6">
					<label>SubCategory Name</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <select name="subcategory" class="form-control" id="subcategory" >
                           <option value="">Select Sub Category</option>
                           
                  </select>
					</div>
					<!-- /.input group -->
				  </div>
        </div>
        <div class="row">
				  <div class="form-group col-lg-6">
					<label>Sub_SubCategory Name</label>

					<div class="input-group">
					  <div class="input-group-prepend">
						  <div class="input-group-text">
							<i class="fa fa-file"></i>
						  </div>
					  </div>
					  <input type="text" class="form-control" name="sub_subcategory" >
					</div>
					<!-- /.input group -->
				  </div>

          <div class="form-group col-lg-6">
          <label>Weight</label>

          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
              <i class="fa fa-file"></i>
              </div>
            </div>
            <input type="text" class="form-control" name="weight" >
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
            <input type="text" class="form-control" name="price" >
          </div>
          <!-- /.input group -->
          </div>
          
          
           <div class="form-group col-lg-6">
          <label>Second Price</label>

          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
              <i class="fa fa-file"></i>
              </div>
            </div>
            <input type="text" class="form-control" name="price2" >
          </div>
          <!-- /.input group -->
          </div>
        </div>
        
                <div class="row">

				  <div class="form-group col-lg-6">
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
        </div
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
            <h4 class="box-title">Sub SubCategory List</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
               <tr>
                    <th>Sr No.</th>
                    <th>Category Name</th>
                    <th>SubCategory Name</th>
                    <th>Sub subcategory Name</th>
                    <th>Image</th>
                    <th>Action</th>
                   
                </tr>
              </thead>
                    <tbody>
                  <?php if (!empty($sub_subcat)):?>
                    <?php $i=1; 
                          foreach ($sub_subcat as $key => $value): ?>
                      <tr>
                        <td><?=$i++?></td>
                         <?php $res = $this->am->selectrow('category',array('id'=>$value->category)); ?>
                        <td><?=$res->name?></td>
                         <?php $res1 = $this->am->selectrow('subcategory',array('id'=>$value->subcategory)); ?>
                         <td><?=$res1->sub_category?></td>
                          <td><?=$value->sub_subcategory?></td>
                        <?php echo '<td><img class="rounded-circle" src="'.base_url().'uploads/'.$value->image.'" height="100" width="120"></td>'?>
                        
                        
                        <td>
                        	<a href="<?php echo base_url('Admin/edit_sub_subcategory/').$value->id ?>" class="btn btn-flat btn-danger rounded-circle" style="background-color:#ef6c00; color:white; border-radius:5px; padding:5px 11px; font-size: 14px;" ><i class="fa fa-edit"></i></a>
                        	<a href="<?php echo base_url('Admin/delete_sub_subcategory/').$value->id ?>" class="btn btn-flat btn-danger rounded-circle" style="background-color:#CC0000; color:white; border-radius:5px; padding:5px 11px; font-size: 14px;" ><i class="fa fa-trash"></i></a>

                        </td>
                         
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

  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 <script>
   $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
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
  