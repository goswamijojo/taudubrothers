

<style type="text/css">
/* #audio-control {*/
/*  cursor:pointer;*/
/*  padding: 10px 20px;*/
/*  background:#000;*/
/*  color: #fff;*/
/*  border-radius: 4px;*/
/*  display: inline-block;*/
/*}*/
/*.hide {*/
/*  display: none;*/
/*}*/
</style>

<!--<div class="container">-->
<!--	<div id="features" class="feature">-->

<!--  	<span class="btn1" onclick="hide()"><i class="fa fa-times" aria-hidden="true"></i></span>-->

 
<!--    <video autoplay muted id="myVideo" width="100%" height="100%" controls>-->
<!--        <source src="https://taudubrothers.com/uploads/346656f1b42b3f23c3e571f0b6ff4294.mp4" type="video/mp4" >   -->
             
<!--    </video>-->
     
<!--        <br /><br />-->
<!--        <div id="audio-control" class="muted">Unmute</div>-->



<!--  </div>-->
<!--</div>-->







<footer class="footer-area two pt-100 pb-70">
    <div class="footer-shape">
        <img src="<?php echo base_url(); ?>web/assets/images/shape8.png" alt="Shape">
        <img src="<?php echo base_url(); ?>web/assets/images/shape9.png" alt="Shape">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-lg-4">
                <div class="footer-item">
                    <div class="footer-logo">
                        <div class="footer-img">
                            <a class="logo" href="<?php echo base_url(); ?>">
                                <img src="<?php echo base_url(); ?>web/assets/images/tudulogo.png" alt="Logo">
                        </div>
                        </a>
                        <p>Your One-Stop Solution For Buying <br>E-Commerce Products, Groceries, and <br>Fresh Eatables at 100% Best-in-Class<br> Prices. Buy Now & Try it For Yourself!</p>
                        <ul>
                             <li>
                                <i class="flaticon-phone-call"></i>
                                <a href="tel:7417104056">+91-7417104056</a>
                               
                            </li>
                            
                            <!--<li>
                                <i class="flaticon-email"></i>
                                <a href=""><span class="__cf_email__"
                                        data-cfemail="7d15181111123d181e120d531e1210">[email&#160;protected]</span></a>
                                <a href=""><span class="__cf_email__"
                                        data-cfemail="adc4c3cbc2edc8cec2dd83cec2c0">[email&#160;protected]</span></a>
                            </li>-->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="footer-item">
                    <div class="footer-services">
                        <h3>Quick Links</h3>
                        <ul>
                            
                             
                           
                            <li>
                                <a href="<?php echo base_url();?>return_policy">Return Policy</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>shipping_policy">Shipping Policy</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>privacy_policy">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>term_condition">Terms & Condition</a>
                            </li>
                            <!--<li>-->
                            <!--    <a href="#">Contact Us</a>-->
                            <!--</li>-->
                            <li><a href="<?php echo base_url();?>delivery_enquiry">Delivery Enquiry Form</a></li>
                            <li>
                                <a href="<?php echo base_url();?>connect_seller">Contact to Seller</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="footer-item">
                    <div class="footer-links">
                        <h3>Important Links</h3>
                        <div class="row">
                            <div class="col-6 col-sm-8 col-lg-8">
                                <ul>
                                   
                                    <li>
                                        <a href="<?php echo base_url();?>all_blog">Blog</a>
                                    </li>
                                    
                                    <li>
                                        <a href="<?php echo base_url();?>checkout">Checkout</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url() ?>">Shop</a>
                                    </li>
                                    
                                    <li>
                                        <?php if(!empty($this->session->userdata('user_id'))) { ?>
                                        <a href="<?php echo base_url('dashboard_overview') ?>">My Account</a>
                                         <?php } ?>
                                    </li>
                                   
                                </ul>
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm-6 col-lg-6">
                <div class="payment-cards">
                    <ul>
                        <li>
                            <a href="https://play.google.com/store/apps/details?id=com.planet.taudubrothres" target="_blank">
                                <img src="<?php echo base_url(); ?>web/assets/images/playstor-icons2.png" alt="Payment">
                            </a>
                
                        </li>
                      
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6">
                <div class="social-links">
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/taudubrothers/" target="_blank">
                                <i class='bx bxl-facebook'></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/taudubrothers/" target="_blank">
                                <i class='bx bxl-instagram'></i>
                            </a>
                        </li>
                     
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


<div class="copyright-area two">
    <div class="container">
        <div class="copyright-item">
            <p>Copyright © Taudu Brothers <span id="dated"></span> All right Reserved</a></p>
        </div>
    </div>
</div>


<div class="modal fade modal-right popup-modal" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Shopping Cart <span class="CartItemCount"> </span> Items</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="cart-table">
                    <table class="table">
                        <tbody class="CartItemHtml">
                         
                        </tbody>
                    </table>
                    <h5>Delivery Charge: <span class="Delivery" style="float:right"></span></h5>
                    <div class="total-amount">
                        
                        <h3>Total: <span class="CartTotal"></span></h3>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
          <form>
                    <!--<input type="text" class="form-control" placeholder="Enter Coupon Code">-->
                  
                    <a href="<?php echo base_url();?>checkout" class="form-control btn common-btn">Proceed To Checkout
                        <!-- <input type="submit" class="form-control btn common-btn" value="Proceed To Checkout"> -->
                    </a>
                        <img src="<?php echo base_url(); ?>web/assets/images/shape1.png" alt="Shape">
                        <img src="<?php echo base_url(); ?>web/assets/images/shape2.png" alt="Shape">
                    
                   
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modal-right popup-modal wishlist-modal" id="exampleModalWishlist" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Wishlist <span class="WishItemCount">02 </span> Items</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="cart-table">
                    <table class="table">
                        <tbody class="WishItemHtml">
                            <tr>
                                <th scope="row">
                                    <img src="<?php echo base_url(); ?>web/assets/images/cart/cart1.png" alt="Cart">
                                </th>
                                <td>
                                    <h3>White Comfy Stool</h3>
                                    <span class="rate">$200.00 x 1</span>
                                </td>
                                <td>
                                   <a class="common-btn">
                                        Add To Cart
                                        <img src="<?php echo base_url(); ?>web/assets/images/shape1.png" alt="Shape">
                                        <img src="<?php echo base_url(); ?>web/assets/images/shape2.png" alt="Shape">
                                    </a>
                                </td>
                                <td>
                                    <a class="close" href="#">
                                        <i class='bx bx-x'></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <img src="<?php echo base_url(); ?>web/assets/images/cart/cart2.png" alt="Cart">
                                </th>
                                <td>
                                    <h3>Yellow Armchair</h3>
                                    <span class="rate">$180.00 x 1</span>
                                </td>
                                <td>
                                    <a class="add_cart common-btn" href="javascript: void(0)">
                                        Add To Cart
                                        <img src="<?php echo base_url(); ?>web/assets/images/shape1.png" alt="Shape">
                                        <img src="<?php echo base_url(); ?>web/assets/images/shape2.png" alt="Shape">
                                    </a>
                                </td>
                                <td>
                                    <a class="close" href="#">
                                        <i class='bx bx-x'></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="go-top">
    <i class='bx bxs-up-arrow-circle'></i>
    <i class='bx bxs-up-arrow-circle'></i>
</div>


<script data-cfasync="false" src="<?php echo base_url(); ?>web/../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="<?php echo base_url(); ?>web/assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>web/assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>web/assets/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>web/assets/js/form-validator.min.js"></script>

<script src="<?php echo base_url(); ?>web/assets/js/contact-form-script.js"></script>

<script src="<?php echo base_url(); ?>web/assets/js/jquery.ajaxchimp.min.js"></script>

<script src="<?php echo base_url(); ?>web/assets/js/jquery.nice-select.min.js"></script>

<script src="<?php echo base_url(); ?>web/assets/js/jquery.meanmenu.js"></script>

<script src="<?php echo base_url(); ?>web/assets/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo base_url(); ?>web/assets/js/jquery.themepunch.revolution.min.js"></script>

<script src="<?php echo base_url(); ?>web/assets/js/extensions/revolution.extension.actions.min.js"></script>
<!--<script src="<?php echo base_url(); ?>web/assets/js/extensions/revolution.extension.carousel.min.js"></script>-->
<script src="<?php echo base_url(); ?>web/assets/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="<?php echo base_url(); ?>web/assets/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="<?php echo base_url(); ?>web/assets/js/extensions/revolution.extension.migration.min.js"></script>
<script src="<?php echo base_url(); ?>web/assets/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="<?php echo base_url(); ?>web/assets/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="<?php echo base_url(); ?>web/assets/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="<?php echo base_url(); ?>web/assets/js/extensions/revolution.extension.video.min.js"></script>


<script src="<?php echo base_url(); ?>web/assets/js/jquery.mixitup.min.js"></script>

<script src="<?php echo base_url(); ?>web/assets/js/owl.carousel.min.js"></script>

<script src="<?php echo base_url(); ?>web/assets/js/jquery-modal-video.min.js"></script>

<script src="<?php echo base_url(); ?>web/assets/js/thumb-slide.js"></script>

<script src="<?php echo base_url(); ?>web/assets/js/custom.js"></script>
<script src="<?php echo base_url(); ?>web/assets/js/system.js"></script>

 <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>


$('.moreless-button').click(function(){
    $('.moretext').slideToggle();
    if($('.moreless-button').text() =="Read more") {
        $(this).text("Read Less")
    }else {
        $(this).text("Read more")
    }
});













const d = new Date();
let year = d.getFullYear();
document.getElementById("dated").innerHTML = year;



function hide() {
  x = document.getElementById('features');
  x.className = 'hide';
  
  // Or...
  // x.style.display = 'none';
}


    $(document).ready(function(){

        $("#features").fadeIn()
        .animate({bottom:0,right:0}, 1500, function() {
            //callback
        });      

        $(".btn1").click(function(e){
            e.preventDefault();
            e.stopPropagation()
            e.mutePropagation()
            $('#features').fadeOut();
           
        });
        
//         function muteUnmute(){
//                 var myVideo =  iframe.getElementById('myVideo'); 
//                 if(myVideo.isMuted()){
//                     myVideo.unMute();
//                 }else{
//                     myVideo.mute();
//                 }
// }
      
    });
    </script>
<style type="text/css">
   .nice-select.swal2-select 
   {
    display: none;
}
</style>

<script>
    $('.add_wishlist').click(function() {
        var product_id=$(this).attr('data-wishlist-id');
        
    $.ajax({
        url: '<?php echo site_url('web/add_wishlist'); ?>',
        type: 'POST',
        data: {
            product_id: product_id,status:status
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if(data.status=='success'){
                 ShowNotificator('success',data.message);
                 refreshMyWishItems();
            }else{
                ShowNotificator('warning',data.message);
            }
        }
    });
});
</script>


<script>
 
    function wishlist_delete(wishlist_id){
            
    $.ajax({
        url: '<?php echo site_url('web/delete_wishlist'); ?>',
        type: 'POST',
        data: {
            wishlist_id: wishlist_id
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if(data.status=='success')
            {
                 ShowNotificator('success',data.message);
                 refreshMyWishItems();
            }
            else
            {
                ShowNotificator('warning',data.message);
            }
        }
    });
};
</script>

<script>
 
        function wishlist_delete_from_wishlist(wishlist_id){
            
    $.ajax({
        url: '<?php echo site_url('web/delete_wishlist'); ?>',
        type: 'POST',
        data: {
            wishlist_id: wishlist_id
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if(data.status=='success'){
                 ShowNotificator('success',data.message);
                 refreshMyWishItems();
            }else{
                ShowNotificator('warning',data.message);
            }
        }
    });
};
</script>



<script>
    $('.add_cart').click(function() {
        var product_id=$(this).attr('data-cart-id');
        var wishlist_id=$(this).attr('data-wishlist-delete');
        //alert(product_id);
    $.ajax({
        url: '<?php echo site_url('web/add_cart'); ?>',
        type: 'POST',
        data: {
            product_id: product_id
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if(data.status=='success'){
                 ShowNotificator('success',data.message);
                 refreshMyCartItems();
                 //wishlist_delete_from_wishlist(wishlist_id);
            }else{
                 window.location.href = 'https://taudubrothers.com/web/login';
                ShowNotificator('warning',data.message);
            }
            
            
        }
        
        
    });
    
});
</script>

<script>
    $('.buy_now').click(function() {
        var product_id=$(this).attr('data-buy-id');
        //alert(product_id);
    $.ajax({
        url: '<?php echo site_url('web/add_cart'); ?>',
        type: 'POST',
        data: {
            product_id: product_id
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if(data.status=='success'){
                 ShowNotificator('success',data.message);
                 refreshMyCartItems();
                 window.location.href="<?php echo base_url(); ?>checkout";
            }else{
                window.location.href = 'https://taudubrothers.com/web/login';
                ShowNotificator('warning',data.message);
            }
        }
    });
});
</script>


<script>
 function cart_add(product_id,type){
    $.ajax({
        url: '<?php echo site_url('web/add_cart'); ?>',
        type: 'POST',
        data: {
            product_id: product_id,type:type
        },
        dataType: 'json',
        success: function(data) {
            // console.log(data);
            if(data.status=='success'){
                 ShowNotificator('success',data.message);
                 refreshMyCartItems();
            }else{
                ShowNotificator('warning',data.message);
            }
        }
    });
}
</script>


<script>
  
 function cart_delete(cart_id){
    $.ajax({
        url: '<?php echo site_url('web/delete_cart'); ?>',
        type: 'POST',
        data: {
            cart_id: cart_id
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if(data.status=='success'){
                 ShowNotificator('success',data.message);
                 refreshMyCartItems();
            }else{
                ShowNotificator('warning',data.message);
            }
        }
    });
};
</script>

<script type="text/javascript">
	function ShowNotificator(icon,title) {
		Swal.fire({
			position: 'bottom-end',
			icon: icon,
			title: title,
			showConfirmButton: false,
			timer: 7000,
			toast: true,
			showClass: {
				popup: 'animate__animated animate__fadeInDown'
			},
			hideClass: 
			{
				popup: 'animate__animated animate__fadeOutUp'
			},
		});
	}
</script>

<script>var variable={
clearShoppingCartUrl:"<?php echo base_url() ?>clearShoppingCart",
manageShoppingCartUrl:" manageShoppingCart",
discountCodeChecker:" discountCodeChecker",
getMyCartItems:"<?php echo base_url() ?>getMyCartItems",
getMyWislistItems:"<?php echo base_url() ?>getMyWislistItems",
getOneProductAjax:"home/getOneProductAjax",
};</script>



<script type="text/javascript">
    $(document).ready(function() {
 
  handleStatusChanged();
  
});

function handleStatusChanged() {
    $('#ad21').on('click', function () {
      toggleStatus();   
      alert();
    });
}

function toggleStatus(status) {
    
    if (status==3) {
        $('.kyc_none').hide();
        $('#pan_number').prop('required',false);
        $('#aadhar_number').prop('required',false);
        $('#gst_no').prop('required',false);
        $('#gst_image').prop('required',false);
        $('#adhar_image').prop('required',false);
        $('#pan_image').prop('required',false);
        } else if (status==2) {
              $('.kyc_none').hide();
              $('#pan_number').prop('required',false);
              $('#aadhar_number').prop('required',false);
              $('#gst_no').prop('required',false);
              $('#gst_image').prop('required',false);
              $('#adhar_image').prop('required',false);
              $('#pan_image').prop('required',false);
        }  else
        {
            
              $('.kyc_none').show();
        } 
}
</script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLCl-JK5usUBFwjG7Y0s9Ef3fSoPV0QTk&callback=initMap&libraries=places&v=weekly"
      defer
    ></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config.MAPS_API_KEY }}&libraries=places&callback=initMap&v=weekly" async></script>
<script>
function initMap() {
	
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -33.8688, lng: 151.2195},
      zoom: 15
    });

    var place="<?php echo $this->session->userdata('place') ?>";
  if(!(place)){
    if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position){
                console.log(position);
              var lat = position.coords.latitude;
              var lng = position.coords.longitude;
              
              lat_lng(lat,lng);
          });
       } else{
           alert('This browser does not support Geolocation Service.');
           return false;
       }
	   //  alert('This browser does not support Geolocation Service.!');
	  
	  function lat_lng(lat,lng){
        $.ajax({
        url: '<?php echo site_url('web/session_location'); ?>',
        type: 'POST',
        data: {
            place:'' ,
            lat: lat,
            lng:lng,
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if(data.status=='success'){
                $('.location').html(data.place);
                 ShowNotificator('success','Location set successfully');
               
            }else{
                ShowNotificator('warning',data.message);
            }
        }
    });
        

  
}

}
















    var input = document.getElementById('pac-input');
    //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });


    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  console.log(place);
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    
        var address = place.formatted_address;
        // if (place.address_components) {
        //     address = [
        //       (place.address_components[0] && place.address_components[0].short_name || ''),
        //       (place.address_components[1] && place.address_components[1].short_name || ''),
        //       (place.address_components[2] && place.address_components[2].short_name || '')
        //       (place.formatted_address)
        //     ].join(' ');
        // }
    
        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
      
       var address=address;
       var lati=place.geometry.location.lat();
       var lng=place.geometry.location.lng();
        
        $.ajax({
        url: '<?php echo site_url('web/session_location'); ?>',
        type: 'POST',
        data: {
            place:address ,
            lat: lati,
            lng:lng,
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if(data.status=='success'){
                $('.location').html(data.place);
                 ShowNotificator('success','location set successfully');
                 location.reload();
               
            }else{
                ShowNotificator('warning',data.message);
            }
        }
    });
        
        
    });
}
</script>


<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLCl-JK5usUBFwjG7Y0s9Ef3fSoPV0QTk&callback=initMap">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myAlert").alert("close");
    });
});
</script>
</body>

</html>