<?php
include_once '../buslogic.php';
if(isset($_POST["Alert_submit"]))
{
    $obj= new clspg();
    $obj->pgtit=$_POST["title"];
    $obj->pgtyp=$_POST["pgtyp"];
    $obj->pgloc=$_POST["pgloc"];
    $obj->pglndmrk=$_POST["lndmrk"];
    $obj->pgadd=$_POST["address"];
    $obj->pgrnt=$_POST["ernt"];
    $obj->pgrntfor=$_POST["rntfor"];
    $obj->pgscrty=$_POST["scrg"];
    $obj->pgocrg=$_POST["ocrg"];
    $obj->pgnoofseats=$_POST["noseat"];
    $obj->pgavlfrm=$_POST["avlfrm"];
    $obj->pgsts="Y";
   $obj->pgregcod=$_SESSION["lcod"];
   //  $obj->pgregcod=1;
    $obj->pgnoper=$_POST["noperson"];
    $obj->pgfursts=$_POST["fursts"];
    if(isset($_POST["delsts"])&& $_POST["delsts"]==1)
    {
    $obj->pgdelsts="Y";
    }
 else {
        
 {
     $obj->pgdelsts="N";
 }}
    $obj->pglat=$_POST["lat"];
    $obj->pglong=$_POST["long"];
    $obj->pgmntcrg=$_POST["mcrg"];
    $obj->pgmntcrgfor=$_POST["mcrg"];
    $obj->pgregdat=date('y-m-d');
   $sts= $obj->save_pg();
   if($sts)
   {
 
   }
   else
   {

       
   }

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
<div class="noo-mainbody-inner">
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
<option value="B">PG</option>
<option value="G">Floor</option>
<option value="G">House</option>
<option value="G">Commercial</option>
</select>
</div>
</div>
</div>


    <div class="col-md-6">
<div class="form-group s-prop-status">
<label>Furnished Status</label>
<div class="dropdown label-select">
    <select class="form-control" name="fursts" required>
    <option value="">select one</option>
<option value="F">Fully-Furnished</option>
<option value="S">Semi-Furnished</option>
<option value="U"> Un-Furnished</option>
</select>
</div>
</div>
</div>

</div>
</div>

<div class="noo-submit row">
<div class="col-md-12">
    <input type="submit" name="Alert_submit" class="btn btn-lg rounded metro btn-primary" id="property_submit" value="Add Alerts">
<label>Your Alerts Request will be submitted and we will update you</label>
</div>
</div>
</form>
</div>
</div>
 
</div>
</div>
</div>
 
</div>
 <?php
 
include_once 'footer.php';
 ?>