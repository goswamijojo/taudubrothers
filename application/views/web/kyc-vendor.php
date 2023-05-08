<?php
include_once("header.php")
?>

<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-content">
                    <h2>KYC</h2>
                    <ul>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <span>kyc</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="title-img">
        <img src="assets/images/page-title1.jpg" alt="About">
        <img src="assets/images/shape16.png" alt="Shape">
        <img src="assets/images/shape17.png" alt="Shape">
        <img src="assets/images/shape18.png" alt="Shape">
    </div>
</div>


<div class="user-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="left-side-tabs">
                    <div class="dashboard-left-links">
                        <a href="dashboard_overview.php" class="user-item"><i class="uil uil-apps"></i>Overview</a>
                        <a href="dashboard_my_orders.php" class="user-item"><i class="uil uil-box"></i>My Orders</a>
                        <a href="kyc-vendor.php" class="user-item active"><i class="uil uil-wallet"></i>My KYC</a>
                        <a href="add_product.php" class="user-item"><i class="uil uil-wallet"></i>Add Product</a>
                        <a href="dashboard_my_wishlist.php" class="user-item"><i class="uil uil-heart"></i>Shopping
                            Wishlist</a>
                        <a href="dashboard_my_addresses.php" class="user-item "><i
                                class="uil uil-location-point"></i>My
                            Address</a>
                        <a href="sign_in.php" class="user-item"><i class="uil uil-exit"></i>Logout</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="user-item-form">
                    <form>
                        <h2>Vendor KYC Form</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="form-label">Enter Your Name*</label>
                                    <input type="text" class="form-control" placeholder="Name:">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="form-label">Enter Your Shop Name*</label>
                                    <input type="text" class="form-control" placeholder="Shop Name:">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Description" id=""
                                        style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Description</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="form-label">Pan Number*</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Pan Number:">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="form-label">Add Your Pan card Image</label>
                                <input type="file" class="custom-file-input" id="inputGroupFile01"
                                    aria-describedby="inputGroupFileAddon01">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="form-label">Adhar Number*</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Adhar Number:">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Add Your Adhar card Image</label>
                                <input type="file" class="custom-file-input" id="inputGroupFile01"
                                    aria-describedby="inputGroupFileAddon01">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="form-label">GST Number*</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="GST Number:">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Add Your GST Image</label>
                                <div class="input-group">

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                                            aria-describedby="inputGroupFileAddon01">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Shop Area*</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Shop Area:">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="form-label">Shop Town*</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Shop Town:">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Shop District*</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Shop District:">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="form-label">Shop State*</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Shop State:">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Shop Pincode*</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Shop Pincode:">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="form-label">Shop Landmark*</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Shop Landmark:">
                                </div>
                            </div>
                            <a href="dashboard_overview.php" class="btn common-btn">Submit</a>
                      


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("footer.php");
?>