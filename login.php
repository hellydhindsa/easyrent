<?php
ob_start();
include_once 'buslogic.php';
if(isset($_REQUEST["sts"])&& $_REQUEST["sts"]=='S')
{
    unset($_SESSION["lcod"]);
}
if(isset($_POST["btnlogin"]))
{
 
    $obj= new clsreg();
    $r=$obj->logincheck($_POST["log"],$_POST["pwd"]);
  //  echo $r;
    if($r=='N')
    {
        $msg="Email Password Incorrect";
    }
        elseif ($r=='U') 
        {
         if(isset($_SESSION["MoreDetailPno"]))
         {
              header("location:user/FrmMoreDetailView.php"); 
         }
        elseif(isset($_SESSION["MoreDetailAgentno"]))
         {
              header("location:user/agentsdetail.php"); 
         }
         else
         {
    header("location:user/frmpg.php");
        }
        
         }
   elseif ($r=='A')
   {
  header("location:admin/frmcty.php");
   }
//    elseif($r=='H')
//        header("location:#");
    
}
if(isset($_POST["btnreg"]))
{
    //------------------sms sending---------
    $otp = rand(1000, 9999);
$url = 'http://smslowprice.com/SendingSms.aspx';
$fields = array('userid'=>urlencode('vickysingla'),
'pass'=>urlencode('welcome@123'),
'phone'=>urlencode($_POST["phn"]),
'msg'=>urlencode('Dear '.$_POST["nam"].', Thanks for Registration.Your Mobile Verification Code for EasyRent is '.$otp.' .'));
$fields_string='';
foreach($fields as $key=>$value)
{ $fields_string .=$key.'='.$value.'&';}
rtrim($fields_string,'&');
$url_final=$url.'?'.$fields_string;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url_final);
$result = curl_exec($ch);
curl_close($ch);
//------------------------------
    $obj= new clsreg();
    $obj->regdate=date('y-m-d');
    $obj->regemail=$_POST["eml"];
 
    $obj->regpwd=$_POST["pwd"];
    $obj->regrol='U';
   $rcode= $obj->save_reg();
 
   $obj1= new clsprf();
    $obj1->prfname=$_POST["nam"];
    $obj1->prfphn=$_POST["phn"];
    $obj1->prftype=$_POST["regtyp"];
    $obj1->prfregcod=$rcode;
    $obj1->prfaddress=$_POST["address"];
    $obj1->prfcmp=$_POST["cmp"];
    $obj1->prfIsActive=0;
    $obj1->otpIsApproved=0;
    $obj1->Otp=$otp;
    $obj1->prfLocation=$_POST["AgentLocation"];

   $s=$_FILES["fil"]["name"];
    $s=  substr($s, strpos($s, '.'));
    $obj1->prfpic=$s;
    echo $s;
    $a=$obj1->save_prf();
    if($s!="")
    {
   move_uploaded_file ($_FILES["fil"]["tmp_name"],"delpics/".$a.$s);
    }
//     $msgreg="Registration sucessfull ";
     $msg="Registration sucessfull ";
 
     
     
     
  
}
ob_end_clean();
?>
<!doctype html>
<html lang="en">

<!-- Mirrored from html.nootheme.com/citilights/login-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Jun 2015 07:46:40 GMT -->
<head>
<meta charset="utf-8">
<title>EasyRent - Login - Register</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="images/icon/favicon.jpg" type="image/x-icon">
 
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,300italic,400italic' rel='stylesheet' type='text/css'>
 
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/style-selector.css">

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/shortcode.css">
<link id="style-main-color" rel="stylesheet" href="css/color/color1.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>

 
function getState(val) {
   
	$.ajax({
	type: "POST",
	url: "user/get_state.php",
	data:'country_id='+val,
	success: function(data){
		$("#pgloc").html(data);
	}
	});
}
</script>
  <style>
    .abcform>form{float:left; margin-left: 33%;
    margin-right: auto;
    max-width: 450px;  }
    .btn-large11{
        background-color: #f0e797;
        color: #bdb254;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    margin-top: 0;
    padding: 8px 16px;
    text-transform: uppercase;
    transition: all 0.3s linear 0s;
   
    }
      .form-group.s-prop-desc-new textarea {
    background-color: rgb(255, 255, 255);
    border: 1px solid rgb(222, 222, 222);
    border-collapse: separate;
    border-radius: 3px;
    bottom: auto;
    box-shadow: none;
    box-sizing: border-box;
    clear: none;
    display: block;
    float: none;
    height: 100px;
    left: auto;
    margin: 0;
    outline: 0 none rgb(85, 85, 85);
    outline-offset: 0;
    padding: 8px;
    position: static;
    right: auto;
    text-align: start;
    top: auto;
    vertical-align: baseline;
   
    z-index: auto;
}
.btn11 {
    color: #bdb254;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    margin-top: 0;
/*    padding: 8px 16px;*/
    text-transform: uppercase;
    transition: all 0.3s linear 0s;
/*    width: 100%;*/
background-color: #f0e797;
-moz-user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    cursor: pointer;
    display: inline-block;
  
 
    line-height: 1.42857;
   
    padding: 6px 12px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
}
</style>
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="page-fullwidth">
 
<div class="site">
 
<header class="noo-header">
 
<div class="top-header">
<div class="container">
<div class="top-header-inner">
<ul class="social-top">
<li><a href="#" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
<li><a href="#" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>

</ul>
<div class="top-header-content">
<div class="emailto content-item">
<a href="http://html.nootheme.com/cdn-cgi/l/email-protection#f29b9c949db2919b869b9e9b959a8681dc919d9f"><i class="fa fa-envelope-o"></i>&nbsp;Email:<span class="__cf_email__" data-cfemail="056c6b636a45666c716c696c626d71762b666a68">[email&#160;protected]</span><script cf-hash='f9e31' type="text/javascript">
/* <![CDATA[ */!function(){try{var t="currentScript"in document?document.currentScript:function(){for(var t=document.getElementsByTagName("script"),e=t.length;e--;)if(t[e].getAttribute("cf-hash"))return t[e]}();if(t&&t.previousSibling){var e,r,n,i,c=t.previousSibling,a=c.getAttribute("data-cfemail");if(a){for(e="",r=parseInt(a.substr(0,2),16),n=2;a.length-n;n+=2)i=parseInt(a.substr(n,2),16)^r,e+=String.fromCharCode(i);e=document.createTextNode(e),c.parentNode.replaceChild(e,c)}}}catch(u){}}();/* ]]> */</script></a>
</div>
<div class="register content-item">
<a href="login.php"><i class="fa fa-key"></i>&nbsp;Register</a>
</div>
<div class="login content-item">
<a href="login.php"><i class="fa fa-sign-in"></i>&nbsp;Login</a>
</div>
 
<div class="header-search">
<label for="input-header-search"><i class="fa fa-search"></i></label>
<input type="text" id="input-header-search" placeholder="Search">
</div>
</div>
</div>
</div>
</div>
 
 
<div class="main-nav-wrap container">
 
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<div class="logo">
<div class="logo-image">
<a href="index.php" title="NooTheme CitiLights"></a>
</div>
</div>
</div>
 
 
<div class="calling-info">
<div class="calling-content">
<i class="fa fa-mobile"></i>
<div class="calling-desc">
CALL US NOW<br>
<span><a>9878161852</a></span>
</div>
</div>
</div>
 
 
<div class="main-navigation">
<nav class="collapse navbar-collapse" id="main-collapse" role="navigation">
<ul class="nav navbar-nav">
<li class="dropdown active">
<a href="index.php">Home&nbsp;<span class="caret"></span></a>

</li>
<li class="dropdown">
<a href="http://localhost:8080/property/ListWithSidebar.php?loc=0&typ=A&cat=A">Properties&nbsp;<span class="caret"></span></a>

</li>

<li class="dropdown active">
    <a href="login.php">Post Property&nbsp;<span class="caret"></span></a>

</li>
<li class="dropdown active">
<a href="index.php">Get Alerts&nbsp;<span class="caret"></span></a>

</li>
<li class="dropdown">
<a href="FrmAgentListing.php">Agents&nbsp;<span class="caret"></span></a>

</li>

<li class="dropdown">
<a href="contact.php">Contact&nbsp;<span class="caret"></span></a>

</li>
</ul>
</nav>
</div>
 
</div>
 
</header>
 
<div class="noo-wrapper">
 
<div class="container-fluid noo-mainbody">
<div class="noo-mainbody-inner">
<div class="row clearfix">
 
<div class="noo-content col-xs-12">
<div class="page-content row">
<div class="col-md-12">
<div class="noo-logreg both">
<div class="logreg-container">
<div class="row clearfix logreg-content">
  
<div class="col-md-12 abcform">
  <form action="login.php" name="login" method="post">
<div class="logreg-title">Login Form</div>
<p class="logreg-desc">Already a member of EasyRent. Please use the form below to log in site.</p>
<div class="form-message"></div>
<div class="logreg-content">
<div class="form-group">
<input type="text" class="form-control" id="log" name="log" placeholder="Username *" required="">
</div>
<div class="form-group">
<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password *" required="">
</div>
</div>
<div class="logreg-action">
<input type="submit" value="Login" name="btnlogin" id="btnlogin" class="btn navbar-btn" />
<?php
        if(isset($msg))
            echo '<label style="color: red;
    font-weight: bold;" >'.$msg.'</label>';
        ?>
</div>
<!--<p class="logreg-desc">Lost your password? <a href="#">Click here to reset</a>
</p>-->

<p class="logreg-desc">Not register yet? <button type="button" class="btn-link" data-toggle="modal" data-target="#myModal">Click Here to register</button>
</p>
 </form>
<!--   ------------------------------------------pop up------------------------------------------------------>




  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title"> Registration form </h2>
        </div>
        <div class="modal-body">

 




         <form name="registration-form" id="registration-form" class="noo-form property-form" action="login.php" method="post"  enctype="multipart/form-data" >
          <div class="col-md-8">
           <div class="form-group s-prop-title">  
 <label class="radio-inline">
      <input type="radio" name="regtyp" value="O" checked="checked">Owner
    </label>
    <label class="radio-inline">
      <input type="radio" name="regtyp" value="B">Broker
    </label>
                <label class="radio-inline">
      <input type="radio" name="regtyp" value="U">Other
    </label>
</div>
</div>
     
        <div class="col-md-8">
<div class="form-group s-prop-title">
<label for="nam">Name&nbsp;&#42;</label>
<input type="text" id="nam" class="form-control" value="" name="nam" required="">
</div>
</div>
<div class="col-md-4">
<div class="form-group s-prop-area">
<label for="phn">Phone No&nbsp;(+91)</label>
<input type="text" id="phn" class="form-control" value="" name="phn" required="">
</div>
</div>
                     <div class="col-md-6">
<div class="form-group s-prop-title">
<label for="eml">Email Id&nbsp;&#42;</label>
<input type="text" id="eml" class="form-control" value="" name="eml" required="">
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-area">
<label for="cmp">Company Name</label>
<input type="text" id="cmp" class="form-control" value="" name="cmp">
</div>
</div>
                                 <div class="col-md-6">
<div class="form-group s-prop-title">
<label for="pwd">Password&nbsp;&#42;</label>
<input type="password" id="pwd" class="form-control" value="" name="pwd" required="">
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-area">
<label for="cpwd">Confirm Password&nbsp;&#42</label>
<input type="password" id="cpwd" class="form-control" value="" name="cpwd" required="">
</div>
</div>
             <div class="col-md-6">
<div class="form-group s-prop-area">
<label for="cpwd">City&nbsp;&#42</label>
<select class="form-control" onChange="getState(this.value);" required>
    <option value="0">Select City</option>
 <?php
  $obj= new clscat();         
  $CitiesArray = $obj->dsp_cat();
     for($i=0; $i<count($CitiesArray); $i++)
        {
          echo " <option value=".$CitiesArray[$i][0]." />".$CitiesArray[$i][1]."</option>";
         }
        ?>
</select>
</div>
</div>
             <div class="col-md-6">
<div class="form-group s-prop-area">
<label for="cpwd">Location&nbsp;&#42</label>
<select class="form-control" name="AgentLocation" id="pgloc" required>
    <option value="0">Select Location</option>

</select>
</div>
</div>
             <div class="col-md-12">
<div class="form-group s-prop-desc-new">
<label for="textarea">Address&nbsp;&#42;</label>
<textarea id="textarea" name="address" rows="3" required=""></textarea>

</div>
</div>
         <div class="col-md-12">
<div class="form-group s-prop-desc-new">
<label for="fil">Select Picture</label>
<input type="file" id="fil" name="fil">

</div>
</div>

          
          <div class="form-actions">
            <button type="submit" name="btnreg" id="btnreg" class="btn11 navbar-btn btn-default">Register</button>
            <button type="reset" class="btn11 navbar-btn btn-default">Cancel</button>
          </div>
  
      </form>  


    

        </div>
        <div class="modal-footer">
          <button type="button" class="btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<!--          ---------------------------------------------------close  popup-------------------------------  -->


</div>
    
<!--    
<div class="col-md-6 register-form">
<form name="registerform" id="registerform" method="post" role="form">
 <form action="login.php" name="reg" method="post">
<div class="logreg-title">Register Form</div>
<p class="logreg-desc">Don't have an account? Please fill in the form below to create one.</p>
<div class="form-message"></div>
<div class="logreg-content">
<div class="form-group">
<label for="user_login" class="sr-only">Username</label>

<input type="text" class="form-control" id="regusr" name="regusr" placeholder="Username *" required="">
</div>
<div class="form-group">
<label for="user_email" class="sr-only">Your Email</label>
<input type="password" class="form-control" id="regpwd" name="regpwd" placeholder="password *" required="">
</div>
</div>
<div class="logreg-action">

<input type="submit" value="Register Account" name="btnreg" class="btn navbar-btn" />
<?php
        if(isset($msgreg))
            echo "<label>".$msgreg."</label>";
        ?>
</div>
  </form>
</div>-->
  
</div>
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
include_once 'footer.php';
?>