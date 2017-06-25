<?php

include_once '../buslogic.php';
//code check user is login or not
 if(!isset($_SESSION["lcod"])){ header("location:../login.php");  }
if(isset($_POST["btnupd"]))
{
   // echo "enter to update   section here ";
     $obj1= new clsprf();
    $obj1->prfname=$_POST["nam"];
   // $obj1->prfphn=$_POST["phn"];
  //  $obj1->prftype=$_POST["regtyp"];
   $obj1->prfcode=$_SESSION["prfcod"];
    $obj1->prfaddress=$_POST["address"];
    $obj1->prfcmp=$_POST["cmp"];
   
   $s=$_FILES["fil"]["name"];
    $s=  substr($s, strpos($s, '.'));
    $obj1->prfpic=$s;
   // echo"jnsadkcksd sakjdnxaskjcb sakjdnasknaskjd askdnaskjdnsakjdbaskjdnaskj;";
   // echo $s;
    $obj1->update_prf();
    $a=$_SESSION["prfcod"];
    if($s!="")
    {
   move_uploaded_file ($_FILES["fil"]["tmp_name"],"../delpics/".$a.$s);
    }
//     $msgreg="Registration sucessfull ";
     $msg="Updation Sucessfull ";
}

include_once 'header_1.php';

?>

 
 
<div class="noo-wrapper">
 
<div class="container noo-mainbody">
<div class="noo-mainbody-inner">
<div class="row clearfix">
 
<div class="noo-content col-xs-12 col-md-8">
<article class="noo-agent">
     <?php 
 
                                         $obj= new clsprf();  
                                       
                                                  $arr = $obj->dsp_prfbyusercod($_SESSION["lcod"]);
                                                     $pi=$arr[0][7];
                                                  $extension=  substr($pi, strpos($pi, '.'));
                                                  if($extension>3)
                                                  {
                                                     $pic='agent5.jpg'; 
                                                  }
 else {
      $pic=$arr[0][7];
 }
                                                      $name=$arr[0][2];
                                                  $phone= $arr[0][3];
                                                  $address= $arr[0][5];
                                                  $cmpny= $arr[0][4];
                                                  $_SESSION["prfcod"]=$arr[0][8];
 ?>
 
<h1 class="content-title"><?php echo $arr[0][2]; ?></h1>
 
 
<!--<ul class="social-list agent-social clearfix">
<li><a href="#" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
<li><a href="#" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
<li><a href="#" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a></li>
<li><a href="#" title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>
<li><a href="#" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></li>
</ul>-->
 

<div class="agent-info clearfix">
<div class="content-featured">
<div class="content-thumb">
    <img src="../delpics/<?php echo $pic; ?>" alt="">
</div>
</div>
<div class="agent-detail">
<h4 class="agent-detail-title">User Info</h4>
<div class="agent-detail-info">
<div class=""><i class="fa fa-phone"></i>&nbsp;
<span>Phone:</span><?php echo $arr[0][3]; ?></div>

<div class=""><i class="fa fa-envelope-square"></i>&nbsp;
<span>Email:</span><?php echo $arr[0][0]; ?></div>
<div class=""><i class="fa fa-skype"></i>&nbsp;
    <span>Type:</span><?php if($arr[0][2]=='O')  echo "Owner"; else echo "Dealer"; ?></div>
    <div class=""><i class="fa fa-skype"></i>&nbsp;
<span>Company:</span><?php echo $arr[0][4]; ?></div>
</div>
<div class="agent-desc">
<h4 class="agent-detail-title">Address</h4>
<p><?php echo $arr[0][5]; ?></p>
</div>
</div>
</div>
 

 
 

 
</article>
</div>
 
 
<div class="noo-sidebar noo-sidebar-right col-xs-12 col-md-4">
<div class="noo-sidebar-inner">
 
<div class="block-sidebar find-property">
<h3 class="title-block-sidebar">Update Profile </h3>
<div class="gsearch">
<div class="gsearch-wrap">
    <form class="gsearchform" method="post" role="search" action="frmprf.php" enctype="multipart/form-data" >
<div class="gsearch-content">
<div class="gsearch-field">
<div class="form-group glocation">
<div class="form-group s-prop-title">
<label for="nam">Name&nbsp;&#42;</label>
<input type="text" id="nam" class="form-control" value="<?php if(isset($name)) echo $name; ?>" name="nam" required="">
</div>
</div>
<!--<div class="form-group gsub-location">
<div class="form-group s-prop-title">
<label for="phn">Phone No&nbsp;&#42;</label>
<input type="text" id="phn" class="form-control" value="<?php if(isset($phone)) echo $phone; ?>" name="phn" required="">
</div>
</div>-->
<div class="form-group gstatus">
<div class="form-group s-prop-title">
<label for="address">Address&nbsp;&#42;</label>
<input type="text" id="address" class="form-control" value="<?php if(isset($address)) echo $address; ?>" name="address" required="">
</div>
</div>
<div class="form-group gtype">
<div class="form-group s-prop-title">
<label for="cmp">Company&nbsp;&#42;</label>
<input type="text" id="cmp" class="form-control" value="<?php if(isset($cmpny)) echo $cmpny; ?>" name="cmp" required="">
</div>
</div>
    <div class="form-group gtype">
    <div class="form-group s-prop-desc-new">
<label for="fil">Select Picture</label>
<input type="file" id="fil" name="fil">
    </div>
</div>
<!--<div class="form-group gbed">
<div class="form-group s-prop-title">
<label for="title">Name&nbsp;&#42;</label>
<input type="text" id="title" class="form-control" value="" name="title" required="">
</div>
</div>
<div class="form-group gbath">
<div class="label-select">
<div class="form-group s-prop-title">
<label for="title">Name&nbsp;&#42;</label>
<input type="text" id="title" class="form-control" value="" name="title" required="">
</div>
</div>
</div>-->
<!--<div class="form-group gprice">
<span class="gprice-label">Price</span>
<div class="gslider-range gprice-slider-range"></div>
<span class="gslider-range-value gprice-slider-range-value-min"></span>
<span class="gslider-range-value gprice-slider-range-value-max"></span>
</div>-->

</div>
<div class="gsearch-action">
<div class="gsubmit">
<!--<a class="btn btn-deault" href="#">Update</a>-->
<input class="btn btn-deault" type="submit" name="btnupd" value="Update">
</div>
</div>
    <div class="form-group garea">
<?php
        if(isset($msg))
            echo '<label style="color: red;
    font-weight: bold;" >'.$msg.'</label>';
        ?>
</div>
</div>
</form>
</div>
</div>
</div>
 

 
</div>
</div>
 
</div>
</div>
</div>
 
</div>
 
 <?php
include_once 'footer_1.php';
?>