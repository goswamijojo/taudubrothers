
<style>
    .carousel-inner img {
    width: 100%;
    height: 100%;
 .products-thumb.active {
    background: maroon;
    color: #fff !important;
}
.products-thumb.active span{
    color:#fff;
}
 </style>
 
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
    
</style>

<div class="sale-area">
<div id="demo" class="carousel slide" data-ride="carousel">
 
  <!-- The slideshow -->

  <div class="carousel-inner">
      
    <?php
      $i= 0;
      foreach($images as $image){
          $active = '';
          if($i == 0){
              $active ='active';
          }
      
      ?>
    <div class="carousel-item <?= $active; ?>">
      <img src="<?php echo base_url('uploads/').$image->image; ?>">
    </div>
 <?php $i++; } ?>
  </div>
   
      
  <!-- Indicators -->
  <ul class="carousel-indicators">
      <?php
      $i= 0;
      foreach($images as $image){
          $active = '';
          if($i == 0){
              $active ='active';
          }
      
      ?>
    <li data-target="#demo" data-slide-to="<?=$i; ?>" class="<?=$active; ?>"></li>
    
    <?php $i++ ; } ?>
    
  </ul>
  
   
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
    </div>

 
 

<div class="products-area two pb-100">
    <div class="container">
    <div class="sorting-slider owl-theme owl-carousel">
        <?php foreach ($category as $res){?>
      <?php if(!empty($category_details)) { if($category_details->slug===$res->slug){ ?>    active <?php } } ?>

    <a href="<?php echo base_url('market-place/'.$res->slug) ?>">
    <div  class="product_img" >
        <img src="<?php echo base_url('uploads/').$res->image; ?>" alt="">
         </div>
        <span><?= ucfirst($res-> name) ?></span>
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
            <?php if(!empty($marketplace)) { ?>
             <?php foreach ($marketplace as $res){?>
             
<?php 

$offer=$res->discount;
$product_price=$res->price*$offer/100;
$offer2=$res->price;
$comision_price=$offer2-$product_price;
                         
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
                         
                         $total_price=$offer2-$product_price+$value;
                        ?>          
            <div class="col-sm-6 col-lg-3">
               
                <div class="products-item">
                    <span class="badge badge-danger"><?=$res->discount?>% Off</span>
                    <div class="top">
                        <a class="add_wishlist wishlist" href="javascript: void(0)" data-wishlist-id="<?= $res->id ?>">
                            <i class='bx bx-heart'></i>
                        </a>
                        <a href="<?php echo base_url('product_details/').$res->slug ?>">
                            <img src="<?php echo base_url().$res->image; ?>" alt="Products">
                            <div class="inner">
                                <h3>
                                    <?= ucfirst($res->product_name) ?>
                                </h3>
                        </a>
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
        <?php } }?>
        
    


  <div id="pagination">
<ul class="tsc_pagination">
    <!-- Show pagination links -->
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
                    <a href="#">
                        <!--<img src="<?php echo base_url($res->image); ?>" alt="Brand">-->
                        <p><?= ucfirst($res-> brand_name) ?></p>
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
            <?php foreach ($testimonial as $res) { ?>
            <div class="testimonials-item">
                <i class="flaticon-quote"></i>
                <p><?= word_limiter($res-> description,30) ?></p>
                <h3><?= ucfirst($res->title) ?></h3>
                <span><?= ucfirst($res->designation) ?></span>
                <img src="<?php echo base_url('/uploads/').$res->image ; ?>" alt="Testimonial">
            </div>
            <?php } ?>
            
        </div>
    </div>
</div>


<div class="support-area pt-100 pb-70">
    <div class="container">
        <div class="row justify-content-center">
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
<!--                        <a href="<?php echo base_url($res->slug)?>">-->
<!--                            <img src="<?php echo base_url('/uploads/').$res->image ;?> " alt="Blog">-->
<!--                        </a>-->
<!--                        <span><?php echo date('d M' ,strtotime($res-> date)) ?> </span>-->
<!--                    </div>-->
<!--                    <div class="bottom">-->
<!--                        <h3>-->
<!--                            <a href="<?php echo base_url('blog/').$res->slug?>"><?= $res-> title ?></a>-->
<!--                        </h3>-->
<!--                        <p><?=  word_limiter($res->discription, 20) ?></p>-->
<!--                        <a class="blog-btn" href="<?php echo base_url($res->slug)?>">-->
<!--                            Read More-->
<!--                            <i class='bx bx-plus'></i>-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            
<!--            <?php } ?>-->
<!--        </div>-->
        
<!--    </div>-->
<!--</section>-->
