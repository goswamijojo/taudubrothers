   
   
   <div class="container">
    <div class="col-lg-12 col-md-12">
               <div class="dashboard-right">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="main-title-tab">
                           
                          <h4><i class="uil uil-box"></i>Seller Profile</h4>
                        </div>
                     </div>
                    
                     <div class="col-lg-12 col-md-12">
                       <div class="row">
                     <?php foreach($seller_profile as $result){ 
                         
                
                     ?> 
                     
                     <?php
                     $user_id=$this->session->userdata('user_id');
                     $follow_status = $this->db->select('*')->from('tbl_follower')->where(array('vendor_id'=>$result['id'],'user_id'=>$user_id))->get()->row_array();
                     $count=$this->db->where(array('vendor_id'=>$result['id']))->get('tbl_follower');
                     $follower_count = $count->num_rows();
                    //echo $this->db->last_query();
                                        
                         ?>
                                         
                     <div class="pdpt-bg col-lg-6 col-md-12">
                           <div class="pdpt-title">
                              <h6>Profile Details </h6>
                           </div>
                           <div class="order-body10">
                              <ul class="order-dtsll">
                                 <li>
                                    <div class="order-dt-img" style="border-radius: 50%;">
                                       <img src="<?=  $result['profile_image']?$result['profile_image']:base_url().'web/assets/images/tudulogo.png'; ?>" alt="" >
                                    </div>
                                 </li>
                                 <li>
                                    <div class="order-dt47">
                                        <a href="<?php echo base_url('seller_shop_list/').$result['user_id']?>" target="_blank">
                                       <h4><?php echo $result['name'];?></h4>
                                       <!--<p><i class="flaticon-phone-call"></i> &nbsp; +91- <?php echo $result['mobile_no'];?></p>-->
                                       
                                        <p><i class="flaticon-email" style="color:#3e3f5e;"></i> &nbsp; <a href="mailto:<?php echo $result['email'];?>"><?php echo $result['email'];?></a></p>
                                        <p><i class="fa fa-user"></i> &nbsp; <?php echo $follower_count ?></p>
                                        </a>
                                        <a href="<?php echo base_url('seller_shop_list/').$result['user_id']?>" class="btn btn-primary" style="background-color:#980000;border: 1px solid #980000">Seller Product List</a>
                                        <!--<a href="<?php echo base_url('seller_shop_list/').$result['user_id']?>" class="btn btn-primary" style="background-color:#980000;border: 1px solid #980000;">Follow</a>-->
                                        
                                        
                                        
                                         <?php if($follow_status['follower_status'] ==1) { ?>
                                        
                                        <button type="button" id="follow_<?php echo $result['user_id']; ?>" data-userid="<?php echo $result['user_id']; ?>" data-Id="<?php echo $result['id']; ?>" class="btn btn-primary follow msg" style="background-color:#980000;border: 1px solid #980000;">UnFollow</button>
                                    <?php } else{ ?>
                                    <button type="button" id="follow_<?php echo $result['user_id']; ?>" data-userid="<?php echo $result['user_id']; ?>" data-Id="<?php echo $result['id']; ?>" class="btn btn-primary follow msg" style="background-color:#980000;border: 1px solid #980000;">Follow</button>
                                    <?php } ?>
                                    </div>
                                    
                                    
                                 </li>
                              </ul>
                          
                              
                           </div>
                        </div>
                                                 
                         <?php } ?>
                         
                                                

                     </div>
                       </div>
                  </div>
               </div>
            </div>
    </div>  
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.follow', function(){
	var userId = $(this).data("userid");
	
	var id = $(this).data("id");
	
	
	$.ajax({
		url:'<?php echo base_url('web/followers')?>',
		method:"POST",
		data:{userId:userId,id:id,status:status},
		dataType:"json",
		success: function(data) {
            console.log(data);
            if(data.status=='success'){
                 ShowNotificator('success',data.message);
                 $('.msg').html('<span">UnFollow</span>');
                 location.reload();
                 
                 
            }else{
                ShowNotificator('warning',data.message);
                $('.msg').html('<span>Follow</span>');
                location.reload();
                
            }
        }
	});
});
    </script>