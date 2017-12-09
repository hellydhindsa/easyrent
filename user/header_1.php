<html lang="en">
<head>
<meta charset="utf-8">
<title>EasyRent - Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="../images/icon/favicon.jpg" type="image/x-icon">

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

<!-- Include Bootstrap Datepicker -->

</head>
<body class="home page-fullwidth">
 
<div class="site">
 
<header class="noo-header">
 
<div class="top-header">
<div class="container">
<div class="top-header-inner">
<ul class="social-top">
<li><a href="https://www.facebook.com/easyrent.co.in" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
<li><a href="https://www.facebook.com/easyrent.co.in" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>

</ul>
<div class="top-header-content">
<div class="emailto content-item">
<a href="#"><i class="fa fa-envelope-o"></i>&nbsp;Email:info@easyrent.com</a>
</div>
<div class="register content-item">
<!--<a href="login.php"><i class="fa fa-key"></i>&nbsp;Register</a>-->
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
<a href="../login.php?sts=S"><i class="fa fa-sign-out"></i>&nbsp;LogOut</a>
</div>' ;  
   }
   ?>
 
<div class="header-search">
<!--<label for="input-header-search"><i class="fa fa-search"></i></label>
<input type="text" id="input-header-search" placeholder="Search">-->
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
    <a href="../index.php" title="Easy Rent"></a>
</div>
</div>
</div>

 <div class="main-navigation">
<nav class="collapse navbar-collapse" id="main-collapse" role="navigation">
<ul class="nav navbar-nav">
    <li class="dropdown">
<a href="frmprf.php" >My Profile&nbsp;<span class="caret"></span></a>
</li>
<li class="dropdown">
<a href="frmmyprp.php">My Properties&nbsp;<span class="caret"></span></a>
</li>
<li class="dropdown">
    <a href="frmpg.php">Add PG &nbsp;<span class="caret"></span></a>

</li>
<li class="dropdown">
    <a href="frmflo.php">Add Floor&nbsp;<span class="caret"></span></a>

</li>
<li class="dropdown">
<a href="frmhou.php">Add House&nbsp;<span class="caret"></span></a>

</li>
<li class="dropdown">
<a href="frmcom.php">Add Commercial Property&nbsp;<span class="caret"></span></a>

</li>


<li class="dropdown">
    <a href="ChangePassword.php">Change Password&nbsp;<span class="caret"></span></a>

</li>
</ul>
</nav>
</div>
</div>
</header>