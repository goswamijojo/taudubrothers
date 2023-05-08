<?php
include_once("header.php")
?>
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-content">
                    <h2>My Address</h2>
                    <ul>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <span>My Address</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="title-img">
        <img src="assets/images/page-title2.jpg" alt="About">
        <img src="assets/images/shape16.png" alt="Shape">
        <img src="assets/images/shape17.png" alt="Shape">
        <img src="assets/images/shape18.png" alt="Shape">
    </div>
</div>
<section class="dashboard-overview">
    
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="left-side-tabs">
                        <div class="dashboard-left-links">
                            <a href="dashboard_overview.php" class="user-item"><i class="uil uil-apps"></i>Overview</a>
                            <a href="dashboard_my_orders.php" class="user-item"><i class="uil uil-box"></i>My Orders</a>
                            <a href="kyc-vendor.php" class="user-item"><i class="uil uil-wallet"></i>My KYC</a>
                            <a href="add_product.php" class="user-item"><i class="uil uil-wallet"></i>Add Product</a>
                            <a href="dashboard_my_wishlist.php" class="user-item"><i
                                    class="uil uil-heart"></i>Shopping
                                Wishlist</a>
                                
                            <a href="dashboard_my_addresses.php" class="user-item active"><i
                                    class="uil uil-location-point"></i>My
                                Address</a>
                            <a href="sign_in.php" class="user-item"><i class="uil uil-exit"></i>Logout</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-right">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-title-tab">
                                    <h4><i class="uil uil-location-point"></i>My Address</h4>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="pdpt-bg">
                                    <div class="pdpt-title">
                                        <h4>My Address</h4>
                                    </div>
                                    <div class="address-body">
                                        <a href="#" class="add-address hover-btn" data-toggle="modal"
                                            data-target="#address_model">Add New Address</a>
                                        <div class="address-item">
                                            <div class="address-icon1">
                                                <i class="uil uil-home-alt"></i>
                                            </div>
                                            <div class="address-dt-all">
                                                <h4>Home</h4>
                                                <p>#0000, St No. 8, Shahid Karnail Singh Nagar, MBD Mall, Frozpur road,
                                                    Ludhiana, 141001</p>
                                                <ul class="action-btns">
                                                    <li><a href="#" class="action-btn"><i class="uil uil-edit"></i></a>
                                                    </li>
                                                    <li><a href="#" class="action-btn"><i
                                                                class="uil uil-trash-alt"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="address-item">
                                            <div class="address-icon1">
                                                <i class="uil uil-home-alt"></i>
                                            </div>
                                            <div class="address-dt-all">
                                                <h4>Office</h4>
                                                <p>#0000, St No. 8, Shahid Karnail Singh Nagar, MBD Mall, Frozpur road,
                                                    Ludhiana, 141001</p>
                                                <ul class="action-btns">
                                                    <li><a href="#" class="action-btn"><i class="uil uil-edit"></i></a>
                                                    </li>
                                                    <li><a href="#" class="action-btn"><i
                                                                class="uil uil-trash-alt"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="address-item">
                                            <div class="address-icon1">
                                                <i class="uil uil-home-alt"></i>
                                            </div>
                                            <div class="address-dt-all">
                                                <h4>Other</h4>
                                                <p>#0000, St No. 8, Shahid Karnail Singh Nagar, MBD Mall, Frozpur road,
                                                    Ludhiana, 141001</p>
                                                <ul class="action-btns">
                                                    <li><a href="#" class="action-btn"><i class="uil uil-edit"></i></a>
                                                    </li>
                                                    <li><a href="#" class="action-btn"><i
                                                                class="uil uil-trash-alt"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    



</section>

<?php
include("footer.php");
?>