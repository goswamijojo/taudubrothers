
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <h3>
        <!--Data Tables-->
        </h3>
        <!--<ol class="breadcrumb">-->
        <!--<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>-->
        <!--<li class="breadcrumb-item" aria-current="page">Tables</li>-->
        <!--    <li class="breadcrumb-item active">Downline</li>-->
        <!--</ol>-->
    </div>
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-12">
         <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">My Level Details</h4>
           
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered  nowrap margin-top-10 w-p100">
              <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>Lavel</th>
                    <th>Total registration</th>
                    <!--<th>registration Achieved</th>-->
                     <!--<th>Inactive User</th>-->
                    <th>Total Income</th>
                </tr>
              </thead>
           <tbody>
                  <tr>
                      <td>1</td>
                        <td>Level 1</td>
                        <td><i class="fa fa-user"></i> <?php 
                $iid=$this->session->userdata('userid');
                $wh = array("refered_by" =>$iid);
               $res = $this->um->selectres('user_transactions');
               $this->db->where($wh);
               $this->db->from("user_transactions");
               echo $this->db->count_all_results(); ?></td>
               
                        
               
               
               <td>ELT <?php   $iid=$this->session->userdata('userid');
                    $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('refered_by',$iid);
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level1=$pay*10/100;
                    echo $level1/2;

                   ?></td>
                       
                         
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Level 2</td>
                        <td><i class="fa fa-user"></i><?php 
                $iid=$this->session->userdata('userid');
                $wh = array("p1"=>$iid);
               $res = $this->um->selectres('user_transactions');
               $this->db->where($wh);
               $this->db->from("user_transactions");
              echo $this->db->count_all_results(); ?></td>
                        
                    
              
              
             
              
              
              <td>ELT <?php  $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p1',$iid);
                
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level2=$pay*5/100;
                     echo $level2/2;

                   ?></td>
                   
                         
                      </tr>
                      <tr>
                        <td>3</td>                
                        <td>Level 3</td>
                        <td><i class="fa fa-user"></i><?php 
                $iid=$this->session->userdata('userid');
                $wh = array("p2"=>$iid);
               $res = $this->um->selectres('user_transactions');
               $this->db->where($wh);
               $this->db->from("user_transactions");
              echo $this->db->count_all_results(); ?></td>
              
              
                      
              <td> ELT <?php   $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p2',$iid);
                 
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level3=$pay*5/100;
                    echo $level3/2;

                   ?></td>
                         
                        
                      </tr>
                      <tr>
                          <td>4</td>
                        <td>Level 4</td>
                        <td><i class="fa fa-user"></i><?php 
                $iid=$this->session->userdata('userid');
                $wh = array("p3"=>$iid);
               $res = $this->um->selectres('user_transactions');
               $this->db->where($wh);
               $this->db->from("user_transactions");
              echo $this->db->count_all_results(); ?></td>
              
              
             
              
              <td>ELT <?php   $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p3',$iid);
                 
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level4=$pay*5/100;
                     echo $level4/2;

                  ?></td>



                      </tr>
                      <tr>
                          
                      
                       
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
  
  