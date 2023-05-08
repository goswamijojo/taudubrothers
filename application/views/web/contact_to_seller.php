

<!--<div class="page-title-area">-->
<!--<div class="d-table">-->
<!--<div class="d-table-cell">-->
<!--<div class="container">-->
<!--<div class="title-content">-->
<!--<h2>Contact to Seller</h2>-->
<!--<ul>-->
<!--<li>-->
<!--<a href="<?php echo base_url();?>">Home</a>-->
<!--</li>-->
<!--<li>-->
<!--<span>Contact to Seller</span>-->
<!--</li>-->
<!--</ul>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--<div class="title-img">-->
<!--      <img src="<?php echo base_url();?>web/assets/images/page-title1.jpg" alt="About">-->
<!--      <img src="<?php echo base_url();?>web/assets/images/shape16.png" alt="Shape">-->
<!--      <img src="<?php echo base_url();?>web/assets/images/shape17.png" alt="Shape">-->
<!--      <img src="<?php echo base_url();?>web/assets/images/shape18.png" alt="Shape">-->
<!--   </div>-->
<!--</div>-->


<div class="contact-area pt-100 pb-70">
<div class="container">
<div class="section-title text-center">
<h2>Contact to Seller</h2>

</div>
<div class="row">
    
<div class="col-sm-12 col-lg-12 m-auto">
    
    <?php if(!empty($this->session->flashdata('error'))) { ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Error!</strong><?php echo $this->session->flashdata('error'); ?>
</div><?php } ?>

<?php if(!empty($this->session->flashdata('success'))) { ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Success! </strong><?php echo $this->session->flashdata('success'); ?>
</div><?php } ?>


<form  method="post" action="<?php echo base_url('connect_seller');?>" class="taudu_contact">
<div class="row" id="contactForm">
<div class="col-6 col-lg-6">
<div class="form-group">
<input type="text" name="name" id="name" class="form-control" placeholder="Name" required data-error="Please enter your name">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-6 col-lg-6">
<div class="form-group">
<input type="email" name="email" id="email" class="form-control" placeholder="Email" required data-error="Please enter your email">
 <div class="help-block with-errors"></div>
</div>
</div>
<div class="col-6 col-lg-6">
<div class="form-group">
<input type="text" name="phone" id="phone_number" placeholder="Phone No." required data-error="Please enter your number" class="form-control" pattern="^([\-\s]?)?[0]?(91)?[6789]\d{9}$" title="please enter a valid phone number" maxlength="10">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-6 col-lg-6">
<div class="form-group">
<input type="text" name="whatsapp" id="msg_subject" class="form-control" placeholder="Whatsapp No." required data-error="Please enter your Whatsapp No." pattern="^([\-\s]?)?[0]?(91)?[6789]\d{9}$" title="please enter a valid phone number" maxlength="10">
<div class="help-block with-errors"></div>
</div>
</div>

<div class="col-lg-12">
<div class="form-group">
<input type="text" name="location" id="msg_subject" class="form-control" placeholder="Location" required data-error="Please enter your Location">
<div class="help-block with-errors"></div>

</div>
</div>
<div class="col-lg-12">
<div class="form-group">
<textarea name="message" class="form-control" id="message" cols="30" rows="8" placeholder="Write message" required data-error="Write your message"></textarea>
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-lg-12">
<div class="form-group">
<div class="form-check">
<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3" required="">
<label class="form-check-label" for="flexCheckDefault3">
I accept all <a href="<?php echo base_url('term_condition')?>">Terms & Conditions</a>
</label>
</div>
</div>
</div>
<div class="col-lg-12">
<div class="text-center">
<button type="submit" class="btn common-btn">
Send Message
<img src="<?php echo base_url();?>web/assets/images/shape1.png" alt="Shape">
<img src="<?php echo base_url();?>web/assets/images/shape2.png" alt="Shape">
</button>
<div id="msgSubmit" class="h3 text-center hidden"></div>
<div class="clearfix"></div>
</div>
</div>
</div>
</form>
</div>
<!--<div class="col-sm-6 col-lg-4">-->
<!--<div class="contact-info">-->
<!--<h3>Contact Information:</h3>-->
<!--<ul class="info">-->
<!--<li>-->
<!--<i class="flaticon-pin"></i>-->
<!--<a href="#">Sector 63 Rd, C Block, Sector 63, Noida, Uttar Pradesh 201309</a>-->

<!--</li>-->
<!--<li>-->
<!--<i class="flaticon-phone-call"></i>-->
<!--<a href="tel:+7417104056">+91-7417104056</a>-->

<!--</li>-->
<!--</ul>-->
<!--</div>-->
<!--</div>-->
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
	    function testInput(event) {
   var value = String.fromCharCode(event.which);
   var pattern = new RegExp(/[a-zåäö ]/i);
   return pattern.test(value);
}

$('#name').bind('keypress', testInput);
$('#father_name').bind('keypress', testInput);
	</script>

