<style>
    strike {
    color: #e35353;
    font-size: 14px;
    font-weight: 300;
}
    
.badge {
    display: inline-block;
    padding: .35em .65em;
    font-size: .75em;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25rem;
    position: absolute;
    background-color: red;
    left: 0;
}


.testimonials-item img {
    position: absolute;
    left: 0;
    right: 0;
    bottom: -50px;
    max-width: 104px;
    max-height: 105px;
    margin-left: auto;
    margin-right: auto;
    border: 6px solid #e7e6e6;
    border-radius: 50%;
}
.cart-text {
    /* margin-left: 20px; */
    width: 100%;
    font-size: 11px;
    font-weight: 700;
    position: relative;
}
.products-item .bottom i {
    display: inline-block;
    width: 60px;
    height: 60px;
    line-height: 42px;
    color: #980000;
    background-color: #fff;
    font-size: 25px;
    border: 10px solid #f5f5f5;
    border-radius: 50%;
    text-align: center;
    cursor: pointer;
    -webkit-transition: .5s;
    transition: .5s;
   
}
/*a.add_cart.cart-text {*/
/*    padding-left: -5px;*/
/*    margin-right: 38px;*/
/*    padding-right: 24px;*/
/*}*/
    
.products-item .top .inner h3 {
    margin-bottom: 6px;
    font-size: 14px;
    text-overflow: ellipsis;
    overflow: hidden;
    width: 170px;
    font-weight: 500;
    white-space: nowrap; 
}

h3 {
    font-weight: 700;
    color: #000000;
    font-family: poppins, sans-serif;
}

.products-item {
    text-align: center;
    background-color: #fff;
    border-radius: 10px;
    /* padding-bottom: 40px; */
    position: relative;
    -webkit-transition: .5s;
    transition: .5s;
    margin-bottom: 30px;
    height: 340px;
}

.products-thumb span {
    display: block;
    font-weight: 600;
    -webkit-transition: .5s;
    transition: .5s;
    /*margin-top: 100px;*/
}

.products-thumb img:nth-child(1) {
    left: 40px;
    bottom: 70px;
}
</style>
<div class="sale-area">
    <!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary popup-button" data-toggle="modal" data-target="#exampleModalLong" style="opacity:0;">-->
<!--  Launch demo modal-->
<!--</button>-->
    <!--<div class="container-fluid">-->
    <!--   <div class="row justify-content-center">-->
    <!--        <div class="col-sm-6 col-lg-4">-->
    <!--            <div class="sale-item sale-bg-one">-->
    <!--                <img src="<?php echo base_url(); ?>web/assets/images/sale-main1.png" alt="Sale">-->
    <!--                <div class="inner">-->
    <!--                    <h3><span class="percent">E-commerce</span></h3>-->
    <!--                   <p>Items you might like</p>-->
    <!--                    <a href="<?php echo base_url();?>">Shop Now</a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="col-sm-6 col-lg-4">-->
    <!--            <div class="sale-item sale-bg-two">-->
    <!--                <img src="<?php echo base_url(); ?>web/assets/images/grocery.png" alt="Sale">-->
    <!--                <div class="inner">-->
    <!--                    <h3><span class="percent">Grocery</span></h3>-->
    <!--                    <p>Essential pantry groceries</p>-->
    <!--                    <a href="<?php echo base_url();?>grocery" >Shop Now</a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="col-sm-6 col-lg-4">-->
    <!--            <div class="sale-item sale-bg-three">-->
    <!--                <img src="<?php echo base_url(); ?>web/assets/images/fresh.png" alt="Sale">-->
    <!--                <div class="inner">-->
    <!--                    <h3><span class="percent">Fresh</span></h3>-->
    <!--                    <p>Fresh fruits and vegetables</p>-->
    <!--                    <a href="<?php echo base_url();?>fresh" >Shop Now</a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
     
    <!--</div>-->
</div>


<div class="products-area two pb-100">
    <div class="container">
    <div class="sorting-slider owl-theme owl-carousel">
        <?php foreach ($category as $res){?>


    <a href="<?php echo base_url($res->slug) ?>">
<div  class="product_img" >
        <img src="<?php echo base_url('uploads/').$res->image; ?>" alt="">
         </div>
        <span><?= strtoupper($res-> name) ?></span>
    </a>
   

<?php } ?>
 

</div>
<!-- --------------------slider-end----------------- -->


        <div class="row align-items-center">
             <div class="col-sm-6 col-lg-6 col-6">
                  <div class="section-title">
               <h2>Top Products</h2>
            </div>
             </div>
             <div class="col-md-6 col-6">
                 <label for="sort" class="dfx">
				<p>Sort by</p>
				<select name="sort">
				    	<option value="">Select</option>
						<option value="">A - Z</option>
						<option value="">Z - A</option>
						<option value="">ASC</option>
						<option value="">DESC</option>
				</select>
		</label>
                 <!-- <div class="section-title">-->
                 <!--  <h2>Top Products</h2>-->
                 <!--</div>-->
             </div>
           
             <?php foreach ($product as $res){?>
            <div class="col-sm-6 col-lg-3">
               
                <div class="products-item">
                    <span class="badge badge-danger"><?=$res->discount?>% Off</span>
                    <div class="top">
                        <a class="add_wishlist wishlist" href="javascript: void(0)" data-wishlist-id="<?= $res->id?>">
                            <i class='bx bx-heart'></i>
                        </a>
                        <a href="<?php echo base_url('product_details/').$res->slug ?>">
                            <?php if(!empty($res->image)) {
                                ?>
                            
                            <img src="<?php echo base_url().$res->image; ?>" alt="Products">
                            <?php } ?>
                            <div class="inner">
                                <h3>
                                    <?= ucfirst($res->product_name) ?>
                                </h3>
                               
                       
                        </a>
<?php 
                        
$offer2=$res->discount;
$offer=$res->price;
$product_price=$res->price*$offer2/100;
$comision_price=$offer-$product_price;               
 //print_r($comision_price);                 
                         
    $val=round($comision_price);
    
    if ($val >'0' && $val <= '500')
{
    $value= $val*0/100;
    //echo $value;
}

elseif ($val >='501' && $val <= '799') {
    $value= $val*5/100;
    //echo $value;
 }
 
 elseif ($val >='800' && $val <= '999') {
    $value= $val*6/100;
    //echo $value;
 }
 elseif ($val >='1000' && $val <= '1499') {
    $value= $val*8/100;
    //echo $value;
 }
 elseif ($val >='1500' && $val <= '1999') {
    $value= $val*10/100;
    //echo $value;
 }
 elseif ($val >='2000' && $val <= '2499') {
    $value= $val*15/100;
    //echo $value;
 }
 elseif ($val >='2500' && $val <= '2999') {
    $value= $val*20/100;
    //echo $value;
 }
 elseif ($val >='3000' && $val <= '3400') {
    $value= $val*25/100;
    //echo $value;
 }
 else {
     $value= $val*30/100;
     //echo $value;
     
 }
    $total_price=$offer-$product_price+$value;
?>
                         <span>₹ <?= round($total_price) ?>  <strike>₹<?= $res-> price?></strike></span>
                    </div>
                </div>
                </a>
                <div class="bottom">
                    <a class="add_cart cart-text" href="javascript: void(0)" data-cart-id ="<?= $res->id?>">Add To Cart</a>
                    <i class='add_cart bx bx-plus' data-cart-id ="<?= $res->id?>"></i>
                </div>
            </div>
            
        </div>
        <?php } ?>
        
    


<div id="pagination">
<ul class="tsc_pagination">
<?php foreach ($links as $link) {
echo "<li>". $link."</li>";
} ?>
</ul>
</div>


</div>
<!--<div class="text-center">
    <a class="common-btn two" href="#">
        Load More Products
        <img src="<?php echo base_url(); ?>web/assets/images/shape1.png" alt="Shape">
        <img src="<?php echo base_url(); ?>web/assets/images/shape2.png" alt="Shape">
    </a>
</div>-->
 
</div>
</div>



<!-- 
<div class="deal-area  pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title">
                    <h2>Deal Of The Day</h2>
                </div>
                <div class="deal-item">
                    <span class="percent">-20%</span>
                    <a class="deal-btn" href="single-product.php">
                        <i class='bx bx-right-arrow-alt'></i>
                    </a>
                    <div class="inner align-items-center">
                        <div class="left">
                            <img src="<?php echo base_url(); ?>web/assets/images/deal-main1.png" alt="Deal">
                        </div>
                        <div class="right">
                            <ul class="reviews">
                                <li>
                                    <i class='bx bxs-star checked'></i>
                                </li>
                                <li>
                                    <i class='bx bxs-star checked'></i>
                                </li>
                                <li>
                                    <i class='bx bxs-star checked'></i>
                                </li>
                                <li>
                                    <i class='bx bxs-star checked'></i>
                                </li>
                                <li>
                                    <i class='bx bxs-star'></i>
                                </li>
                                <li>
                                    <span>(4 Reviews)</span>
                                </li>
                            </ul>
                            <h3>Best Bionic Thunder Headphones</h3>
                            <ul class="price">
                                <li>$130.00</li>
                                <li><del>$150.00</del></li>
                            </ul>
                            <ul class="features">
                                <li>
                                    <span>Main Features:</span>
                                </li>
                                <li>High Quality Sound</li>
                                <li>Voice Cancellation</li>
                                <li>Mobile Support</li>
                                <li>3+ Years Warranty</li>
                            </ul>
                            <ul class="timer">
                                <li>
                                    <div class="timer-inner">
                                        <span id="days"></span>
                                        <p>Days</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="timer-inner">
                                        <span id="hours"></span>
                                        <p>Hrs</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="timer-inner">
                                        <span id="minutes"></span>
                                        <p>Mins</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="timer-inner">
                                        <span id="seconds"></span>
                                        <p>Secs</p>
                                    </div>
                                </li>
                            </ul>
                            <ul class="cart-wishlist">
                                <li>
                                    <a href="#">
                                        <i class='bx bxs-cart'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class='bx bxs-heart'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-title">
                    <h2>Hot Offers</h2>
                </div>
                <div class="deal-item two">
                    <span class="percent">-20%</span>
                    <a class="deal-btn" href="single-product.php">
                        <i class='bx bx-right-arrow-alt'></i>
                    </a>
                    <div class="inner align-items-center">
                        <div class="left">
                            <img src="<?php echo base_url(); ?>web/assets/images/deal-main2.png" alt="Deal">
                        </div>
                        <div class="right">
                            <ul class="reviews">
                                <li>
                                    <i class='bx bxs-star checked'></i>
                                </li>
                                <li>
                                    <i class='bx bxs-star checked'></i>
                                </li>
                                <li>
                                    <i class='bx bxs-star checked'></i>
                                </li>
                                <li>
                                    <i class='bx bxs-star checked'></i>
                                </li>
                                <li>
                                    <i class='bx bxs-star'></i>
                                </li>
                                <li>
                                    <span>(4 Reviews)</span>
                                </li>
                            </ul>
                            <h3>Bionic Thunder Smart Watch</h3>
                            <ul class="price">
                                <li>$130.00</li>
                                <li><del>$150.00</del></li>
                            </ul>
                            <h4>Get This Product Within: <span>31 December</span></h4>
                            <ul class="cart-wishlist">
                                <li>
                                    <a href="#">
                                        <i class='bx bxs-cart'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class='bx bxs-heart'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="deal-black">
                    <img src="<?php echo base_url(); ?>web/assets/images/deal-shape1.png" alt="Shape">
                    <h3>50% Black Friday Sale</h3>
                    <a href="shop.php">View Products</a>
                </div>
            </div>
        </div>
    </div>
</div>  -->


<section class="brand-area pb-70">
    <div class="container">
        <div class="section-title">
            <h2>Our Trusted Brand</h2>
        </div>
        <div class="row justify-content-center">
            <?php foreach ($brand as $res) {?>
            <div class="col-sm-4 col-lg-3">
                <div class="brand-item">
                    <a href="<?php echo base_url('brand_list/').$res->id?>">
                        <!--<img src="<?php echo base_url($res->image); ?>" alt="Brand">-->
                        <p><?= ucfirst($res->brand_name) ?></p>
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>


<!--<div class="products-area two pb-70">
    <div class="container">
        <div class="section-title">
            <h2>Best Selling Products</h2>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="products-item">
                    <div class="top">
                        <a class="wishlist" href="#">
                            <i class='bx bx-heart'></i>
                        </a>
                        <img src="<?php echo base_url(); ?>web/assets/images/products/products22.png" alt="Products">
                        <div class="inner">
                            <h3>
                                <a href="#">Bionic Thunder Headphones</a>
                            </h3>
                            <span>$200.00</span>
                        </div>
                    </div>
                    <div class="bottom">
                        <a class="cart-text" href="#">Add To Cart</a>
                        <i class='bx bx-plus'></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="products-item">
                    <div class="top">
                        <a class="wishlist" href="#">
                            <i class='bx bx-heart'></i>
                        </a>
                        <img src="<?php echo base_url(); ?>web/assets/images/products/products23.png" alt="Products">
                        <div class="inner">
                            <h3>
                                <a href="#">Xiaomi A1821 Smart Watch</a>
                            </h3>
                            <span>$180.00</span>
                        </div>
                    </div>
                    <div class="bottom">
                        <a class="cart-text" href="#">Add To Cart</a>
                        <i class='bx bx-plus'></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="products-item">
                    <div class="top">
                        <a class="wishlist" href="#">
                            <i class='bx bx-heart'></i>
                        </a>
                        <img src="<?php echo base_url(); ?>web/assets/images/products/products24.png" alt="Products">
                        <div class="inner">
                            <h3>
                                <a href="#">Nikon D5600 DSLR Camera</a>
                            </h3>
                            <span>$170.00</span>
                        </div>
                    </div>
                    <div class="bottom">
                        <a class="cart-text" href="#">Add To Cart</a>
                        <i class='bx bx-plus'></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="products-item">
                    <div class="top">
                        <a class="wishlist" href="#">
                            <i class='bx bx-heart'></i>
                        </a>
                        <img src="<?php echo base_url(); ?>web/assets/images/products/products25.png" alt="Products">
                        <div class="inner">
                            <h3>
                                <a href="#">Delux OM02 Keyboard</a>
                            </h3>
                            <span>$190.00</span>
                        </div>
                    </div>
                    <div class="bottom">
                        <a class="cart-text" href="#">Add To Cart</a>
                        <i class='bx bx-plus'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->


<div class="testimonials-area two pb-100">
    <div class="container">
        <div class="section-title">
            <h2>Our Client Testimonials</h2>
        </div>
        <div class="testimonials-slider owl-theme owl-carousel">
            <?php foreach ($testimonial as $res) {?>
            <div class="testimonials-item">
                <i class="flaticon-quote"></i>
                <p><?= word_limiter($res-> description, 30); ?></p>
                <h3><?= ucfirst($res->title) ?></h3>
                <span><?= ucfirst($res->designation) ?></span>
                <img src="<?php echo base_url('/uploads/').$res->image ; ?>" alt="Testimonial">
            </div>
            <?php } ?>
            
        </div>
    </div>
</div>


<div class="support-area pt-80 pb-40" style="background-color:#e5e5e5;">
    <div class="container">
        <div class="row justify-content-center">
             <h2 class=" pb-3">Why Choose Us</h2>
            <div class="col-sm-6 col-lg-4">
                <div class="support-item two">
                    <i class="flaticon-free-delivery"></i>
                    <h3>Free Next-Day Delivery</h3>
                    <p>Get Your Product Within 24 Hours of Placing The Order.</p>
                    <img src="<?php echo base_url(); ?>web/assets/images/support-shape1.png" alt="Shape">
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="support-item three">
                    <i class="flaticon-call-center"></i>
                    <h3>24/7 Customer Support</h3>
                    <p>Warriors Ready to Serve Our Family 24/7 Days.</p>
                    <img src="<?php echo base_url(); ?>web/assets/images/support-shape1.png" alt="Shape">
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="support-item four">
                    <i class="flaticon-giftbox"></i>
                    <h3>Weekly Gift Voucher</h3>
                    <p>Enjoy Weekly Vouchers For Keeping The Cart Full of Joy.</p>
                    <img src="<?php echo base_url(); ?>web/assets/images/support-shape1.png" alt="Shape">
                </div>
            </div>
        </div>
    </div>
</div>


<!--<section class="blog-area two pt-100 pb-70">-->
<!--    <div class="container">-->
<!--        <div class="section-title">-->
<!--            <h2>Read Our Latest Blog</h2>-->
<!--        </div>-->
       
<!--        <div class="row justify-content-center">-->
<!--            <?php foreach ($blog as $res) {?>-->
<!--            <div class="col-sm-6 col-lg-4 my-2">-->
<!--                <div class="blog-item">-->
<!--                    <div class="top">-->
<!--                         <div class="blog_img">-->
<!--                        <a href="<?php echo base_url('blog/').$res->slug ?>">-->
<!--                            <img src="<?php echo base_url('/uploads/').$res->image ;?> " alt="Blog" class="img-fluid">-->
<!--                        </a>-->
<!--                        </div>-->
<!--                        <span><?php echo date('d M' ,strtotime($res-> date)) ?> </span>-->
<!--                    </div>-->
<!--                    <div class="bottom">-->
<!--                        <h3>-->
<!--                            <a href="<?php echo base_url('blog/').$res->slug?>"><?= $res-> title ?></a>-->
                            
<!--                        </h3>-->
<!--                        <p><?=  word_limiter($res->discription, 20) ?></p>-->
<!--                        <a class="blog-btn" href="<?php echo base_url('blog/').$res->slug ?>">-->
<!--                            Read More-->
<!--                            <i class='bx bx-plus'></i>-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            
<!--            <?php } ?>-->
<!--        </div>-->
<!--        <div class="text-center">-->
<!--    <a class="common-btn two" href="<?php echo base_url('all_blog/') ?>">-->
<!--        Load More Blogs-->
<!--        <img src="<?php echo base_url(); ?>web/assets/images/shape1.png" alt="Shape">-->
<!--        <img src="<?php echo base_url(); ?>web/assets/images/shape2.png" alt="Shape">-->
<!--    </a>-->
<!--</div>-->
        
<!--    </div>-->
<!--</section>-->



<!-- Modal -->
<!--<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">-->
<!--  <div class="modal-dialog" role="document">-->
<!--    <div class="modal-content">-->
<!--      <div class="modal-header">-->
<!--        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>-->
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--          <span aria-hidden="true">&times;</span>-->
<!--        </button>-->
<!--      </div>-->
<!--      <div class="modal-body">-->
<!--       <video src="<?php echo base_url(); ?>web/assets/images/video.mp4" autoplay muted></video>-->
<!--      </div>-->
      
<!--    </div>-->
<!--  </div>-->
<!--</div>-->

<!--<script>-->
<!--      window.addEventListener('load', () => {-->
<!--                const button = document.querySelector('.popup-button');-->
<!--                button.click();-->
<!--                button.style.display = "none"-->
<!--            })-->
<!-- </script>-->