
  
  
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
                    
                     <th>Total Business</th>
                  
                    <th>Total Income</th>
                </tr>
              </thead>
  <tbody>
                  <tr>
                      <td>1</td>
                        <td><a href="<?php echo base_url();?>User/first_level_user">Level 1</a></td>
                        <td><i class="fa fa-user"></i> <?php 
                $iid=$this->session->userdata('userid');
                $wh = array("refered_by" =>$iid);
               $res = $this->um->selectres('user_registeration');
               $this->db->where($wh);
               $this->db->from("user_registeration");
               echo $this->db->count_all_results(); ?></td>
               
                 
               <td>
                   USD <?php   $iid=$this->session->userdata('userid');
                    $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p1',$iid);
                 
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level1=$pay;
                    echo $level1/1;

                   ?>
               </td>
               
               <td>ELT <?php   

                    $iid=$this->session->userdata('userid');
                    $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p1',$iid);
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level1=$pay*10/100;
                    echo $level1/2;

                   ?></td>
                       
                         
                      </tr>
                      <tr>
                        <td>2</td>
                       <td><a href="<?php echo base_url();?>User/second_level_user">Level 2</a></td>
                        <td><i class="fa fa-user"></i><?php 
                $iid=$this->session->userdata('userid');
                $wh = array("p1"=>$iid);
               $res = $this->um->selectres('user_registeration');
               $this->db->where($wh);
               $this->db->from("user_registeration");
              echo $this->db->count_all_results(); ?></td>
                        
                        
                   <td>USD <?php  $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p2',$iid);
                  
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level2=$pay;
                     echo $level2/1;

                   ?></td>     
              
              
              <td>ELT <?php  $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p2',$iid);
                  
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level2=$pay*5/100;
                     echo $level2/2;

                   ?></td>
                   
                         
                      </tr>
                      <tr>
                        <td>3</td>                
                        <td><a href="<?php echo base_url();?>User/third_level_user">Level 3</a></td>
                        <td><i class="fa fa-user"></i><?php 
                $iid=$this->session->userdata('userid');
                $wh = array("p2"=>$iid);
               $res = $this->um->selectres('user_registeration');
               $this->db->where($wh);
               $this->db->from("user_registeration");
              echo $this->db->count_all_results(); ?></td>
              
              <td>USD <?php   $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p3',$iid);
                   
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level3=$pay;
                    echo $level3/1;

                   ?></td>
                        
              <td>ELT <?php   $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p3',$iid);
                   
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level3=$pay*5/100;
                    echo $level3/2;

                   ?></td>
                         
                        
                      </tr>
                      <tr>
                          <td>4</td>
                        <td><a href="<?php echo base_url();?>User/fourth_level_user">Level 4</a></td>
                        <td><i class="fa fa-user"></i> <?php 
                $iid=$this->session->userdata('userid');
                $wh = array("p3"=>$iid);
               $res = $this->um->selectres('user_registeration');
               $this->db->where($wh);
               $this->db->from("user_registeration");
              echo $this->db->count_all_results(); ?></td>
              
              
                  <td>USD <?php $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p4',$iid);
                  
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level4=$pay;
                     echo $level4/1;

                  ?></td>      
              
              
              <td>ELT <?php   $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p4',$iid);
                  
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level4=$pay*5/100;
                     echo $level4/2;

                  ?></td>



                      </tr>
                      <tr>
                          <td>5</td>
                        <td><a href="<?php echo base_url();?>User/fifth_level_user">Level 5</a></td>
                        <td><i class="fa fa-user"></i> <?php 
                $iid=$this->session->userdata('userid');
                $wh = array("p4"=>$iid);
               $res = $this->um->selectres('user_registeration');
               $this->db->where($wh);
               $this->db->from("user_registeration");
              echo $this->db->count_all_results(); ?></td>
              
              
              <td>USD <?php 
                    $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p5',$iid);
                  
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level5=$pay; 
                    echo $level5/1;
                    ?></td>
                        
              <td>ELT <?php 
                    $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p5',$iid);
                  
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level5=$pay*2/100; 
                    echo $level5/2;
                    ?>
                      
                    </td>


                         
                      </tr>
                      <tr>
                          <td>6</td>
                       <td><a href="<?php echo base_url();?>User/six_level_user">Level 6</a></td>
                        <td><i class="fa fa-user"></i> <?php 
                $iid=$this->session->userdata('userid');
                $wh = array("p5"=>$iid);
               $res = $this->um->selectres('user_registeration');
               $this->db->where($wh);
               $this->db->from("user_registeration");
              echo $this->db->count_all_results(); ?></td>
              
              
              
              <td>USD <?php $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p6',$iid);
                   
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    echo $level6=$pay/1;
                      

                   ?></td>
                        
              <td>ELT <?php    $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p6',$iid);
                   
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level6=$pay*1/100;
                      echo $level6/2;

                   ?></td>
                         
                      </tr>
                      <tr>
                          <td>7</td>
                       <td><a href="<?php echo base_url();?>User/seven_level_user">Level 7</a></td>
                        <td><i class="fa fa-user"></i> <?php 
                $iid=$this->session->userdata('userid');
                $wh = array("p6"=>$iid);
               $res = $this->um->selectres('user_registeration');
               $this->db->where($wh);
               $this->db->from("user_registeration");
              echo $this->db->count_all_results(); ?></td>
              
              <td>USD <?php    $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p7',$iid);
                 
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level7=$pay;
                    echo $level7/1;
                   ?></td>
                       
              <td>ELT <?php    $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p7',$iid);
                 
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level7=$pay*0.5/100;
                    echo $level7/2;
                   ?></td>   
                      </tr>
                      <tr>
                          <td>8</td>
                        <td><a href="<?php echo base_url();?>User/eight_level_user">Level 8</a></td>
                        <td><i class="fa fa-user"></i> <?php 
                $iid=$this->session->userdata('userid');
                $wh = array("p7"=>$iid);
               $res = $this->um->selectres('user_registeration');
               $this->db->where($wh);
               $this->db->from("user_registeration");
              echo $this->db->count_all_results(); ?></td>
              
              <td>USD <?php 
                    $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p8',$iid);
                   
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level8=$pay;
                     echo $level8/1;
 ?></td>
                       
              <td>ELT <?php 
                    $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p8',$iid);
                   
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level8=$pay*0.5/100;
                     echo $level8/2;
 ?></td>
 
 
            
                         
                      </tr>
                      
                      
                      
                       <tr>
                          <td>9</td>
                        <td><a href="<?php echo base_url();?>User/nine_level_user">Level 9</a></td>
                        <td><i class="fa fa-user"></i> <?php 
                $iid=$this->session->userdata('userid');
                $wh = array("p8"=>$iid);
               $res = $this->um->selectres('user_registeration');
               $this->db->where($wh);
               $this->db->from("user_registeration");
              echo $this->db->count_all_results(); ?></td>
              
              
              <td>USD <?php 
                    $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p9',$iid);
                    
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level9=$pay;
                     echo $level9/1;
 ?></td>
                        
              <td>ELT <?php 
                    $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p9',$iid);
                    
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level9=$pay*0.5/100;
                     echo $level9/2;
 ?></td>
 
 
            
                         
                      </tr>
                      
                      
                       <tr>
                          <td>10</td>
                       <td><a href="<?php echo base_url();?>User/ten_level_user">Level 10</a></td>
                        <td><i class="fa fa-user"></i> <?php 
                $iid=$this->session->userdata('userid');
                $wh = array("p9"=>$iid);
               $res = $this->um->selectres('user_registeration');
               $this->db->where($wh);
               $this->db->from("user_registeration");
              echo $this->db->count_all_results(); ?></td>
              
              
              
              <td>USD <?php 
                    $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p10',$iid);
                  
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level10=$pay;
                    echo $level10/1;
                  ?></td>
                        
              <td>ELT <?php 
                    $this->db->select_sum('payment_amount');
                    $this->db->from('user_transactions');
                    $this->db->where('p10',$iid);
                  
                    $query=$this->db->get();
                    $pay=$query->row()->payment_amount;
                    $level10=$pay*0.5/100;
                     echo $level10/2;
 ?></td>
 
 
            
                         
                      </tr>
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
  
  