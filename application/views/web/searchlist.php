
 <div class="page-title-area">
   <div class="d-table">
      <div class="d-table-cell">
         <div class="container">
            <div class="title-content">
            
            <?php if(!empty($category_details->name)) { ?>
                
               <h2> <?php echo $category_details->name?></h2>
                <?php } ?>
               <ul>
                  <li>
                     <a href="<?php echo base_url();?>">Home</a>
                  </li>
                 
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="title-img">
      <img src="<?php echo base_url();?>web/assets/images/page-title1.jpg" alt="About">
      <img src="<?php echo base_url();?>web/assets/images/shape16.png" alt="Shape">
      <img src="<?php echo base_url();?>web/assets/images/shape17.png" alt="Shape">
      <img src="<?php echo base_url();?>web/assets/images/shape18.png" alt="Shape">
   </div>
</div>
<div class="products-area ptb-100">
<div class="container">
<div class="section-title text-center">
   <h2>Products </h2>
</div>
 <div class="row">
             <?php foreach ($product as $res) {
               ?>
            <div class="col-sm-6 col-lg-3">
               
                <div class="products-item">
                    <div class="top">
                         <a class="add_wishlist wishlist" href="javascript: void(0)" data-wishlist-id="<?= $res->id?>">
                            <i class='bx bx-heart'></i>
                        </a>
                        <a href="<?php echo base_url('product_details/').$res->slug ?>" target="_blank">
                            <img src="<?php echo base_url().$res->image; ?>" alt="Products">
                            <div class="inner">
                                <h3>
                                    <?= ucfirst($res->product_name) ?>
                                </h3>
                        </a>
                        <span>₹<?= $res-> price?></span>
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
<div class="text-center">
    
<?php if(!empty($product)) { ?>

    
    <?php }
    else { ?>
      <a class="common-btn two" href="#">
        No  Products Found!
    </a>
    
    <?php } ?>
     <br>
   <div id="pagination">
<ul class="tsc_pagination">
    <!-- Show pagination links -->
<?php foreach ($links as $link) {
echo "<li>". $link."</li>";
} ?>
</ul>
</div>
</div>

</div>
</div>
</div>