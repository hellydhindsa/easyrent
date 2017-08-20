
<?php
//session_start();
include_once '../buslogic.php';

if (isset($_REQUEST["prpcod"]))
{
    if(isset($_REQUEST["mode"])&& $_REQUEST["mode"]=='A')
    {
        $obj=new clsprop();
        $obj->UpdatePropertyStatus($_REQUEST["prpcod"], $_REQUEST["typ"], 0);
       
    }
    else if(isset($_REQUEST["mode"])&& $_REQUEST["mode"]=='NA')
    {
       $obj=new clsprop();
        $obj->UpdatePropertyStatus($_REQUEST["prpcod"], $_REQUEST["typ"], 1);
       
    }
else if(isset($_REQUEST["mode"]) && $_REQUEST["mode"]=='S')
{
  
    $obj=new clsprop();
        $obj->UpdatePropertyIndexStatus($_REQUEST["prpcod"], $_REQUEST["typ"], 0);
       
}
else if(isset($_REQUEST["mode"]) && $_REQUEST["mode"]=='NS')
{
  
   $obj=new clsprop();
        $obj->UpdatePropertyIndexStatus($_REQUEST["prpcod"], $_REQUEST["typ"], 1);
       
}
}
//if(!isset($_SESSION["lcod"]))
//{
//    header("location:../frmlogin.php?sts=S");
//}
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
        $obj= new clsprop();
        $arr = $obj->dsp_propertiesForAdmin();
        If(count($arr)>0)
            echo "<table width='90%'><tr><th>Properties</th><th>Discription</th><th>Type</th><th>Rent</th><th>Date</th><th>Activate</th><th>Show to Index</th></tr>";
        for($i=0; $i<count($arr); $i++)
        {
            $type=  substr($arr[$i][2], 0, 1);
            echo"<tr width='10%'><td>".$arr[$i][0]."</td>";
            echo"<td width='10%'>".$arr[$i][1]."</td>";
            echo"<td width='20%'>".$arr[$i][2]."</td>";
            echo"<td width='10%'>".$arr[$i][3]."</td>";
             echo"<td width='10%'>".$arr[$i][9]."</td>";
            if($arr[$i][10]==1)
            {
            echo"<td width='10%'><a href=frmManageProperty.php?prpcod=".$arr[$i][8]."&mode=A&typ=".$type." >Active</a></td>";
        }
 else {
      echo"<td width='10%'><a href=frmManageProperty.php?prpcod=".$arr[$i][8]."&mode=NA&typ=".$type." >Not Active</a></td>";
 }
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            if($arr[$i][11]==1)
            {
             echo"<td width='10%'><a href=frmManageProperty.php?prpcod=".$arr[$i][8]."&mode=S&typ=".$type." >Shown</a> </td></tr>";
            }
            else
            {
             echo"<td width='10%'><a href=frmManageProperty.php?prpcod=".$arr[$i][8]."&mode=NS&typ=".$type." > Not Shown</a> </td></tr>";   
            }
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