
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <h3>
       
        </h3>
       <!--  <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Tables</li>
            <li class="breadcrumb-item active">Executive</li>
        </ol> -->
    </div>
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-12">
         <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">My Rewards </h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
               <tr>
                    <th>Sr No.</th>
                    <th>Rewards</th>
                    <th>Achievement Date</th>
                   
                </tr>
              </thead>
                    <tbody>
                  
                      <tr>

                        <?php  
                    $id=$this->session->userdata('userid');
                    $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('refered_by',$id);
                    $query=$this->db->get();
                    $rewards=$query->row()->payment_amount;

                       //echo $this->db->last_query();die;

                        if($rewards >='1000')
                        {
                          ?>
                        <td>1</td>
                        <td>4 Days & 3 Nights National Tour</td> 
                        <td>20-1-2022</td>  
                        <?php
                        
                        ?>
                      </tr>

                      <?php 
                    }

                   if ($rewards>='10000') 
                    {
                      ?>

                       <tr>
                      
                        <td>2</td>
                         <td>Maruti Suzuki Swift + 4 Days & 3 Nihts foreign Tour</td> 
                        <td>20-1-2022</td>
                      </tr>

                      <?php
                       }

                       if ($rewards>='100000') 
                    {
                      ?>

                       <tr>
                      
                        <td>3</td>
                         <td>Maruti Suzuki Swift + 4 Days & 3 Nights foreign Tour</td> 
                        <td>20-1-2022</td>
                      </tr>

                      <?php
                       }

                       if ($rewards>='1000000') 
                    {
                      ?>

                       <tr>
                      
                        <td>4</td>
                         <td>Toyota Fortuner + 4 Days & 3 Nights foreign Tour</td> 
                        <td>20-1-2022</td>
                      </tr>

                      <?php
                       }

                    ?>
                     


                       
                   
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
  
  