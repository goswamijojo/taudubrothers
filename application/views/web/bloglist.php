<div class="page-title-area">
   <div class="d-table">
      <div class="d-table-cell">
         <div class="container">
            <div class="title-content">
               <h2>Blog Details</h2>
               <ul>
                  <li>
                     <a href="<?php echo base_url ();?>">Home</a>
                  </li>
                  <li>
                     <span>Blog Details</span>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="title-img">
      <img src="<?php echo base_url ();?>web/assets/images/page-title4.jpg" alt="About">
      <img src="<?php echo base_url ();?>web/assets/images/shape16.png" alt="Shape">
      <img src="<?php echo base_url ();?>web/assets/images/shape17.png" alt="Shape">
      <img src="<?php echo base_url ();?>web/assets/images/shape18.png" alt="Shape">
   </div>
</div>


<div class="blog-details-area ptb-100">
   <div class="container">
      <div class="row">
         <div class="col-lg-8">
            <div class="details-item">
               <div class="details-img">
                  <img src="<?php echo base_url ('uploads/').$blog->image;?>" alt="Blog">
                  <ul class="details-date">
                     <li>
                        <i class='bx bxs-calendar'></i>
                        <span><?php echo date('d M Y' ,strtotime($blog-> date)) ?> </span>
                     </li>
                     <li>
                        <i class='bx bxs-comment-detail'></i>
                        <a href="#">02 Comments</a>
                     </li>
                     <li>
                        <i class='bx bx-user'></i>
                        <span>By:</span>
                        <a href="#">Admin</a>
                     </li>
                  </ul>
                  <h2><?= ucfirst($blog-> title) ?></h2>
                  <p><?= $blog-> discription ?></p>
                  <!--<img src="<?php echo base_url ();?>web/assets/images/blog/blog-details2.png" alt="Details">-->
                  <ul class="details-social">
                     <li>
                        <span>Share:</span>
                     </li>
                     <li>
                        <a href="#" target="_blank">
                        <i class='bx bxl-facebook'></i>
                        </a>
                     </li>
                     <li>
                        <a href="#" target="_blank">
                        <i class='bx bxl-twitter'></i>
                        </a>
                     </li>
                     <li>
                        <a href="#" target="_blank">
                        <i class='bx bxl-linkedin'></i>
                        </a>
                     </li>
                     <li>
                        <a href="#" target="_blank">
                        <i class='bx bxl-skype'></i>
                        </a>
                     </li>
                     <li>
                        <a href="#" target="_blank">
                        <i class='bx bxl-youtube'></i>
                        </a>
                     </li>
                  </ul>
               </div>
               <!--<div class="details-arrow-page">
                  <div class="row">
                     <div class="col-sm-6 col-lg-6">
                        <div class="left">
                           <a class="arrows" href="#">
                           <i class='bx bx-chevron-left'></i>
                           Previous Post
                           </a>
                           <ul class="align-items-center">
                              <li>
                                 <img src="<?php echo base_url ();?>web/assets/images/blog/blog-thumb1.jpg" alt="Details">
                              </li>
                              <li>
                                 <h3><a href="#">How Can I Choose A Perfect Bed For My Bed Room</a></h3>
                                 <i class='bx bxs-calendar'></i>
                                 <span>01 Dec, 2020</span>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-6">
                        <div class="right">
                           <a class="arrows" href="#">
                           <i class='bx bx-chevron-right'></i>
                           Next Post
                           </a>
                           <ul class="align-items-center">
                              <li>
                                 <h3><a href="#">Luxurious Furniture Aren't Expensive All The Time</a></h3>
                                 <i class='bx bxs-calendar'></i>
                                 <span>02 Dec, 2020</span>
                              </li>
                              <li>
                                 <img src="<?php echo base_url ();?>web/assets/images/blog/blog-thumb2.jpg" alt="Details">
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>-->
               <!--<div class="details-comments">
                  <h3>Comments <span>02</span></h3>
                  <ul>
                     <li>
                        <img src="<?php echo base_url ();?>web/assets/images/blog/comment1.jpg" alt="Blog">
                        <h4>Tom Henry</h4>
                        <span>01 December, 2020</span>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus voluptas modi esse perspiciatis vero sint doloremque voluptates placeat veritatis explicabo</p>
                        <a href="#">Reply</a>
                     </li>
                     <li>
                        <img src="<?php echo base_url ();?>web/assets/images/blog/comment2.jpg" alt="Blog">
                        <h4>Angele Carter</h4>
                        <span>02 December, 2020</span>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus voluptas modi esse perspiciatis vero sint doloremque voluptates placeat veritatis explicabo</p>
                        <a href="#">Reply</a>
                     </li>
                  </ul>
               </div>
               <div class="details-form">
                  <h3>Leave A Comment</h3>
                  <form>
                     <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name">
                     </div>
                     <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email">
                     </div>
                     <div class="form-group">
                        <textarea id="your-comments" rows="8" class="form-control" placeholder="Comments"></textarea>
                     </div>
                     <button type="submit" class="btn common-btn">
                     Post A Comment
                     <img src="<?php echo base_url ();?>web/assets/images/shape1.png" alt="Shape">
                     <img src="<?php echo base_url ();?>web/assets/images/shape2.png" alt="Shape">
                     </button>
                  </form>
               </div>-->
            </div>
         </div>
         <div class="col-lg-4">
            <div class="widget-area">
               <!--<div class="search widget-item">
                  <form>
                     <input type="text" class="form-control" placeholder="Search...">
                     <button type="submit" class="btn">
                     <i class='bx bx-search'></i>
                     </button>
                  </form>
               </div>-->
               <!--<div class="categories widget-item">
                  <h3>Categories:</h3>
                  <ul>
                     <li>
                        <a href="#">Furniture <span>(12)</span></a>
                     </li>
                     <li>
                        <a href="#">Trend <span>(10)</span></a>
                     </li>
                     <li>
                        <a href="#">Modern <span>(21)</span></a>
                     </li>
                     <li>
                        <a href="#">Luxury <span>(04)</span></a>
                     </li>
                  </ul>
               </div>-->
               <div class="articles widget-item">
                  <h3>Recent Articles:</h3>
                  <?php foreach ($recent_blog as $res ) {?>
                  <div class="inner">
                     <ul class="align-items-center">
                        <li>
                           <img src="<?php echo base_url('uploads/').$res->image;?>" alt="Blog">
                        </li>
                        <li>
                           <a href="<?php echo base_url('blog/').$res->slug?>"><?= ucfirst($res-> title) ?></a>
                           <i class='bx bxs-calendar'></i>
                           <span><?php echo date('d M',strtotime($res->date))?></span>
                        </li>
                     </ul>
                  </div>
                  <?php } ?>
                  
                <!--  <div class="inner">
                     <ul class="align-items-center">
                        <li>
                           <img src="<?php echo base_url ();?>web/assets/images/blog/article3.jpg" alt="Blog">
                        </li>
                        <li>
                           <a href="#">How To Choose The Best Smartphone For Your Task?</a>
                           <i class='bx bxs-calendar'></i>
                           <span>03 Dec, 2020</span>
                        </li>
                     </ul>
                  </div>-->
               </div>
               <!--<div class="tags widget-item">
                  <h3>Tags:</h3>
                  <ul>
                     <li>
                        <a href="#">Furniture</a>
                     </li>
                     <li>
                        <a href="#">Trendy</a>
                     </li>
                     <li>
                        <a href="#">Modern Trendy</a>
                     </li>
                     <li>
                        <a href="#">White Furniture</a>
                     </li>
                     <li>
                        <a href="#">Luxury</a>
                     </li>
                     <li>
                        <a href="#">Room</a>
                     </li>
                     <li>
                        <a href="#">Decoration</a>
                     </li>
                     <li>
                        <a href="#">Cheap</a>
                     </li>
                  </ul>
               </div>-->
            </div>
         </div>
      </div>
   </div>
</div>