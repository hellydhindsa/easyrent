<?php
ob_start();
include_once 'buslogic.php';
$showOTP_modal = false;
if(isset($_REQUEST["sts"])&& $_REQUEST["sts"]=='S')
{
    unset($_SESSION["lcod"]);
}
//  function ActionAfterLogin()
//     {
//          $msg='enter method';
//             if($r=='N')
//    {
//        $msg="Email Password Incorrect";
//        clearLoginSessions();
//    }
//        elseif ($r=='U') 
//        {
//         if(isset($_SESSION["MoreDetailPno"]))
//         {
//             $PropertyNO=$_SESSION["MoreDetailPno"];
//             $PropertyType=$_SESSION["MoreDetailPType"];
//              header("location:user/FrmMoreDetailView.php?pno=$PropertyNO&typ=$PropertyType");
//             // header("location:user/FrmMoreDetailView.php"); 
//               unset($_SESSION["MoreDetailPno"]);
//               unset($_SESSION["MoreDetailPType"]);
//         }
//        elseif(isset($_SESSION["MoreDetailAgentno"]))
//         {
//              header("location:user/agentsdetail.php"); 
//         }
//         else
//         {
//    header("location:user/frmpg.php");
//        }
//        clearLoginSessions();
//         }
//   elseif ($r=='A')
//   {
//  header("location:admin/frmcty.php");
//  clearLoginSessions();
//   }
//    elseif ($r=='O')
//   {
//        $_SESSION["LoginEmail"]=$_POST["log"];
//        $_SESSION["LoginPassword"]=$_POST["pwd"];
//      //  $showOTP_modal=true;
//      
//       echo '<script type="text/javascript">',
//     ' $(\'#OTPConfirmModel\').modal();',
//     '</script>';
//   }
//  
//     }
if(isset($_POST['resendOTP'])){
   //myFunction(); //here goes the function call
}
if(isset($_POST["btnlogin"]))
{
 
    $obj= new clsreg();
    $r=$obj->logincheck($_POST["log"],$_POST["pwd"]);
  
             if($r=='N')
    {
        $msg="Email Password Incorrect";
        clearLoginSessions();
    }
        elseif ($r=='U') 
        {
         if(isset($_SESSION["MoreDetailPno"]))
         {
           $PropertyNO=$_SESSION["MoreDetailPno"];
             $PropertyType=$_SESSION["MoreDetailPType"];
              header("location:user/FrmMoreDetailView.php?pno=$PropertyNO&typ=$PropertyType");
             // header("location:user/FrmMoreDetailView.php"); 
               unset($_SESSION["MoreDetailPno"]);
               unset($_SESSION["MoreDetailPType"]);
         }
        elseif(isset($_SESSION["MoreDetailAgentno"]))
         {
            $Agentno=$_SESSION["MoreDetailAgentno"];
             header("location:user/agentsdetail.php?ano=$Agentno");
             unset($_SESSION["MoreDetailAgentno"]);
              //header("location:user/agentsdetail.php"); 
         }
           elseif(isset($_SESSION["TypeAlerts"]))
         {
             header("location:user/frmAlerts.php");
             unset($_SESSION["TypeAlerts"]);
             
         }
         else
         {
    header("location:user/frmpg.php");
        }
        clearLoginSessions();
         }
   elseif ($r=='A')
   {
  header("location:admin/frmcty.php");
  clearLoginSessions();
   }
    elseif ($r=='O')
   {
        $_SESSION["LoginEmail"]=$_POST["log"];
        $_SESSION["LoginPassword"]=$_POST["pwd"];
        $showOTP_modal=true;
      $msg='OTP REQUIRED';
     
   }
  

}
if(isset($_POST["submitOtpVerification"]))
{
  //  $msg=$_SESSION["LoginEmail"].$_SESSION["LoginPassword"].$_POST["OTPTextBox"];
     $obj= new clsreg();
    $r=$obj->UpdateOTPStatus($_SESSION["LoginEmail"],$_SESSION["LoginPassword"],$_POST["OTPTextBox"]);  
  //  ActionAfterLogin($r);
                if($r=='N')
    {
        $msg="Email Password Incorrect";
        clearLoginSessions();
    }
        elseif ($r=='U') 
        {
         if(isset($_SESSION["MoreDetailPno"]))
         {
               $PropertyNO=$_SESSION["MoreDetailPno"];
             $PropertyType=$_SESSION["MoreDetailPType"];
              header("location:user/FrmMoreDetailView.php?pno=$PropertyNO&typ=$PropertyType");
             // header("location:user/FrmMoreDetailView.php"); 
               unset($_SESSION["MoreDetailPno"]);
               unset($_SESSION["MoreDetailPType"]);
         }
        elseif(isset($_SESSION["MoreDetailAgentno"]))
         {
             $Agentno=$_SESSION["MoreDetailAgentno"];
             header("location:user/agentsdetail.php?ano=$Agentno");
             unset($_SESSION["MoreDetailAgentno"]);
             // header("location:user/agentsdetail.php"); 
         }
           elseif(isset($_SESSION["TypeAlerts"]))
         {
             header("location:user/frmAlerts.php");
             unset($_SESSION["TypeAlerts"]);
             
         }
         else
         {
    header("location:user/frmpg.php");
        }
        clearLoginSessions();
         }
   elseif ($r=='A')
   {
  header("location:admin/frmcty.php");
  clearLoginSessions();
   }
    elseif ($r=='O')
   {
       // $_SESSION["LoginEmail"]=$_POST["log"];
      //  $_SESSION["LoginPassword"]=$_POST["pwd"];
        $showOTP_modal=true;
      $msg='OTP REQUIRED';
     
   }
}
if(isset($_POST["btnreg"]))
{
 
    $obj= new clsreg();
    $obj->regdate=date('y-m-d');
    $obj->regemail=$_POST["eml"];
 
    $obj->regpwd=$_POST["pwd"];
    $obj->regrol='U';
   $rcode= $obj->save_reg();
 if($rcode!=1062)
 {
     $otp = rand(1000, 9999);
   $obj1= new clsprf();
    $obj1->prfname=$_POST["nam"];
    $obj1->prfphn=$_POST["phn"];
    $obj1->prftype=$_POST["regtyp"];
    $obj1->prfregcod=$rcode;
    $obj1->prfaddress=$_POST["address"];
    $obj1->prfcmp=$_POST["cmp"];
    $obj1->prfIsActive=1;
    $obj1->otpIsApproved=0;
    $obj1->Otp=$otp;
    $obj1->prfLocation=$_POST["AgentLocation"];

   $s=$_FILES["fil"]["name"];
    $s=  substr($s, strpos($s, '.'));
    $obj1->prfpic=$s;
    $profileCode=$obj1->save_prf();
    
    if($profileCode !=1062)
 {
        SendOtp($_POST["nam"],$_POST["phn"],$otp);
    if($s!="")
    {
   move_uploaded_file ($_FILES["fil"]["tmp_name"],"delpics/".$profileCode.$s);
    }
 
     $msg="Registration sucessfull ";
 }
 else {
     $msg="Your Phone Number -".$_POST["phn"]."- Already Exist";
 
 }
 }
 else
 {
     $msg="Your Email -".$_POST["eml"]."- Already Exist";  
 }
 
     
     
     
  
}
if(isset($_POST["submitPwdReset"])){
      $obj= new clsreg();
    $resetStatus=$obj->ResetPassword($_POST["ResetPhoneNumber"]);  
  //  ActionAfterLogin($r);
                if($resetStatus=='InvalidPhone')
    {
        $msg="Phone Number Incorrect";
     
    }
    else
    {
        $msg='Password Reset sucessfully.Your new password send to your phone Number.';
        $resetMessage='Password Reset sucessfully your new password is: '.$resetStatus;
         $ObjGeneralFunction= new GeneralFunction();
        $ObjGeneralFunction->SendMessageByPhone($_POST["ResetPhoneNumber"], $resetMessage);
    }
}
function SendOtp($name,$phoneNumber,$otp)
{
       //------------------sms sending---------
    $url = 'http://smslowprice.com/SendingSms.aspx';
$fields = array('userid'=>urlencode('vickysingla'),
'pass'=>urlencode('welcome@123'),
'phone'=>urlencode($phoneNumber),
'msg'=>urlencode('Dear '.$name.', Thanks for Registration.Your Mobile Verification Code for EasyRent is '.$otp.' .'));
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
}
function clearLoginSessions()
{
     if(isset($_SESSION["LoginEmail"]))
         {
         unset($_SESSION["LoginEmail"]);
         }
         if(isset($_SESSION["LoginPassword"]))
         {
             unset($_SESSION["LoginPassword"]);
         }
     }
   
ob_end_clean();
 include_once 'header.php';
?>
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
$(document).ready(function(){
$("#ResendOTP").click(function(){
   
   $.ajax({
	type: "POST",
	url: "user/ReSendOtpAjax.php",
	//data:'country_id='+val,
	success: function(data){
		$("#resentOtpMessages").html(data);
	}
	});
});
});
</script>
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
<p class="logreg-desc">Lost your password? <a id="OnlickrestPwd" href="#">Click here to reset</a>
</p>

<p class="logreg-desc">Not register yet? <button type="button" class="btn-link" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">Click Here to register</button>
</p>
 </form>
<!--   ------------------------------------------pop up------------------------------------------------------>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" >
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
<!-------------------model for otp OTPConfirmModel----------- -->
<div class="modal fade" id="OTPConfirmModel" role="dialog" >
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title"> One Time Password Verification</h2>
        </div>
        <div class="modal-body">
     <form name="SubmitOTP-form" id="registration-form" class="noo-form property-form" action="login.php" method="post">
          
                     <div class="col-md-12">
<div class="form-group s-prop-title">
<label for="eml">OTP&nbsp;&#42;</label>
<input type="number" id="eml" class="form-control" value="" name="OTPTextBox" required="">
</div>
</div>

       
          <div class="form-actions">
            <button type="submit" name="submitOtpVerification" id="btnreg" class="btn11 navbar-btn btn-default">Submit</button>
    
            <button type="button" id="ResendOTP" name="resendOTP" class="btn11 navbar-btn btn-default">Resend Otp</button>
         <label id="resentOtpMessages" style="color: green;
    font-weight: bold;" ></label>
        
          </div>
  
      </form>  


    

        </div>
        <div class="modal-footer">
          <button type="button" class="btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!---------------------model end for otp---------------->
<!-------------------model for reset pwd----------- -->
<div class="modal fade" id="ResetPasswordModel" role="dialog" >
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title"> Reset Password</h2>
        </div>
        <div class="modal-body">
          <form name="SubmitpwdRestform" id="registration-form" class="noo-form property-form" action="login.php" method="post">
          
                     <div class="col-md-12">
<div class="form-group s-prop-title">
<label for="phone">Phone Number&nbsp;&#42;</label>
<input type="number" id="PhoneNumber" class="form-control" value="" name="ResetPhoneNumber" required="">
</div>
</div>

       
          <div class="form-actions">
            <button type="submit" name="submitPwdReset" id="btnreg" class="btn11 navbar-btn btn-default">Submit</button>
            
          </div>
  
      </form>  


    
    

        </div>
        <div class="modal-footer">
          <button type="button" class="btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!---------------------model end for reset pwd---------------->
</div>
    <?php if($showOTP_modal){?>
  <script> 
      
 $('#OTPConfirmModel').modal();
     
       
  </script>
    <?php } ?>

<?php
        if(isset($msgreg))
            echo "<label>".$msgreg."</label>";
        ?>
</div>
    <script>
  function openOTPModel()
  {
     
       $('#OTPConfirmModel').modal();
  }
  
  $( "#OnlickrestPwd" ).click(function() {
$('#ResetPasswordModel').modal();
});
        </script>

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