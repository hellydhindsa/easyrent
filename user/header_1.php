<!doctype html>
<html lang="en">

<!-- Mirrored from html.nootheme.com/citilights/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Jun 2015 07:46:40 GMT -->
<head>
<meta charset="utf-8">
<title>EasyRent - Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="../images/icon/favicon.jpg" type="image/x-icon">
 
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,300italic,400italic' rel='stylesheet' type='text/css'>
 
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="../css/jquery.nouislider.min.css">
<link rel="stylesheet" href="../css/style-selector.css">
 
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/shortcode.css">
<link rel="stylesheet" href="../css/home.css">
<link rel="stylesheet" href="../css/citilights-shortcode.css">
<link id="style-main-color" rel="stylesheet" href="../css/color/color1.css">
<script type="text/javascript" src="../js/jquery.min.js"></script>
<!--<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-6655257-31', 'auto');
    ga('send', 'pageview');
  </script>-->
 
 
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->



<!-- Include Bootstrap Datepicker -->

</head>
<body class="home page-fullwidth">
 
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
<a href="#"><i class="fa fa-envelope-o"></i>&nbsp;Email:info@easyrent.co.in<script cf-hash='f9e31' type="text/javascript">
/* <![CDATA[ */!function(){try{var t="currentScript"in document?document.currentScript:function(){for(var t=document.getElementsByTagName("script"),e=t.length;e--;)if(t[e].getAttribute("cf-hash"))return t[e]}();if(t&&t.previousSibling){var e,r,n,i,c=t.previousSibling,a=c.getAttribute("data-cfemail");if(a){for(e="",r=parseInt(a.substr(0,2),16),n=2;a.length-n;n+=2)i=parseInt(a.substr(n,2),16)^r,e+=String.fromCharCode(i);e=document.createTextNode(e),c.parentNode.replaceChild(e,c)}}}catch(u){}}();/* ]]> */</script></a>
</div>
<div class="register content-item">
<a href="login.php"><i class="fa fa-key"></i>&nbsp;Register</a>
</div>
<!--<div class="login content-item">
<a href="login.php"><i class="fa fa-sign-in"></i>&nbsp;Login</a>
</div>-->
 <?php
    if(!isset($_SESSION["lcod"]))
   {
       echo'<div class="login content-item">
<a href="../login.php"><i class="fa fa-sign-in"></i>&nbsp;Login</a>
</div>' ;
   }
   else
   {
     echo'<div class="login content-item">
<a href="../login.php?sts=S"><i class="fa fa-sign-out"></i>&nbsp;Login Out</a>
</div>' ;  
   }
   ?>
 
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
    <a href="../index.php" title="NooTheme CitiLights"></a>
</div>
</div>
</div>
 
 
<div class="calling-info">
<div class="calling-content">
<i class="fa fa-mobile"></i>
<div class="calling-desc">
CALL US NOW<br>
<span><a href="tel:(+01)-793-7938">(+01)-793-7938</a></span>
</div>
</div>
</div>
 

 <div class="main-navigation">
<nav class="collapse navbar-collapse" id="main-collapse" role="navigation">
<ul class="nav navbar-nav">
<li class="dropdown active">
    <a href="frmpg.php">Add PG&nbsp;<span class="caret"></span></a>

</li>
<li class="dropdown">
    <a href="frmflo.php">Add Floor&nbsp;<span class="caret"></span></a>

</li>
<li class="dropdown">
<a href="frmhou.php">Add house&nbsp;<span class="caret"></span></a>

</li>
<li class="dropdown">
<a href="frmcom.php">Add commercial Property&nbsp;<span class="caret"></span></a>

</li>
<li class="dropdown">
<a href="#">abc3&nbsp;<span class="caret"></span></a>

</li>
<li class="dropdown">
<a href="contact.html">abc4&nbsp;<span class="caret"></span></a>

</li>
</ul>
</nav>
</div>
</div>
 
</header>
 