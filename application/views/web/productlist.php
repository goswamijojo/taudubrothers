<meta property="og:title" content="<?= ucfirst($product_details-> product_name) ?>" />
 
<meta property="og:url" content=" <?php
echo $actual_link = ("https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

?>" />
<meta property="og:image:url" content="<?php echo base_url().$product_details->image; ?>" />
<meta property="og:description" content="Site description" />

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

<!--<div class="page-title-area">-->
<!--   <div class="d-table">-->
<!--      <div class="d-table-cell">-->
<!--         <div class="container">-->
<!--            <div class="title-content">-->
<!--               <h3><?= word_limiter(ucfirst($product_details->product_name), 5) ?></h3>-->
<!--               <ul>-->
<!--                  <li>-->
<!--                     <a href="<?php echo base_url ();?>">Home</a>-->
<!--                  </li>-->
<!--                  <li>-->
<!--                     <span><?= ucfirst($product_details-> product_name) ?></span>-->
<!--                  </li>-->
<!--               </ul>-->
<!--            </div>-->
<!--         </div>-->
<!--      </div>-->
<!--   </div>-->
<!--   <div class="title-img">-->
<!--      <img src="<?php echo base_url ()?>web/assets/images/page-title2.jpg" alt="About">-->
      
<!--   </div>-->
<!--</div>-->
<div class="product-details-area ptb-100">
   <div class="container">
        
      <div class="top">
         <div class="row">
            <div class="col-lg-6">
               <div class="outer">
                  <div class="row ">
                     <div class="col-sm-2 col-lg-2">
                        
                        <div class="owl-thumbs" data-slider-id="1" >
                            <?php if (!empty($product_details->video)) { ?>
                           <div class="item owl-thumb-item">
                              
                              <div class="top-img-left" >
                               <video src="<?php echo base_url().$product_details->video; ?>" height="80" width="80"  >
                               <source src="<?php echo base_url().$product_details->video; ?>" type="video/mp4">
                               </video>
                              </div>
                              
                              </div>
                              <?php } ?>
                           <?php if (!empty($product_details->image)) { ?>
                           <div class="item owl-thumb-item">
                              <div class="top-img-left">
                                 <img src="<?php echo base_url().$product_details->image; ?>" alt="Product">
                              </div>
                           </div>
                           <?php } ?>
                           <?php if (!empty($product_details->image1)) { ?>
                           <div class="item owl-thumb-item">
                              <div class="top-img-left">
                                 <img src="<?php echo base_url().$product_details->image1; ?>" alt="Product">
                              </div>
                           </div>
                           <?php } ?> 
                           <?php if (!empty($product_details->image2)) { ?>
                           <div class="item owl-thumb-item">
                              <div class="top-img-left">
                                 <img src="<?php echo base_url().$product_details->image2; ?>" alt="Product">
                              </div>
                           </div>
                           <?php } ?>
                           <?php if (!empty($product_details->image3)) { ?>
                           <div class="item owl-thumb-item">
                              <div class="top-img-left">
                                 <img src="<?php echo base_url().$product_details->image3; ?>" alt="Product">
                              </div>
                           </div>
                           <?php } ?>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-10">
                        <div class="image-slides owl-carousel owl-theme" data-slider-id="1">
                           <?php if (!empty($product_details->video)) { ?>
                           <div class="item">
                              
                                 <video class="js-player" src="<?php echo base_url().$product_details->video; ?>">
                                <source src="<?php echo base_url().$product_details->video; ?>" type="video/mp4">
                                 </video>
                           


                           </div>
                           <?php } ?>
                           <?php if (!empty($product_details->image)) { ?>
                           <div class="top-img-right">
                              <img src="<?php echo base_url().$product_details->image; ?>" alt="Product">
                           </div>
                           <?php } ?>
                           <?php if (!empty($product_details->image1)) { ?>
                           <div class="top-img-right">
                              <img src="<?php echo base_url().$product_details->image1; ?>" alt="Product">
                           </div>
                           <?php } ?>
                           <?php if (!empty($product_details->image2)) { ?>
                           <div class="top-img-right">
                              <img src="<?php echo base_url().$product_details->image2; ?>" alt="Product">
                           </div>
                           <?php } ?>
                           <?php if (!empty($product_details->image3)) { ?>
                           <div class="top-img-right">
                              <img src="<?php echo base_url().$product_details->image3; ?>" alt="Product">
                           </div>
                           <?php } ?>
                        </div>
                          <ul class="cart row">
                     <!--<li>
                        <ul class="number">
                           <li>
                              <span class="minus">-</span>
                              <input type="text" value="1">
                              <span class="plus">+</span>
                           </li>
                        </ul>
                     </li>-->
                     <li class="col-6 col-md-6">
                        <a class="add_cart common-btn" href="javascript: void(0)" data-cart-id="<?= $product_details->id?>">Add To Cart <img src="<?php echo base_url ()?>web/assets/images/shape1.png" alt="Shape">
                        <img src="<?php echo base_url ()?>web/assets/images/shape2.png" alt="Shape">
                        </a>
                        
                     </li>
                     
                     
                     <li class="col-6 col-md-6">
                        <a class="buy_now common-btn" href="javascript: void(0)" data-buy-id="<?= $product_details->id?>">Buy Now <img src="<?php echo base_url ()?>web/assets/images/shape1.png" alt="Shape">
                        <img src="<?php echo base_url ()?>web/assets/images/shape2.png" alt="Shape">
                        </a>
                     </li>
                     
                  </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="top-content">
                   
                  <h2><?= ucfirst ($product_details-> product_name) ?></h2>
                  <ul class="reviews">
                     <li>
                        <!--<i class="bx bxs-star checked"></i>-->
                     </li>
                     
                     <li>
                        <!--<span>(2 Reviews)</span>-->
                     </li>
                     <li>

<?php 

$offer=$product_details->discount;
 $product_price=$product_details->price*$offer/100;
 $offer2=$product_details->price;
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
                        
                        
                        <h3>₹<?= round($total_price) ?><span><strike>₹<?= $product_details-> price?></strike></span></h3>
                     </li>
                  </ul>
              
                    <!--<p><?=  word_limiter($product_details->description, 20) ?></p>-->
                  <ul class="tag">
                     <li>Number of <?= ucfirst ($product_details-> product_name) ?>: <span><?= $product_details-> quantity?$product_details-> quantity: 0; ?></span>
                     </li>
                     <?php if(!empty($brand)) { ?>
                     <li>Brand: <span><?= $brand-> brand_name?></span>
                     </li>
                     <?php } ?>
                     <!--<li>Size: <span>8 - 9 Years</span>
                     </li>-->
                     <li>Color: <span><?= $product_details-> color ?></span>
                     </li>
                  </ul>
                  <div class="list-btn mb-3">
                <a class="add_wishlist wishlist-btn" href="javascript: void(0)" data-wishlist-id="<?= $product_details->id?>">
                  <i class="bx bx-heart"></i>Add To Wishlist </a>
                  
                 <!--  <a class="wishlist-btn"href="https://web.whatsapp.com/send?" target="_blank"><i class="fab fa-whatsapp" style='font-size:25px;color:green'></i> Share To WhatsApp</a>-->
                  <?php

$actual_link = urlencode("https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

?>
                               <a class="wishlist-btn" href="https://api.whatsapp.com/send?text=<?=  word_limiter($product_details->product_name, 20) ?> - Hey! I found an awesome product on Taudu Brothers %0D%0A<?php echo $actual_link; ?> %0D%0A Find Your Best Deal on Taudu Brothers. Shop Now!%0D%0A https://play.google.com/store/apps/details?id=com.planet.taudubrothres
                               " target="_blank" class="btn-share share whatsapp">
                                <i class="fab fa-whatsapp" style='font-size:22px;color:green'></i>
                                <span class="hidden-sm">Share To Whatsapp</span>
                            </a>

                  </div>
                   <p><?=  word_limiter($product_details->description, 20) ?>  <a class="moreless-button" href="#">Read more</a></p>
                    <p class="moretext"><?= $product_details-> description?></p>
                
                  
                   
               </div>
            </div>
         </div>
      </div>
      <!--<div class="bottom">-->
      <!--   <ul class="nav nav-pills" id="pills-tab" role="tablist">-->
      <!--      <li class="nav-item" role="presentation">-->
      <!--         <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Description</a>-->
      <!--      </li>-->
         
      <!--      <li class="nav-item" role="presentation">-->
      <!--   </ul>-->
      <!--   <div class="tab-content" id="pills-tabContent">-->
      <!--      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">-->
      <!--         <div class="bottom-description">-->
      <!--            <p><?= $product_details-> description?></p>-->
      <!--         </div>-->
      <!--      </div>-->
      <!--      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">-->
      <!--         <div class="bottom-comment">-->
      <!--            <ul class="comments">-->
      <!--               <li>-->
      <!--                  <img src="<?php echo base_url ()?>web/assets/images/blog/comment1.jpg" alt="Blog">-->
      <!--                  <h4>Tom Henry</h4>-->
      <!--                  <span>01 December, 2020</span>-->
      <!--                  <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren</p>-->
      <!--                  <ul class="reviews">-->
      <!--                     <li>-->
      <!--                        <i class="bx bxs-star checked"></i>-->
      <!--                     </li>-->
      <!--                     <li>-->
      <!--                        <i class="bx bxs-star checked"></i>-->
      <!--                     </li>-->
      <!--                     <li>-->
      <!--                        <i class="bx bxs-star checked"></i>-->
      <!--                     </li>-->
      <!--                     <li>-->
      <!--                        <i class="bx bxs-star checked"></i>-->
      <!--                     </li>-->
      <!--                     <li>-->
      <!--                        <i class="bx bxs-star checked"></i>-->
      <!--                     </li>-->
      <!--                  </ul>-->
      <!--               </li>-->
      <!--               <li>-->
      <!--                  <img src="<?php echo base_url ()?>web/assets/images/blog/comment2.jpg" alt="Blog">-->
      <!--                  <h4>Angele Carter</h4>-->
      <!--                  <span>02 December, 2020</span>-->
      <!--                  <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren</p>-->
      <!--                  <ul class="reviews">-->
      <!--                     <li>-->
      <!--                        <i class="bx bxs-star checked"></i>-->
      <!--                     </li>-->
      <!--                     <li>-->
      <!--                        <i class="bx bxs-star checked"></i>-->
      <!--                     </li>-->
      <!--                     <li>-->
      <!--                        <i class="bx bxs-star checked"></i>-->
      <!--                     </li>-->
      <!--                     <li>-->
      <!--                        <i class="bx bxs-star checked"></i>-->
      <!--                     </li>-->
      <!--                     <li>-->
      <!--                        <i class="bx bxs-star"></i>-->
      <!--                     </li>-->
      <!--                  </ul>-->
      <!--               </li>-->
      <!--            </ul>-->
      <!--         </div>-->
      <!--         <div class="bottom-review">-->
      <!--            <h3>Leave A Review</h3>-->
      <!--            <form>-->
      <!--               <div class="form-group">-->
      <!--                  <input type="text" class="form-control" placeholder="Name">-->
      <!--               </div>-->
      <!--               <div class="form-group">-->
      <!--                  <input type="email" class="form-control" placeholder="Email">-->
      <!--               </div>-->
      <!--               <div class="form-group">-->
      <!--                  <textarea id="your-comments" rows="8" class="form-control" placeholder="Comments"></textarea>-->
      <!--               </div>-->
      <!--               <button type="submit" class="btn common-btn">Post A Review <img src="<?php echo base_url ()?>web/assets/images/shape1.png" alt="Shape">-->
      <!--               <img src="<?php echo base_url ()?>web/assets/images/shape2.png" alt="Shape">-->
      <!--               </button>-->
      <!--            </form>-->
      <!--         </div>-->
      <!--      </div>-->
      <!--   </div>-->
      <!--</div>-->
   </div>
</div>
<div class="testimonials-area two pb-100">
   <div class="container">
      <div class="section-title">
         <h2>Related Products</h2>
      </div>
      <div class="testimonials-slider owl-theme owl-carousel">
         <?php foreach ($related_product as $res) { ?>
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
                        
         <div class="products-item">
             <span class="badge badge-danger"><?=$res->discount?>% Off</span>
            <div class="top">
                <a class="add_wishlist wishlist" href="javascript: void(0)" data-wishlist-id="<?= $res->id?>">
               <i class="bx bx-heart"></i>
               </a>
               <img src="<?php echo base_url().$res->image; ?>" alt="Product">
               <div class="inner">
                  <h3>
                     <a href="<?php echo base_url('product_details/').$res->slug ?>">
                     <?= $res-> product_name?>   </a>
                  </h3>
                  <span> ₹<?= $total_price ?> <strike>₹<?= $res-> price?></strike></span>
               </div>
            </div>
            <div class="bottom">
               <a class="add_cart cart-text" href="javascript: void(0)" data-cart-id ="<?= $res->id?>">Add To Cart</a>
                    <i class='add_cart bx bx-plus' data-cart-id ="<?= $res->id?>"></i>
                    
            </div>
            
         </div>
         
         <?php } ?>
         
      </div>
   </div>
</div>
<!--<div class="products-area pb-70">-->
<!--  <div class="container">-->
<!--    <div class="section-title">-->
<!--      <h2>Related Products</h2>-->
<!--    </div>-->
<!--    <div class="row">-->
<!--        <?php foreach($related_product as $res){?>-->
<!--      <div class="col-sm-6 col-lg-3">-->
<!--        <div class="products-item">-->
<!--          <div class="top">-->
<!--            <a class="wishlist" href="#">-->
<!--              <i class="bx bx-heart"></i>-->
<!--            </a>-->
<!--            <img src="<?php echo base_url ($res->image)?>" alt="Products">-->
<!--            <div class="inner">-->
<!--              <h3>-->
<!--                <a href="<?php echo base_url('product_details/').$res->slug ?>">-->
<!--                    <?= $res-> product_name?></a>-->
<!--              </h3>-->
<!--              <span>₹<?= $res->price ?></span>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="bottom">-->
<!--            <a class="cart-text" href="#">Add To Cart</a>-->
<!--            <i class="bx bx-plus"></i>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--       <?php } ?>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->


<link rel="stylesheet" href="<?php echo base_url(); ?>web/assets/css/plyr.css" />
<script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>


<script>

    document.addEventListener('DOMContentLoaded', () => {

        // Controls (as seen below) works in such a way that as soon as you explicitly define (add) one control

        // to the settings, ALL default controls are removed and you have to add them back in by defining those below.



        // For example, let's say you just simply wanted to add 'restart' to the control bar in addition to the default.

        // Once you specify *just* the 'restart' property below, ALL of the controls (progress bar, play, speed, etc) will be removed,

        // meaning that you MUST specify 'play', 'progress', 'speed' and the other default controls to see them again.



        const controls = [

            'play-large', // The large play button in the center

            'restart', // Restart playback

            'rewind', // Rewind by the seek time (default 10 seconds)

            'play', // Play/pause playback

            'fast-forward', // Fast forward by the seek time (default 10 seconds)

            'progress', // The progress bar and scrubber for playback and buffering

            'current-time', // The current time of playback

            'duration', // The full duration of the media

            'mute', // Toggle mute

            'volume', // Volume control

            'captions', // Toggle captions

            'settings', // Settings menu

            //'pip', // Picture-in-picture (currently Safari only)

            'airplay', // Airplay (currently Safari only)

            //'download', // Show a download button with a link to either the current source or a custom URL you specify in your options
            

            'fullscreen' // Toggle fullscreen
            
            

        ];



        const player = Plyr.setup('.js-player', { controls });



    });
</script>