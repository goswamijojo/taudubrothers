<style>
.top img {
    height: 200px;
}
</style>

<!--<div class="page-title-area">-->
<!--   <div class="d-table">-->
<!--      <div class="d-table-cell">-->
<!--         <div class="container">-->
<!--            <div class="title-content">-->
<!--               <h2>Blog</h2>-->
<!--               <ul>-->
<!--                  <li>-->
<!--                     <a href="index.php">Home</a>-->
<!--                  </li>-->
<!--                  <li>-->
<!--                     <span>Blog</span>-->
<!--                  </li>-->
<!--               </ul>-->
<!--            </div>-->
<!--         </div>-->
<!--      </div>-->
<!--   </div>-->
<!--   <div class="title-img">-->
<!--      <img src="<?php echo base_url();?>web/assets/images/page-title1.jpg" alt="About">-->
     
<!--   </div>-->
<!--</div>-->
<section class="blog-area ptb-100">
   <div class="container">
       
      <div class="row justify-content-center">
          <?php foreach($all_blog as $res) { ?>
         <div class="col-sm-6 col-lg-4 my-2">
            <div class="blog-item">
               <div class="top">
                  <?php if(!empty($res->image)) { ?>
                  <a href="<?php echo base_url('blog/').$res->slug?>">
                  <img src="<?php echo base_url('uploads/').$res->image;?>" alt="Blog">
                  </a>
               <?php } ?>
                  <span><?php echo date('d M',strtotime($res->date))?></span>
               </div>
               <div class="bottom">
                  <h3>
                     <a href="<?php echo base_url('blog/').$res->slug?>"><?= ucfirst($res-> title) ?></a>
                  </h3>
                  <p><?= word_limiter($res-> discription, 20)?></p>
                  <a class="blog-btn" href="<?php echo base_url('blog/').$res->slug?>">
                  Read More
                  <i class='bx bx-plus'></i>
                  </a>
               </div>
            </div>
            
         </div>
         <?php } ?>
         
         
         
       
        
         
         
         
      </div>
      <!--<div class="text-center">
         <a class="common-btn" href="#">
         Load More Article
         <img src="<?php echo base_url();?>web/assets/images/shape1.png" alt="Shape">
         <img src="<?php echo base_url();?>web/assets/images/shape2.png" alt="Shape">
         </a>
         </div>-->
         
          <div id="pagination">
<ul class="tsc_pagination">
    <!-- Show pagination links -->
    
<?php foreach ($links as $link) {
echo "<li>". $link."</li>";
} ?>
</ul>
</div>
   </div>
   
</section>