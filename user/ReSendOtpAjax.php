<?php
include_once '../buslogic.php';

//if(!empty($_POST["PropertyType"])) {
       if(isset($_SESSION["LoginEmail"]))
   {
      $Email=$_SESSION["LoginEmail"];
     // $typ="P";
   
  
   // $cod=$_SESSION["pgcod"];
  //  $cod=56;
   // $typ=$_POST["PropertyType"];
	 $obj= new clsprop();
            $phoneEmail = $obj->GetOtpByEmail($Email);
            $objGenfunction=new GeneralFunction();
            $message= 'OTP for EasyRent Registration is '.$phoneEmail[0][0];
            $objGenfunction->SendMessageByPhone($phoneEmail[0][1], $message);
            echo 'your OTP send at '.$phoneEmail[0][1];
//}
   }
   else
   {
       echo 'your OTP Resend is unsucessfull';
   }
?>
	


        
        
        
        
        
        
         
          