<?php

include_once '../buslogic.php';
//code check user is login or not and IS It Admin
 if(!isset($_SESSION["lcod"]) || $_SESSION["lcod"]!=11){header("location:../login.php");}
 


if(isset($_POST["buttonChangePassword"]))
{
 if($_POST["Password"]==$_POST["Confirmpassword"]){
    $obj= new clsreg();
    $r=$obj->ChangePassword($_POST["Password"],$_SESSION["lcod"]);
  
             if($r=='N')
    {
        $msg="Change Password Not Completed";
       
    }
    else
    {
        $msg="Dear Admin Change Password Completed Sucessfully"; 
        $ObjGeneralFunction= new GeneralFunction();
        $ObjGeneralFunction->SendMessageByPhone($r, $msg);
       
    }
  
 }
  else
  {
      $msg="Password and Confirm Password are not same";  
  }

}

  include_once 'AdminHeader.php';
?>

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
    <form action="ChangePassword.php" name="login" method="post">
<div class="logreg-title">Change Password Form</div>
<p class="logreg-desc">Already a member of EasyRent. Please use the form below to change password in site.</p>
<div class="form-message"></div>
<div class="logreg-content">
<div class="form-group">
<input type="password" class="form-control" id="pwd" name="Password" placeholder="New Password *" required="">
</div>
<div class="form-group">
<input type="password" class="form-control" id="pwd" name="Confirmpassword" placeholder=" Confirm Password *" required="">
</div>
</div>
<div class="logreg-action">
<input type="submit" value="Submit" name="buttonChangePassword" id="btnlogin" class="btn navbar-btn" />
<?php
        if(isset($msg))
            echo '<label style="color: red;
    font-weight: bold;" >'.$msg.'</label>';
        ?>

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
 
</div>
</div>

 <?php
include_once 'Adminfooter.php';
?>