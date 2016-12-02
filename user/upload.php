
<?php
include_once '../buslogic.php';
     
    if (!empty($_FILES)) {
        $obj= new clspgpic();
    $lpgpic=$obj->fndlstpgpic();
   $lpgpic=$lpgpic+1;
   $obj->pgpicdsc="this is pg description";
   if(isset($_SESSION["pgcod"]))
   {
       $obj->pgpicpgcod=$_SESSION["pgcod"];
       $obj->pgpictyp="P";
   }
   else if(isset($_SESSION["flocod"]))
   {
       $obj->pgpicpgcod=$_SESSION["flocod"];
       $obj->pgpictyp="F";
   }
    else if(isset($_SESSION["huscod"]))
   {
       $obj->pgpicpgcod=$_SESSION["huscod"];
       $obj->pgpictyp="H";
   }
    else if(isset($_SESSION["cpcod"]))
   {
       $obj->pgpicpgcod=$_SESSION["cpcod"];
       $obj->pgpictyp="C";
   }
   else
   {
       $obj->pgpicpgcod=0;
       $obj->pgpictyp="N";
   }
         $s=$_FILES["file"]["name"];
    $s=  substr($s, strpos($s, '.'));
        $tempFile = $_FILES['file']['tmp_name'];
        $obj->pgpicfil=$s;
        $obj->save_pgpic();  
     
       
 
       $fullPath= "../pgpics/".$lpgpic.$s;

        if (move_uploaded_file($tempFile, $fullPath)) {
            die($fullPath);
        } else {
            die('e');
        } 
    }
?>
