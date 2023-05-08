<style>
    strike{
        color: #e35353;
    }
</style>
 

<div class="products-area two pb-100">
    <div class="container">
    <div class="sorting-slider owl-theme owl-carousel">
        <?php foreach ($category as $res){?>
<div class="products-thumb">

    <a href="<?php echo base_url('fresh/'.$res->slug) ?>">
<div  class="product_img" >
        <img src="<?php echo base_url('uploads/').$res->image; ?>" alt="">
         </div>
        <span><?= strtoupper($res-> name) ?></span>
    </a>
   
</div>
<?php } ?>
 

</div>
<!-- --------------------slider-end----------------- -->


        <div class="row">
             <?php foreach ($product as $res){?>
            <div class="col-sm-6 col-lg-3">
               
                <div class="products-item">
                    <div class="top">
                        <a class="add_wishlist wishlist" href="javascript: void(0)" data-wishlist-id="<?= $res->id?>">
                            <i class='bx bx-heart'></i>
                        </a>
                        <a href="<?php echo base_url('product_details/').$res->slug ?>">
                            <img src="<?php echo base_url().$res->image; ?>" alt="Products">
                            <div class="inner">
                                <h3>
                                    <?= ucfirst($res->product_name) ?>
                                </h3>
                               
                       
                        </a>
                        <?php 
                        $val=$res->price;
                        
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
                         $offer=$res->discount;
                  $product_price=$res->price*$offer/100;
                  
                   $offer=$res->price;
                   
                   $total_price=$offer-$product_price+$value;
                        ?>
                         <span>₹ <?= $total_price ?> Kg <strike>₹<?= $res-> price?> Kg</strike></span>
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
        
    





</div>
<div id="pagination">
<ul class="tsc_pagination">
<?php foreach ($links as $link) {
echo "<li>". $link."</li>";
} ?>
</ul>
</div>
 
</div>
</div>


<div class="testimonials-area two pb-100">
    <div class="container">
        <div class="section-title">
            <h2>Our Client Testimonials</h2>
        </div>
        <div class="testimonials-slider owl-theme owl-carousel">
            <?php foreach ($testimonial as $res) {?>
            <div class="testimonials-item">
                <i class="flaticon-quote"></i>
                <p><?= ucfirst($res-> description) ?></p>
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


<section class="blog-area two pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <h2>Read Our Latest Blog</h2>
        </div>
       
        <div class="row justify-content-center">
            <?php foreach ($blog as $res) {?>
            <div class="col-sm-6 col-lg-4 my-2">
                <div class="blog-item">
                    <div class="top">
                        <a href="<?php echo base_url('blog/').$res->slug ?>">
                            <img src="<?php echo base_url('/uploads/').$res->image ;?> " alt="Blog">
                        </a>
                        <span><?php echo date('d M' ,strtotime($res-> date)) ?> </span>
                    </div>
                    <div class="bottom">
                        <h3>
                            <a href="<?php echo base_url('blog/').$res->slug?>"><?= $res-> title ?></a>
                            
                        </h3>
                        <p><?=  word_limiter($res->discription, 20) ?></p>
                        <a class="blog-btn" href="<?php echo base_url($res->slug)?>">
                            Read More
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <?php } ?>
        </div>
        <div class="text-center">
    <a class="common-btn two" href="<?php echo base_url('all_blog/') ?>">
        Load More Blogs
        <img src="<?php echo base_url(); ?>web/assets/images/shape1.png" alt="Shape">
        <img src="<?php echo base_url(); ?>web/assets/images/shape2.png" alt="Shape">
    </a>
</div>
        
    </div>
</section>
