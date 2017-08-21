<?php
include_once '../buslogic.php';
//code check user is login or not
 if(!isset($_SESSION["lcod"]))
   {   header("location:../login.php");}
   
if(isset($_POST["Alert_submit"]))
{
    $obj= new classUserAlerts();
   // $obj->FurnishedStatus=$_POST["fursts"];
    $obj->Location=$_POST["pgloc"];
   $obj->PropertyType=$_POST["prptyp"];
    $obj->UserId=$_SESSION["lcod"];
   $stsAlert= $obj->SaveUserAlerts();
   if($stsAlert)
   {
 $msg="your Testimonial Added Sucessfully";
   }
   else
   {

      $msg="your Testimonial Not Added Sucessfully";  
   }
    
}
if (isset($_REQUEST["AlterCod"]))
{
    if(isset($_REQUEST["mode"])&& $_REQUEST["mode"]=='D')
    {
        $obj=new classUserAlerts();
        $obj->UserAlertsId=$_REQUEST["AlterCod"];
      $deleteStatus=  $obj->DeleteUserAlerts();
      if($deleteStatus)
      {
          $msg="your Testimonial Deleted Sucessfully"; 
      }
      else
      {
         $msg="your Testimonial Not Deleted Sucessfully";  
      }
    }
}
function GetPropertyType($propertyTyp) {
        $FinalType="PG";
        if($propertyTyp =='P')
        {
          $FinalType="PG";
        }
        else if ($propertyTyp =='F')
        {
             $FinalType="Floor";
        }
         else if ($propertyTyp =='H')
        {
            $FinalType="House"; 
        }
          else if ($propertyTyp =='C')
        {
           $FinalType="Commercial";  
        }
           
            return $FinalType;
         }

include_once 'header.php';
?>
<script>
function getState(val) {
   
	$.ajax({
	type: "POST",
	url: "get_state.php",
	data:'country_id='+val,
	success: function(data){
		$("#pgloc").html(data);
	}
	});
}
</script>
<div class="noo-wrapper">
 
<div class="container noo-mainbody">

<div class="row clearfix">
 
<div class="noo-content col-xs-12 col-md-12">
<div class="submit-header">
<h1 class="page-title">Set Alerts</h1>
</div>
<div class="submit-content">
    <form id="new_post" name="new_post" method="post" class="noo-form property-form" role="form" action="frmAlerts.php">
   
<div class="noo-control-group">
<div class="group-title">Alert Description</div>
<div class="group-container row">
  <div class="col-md-6">
<div class="form-group s-prop-location">
<label>City</label>
<div class="dropdown label-select">
    <select class="form-control" onChange="getState(this.value);" required>
<option value="">Select City</option>
  <?php
                                         $obj= new clscat();         
                                                  $arr = $obj->dsp_cat();
     
        for($i=0; $i<count($arr); $i++)
        {
           
        echo " <option value=".$arr[$i][0]." />".$arr[$i][1]."</option>";
           

        }
        ?>
    </select>
</div>
</div>
</div>
    <div class="col-md-6">
<div class="form-group s-prop-sub_location">
<label>Location</label>
<div class="dropdown label-select">
    <select class="form-control" name="pgloc" id="pgloc" required>
<option value="">Select Location</option>

</select>
</div>
</div>
</div> 
<div class="col-md-6">
<div class="form-group s-prop-type">
<label>Property Type</label>
<div class="dropdown label-select">
    <select class="form-control" name="prptyp" required>
<option value="">select one</option>
<option value="P">PG</option>
<option value="F">Floor</option>
<option value="H">House</option>
<option value="C">Commercial</option>
</select>
</div>
</div>
</div>
</div>
</div>

<div class="noo-submit row">
<div class="col-md-12">
    <input type="submit" name="Alert_submit" class="btn btn-lg rounded metro btn-primary" id="property_submit" value="Add Alerts">
<?php
        if(isset($msg))
            echo '<label style="color: red;
    font-weight: bold;" >'.$msg.'</label>';
        ?>
</div>
    <div class="noo-control-group">
<div class="group-title">MY Alerts</div>
 <?php
        $objDispay= new classUserAlerts();
        $arr = $objDispay->DispalyUserAlerts($_SESSION["lcod"]);
        If(count($arr)>0)
                for($i=0; $i<count($arr); $i++)
        {
 echo'<div class="group-container row">
  
<div class="col-md-9">
<div class="form-group s-prop-type">

<div class="form-message">
    <span class="form-control"> <b>your Alert for City :</b>';
echo $arr[$i][0].", <b>Location :</b>".$arr[$i][1]." <b>With Property Type :</b> ".GetPropertyType($arr[$i][2])." <b>Is Set</b>";
 echo'</span>
</div>
</div>
</div>
<div class="col-md-3"> <a href=frmAlerts.php?AlterCod=';
echo $arr[$i][3];
echo'&mode=D >
<input type="button" name="Alert_submit12" class="btn btn-lg rounded metro btn-primary" id="property_submit" value="Delete Alerts">
</a></div>

</div>';




           
        
//            echo"<tr><td>".$arr[$i][1]."</td>";
//            echo"<td><a href=frmcty.php?catcod=".$arr[$i][0]."&mode=E >Edit</a>";
//            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
//             echo"<a href=frmcty.php?catcod=".$arr[$i][0]."&mode=D >delete</a> </td></tr>";
        }
       // echo "</table>";
        ?>




</div>
</div>
</form>
</div>
</div>
 
</div>

</div>
 
</div>
 <?php
 
include_once 'footer.php';
 ?>