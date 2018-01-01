
<?php
//session_start();
include_once '../buslogic.php';
//code check user is login or not and IS It Admin
 if(!isset($_SESSION["lcod"]) || $_SESSION["lcod"]!=11){header("location:../login.php");}
 
if (isset($_REQUEST["Contactcod"]))
{
        $obj=new ContactForm();
    if(isset($_REQUEST["mode"])&& $_REQUEST["mode"]=='A')
    {
    
        $obj->UpdateContactFormStatus($_REQUEST["Contactcod"], 1);
       
    }
    else if(isset($_REQUEST["mode"])&& $_REQUEST["mode"]=='D')
    {
  
        $obj->UpdateContactFormStatus($_REQUEST["Contactcod"], 0);
        $contactcod=$_REQUEST["Contactcod"];
        header("location:MoreDeatailcontact.php?Contactcod=$contactcod");
       
    }

}

include_once 'AdminHeader.php';
?>

 
<div class="noo-wrapper">
 
    
   
<div class="container noo-mainbody">

<div class="noo-mainbody-inner">
<div class="row clearfix">
 

 
 
<div class="noo-content col-xs-12 col-md-12">

<div class="submit-content">
<form id="new_post"  class="noo-form property-form" >
 <div class=" col-md-12">
      <?php
        $obj= new ContactForm();
        $arr = $obj->GetContactForm();
        If(count($arr)>0)
            echo "<table width='90%'><tr><th>Name</th><th>Email</th><th>Subject</th><th>Date</th><th>Delete</th><th>Moredetail</th></tr>";
        for($i=0; $i<count($arr); $i++)
        {
           // $type=  substr($arr[$i][2], 0, 1);
            echo"<tr width='10%'><td>".$arr[$i][0]."</td>";
            echo"<td width='10%'>".$arr[$i][1]."</td>";
            echo"<td width='20%'>".$arr[$i][2]."</td>";
          //  echo"<td width='50%'>".$arr[$i][3]."</td>";
             echo"<td width='10%'>".$arr[$i][4]."</td>";
          //  if($arr[$i][6]==1)
          //  {
            echo"<td width='10%'><a href=Viewcontactforms.php?Contactcod=".$arr[$i][6]."&mode=A>Delete</a></td>";
        //}MoreDeatailcontact.php  viewcontactForms.php
echo"<td width='10%'><a href=Viewcontactforms.php?Contactcod=".$arr[$i][6]."&mode=D>Detail</a></td>";
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
           
        }
        echo "</table>";
        ?>
    </div>
</form>
</div>
</div>
 
    
</div>
</div>
     </div>  
    

</div>
 
   <?php
include_once 'Adminfooter.php';
?>