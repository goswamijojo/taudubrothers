<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	function pr($data)
	{
		echo "<pre>";
		print_r($data);
		die;
	}

    function get_user_name($id)
    {
	   $ci =& get_instance();
	   // $class = $ci->db->query("SELECT * FROM user_registeration WHERE userid='$id' and status=1 ");
	   $class = $ci->db->query("SELECT * FROM user_registeration WHERE userid='$id' ");
       $class = $class->row();
	   return $class;
	}
	function get_user_info1($id)
    {
	   $ci =& get_instance();
	   $class = $ci->db->query("SELECT * FROM matching_income WHERE id='$id'");
       $class = $class->row();
	   return $class;
	}


  function get_kyc($id)
    {
	   $ci =& get_instance();
	   $class = $ci->db->query("SELECT * FROM userkyc_details WHERE userid='$id'");
       $class = $class->row();
	   return $class;
	}

	function check_duplicate_sponser_left($sponsor_id)
    {
    	  $ci =& get_instance();
          $class = $ci->db->query("SELECT * FROM user_registeration WHERE position = 'Left' AND sponsor_id = '$sponsor_id'");
          $class = $class->result();
          return $class;
    }

     function check_duplicate_sponser_right($sponsor_id)
    {
    	  $ci =& get_instance();
          $class = $ci->db->query("SELECT * FROM user_registeration WHERE position = 'Right' AND sponsor_id = '$sponsor_id'");
          $class = $class->result();
          return $class;
    }


	function my_left_Dline($uid)
    {
      $ci =& get_instance();
	  $class = $ci->db->query("SELECT * FROM user_registeration WHERE FIND_IN_SET($uid,left_parent) ORDER BY id DESC LIMIT 1");
      return $class = $class->row();
      // return $class = $class->result();
      // return $class->userid;
    }

    function my_right_Dline($uid)
    {
      $ci =& get_instance();
	$class = $ci->db->query("SELECT * FROM user_registeration WHERE  FIND_IN_SET($uid,right_parent) ORDER BY id DESC LIMIT 1");
      return $class = $class->row();
      // return $class->userid;
    }

	 function get_left_dline_carry_fwd($id)
     {
	   $ci =& get_instance();
	   $class = $ci->db->query("SELECT * FROM user_registeration WHERE  FIND_IN_SET($id,parent_id) AND status=1 AND carry_fwd_status=0");
       $class = $class->result();
	   return $class;
	 }

	 function get_right_dline_carry_fwd($id)
     {
	   $ci =& get_instance();
	   $class = $ci->db->query("SELECT * FROM user_registeration WHERE  FIND_IN_SET($id,parent_id) AND status=1 AND carry_fwd_status=0");
       $class = $class->result();
	   return $class;
	 }


	function matching_amount_by_Date($id,$date)
    {
	   $ci =& get_instance();
	   $class = $ci->db->query("SELECT * FROM matching_income WHERE user_id='$id' and cr_date='$date' ORDER BY id desc limit 1");
       $class = $class->row();
	   return $class;
	}
	function get_users_list_id($idd){
		$ci =& get_instance();
    	$class = $ci->db->query("SELECT * FROM user_registeration WHERE id='$idd' AND status='1'");
    	$class = $class->row();
	  	return $class;
	}

	function get_users_details($userid){
		$ci =& get_instance();
      $class = $ci->db->query("SELECT * FROM user_registeration WHERE  FIND_IN_SET($userid,parent_id)");
      $class = $class->result();
      return $class;
	}

	function get_left_downline_total($id){
		$ci =& get_instance();
	    $class = $ci->db->query("SELECT * FROM user_registeration WHERE  FIND_IN_SET($id,parent_id)");
	    $class = $class->result();
	    return $class;
	}

	function get_right_downline_total($id){
		$ci =& get_instance();
	    $class = $ci->db->query("SELECT * FROM user_registeration WHERE  FIND_IN_SET($id,parent_id)");
	    $class = $class->result();
	    return $class;
	}
	function get_matching_income($id){
 		$ci =& get_instance();
    	$class = $ci->db->query("SELECT * FROM matching_income WHERE `user_id`='$id'  ORDER BY id desc limit 1");
    	$class = $class->row();
  		return $class;
	}

	function get_allMatched_ID($id,$matchid){
 		$ci =& get_instance();
    	// $class = $ci->db->query("SELECT * FROM matching_income WHERE `user_id`='$id' AND NOT IN (SELECT * FROM matching_income WHERE FIND_IN_SET($matchid,`from`))");

    $class=$ci->db->query("SELECT * FROM matching_income WHERE `user_id`='$id' AND `from` IN('$matchid')");
    	$class = $class->result();
  		return $class;
	}

	function get_matching_Ids($id){
 		$ci =& get_instance();
    	$class = $ci->db->query("SELECT * FROM matching_income WHERE `user_id`='$id'");
    	$class = $class->result();
  		return $class;
	}
	function get_users_list(){
		$ci =& get_instance();
    	$class = $ci->db->query("SELECT * FROM user_registeration WHERE role='0' AND status='1'");
    	$class = $class->result();
	  	return $class;
	}
	
	function get_sponsor_downline_list($user_id,$position){
    	$ci =& get_instance();
    	$class = $ci->db->query("SELECT * FROM user_registeration WHERE  FIND_IN_SET($user_id,parent_id) and position='$position' order by id desc limit 1");
	    $class = $class->row();
  		return $class;
	}

	/*---------------------------------------*/
	function get_my_first_user($user_id,$position){   
    	$ci =& get_instance();
       $class = $ci->db->query("SELECT * FROM user_registeration WHERE refered_by='$user_id' AND sponsor_id='$user_id' AND position='$position' AND status=1");
    	$class = $class->row();
  		return $class;
	}
	// function get_my_first_user($user_id,$position){   
 //    	$ci =& get_instance();
 //    	$class = $ci->db->query("SELECT * FROM user_registeration WHERE refered_by='$user_id' AND position='$position' AND status=1");
 //    	$class = $class->row();
 //  		return $class;
	//}
	/*-----------------------------------------*/

	function get_my_first_downline_user($user_id){   
    	$ci =& get_instance();
    	$class = $ci->db->query("SELECT * FROM user_registeration WHERE FIND_IN_SET($user_id,parent_id) AND position='Left' AND status=1 LIMIT 1");
    	$class = $class->row();
  		return $class;
	}
	function get_my_second_downline_user($user_id){   
    	$ci =& get_instance();
    	$class = $ci->db->query("SELECT * FROM user_registeration WHERE FIND_IN_SET($user_id,parent_id) AND position='Right' AND status=1 LIMIT 1");
    	$class = $class->row();
  		return $class;
	}

	function get_my_downline_user1($user_id,$position){
	  $ci =& get_instance();
      $class = $ci->db->query("SELECT * FROM user_registeration WHERE  FIND_IN_SET($user_id,$position)");
      $class = $class->result();
      return $class;
    }
   function get_my_downline_user($user_id){
	  $ci =& get_instance();
      $class = $ci->db->query("SELECT * FROM user_registeration WHERE  FIND_IN_SET($user_id,parent_id)");
      $class = $class->result();
      return $class;
    }

    function get_allMatched_ID_L($id,$matchid){
$ci =& get_instance();
// $class = $ci->db->query("SELECT FROM matching_income WHERE `user_id`='$id' AND NOT IN (SELECT FROM matching_income WHERE FIND_IN_SET($matchid,`from`))");
$class=$ci->db->query("SELECT * FROM matching_income WHERE `user_id`='$id' AND left_from='$matchid'");
$class = $class->result();
return $class;
}
function get_allMatched_ID_R($id,$matchid){
$ci =& get_instance();
 $class=$ci->db->query("SELECT * FROM matching_income WHERE `user_id`='$id' AND right_from='$matchid'");
$class = $class->result();
return $class;
}

	function get_sponsor_info($sponsor_id){
 		$ci =& get_instance();
	    $class = $ci->db->query("SELECT * FROM user_registeration WHERE  userid='$sponsor_id'");
    	$class = $class->row();
	  	return $class;
	}
	function GetChildMemberById($s_id) 
     {  
     	$ci =& get_instance();
	    $ci->db->select('userid');
    	$ci->db->from("user_registeration");
    	$ci->db->where("sponsor_id",$s_id);
    	$ci->db->order_by("position","asc");
      	$query = $ci->db->get();
    	if ($query) {
      		 return $query->result_array();
     	} else { return false;
     }
    }

	function get_my_right_direct_downline($sponsor_id)
	{
     	$ci =& get_instance();
    	$class = $ci->db->query("SELECT * FROM user_registeration WHERE  sponsor_id='$sponsor_id' and position='Right'");
	    $class = $class->row();
  		return $class;
    }

	function get_user_info_by_user_id($user_id)
	{
 		$ci =& get_instance();
    	 $class = $ci->db->query("SELECT * FROM user_registeration WHERE userid='$user_id'");
	    $class = $class->row();
 		return $class;
	}

	function get_my_left_direct_downline($sponsor_id)
	{
     	$ci =& get_instance();
   		$class = $ci->db->query("SELECT * FROM user_registeration WHERE  sponsor_id='$sponsor_id' and position='Left'");
	    $class = $class->row();
 		return $class;
    }

	function get_sponsor_direct_downline($sponsor_id){    
 	$ci =& get_instance();
  	$class = $ci->db->query("SELECT * FROM user_registeration WHERE  sponsor_id='$sponsor_id'");
    $class = $class->result();
  	return $class;
	}

	function get_payout_details($userid){
	 $ci =& get_instance();
     $class = $ci->db->query("SELECT * FROM payout_details WHERE  user_id='$userid' order by id desc limit 1");
     $class = $class->row();
  	 return $class;
	}
		function get_dircet_income_details($userid){
	 $ci =& get_instance();
     $class = $ci->db->query("SELECT * FROM direct_income WHERE  user_id='$userid' order by id desc limit 1");
     $class = $class->row();
  	 return $class;
	}

	function get_payout_for_payment($userid,$from_date,$to_date){
	 $ci =& get_instance();
     $class = $ci->db->query("SELECT * FROM payout_details WHERE  user_id='$userid' AND created_at 
     	>='$from_date' AND created_at <='$to_date' order by id desc limit 1");   
     $class = $class->row();
  	 return $class;
	}

	function get_carry_fordword($userid){
	 $ci =& get_instance();
     $class = $ci->db->query("SELECT * FROM carry_fordword WHERE  user_id='$userid' order by id desc limit 1");
     $class = $class->row();
  	 return $class;
	}


	function countId($userid){
	 $ci =& get_instance();
     $class = $ci->db->query("SELECT * FROM payout_details WHERE  user_id='$userid'");
     $class = $class->num_rows();
  	 return $class;
	}

	function countleft($id)
	{
		$ci =& get_instance();
		$class = $ci->db->query("SELECT * FROM user_registeration WHERE FIND_IN_SET($id,parent_id) AND position = 'Left'");
		// $ci->db->where('position','Left');
	 //    $ci->db->like('parent_id',$id);
	 //    $class=$ci->db->get('user_registeration');	 
     	$class = $class->num_rows();
  	 	return $class;
	}

	function countright($id){
		// $ci =& get_instance();
		// $ci->db->where('position','Right');
	 //    $ci->db->like('parent_id',$id);
	 //    $class=$ci->db->get('user_registeration');	 
  //    	$class = $class->num_rows();
  // 	 	return $class;

		$ci =& get_instance();
		$class = $ci->db->query("SELECT * FROM user_registeration WHERE FIND_IN_SET($id,parent_id)  AND position = 'Right'");
     	$class = $class->num_rows();
  	 	return $class;

	}

	function countmatchingIncome($userid){
	 $ci =& get_instance();
     $class = $ci->db->query("SELECT * FROM matching_income WHERE  user_id='$userid'");
     $class = $class->num_rows();
  	 return $class;
	}

	function get_direct_income($id){
	 	$ci =& get_instance();
	    $class = $ci->db->query("SELECT * FROM direct_income WHERE user_id='$id' ORDER BY id desc limit 1");
	    $class = $class->row();
	    return $class;
	}

	function get_dimb($id){
	 	$ci =& get_instance();
	    $class = $ci->db->query("SELECT * FROM direct_matching_bonus WHERE user_id='$id' ORDER BY id desc limit 1");
	    $class = $class->row();
	    return $class;
	}

	function get_referedby_info($refered_by){
		$ci =& get_instance();
		$class = $ci->db->query("SELECT * FROM user_registeration WHERE  userid='$refered_by'");
		$class = $class->row();
		return $class;
	}
	function get_user_info($id)
    {
	   $ci =& get_instance();
	   $class = $ci->db->query("SELECT * FROM user_registeration WHERE id='$id'");
       $class = $class->row();
	   return $class;
	}

	function countAllUser()
    {
	   $ci =& get_instance();
	   $class = $ci->db->query("SELECT * FROM user_registeration WHERE role='0'");
       $class = $class->num_rows();
	   return $class;
	}
	function activeUser()
    {
	   $ci =& get_instance();
	   $class = $ci->db->query("SELECT * FROM user_registeration WHERE role='0' AND status='1'");
       $class = $class->num_rows();
	   return $class;
	}
	function inactiveUser()
    {
	   $ci =& get_instance();
	   $class = $ci->db->query("SELECT * FROM user_registeration WHERE role='0' AND status='0'");
       $class = $class->num_rows();
	   return $class;
	}
 ?>