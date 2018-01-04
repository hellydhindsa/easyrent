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
            if(isset($phoneEmail))
            {
            $objGenfunction=new GeneralFunction();
            $message= 'OTP for EasyRent Registration is '.$phoneEmail[0][0];
            $objGenfunction->SendMessageByPhone($phoneEmail[0][1], $message);
            $userSucessMessage='*******'.substr($phoneEmail[0][1], 7);
            echo 'Your OTP send at '.$userSucessMessage;
            }
            else
            {
                echo 'Your OTP Resend is unsucessfull';
            }
//}
   }
   else
   {
       echo 'Your OTP Resend is unsucessfull';
   }
?>
	


        
        
        
        
        
        
         
          