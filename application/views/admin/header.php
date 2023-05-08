<!DOCTYPE html>
<html lang="en">
  

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url();?>Admin_dashborad/images/favicon/Fevicon-tb-icon.png">
    <title>Taudu Brothers | Admin Panel </title>
    
    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="<?php echo base_url();?>Admin_dashborad/assets/vendor_components/bootstrap/dist/css/bootstrap.css">
      
    <!--amcharts -->
    <link href="<?php echo base_url();?>Admin_dashborad/www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css" />
    
    <!-- theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>Admin_dashborad/css/style.css">
    
    <!-- Crypto Admin skins -->
    <link rel="stylesheet" href="<?php echo base_url();?>Admin_dashborad/css/skin_color.css">
    <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

     
  </head>

<body class="hold-transition dark-skin dark-sidebar sidebar-mini theme-yellow">
    
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo -->

    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <div>
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <i class="ti-align-left"></i>
          </a>
          
          <a href="#" data-provide="fullscreen" class="sidebar-toggle" title="Full Screen">
            <i class="mdi mdi-crop-free"></i>
          </a> 
        
      </div>
        
      <div class="navbar-custom-menu r-side">
        <ul class="nav navbar-nav">
          <!-- full Screen -->
          <!--<li class="search-bar">         -->
          <!--    <div class="lookup lookup-circle lookup-right">-->
          <!--       <input type="text" name="s">-->
          <!--    </div>-->
          <!--</li>         -->
         

          <!-- User Account-->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="User">
              <img src="<?php echo base_url();?>Admin_dashborad/images/avatar/7.jpg" class="user-image rounded-circle" alt="User Image">
            </a>
            <ul class="dropdown-menu animated flipInX">
              <!-- User image -->
              <li class="user-header bg-img" style="background-image: url(../images/user-info.jpg)" data-overlay="3">
                  <div class="flexbox align-self-center">                     
                    <img src="<?php echo base_url();?>Admin_dashborad/images/avatar/7.jpg" class="float-left rounded-circle" alt="User Image">                     
                    <h4 class="user-name align-self-center">
                      <span><?=ucfirst($this->session->userdata('name'));?></span>
                      
                    </h4>
                  </div>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url('Admin/logout');?>"><i class="ion-log-out"></i> Logout</a>
                    <div class="dropdown-divider"></div>
                    
              </li>
            </ul>
          </li>  
        </ul>
      </div>
    </nav>
  </header>


    <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar"> 
    
        <div class="user-profile">
      <div class="ulogo">
         <a href="<?php echo base_url();?>admin/dashboard">
          
          <h3><b>Admin</b> Dashboard</h3>
        </a>
      </div>
      <div class="profile-pic">
        <img src="<?php echo base_url();?>Admin_dashborad/images/avatar/7.jpg" alt="user">  
          <div class="profile-info"><h5 class="mt-15"><?=ucfirst($this->session->userdata('name'));?></h5>
            
          </div>
      </div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">
      
    <li class="">
          <a href="<?php echo base_url();?>admin/dashboard">
            <i class="ti-dashboard"></i>
            <span>Dashboard</span>
          </a>
    </li>




         <li>
          <a href="<?=base_url()?>admin/banner/">
            <i class="ti-pie-chart"></i>
           <span>Add Banner</span>
          </a>
        </li> 

        <!-- <li>
          <a href="<?=base_url()?>admin/best_seller">
            <i class="ti-pie-chart"></i>
           <span>Add Best Seller Product </span>
          </a>
        </li> -->
        
        <!--<li>
          <a href="<?=base_url()?>admin/sub_category">
            <i class="ti-pie-chart"></i>
           <span>Add Mens Products</span>
          </a>
        </li>-->

<li>
          <a href="<?=base_url()?>admin/category">
            <i class="ti-pie-chart"></i>
           <span>Add Category</span>
          </a>
        </li>
        
        <li>
          <a href="<?=base_url()?>admin/sub_category">
            <i class="ti-pie-chart"></i>
           <span>Add Sub Category</span>
          </a>
        </li> 



      <!--  <li>
          <a href="<?=base_url()?>admin/sub_subcategory">
            <i class="ti-pie-chart"></i>
           <span>Add Sub SubCategory</span>
          </a>
        </li> -->

         <li class="treeview">
          <a href="#">
            <i class="ti-pie-chart"></i>
            <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                 <li><a href="<?=base_url()?>Admin/product"><i class="ti-more"></i>Add Product</a></li>
                 <li><a href="<?=base_url()?>Admin/product_list"><i class="ti-more"></i>Manage Product</a></li>
                 <li><a href="<?=base_url()?>Admin/seller_product_manage"><i class="ti-more"></i>Seller Product Manage</a></li>
            
          </ul>
        </li> 
        <li class="treeview">
          <a href="#">
            <i class="ti-pie-chart"></i>
            <span>Brand</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
      <li><a href="<?=base_url()?>Admin/brand"><i class="ti-more"></i>Add Brand</a></li>
           
          </ul>
        </li> 
        <li class="treeview">
          <a href="#">
            <i class="ti-pie-chart"></i>
            <span>Color</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
      <li><a href="<?=base_url()?>Admin/color"><i class="ti-more"></i>Add Color</a></li>
           
          </ul>
        </li>
        
         <li>
          <a href="<?=base_url()?>admin/user_list">
            <i class="ti-pie-chart"></i>
           <span>User List</span>
          </a>
        </li> 

         
           <li>
          <a href="<?=base_url()?>admin/order_list">
            <i class="ti-pie-chart"></i>
           <span>Order List</span>
          </a>
        </li> 

        
        
        <li>
          <a href="<?php echo base_url('Admin/testimonial'); ?>">
            <i class="ti-pie-chart"></i>
           <span>Testimonial</span>
          </a>
        </li> 
        <li>
          <a href="<?php echo base_url('Admin/blog'); ?>">
            <i class="ti-pie-chart"></i>
           <span>Blog</span>
          </a>
        </li> 
        <li>
          <a href="<?php echo base_url('Admin/delivery_enquiry'); ?>">
            <i class="ti-pie-chart"></i>
           <span>Delivery Enquiry</span>
          </a>
        </li> 
         <li>
          <a href="<?php echo base_url('Admin/connect_seller_list'); ?>">
            <i class="ti-pie-chart"></i>
           <span>Contact to Seller Request</span>
          </a>
        </li> 

          <li>
          <a href="<?=base_url()?>admin/notifaction">
            <i class="ti-pie-chart"></i>
           <span>Add Notification</span>
          </a>
        </li>  
      
        <li>
          <a href="<?php echo base_url();?>admin/logout">
            <i class="ti-power-off"></i>
      <span>Log Out</span>
          </a>
        </li> 
        
      </ul>
    </section>
  </aside>

    <script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
function myFunctionWallet() {
  var copyText = document.getElementById("myWallet");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>
<script type="text/javascript">
  document.getElementById("copyButton").addEventListener("click", function() {
    copyToClipboard(document.getElementById("copyTarget"));
});

function copyToClipboard(elem) {
    // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
        succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}
</script>