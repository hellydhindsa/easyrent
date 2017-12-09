<?php
include_once '../buslogic.php';

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
include_once 'AdminHeader.php';
?>
<div class="noo-wrapper">
 
<div class="container noo-mainbody">
<div class="noo-mainbody-inner">
<div class="row clearfix">
 
<div class="noo-content col-xs-12 col-md-8">
<div class="page-content">

    <h4>CONTACT More Detail</h4>
<div class="row contact-form">

<div class="col-sm-12 col-md-12">
<div class="contact-desc">

<hr class="noo-gap">
<form name="new_post" method="post"  action="contact.php">
   <p>
<span class="form-group form-control-wrap your-name">
<input type="text" name="your-name" class="form-control" value="" size="40" placeholder="Contact Name*" readonly="true">
</span>
</p>
<p>
<span class="form-group form-control-wrap your-email">
<input type="email" name="your-email" class="form-control" value="" size="40" placeholder="Contact Email*" readonly="true">
</span>
</p>
<p>
<span class="form-group form-control-wrap your-subject">
    <input type="text" name="your-subject" class="form-control" value="" size="40" placeholder="contact Subject" readonly="true">
</span>
</p>
<p>
<span class="form-group form-control-wrap your-message">
<textarea name="your-message" cols="40" class="form-control" rows="10" placeholder="contact Message" readonly="true"></textarea>
</span>
</p>
<p>

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
include_once 'Adminfooter.php';
?>