
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-content">
                    <h2>My Address</h2>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
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
        <img src="<?php echo base_url();?>web/assets/images/page-title2.jpg" alt="About">
        <img src="<?php echo base_url();?>web/assets/images/shape16.png" alt="Shape">
        <img src="<?php echo base_url();?>web/assets/images/shape17.png" alt="Shape">
        <img src="<?php echo base_url();?>web/assets/images/shape18.png" alt="Shape">
    </div>
</div>
<section class="dashboard-overview">
    
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="left-side-tabs">
                        <div class="dashboard-left-links">
                            <a href="<?php echo base_url('dashboard_overview');?>" class="user-item"><i class="uil uil-apps"></i>Overview</a>
                            <a href="dashboard_my_orders.php" class="user-item"><i class="uil uil-box"></i>My Orders</a>
                            <?php if(empty($user->kyc_status)) { ?>
                         <a href="<?php echo base_url('kyc_vendor');?>" class="user-item"><i class="uil uil-wallet"></i>My KYC</a>
                         <?php } ?>
                         <?php if(!empty($user->kyc_status)) { ?>
                            <a href="<?php echo base_url('add_product');?>" class="user-item"><i class="uil uil-wallet"></i>Add Product</a>
                            <?php } ?>
                            <a href="<?php echo base_url('wishlist');?>" class="user-item"><i
                                    class="uil uil-heart"></i>Shopping
                                Wishlist</a>
                                
                            <a href="<?php echo base_url('add_address');?>" class="user-item active"><i
                                    class="uil uil-location-point"></i>My
                                Address</a>
                            <a href="<?php echo base_url('logout');?>" class="user-item"><i class="uil uil-exit"></i>Logout</a>
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
                                       <?php if(!empty($this->session->flashdata('error'))){?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <?php echo $this->session->flashdata('error'); ?>
                                        </div>
                                        <?php } ?>
                                         <?php if(!empty($this->session->flashdata('success'))){?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <?php echo $this->session->flashdata('success'); ?>
                                        </div>
                                        <?php } ?>
                                    
                                    <div class="address-body">
                                        <a href="#" class="add-address hover-btn" data-bs-toggle="modal"
                                        data-bs-target="#address_model">
                                        Add New Address
                                    </a>
                                        
                                        <?php foreach($address as $res){ ?>
                                        <div class="address-item">
                                            <div class="address-icon1">
                                                <img class="uil uil-home-alt" src="<?php echo base_url() ?>web/assets/images/home.png"/> 
                                            </div>
                                            <div class="address-dt-all">
                                                <h4><?php echo $res->address_type ?></h4>
                                                <p><?php echo $res->name .' , ' .$res->area_street .' , ' . $res->town_village.' , '.$res->city .' , '. $res->state  ?>  Land Mark-<?= $res->landmark ?> , <?= $res->pin_code ?></p>
                                                <ul class="action-btns">
                                                    <li><a href="#" class="action-btn"><i class="uil uil-edit"></i></a>
                                                    </li>
                                                    <li><a href="<?php echo base_url() ?>delete_address/<?= $res->address_id ?>" class="action-btn"> <img class="uil uil-home-alt" src="<?php echo base_url() ?>web/assets/images/delete.png"/> </a></li>
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
            </div>
        </div>
</section>


<div class="modal fade" id="address_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="cate-header">
                    <h4>Add New Address</h4>
                </div>
                <div class="add-address-form">
                    <div class="checout-address-step">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="" action="<?php echo base_url(); ?>add_address_user" method="post">

                                    <div class="form-group">
                                        <div class="product-radio">
                                            <ul class="product-now">
                                                <li>
                                                    <input type="radio" id="ad1" name="address_type" value="Home" checked>
                                                    <label for="ad1">Home</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="ad2" name="address_type" value="Office">
                                                    <label for="ad2">Office</label>
                                                </li>
                                                <!--<li>-->
                                                <!--    <input type="radio" id="ad3" name="address1">-->
                                                <!--    <label for="ad3">Other</label>-->
                                                <!--</li>-->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="address-fieldset">
                                        <div class="row">
                                             <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Street / Society / Office Name*</label>
                                                    <input id="street" name="name" type="text"
                                                        placeholder="Street / Society / Office Name" class="form-control input-md">
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Area /Street / Block.*</label>
                                                    <input id="flat" name="area_street" type="text" placeholder="Area /Street / Block."
                                                        class="form-control input-md" required="">
                                                </div>
                                            </div>
                                           
                                           <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Town / Village*</label>
                                                    <input id="flat" name="town_village" type="text" placeholder="Town / Village"
                                                        class="form-control input-md" required="">
                                                </div>
                                            </div>
                                           <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">District/City*</label>
                                                    <input id="flat" name="city" type="text" placeholder="District/City"
                                                        class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">State*</label>
                                                    <input id="flat" name="state" type="text" placeholder="State"
                                                        class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Phone*</label>
                                                    <input id="flat" name="mobile_no" type="text" placeholder="Phone"
                                                        class="form-control input-md" required="">
                                                </div>
                                            </div>
                                             <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Pincode*</label>
                                                    <input id="pincode" name="pin_code" type="text" placeholder="Pincode"
                                                        class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Locality/Land mark*</label>
                                                    <input id="Locality" name="landmark" type="text"
                                                        placeholder="Locality/Land mark" class="form-control input-md"
                                                        required="">
                                                </div>
                                            </div>

                                            <div class="address-btns">
                                                <button type="submit" class="save-btn14 hover-btn"
                                                   >Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
