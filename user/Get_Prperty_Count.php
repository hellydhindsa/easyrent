<?php
include_once '../buslogic.php';

//if(!empty($_POST["PropertyType"])) {
       if(isset($_SESSION["pgcod"]))
   {
      $cod=$_SESSION["pgcod"];
      $typ="P";
   }
   else if(isset($_SESSION["flocod"]))
   {
      $cod=$_SESSION["flocod"];
       $typ="F";
   }
    else if(isset($_SESSION["huscod"]))
   {
      $cod=$_SESSION["huscod"];
       $typ="H";
   }
    else if(isset($_SESSION["cpcod"]))
   {
      $cod=$_SESSION["cpcod"];
      $typ="C";
   }
   else
   {
      $cod=0;
      $typ="N";
   }
   // $cod=$_SESSION["pgcod"];
  //  $cod=56;
   // $typ=$_POST["PropertyType"];
	 $obj= new clspgpic();
            $count = $obj->GetPropertyPicturesCount($cod,$typ);
            echo $count;
//}
?>
	


        
        
        
        
        
        
         
          