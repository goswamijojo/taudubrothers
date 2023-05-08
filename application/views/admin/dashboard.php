<!-- Content Wrapper. Contains page content -->




  <div class="content-wrapper">
	  <div class="container-full">


		<!-- Content Header (Page header) -->	  
		<div class="content-header">
			<h3>
				<!--Dashboard-->
			
		  	</h3>
		  <!--	<ol class="breadcrumb">-->
				<!--<li class="breadcrumb-item"><a href=""><i class="fa fa-dashboard"></i> Home</a></li>-->
				<!--<li class="breadcrumb-item active">Dashboard</li>-->
		  <!--	</ol>-->
		</div>

		<!-- Main content -->
		<section class="content">
			<div class="row">
        <div class="col-md-6 col-xl-3">
          <div class="box pull-up">
            <div class="box-body">
              <div class="row align-items-center">
                 <!-- <div class="col-6"> -->
                  <a href="<?php echo base_url('admin/user_list'); ?>"  class="btn btn-dark"><h5>Total User</h5></a>
            <!--     </div> -->

               
               
                <div class="col-12">
                  <div id="" class="mt-10"></div>
                </div>
              </div>
               <div class="col-6">
                   
           
                  <?php
              $res = $this->am->selectres(' user_registeration');
              $this->db->from(" user_registeration");
              $val= $this->db->count_all_results();
              if (!empty($val))
                     {
                      ?>
                    <h4 class="counter text-center mb-0"><?php echo $val ?></h4>
                      <?php 
                    }
                    else
                    {
                    ?>
                     <h4 class="counter text-center mb-0">0</h4>
                     <?php
                    }
                    ?> 
                  
                </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="box pull-up">
            <div class="box-body">
              <div class="row align-items-center">
                 <!-- <div class="col-6"> -->
                 <a href="<?php echo base_url('Admin/connect_seller_list'); ?>"  class="btn btn-dark"><h5>Total Seller</h5></a>
            <!--     </div> -->

               
               
                <div class="col-12">
                  <div id="" class="mt-10"></div>
                </div>
              </div>
               <div class="col-6">
                   
           
                  <?php
              $res = $this->am->selectres(' seller_registeration');
              $this->db->from(" seller_registeration");
              $val= $this->db->count_all_results();
              if (!empty($val))
                     {
                      ?>
                     <h4 class="counter text-center mb-0"><?php echo $val ?></h4>
                      <?php 
                    }
                    else
                    {
                    ?>
                     <h4 class="counter text-center mb-0">0</h4>
                     <?php
                    }
                    ?> 
                  
                </div>
            </div>
          </div>
        </div>
         <div class="col-md-6 col-xl-3">
          <div class="box pull-up">
            <div class="box-body">
              <div class="row align-items-center">
                 <!-- <div class="col-6"> -->
                  <a href="<?php echo base_url('admin/category'); ?>"  class="btn btn-dark"><h5>Category</h5></a>
               <!--  </div> -->
              

                <div class="col-12">
                  <div id="" class="mt-10"></div>
                 
                </div>
              </div>
              <div class="col-6">
              
             <?php
              $res = $this->am->selectres(' category');
              $this->db->from(" category");
              $category= $this->db->count_all_results();
              if (!empty($category))
                     {
                      ?>
                     <h4 class="counter text-center mb-0"><?php echo $category ?></h4>
                      <?php 
                    }
                    else
                    {
                    ?>
                     <h4 class="counter text-center mb-0">0</h4>
                     <?php
                    }
                    ?> 
             </div>
            </div>
          </div>
        </div>



         <div class="col-md-6 col-xl-3">
          <div class="box pull-up">
            <div class="box-body">
              <div class="row align-items-center">
                 <!-- <div class="col-6"> -->
                  <a href="<?php echo base_url('admin/sub_category'); ?>" class="btn btn-dark"><h5>Sub Category</h5></a>
               <!--  </div> -->
                
               
                <div class="col-12">
                  <div id="" class="mt-10"></div>
                </div>
              </div>

              <div class="col-6">
                  
                 
                  
              <?php
              $res = $this->am->selectres('subcategory');
              $this->db->from(" subcategory");
              $subcategory= $this->db->count_all_results();
              if (!empty($subcategory))
                     {
                      ?>
                     <h4 class="counter text-center mb-0"><?php echo $subcategory ?></h4>
                      <?php 
                    }
                    else
                    {
                    ?>
                     <h4 class="counter text-center mb-0">0</h4>
                     <?php
                    }
                    ?> 
                </div>
            </div>
          </div>
        </div>
        


         <!--<div class="col-md-6 col-xl-3">
          <div class="box pull-up">
            <div class="box-body">
              <div class="row align-items-center">
                  <div class="col-6">
                  <a class="btn btn-dark"><h5>Sub SubCategory</h5></a>
                 </div>
               
               
                <div class="col-12">
                  <div id="" class="mt-10"></div>
                </div>
              </div>
               <div class="col-6">
                  
              <?php
              $res = $this->am->selectres('sub_subcategory');
              $this->db->from("sub_subcategory");
              $sub_subcategory= $this->db->count_all_results();
              if (!empty($sub_subcategory))
                     {
                      ?>
                     <h4 class="counter text-center mb-0"><?php echo $sub_subcategory ?></h4>
                      <?php 
                    }
                    else
                    {
                    ?>
                     <h4 class="counter text-center mb-0">0</h4>
                     <?php
                    }
                    ?> 

                </div>
            </div>
          </div>
        </div>-->
        <div class="col-md-6 col-xl-3">
          <div class="box pull-up">
            <div class="box-body">
              <div class="row align-items-center">
                 <!-- <div class="col-6"> -->
                  <a class="btn btn-dark"><h5>Admin Product</h5></a>
               <!--  </div> -->
                
               
                <div class="col-12">
                    
                  <div id="" class="mt-10"></div>
                </div>
              </div>

              <div class="col-6">
                  
                     <?php
              $res = $this->am->selectres('seller_product');
              $this->db->from("seller_product");
              $this->db->where('type',1);
              $product= $this->db->count_all_results();
              if (!empty($product))
                     {
                      ?>
                     <h4 class="counter text-center mb-0"><?php echo $product ?></h4>
                      <?php 
                    }
                    else
                    {
                    ?>
                     <h4 class="counter text-center mb-0">0</h4>
                     <?php
                    }
                    ?> 

                </div>
            </div>
          </div>
        </div>
        
         <div class="col-md-6 col-xl-3">
          <div class="box pull-up">
            <div class="box-body">
              <div class="row align-items-center">
                 <!-- <div class="col-6"> -->
                  <a href="<?php echo base_url('admin/seller_product_manage'); ?>" class="btn btn-dark"><h5>Seller Product</h5></a>
               <!--  </div> -->
                
               
                <div class="col-12">
                  <div id="" class="mt-10"></div>
                </div>
              </div>

              <div class="col-6">
                  
                     <?php
              $res = $this->am->selectres('seller_product');
              $this->db->from("seller_product");
              $product= $this->db->count_all_results();
              if (!empty($product))
                     {
                      ?>
                     <h4 class="counter text-center mb-0"><?php echo $product ?></h4>
                      <?php 
                    }
                    else
                    {
                    ?>
                     <h4 class="counter text-center mb-0">0</h4>
                     <?php
                    }
                    ?> 

                </div>
            </div>
          </div>
        </div>


				<div class="col-md-6 col-xl-3">
          <div class="box pull-up">
            <div class="box-body">
              <div class="row align-items-center">
                 <!-- <div class="col-6"> -->
                  <a href="<?php echo base_url('admin/order_list'); ?>" class="btn btn-dark"><h5>Order List</h5></a>
               <!--  </div> -->
                

                <div class="col-12">
                    <?php
              $res = $this->am->selectres('user_payment_details');
              $this->db->from("user_payment_details");
              $product= $this->db->count_all_results();
              if (!empty($product))
                     {
                      ?>
                     <h4  class="counter text-center mb-0"><?php echo $product ?></h4>
                      <?php 
                    }
                    else
                    {
                    ?>
                     <h4 class="counter text-center mb-0">0</h4>
                     <?php
                    }
                    ?> 
                  <div id="" class="mt-10"></div>
                </div>
              </div>
            </div>
          </div>
        </div>




				<div class="col-md-6 col-xl-3">
          <div class="box pull-up">
            <div class="box-body">
              <div class="row align-items-center">
                 <!-- <div class="col-6"> -->
                  <a href="<?php echo base_url('Admin/testimonial'); ?>" class="btn btn-dark"><h5>Testimonials</h5></a>
               <!--  </div> -->
                
               
                <div class="col-12">
                  <div id="" class="mt-10"></div>
                </div>
              </div>

              <div class="col-6">
                  
                     <?php
              $res = $this->am->selectres('testimonial');
              $this->db->from("testimonial");
              $product= $this->db->count_all_results();
              if (!empty($product))
                     {
                      ?>
                     <h4 class="counter text-center mb-0"><?php echo $product ?></h4>
                      <?php 
                    }
                    else
                    {
                    ?>
                     <h4 class="counter text-center mb-0">0</h4>
                     <?php
                    }
                    ?> 

                </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 col-xl-3">
          <div class="box pull-up">
            <div class="box-body">
              <div class="row align-items-center">
                 <!-- <div class="col-6"> -->
                  <a href="<?php echo base_url('admin/blog'); ?>" class="btn btn-dark"><h5>Blog</h5></a>
               <!--  </div> -->
                
               
                <div class="col-12">
                  <div id="" class="mt-10"></div>
                </div>
              </div>

              <div class="col-6">
                  
                     <?php
              $res = $this->am->selectres('blog');
              $this->db->from("blog");
              $product= $this->db->count_all_results();
              if (!empty($product))
                     {
                      ?>
                     <h4 class="counter text-center mb-0"><?php echo $product ?></h4>
                      <?php 
                    }
                    else
                    {
                    ?>
                     <h4 class="counter text-center mb-0">0</h4>
                     <?php
                    }
                    ?> 

                </div>
            </div>
          </div>
        </div>

        <!-- <div class="col-md-6 col-xl-3">
        </div> -->

				



        

				</div> 
			</div>	
		</section>
		<!-- /.content -->
	  </div>
  </div>





  