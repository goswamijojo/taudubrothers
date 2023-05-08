
<!--<div class="page-title-area">-->
<!--<div class="d-table">-->
<!--<div class="d-table-cell">-->
<!--<div class="container">-->
<!--<div class="title-content">-->
<!--<h3>Dashboard</h3>-->
<!--<ul>-->
<!--<li>-->
<!--<a href="<?php echo base_url();?>">Home</a>-->
<!--</li>-->
<!--<li>-->
<!--<span>Dashboard</span>-->
<!--</li>-->
<!--</ul>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--<div class="title-img">-->
<!--<img src="<?php echo base_url();?>web/assets/images/page-title2.jpg" alt="About">-->
<!--<img src="<?php echo base_url();?>web/assets/images/shape16.png" alt="Shape">-->
<!--<img src="<?php echo base_url();?>web/assets/images/shape17.png" alt="Shape">-->
<!--<img src="<?php echo base_url();?>web/assets/images/shape18.png" alt="Shape">-->
<!--</div>-->
<!--</div>-->
<section class="dashboard-overview">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="left-side-tabs">
                    <div class="dashboard-left-links">
                        <a href="<?php echo base_url('dashboard_overview');?>" class="user-item active"><i
                                class="uil uil-apps"></i>Overview</a>
                        <a href="<?php echo base_url('user_profile');?>" class="user-item"><i class="uil uil-box"></i>My Profile</a>
                       
                        <?php if($user->kyc_status==0) { ?>
                         <a href="<?php echo base_url('kyc_vendor');?>" class="user-item"><i class="uil uil-wallet"></i>My KYC</a>
                         <?php } ?>
                         
                          <a href="<?php echo base_url('my_order');?>" class="user-item"><i class="uil uil-box"></i>My Orders</a>
                         <?php if(!empty($user->kyc_status)) { ?>
                         <a href="<?php echo base_url('add_product');?>" class="user-item"><i class="uil uil-wallet"></i>Add Product</a>
                         
                         
                        
                         <a href="<?php echo base_url('view_product');?>" class="user-item"><i class="uil uil-wallet"></i>View Product List</a>
                          <?php } ?>
                          <?php if($user->kyc_type > 0 ) { ?>
                           <a href="<?php echo base_url('seller_order');?>" class="user-item"><i class="uil uil-wallet"></i>Seller Order</a>
                          
                          <?php } ?>
                        <a href="<?php echo base_url('wishlist');?>" class="user-item"><i class="uil uil-heart"></i>Shopping
                            Wishlist</a>
                        <!--<a href="<?php echo base_url('add_address');?>" class="user-item"><i class="uil uil-location-point"></i>My-->
                        <!--    Address</a>-->
                        <a href="<?php echo base_url();?>logout" class="user-item"><i class="uil uil-exit"></i>Logout</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="dashboard-right">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-title-tab">
                                <h4><i class="uil uil-apps"></i>Overview</h4>
                            </div>
                            <div class="welcome-text">
                                <h2>Hi! <?php if(!empty($user->name)) { echo ucfirst($user-> name) ; }?></h2>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6 col-md-12">
                            <div class="pdpt-bg">
                                <div class="pdpt-title">
                                    <h4>My Rewards</h4>
                                </div>
                                <div class="ddsh-body">
                                    <h2>6 Rewards</h2>
                                    <ul>
                                        <li>
                                            <a href="#" class="small-reward-dt hover-btn">Won $2</a>
                                        </li>
                                        <li>
                                            <a href="#" class="small-reward-dt hover-btn">Won 40% Off</a>
                                        </li>
                                        <li>
                                            <a href="#" class="small-reward-dt hover-btn">Caskback $1</a>
                                        </li>
                                        <li>
                                            <a href="#" class="rewards-link5">+More</a>
                                        </li>
                                    </ul>
                                </div>
                                <a href="#" class="more-link14">Rewards and Details <i
                                        class="uil uil-angle-double-right"></i></a>
                            </div>
                        </div> -->
                        <!-- <div class="col-lg-6 col-md-12">
                            <div class="pdpt-bg">
                                <div class="pdpt-title">
                                    <h4>My Orders</h4>
                                </div>
                                <div class="ddsh-body">
                                    <h2>2 Recently Purchases</h2>
                                    <ul class="order-list-145">
                                        <li>
                                            <div class="smll-history">
                                                <div class="order-title">2 Items <span data-inverted=""
                                                        data-tooltip="2kg broccoli, 1kg Apple"
                                                        data-position="top center">?</span></div>
                                                <div class="order-status">On the way</div>
                                                <p>$22</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <a href="#" class="more-link14">All Orders <i
                                        class="uil uil-angle-double-right"></i></a>
                            </div>
                        </div> -->
                        <div class="col-lg-12 col-md-12">
                            <!-- <div class="pdpt-bg">
                                <div class="pdpt-title">
                                    <h4>My Wallet</h4>
                                </div>
                                <div class="wllt-body">
                                    <h2>Credits $100</h2>
                                    <ul class="wallet-list">
                                        <li>
                                            <a href="#" class="wallet-links14"><i class="uil uil-card-atm"></i>Payment
                                                Methods</a>
                                        </li>
                                        <li>
                                            <a href="#" class="wallet-links14"><i class="uil uil-gift"></i>3 offers
                                                Active</a>
                                        </li>
                                        <li>
                                            <a href="#" class="wallet-links14"><i class="uil uil-coins"></i>Points
                                                Earning</a>
                                        </li>
                                    </ul>
                                </div>
                                <a href="#" class="more-link14">Rewards and Details <i
                                        class="uil uil-angle-double-right"></i></a>
                            </div> -->
                            <!--<div class="pdpt-bg">
                                <div class="pdpt-title">
                                    <h4>My Orders</h4>
                                </div>
                                <div class="ddsh-body">
                                    <h2>2 Recently Purchases</h2>
                                    <ul class="order-list-145">
                                        <li>
                                            <div class="smll-history">
                                                <div class="order-title">2 Items <span data-inverted=""
                                                        data-tooltip="2kg broccoli, 1kg Apple"
                                                        data-position="top center">?</span></div>
                                                <div class="order-status">On the way</div>
                                                <p>$22</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <a href="<?php echo base_url()?>my_order" class="more-link14">All Orders <i
                                        class="uil uil-angle-double-right"></i></a>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   


    </section>
