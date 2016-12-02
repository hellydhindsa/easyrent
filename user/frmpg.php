<?php
include_once '../buslogic.php';
if(isset($_POST["property_submit"]))
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
 
  
if(isset($_POST["pfac"]))
{
   foreach($_POST["pfac"] as $check) {
       $obj1= new clsfacprp();
    $obj1->faccode=$check; 
     $obj1->prpcod=$_SESSION["pgcod"];
     $obj1->type='P';
       $obj1->save_facprp();
}
   }
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
    
    <!--   ------------------------------------------pop up------------------------------------------------------>




  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title"> Upload PG Pictures </h2>
        </div>
        <div class="modal-body">

 
<form action="upload.php" class="dropzone" id="uploadFile" name="uploadFile" method="POST">
        <span id="tmp-path"></span>
    </form>
You Have To Choose At least One Picture

    

        </div>
        <div class="modal-footer">
          <button type="button" class="btn11 btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!--    ----------------------------------------------------------end model and images popup--------------------------->
<div class="noo-mainbody-inner">
<div class="row clearfix">
 
<div class="noo-sidebar noo-sidebar-left col-xs-12 col-md-4">
<div class="noo-sidebar-inner">
<div class="user-sidebar-menu dashboard-sidebar">

<?php 
include_once 'leftpanel.php';
?>
</div>

</div>
</div>
 
 
<div class="noo-content col-xs-12 col-md-8">
<div class="submit-header">
<h1 class="page-title">Submit PG</h1>
</div>
<div class="submit-content">
<form id="new_post" name="new_post" method="post" class="noo-form property-form" role="form" action="frmpg.php">
   
<div class="noo-control-group">
<div class="group-title">PG Description</div>
<div class="group-container row">
    <div class="col-md-8">
<div class="form-group s-prop-title">
<label for="title">Title&nbsp;&#42;</label>
<input type="text" id="title" class="form-control" value="" name="title" required="">
</div>
</div>
<div class="col-md-4">
<div class="form-group s-prop-type">
<label>PG for</label>
<div class="dropdown label-select">
    <select class="form-control" name="pgtyp" required>
<option value="">select one</option>
<option value="B">Boys</option>
<option value="G">Girls</option>

</select>
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group s-prop-type">
<label>Number Of Seats</label>
<div class="dropdown label-select">
    <select class="form-control" name="noseat" required>
<option value="">select one</option>
<option value="1">One</option>
<option value="2">Two</option>
<option value="3">Three</option>
<option value="4">Four</option>
<option value="5">Five</option>
<option value="6">Six</option>
<option value="7">Seven</option>
<option value="8">Eight</option>
<option value="9">Nine</option>
<option value="10">Ten</option>
<option value="11">Eleven</option>
<option value="12">Twelve</option>
<option value="13">Thirteen</option>
<option value="14">Fourteen</option>
<option value="15">Fifteen</option>
<option value="16">Sixteen</option>
<option value="17">Seventeen</option>
<option value="18">Eighteen</option>
<option value="19">Nineteen</option>
<option value="20">Twenty</option>


</select>
</div>
</div>
</div>
    <div class="col-md-6">
<div class="form-group s-prop-status">
<label>Persons Sharing Room</label>
<div class="dropdown label-select">
    <select class="form-control" required name="noperson">
    <option value="">select one</option>
<option value="1">One</option>
<option value="2">Two</option>
<option value="3">Three</option>
<option value="4">Four</option>
<option value="5">Five</option>
<option value="6">Six</option>
<option value="7">Seven</option>
<option value="8">Eight</option>
<option value="9">Nine</option>
<option value="10">Ten</option>

</select>
</div>
</div>
</div>
    <div class="col-md-6">
        
<div class="form-group s-prop-bedrooms">
<label for="avlfrm">Avalable From</label>
<div class="input-group date datepicker" id="datetimepicker">
<input type="text" id="avlfrm" class="form-control" value="" name="avlfrm" required>
 <span class="input-group-addon">
    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
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




<div class="col-md-12">
<div class="form-group s-prop-desc">
<label for="desc">Description&nbsp;&#42;</label>
<textarea id="desc" name="desc" rows="10" required=""></textarea>
</div>
</div>
<div class="col-md-12">
<div class="form-group s-prop-_noo_property_feature_attic">

<label for="_noo_property_feature_attic" class="checkbox-label">
<input type="checkbox" id="delsts" name="delsts" class="" value="1">&nbsp;I am not intrested in in getting response from brokers. <i></i>
</label>
</div>
</div>
</div>
</div>




<div class="noo-control-group small-group">
<div class="group-title">Amenities &amp; Features</div>
<div class="group-container row">
    
    
    <?php
                                         $obj= new clsfac();  
                                         $obj->factype='P';
                                                  $arr = $obj->dsp_fac();
     
        for($i=0; $i<count($arr); $i++)
        {
      
           
echo'<div class="col-md-6"><div class="form-group s-prop-_noo_property_feature_attic"><label for="_noo_property_feature_attic" class="checkbox-label"><input type="checkbox" id="pfac[]" name="pfac[]" class="" value="';
echo $arr[$i][0];    
echo' ">&nbsp;';
echo $arr[$i][1];
echo'<i></i></label></div></div>';
        }
        ?>
    
    


</div>
</div>


<div class="noo-control-group">
<div class="group-title">Listing Location</div>
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
<div class="col-md-8">
<div class="form-group s-prop-address">
<label for="address">Address&nbsp;&#42;</label>
<textarea id="address" class="form-control" name="address" rows="1" required=""></textarea>
</div>
</div>

<div class="col-md-4">
<div class="form-group s-prop-lat">
<label for="lat">Latitude (for Maps)</label>
<input type="text" id="lat" class="form-control" value="40.714398" name="lat" readonly>
</div>
</div>
<div class="col-md-8">
<div class="form-group s-prop-address">
<label for="lndmrk">LandMark&nbsp;&#42;</label>
<textarea id="lndmrk" class="form-control" name="lndmrk" rows="1" required=""></textarea>
</div>
</div>
<div class="col-md-4">
<div class="form-group s-prop-long">
<label for="long">Longitude (for Maps)</label>
<input type="text" id="long" class="form-control" value="-74.005279" name="long" readonly>
</div>
</div>

<div class="col-md-12">
<div class="noo_property_google_map">
<div id="noo_property_google_map" class="form-group noo_property_google_map" style="height: 300px; margin-top: 25px; overflow: hidden;position: relative;width: 100%;">
</div>
<div class="noo_property_google_map_search">
<input placeholder="Search your map" type="text" autocomplete="off" id="noo_property_google_map_search_input">
</div>
</div>
 
</div>
</div>
</div>

<div class="noo-control-group">
<div class="group-title">Rents and Charges</div>
<div class="group-container row">
    
<div class="col-md-7">
<div class="form-group s-prop-bedrooms">
<label for="ernt">Expected Rent&nbsp;(rupees)</label>
<input type="text" id="ernt" class="form-control" value="" name="ernt" required>
</div>
</div>
<div class="col-md-5">
<div class="form-group s-prop-status">
<label> Structure</label>
<div class="dropdown label-select">
    <select class="form-control" name="rntfor" required>
    <option value="">select one</option>
<option value="M">Monthly</option>
<option value="Q">Quartly</option>
<option value="Y">Yearly</option>

</select>
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-type">
<label for="scrg">Security Charges</label>
<input type="text" id="scrg" class="form-control" value="" name="scrg" required>
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-bedrooms">
<label for="ocrg">Other charges</label>
<input type="text" id="ocrg" class="form-control" value="" name="ocrg" required>
</div>
</div>

<div class="col-md-7">
<div class="form-group s-prop-bedrooms">
<label for="mcrg">Maintainness Charges&nbsp;(rupees)</label>
<input type="text" id="mcrg" class="form-control" value="" name="mcrg" required>
</div>
</div>
<div class="col-md-5">
<div class="form-group s-prop-status">
<label> Structure</label>
<div class="dropdown label-select">
    <select class="form-control" name="mcrgfor" required>
        <option value="">select one</option>
    <option value="M">Monthly</option>
<option value="Q">Quartly</option>
<option value="Y">Yearly</option>
<option value="O">One-Time</option>

</select>
</div>
</div>
</div>
</div>
</div>
<!--    <div class="noo-control-group">
<div class="group-title">Property Images</div>
<div class="group-container row">
<div class="col-md-12">
<div id="upload-container">
<div id="aaiu-upload-container">
<div class="moxie-shim moxie-shim-html5">
<label for="input-upload" class="btn btn-secondary btn-lg">Select Images</label>
<input id="input-upload" type="file" multiple="" accept="image/jpeg,image/gif,image/png">
</div>
<p>At least 1 image is required for a valid submission. The featured image will be used to dispaly on property listing page.</p>
</div>
</div>
</div>
</div>
</div>-->
<div class="noo-submit row">
<div class="col-md-12">
    <input type="submit" name="property_submit" class="btn btn-lg rounded metro btn-primary" id="property_submit" value="Add Property">
<label>Your submission will be reviewed by Administrator before it can be published</label>
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