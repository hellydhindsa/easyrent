<?php
include_once 'buslogic.php';

if(isset($_POST["Contact_submit"]))
{
    $obj= new ContactForm();
    $obj->contactFormName=$_POST["your-name"];
    $obj->contactFormEmail=$_POST["your-email"];
    $obj->contactFormSubject=$_POST["your-subject"];
    $obj->contactFormMessage=$_POST["your-message"];
    $obj->contactFormDate=date('y-m-d');
   $sts= $obj->saveContactForm();
   if($sts)
   {
 $msg="Your message is Submitted.";
   }
   else
   {

       
   }

}

include_once 'header.php';
?>
<div class="noo-wrapper">
 
<div class="container noo-mainbody">
<div class="noo-mainbody-inner">
<div class="row clearfix">
 
<div class="noo-content col-xs-12 col-md-8">
<div class="page-content">

    <h4>CONTACT US</h4>
<div class="row contact-form">
<div class="col-sm-6 col-md-4">
<div class="contact-info">
<div class="text-block">
<h4>Contact Info</h4>
</div>
<div class="text-block">
<ul>
<li><b>Address</b>SE0 244 Sector 34c Chandigarh</li>
<li><b>Phone</b>9878161852</li>
<li><b>Email</b>info@EasyRent.co.in</li>
<li><b>Office</b>9465209952</li>
<li><b>Website</b>http://EasyRent.co.in</li>
</ul>
</div>
</div>
</div>
<div class="col-sm-12 col-md-8">
<div class="contact-desc">
<div class="text-block">
<h4>Drop Us A Line</h4>
<p>If you have any problems, please use the form below to leave us your questions. We will reply you as soon as possible. Thank you!</p>
 <?php
        if(isset($msg))
            echo '<label style="color: red;
    font-weight: bold;" >'.$msg.'</label>';
        ?>
</div>
<hr class="noo-gap">
<form name="new_post" method="post"  action="contact.php">
   <p>
<span class="form-group form-control-wrap your-name">
<input type="text" name="your-name" class="form-control" value="" size="40" placeholder="Your Name*">
</span>
</p>
<p>
<span class="form-group form-control-wrap your-email">
<input type="email" name="your-email" class="form-control" value="" size="40" placeholder="Your Email*">
</span>
</p>
<p>
<span class="form-group form-control-wrap your-subject">
<input type="text" name="your-subject" class="form-control" value="" size="40" placeholder="Subject">
</span>
</p>
<p>
<span class="form-group form-control-wrap your-message">
<textarea name="your-message" cols="40" class="form-control" rows="10" placeholder="Your Message"></textarea>
</span>
</p>
<p>
<input type="submit" name="Contact_submit" class="submit" value="SEND MESSAGE">

</p>
</form>
</div>
</div>
</div>
</div>
</div>
 
 
<div class="noo-sidebar noo-sidebar-right col-xs-12 col-md-4">
<div class="noo-sidebar-inner">
 
<div class="block-sidebar calendar">
<h4 class="title-block-sidebar">Calendar</h4>
<div class="datepicker"></div>
</div>
 
</div>
</div>
 
</div>
</div>
</div>
 
</div>
 
 <?php
include_once 'footer.php';
?>