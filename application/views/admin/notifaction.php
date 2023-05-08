<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1>Notification</h1>
          		</div>
          		<div class="col-sm-6">
            		<ol class="breadcrumb float-sm-right">
              			<li class="breadcrumb-item"><a href="#">Home</a></li>
              			<li class="breadcrumb-item active">Notification</li>
					</ol>
          		</div>
        	</div>
      	</div><!-- /.container-fluid -->
    </section>
  	<section class="content">
		<div class="container-fluid">
        	<div class="row">
          		<!-- left column -->
          		<div class="col-md-12">
            		<!-- general form elements -->
            		<div class="card card-primary">
              			<div class="card-header">
                			<h3 class="card-title">Notification</h3>
              			</div>
						  <center> <?php if($this->session->flashdata('success_msg')): ?>             
              <alert class="alert alert-success msg"><?=$this->session->flashdata('success_msg')?></alert> 
            <?php endif ?></center>
                        <form action="<?=base_url()?>Admin/add_notifaction" enctype="multipart/form-data" method="post"> 
                			<div class="card-body">
                   				<div class="row">
                     				<div class="col-md-12 form-group">
                     					<label for="Designation">Title</label>
										<div class="input-group mb-3">
                  							<div class="input-group-prepend">
                    							<span class="input-group-text"></span>
											</div>
											<input type="text" name="title" required="" value=""class="form-control" placeholder="Title">
									</div>
                                     </div>
                                     
                                     <div class="col-md-12 form-group">
                     					<label for="Designation">Image</label>
										<div class="input-group mb-3">
                  							<div class="input-group-prepend">
                    							<span class="input-group-text"></span>
											</div>
											<input type="file" name="image" required="" value=""class="form-control" placeholder="Title">
									</div>
                                     </div>
					              	<div class="col-md-12 form-group">
										<label>Description*</label>
										<textarea name="description" maxlength="1000" row="5" col="50" class="form-control " novalidate></textarea>
									</div>
            					</div>
								<div class="card-footer">
                                    <button type="submit" class="btn btn-primary ">Submit</button>
                                </div>
							</div>	
						</from>
					</div>	
				</div>
			</div>
		</div>				
	</section>

  </div>
</div>	