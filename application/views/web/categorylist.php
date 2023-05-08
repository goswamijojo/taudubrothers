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
    height: 365px;
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
<!-- <div class="page-title-area">-->
<!--   <div class="d-table">-->
<!--      <div class="d-table-cell">-->
<!--         <div class="container">-->
<!--            <div class="title-content">-->
            
                
<!--               <h2><?= ucfirst($category_details-> name) ?></h2>-->
                
<!--               <ul>-->
<!--                  <li>-->
<!--                     <a href="<?php echo base_url();?>">Home</a>-->
<!--                  </li>-->
<!--                  <li>-->
<!--                     <span><?= ucfirst($category_details-> name) ?></span>-->
<!--                  </li>-->
<!--               </ul>-->
<!--            </div>-->
<!--         </div>-->
<!--      </div>-->
<!--   </div>-->
<!--   <div class="title-img">-->
<!--      <img src="<?php echo base_url();?>web/assets/images/page-title1.jpg" alt="About">-->
<!--      <img src="<?php echo base_url();?>web/assets/images/shape16.png" alt="Shape">-->
<!--      <img src="<?php echo base_url();?>web/assets/images/shape17.png" alt="Shape">-->
<!--      <img src="<?php echo base_url();?>web/assets/images/shape18.png" alt="Shape">-->
<!--   </div>-->
<!--</div>-->
<div class="products-area ptb-100">
<div class="container">
<div class="section-title text-center">
   <h2>PRODUCTS OF <?= ucfirst($category_details-> name) ?></h2>
</div>
 <div class="row">
             <?php foreach ($product as $res) {
               ?>
               
               
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