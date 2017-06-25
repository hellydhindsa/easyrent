<?php
include_once '../buslogic.php';
//code check user is login or not
 if(!isset($_SESSION["lcod"])){   header("location:../login.php");}
if(isset($_POST["property_submit"]))
{
    $obj= new clsflo();
    $obj->flofor=$_POST["flofor"];
    $obj->floloc=$_POST["pgloc"];
    $obj->flolndmrk=$_POST["lndmrk"];
    $obj->floadd=$_POST["address"];
    $obj->flobdrm=$_POST["bdrm"];
    $obj->flobthrm=$_POST["bthrm"];
    $obj->floblcny=$_POST["blcny"];
    $obj->floktchn=$_POST["ktchn"];
    $obj->flolvrm=$_POST["lvrm"];
    $obj->flofursts=$_POST["fursts"];
    $obj->floflono=$_POST["flono"];
     $obj->floflotot=$_POST["totflo"];
    $obj->flornt=$_POST["exprnt"];
    $obj->florntfor=$_POST["rntfor"];
    $obj->floocrg=$_POST["ocrg"];
    $obj->floscrty=$_POST["scrty"];
    $obj->flomntcrg=$_POST["mntcrg"];
     $obj->flomntcrgfor=$_POST["mntcrgfor"];
    $obj->flosts="P";
       $obj->floregcod=$_SESSION["lcod"];
    //$obj->floregcod=2;
       $cls_date = new DateTime($_POST["avlfrm"]);
    $obj->floavlfrm=$cls_date->format('y-m-d');
   // $obj->floavlfrm=$_POST["avlfrm"];
    $obj->flodsc=$_POST["desc"];
 //   $obj->flodelsts=$_POST["avlfrm"];
     $obj->flolat=$_POST["lat"];
    $obj->flolong=$_POST["long"];
    $obj->flototare=$_POST["totare"];
    $obj->floareunt=$_POST["areunt"];
    $obj->floregdat=date('y-m-d');
 

    if(isset($_POST["delsts"])&& $_POST["delsts"]==1)
    {
    $obj->flodelsts="Y";
    }
 else {
        
 {
     $obj->flodelsts="N";
 }}
    
   $sts= $obj->save_flo();
   if($sts)
   {
 
  
if(isset($_POST["pfac"]))
{
   foreach($_POST["pfac"] as $check) {
       $obj1= new clsfacprp();
    $obj1->faccode=$check; 
     $obj1->prpcod=$_SESSION["flocod"];
     $obj1->type='F';
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
    
     <?php 
include_once 'MultiPicturesUploadPanel.php';
?>
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
<h1 class="page-title">Submit Floor</h1>
</div>
<div class="submit-content">
    <form id="new_post" name="new_post" method="post" class="noo-form property-form" role="form" action="frmflo.php">
<div class="noo-control-group">
<div class="group-title">Floor Description</div>
<div class="group-container row">
  
<div class="col-md-6">
<div class="form-group s-prop-type">
<label>Floor For</label>
<div class="dropdown label-select" >
    <select class="form-control"  name="flofor" required>
<option value="">select one</option>
<option value="B">Boys</option>
<option value="G">Girls</option>
<option value="F">Family</option>
</select>
</div>
</div>
</div>
 
<div class="price col-md-6">
    <div class="form-group s-prop-type">
<label>Floor No</label>
<div class="dropdown label-select">
<select class="form-control" name="flono" required>
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
<div class="price_label col-md-6">
    <div class="form-group s-prop-type">
<label>Total Floors</label>
<div class="dropdown label-select">
<select class="form-control" name="totflo" required>
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
      <div class="price col-md-6">
<div class="form-group s-prop-bedrooms">
<label for="avlfrm">Available From</label>
<div class="input-group date datepicker" id="datetimepicker">
<input type="text" id="avlfrm" class="form-control" value="" name="avlfrm">
 <span class="input-group-addon">
    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
</div>
</div>
</div>

<div class="col-md-12">
<div class="form-group s-prop-desc">
<label for="desc">Description&nbsp;&#42;</label>
<textarea id="desc" name="desc" rows="10" required="" ></textarea>
</div>
</div>
<div class="col-md-12">
<div class="form-group s-prop-_noo_property_feature_attic">
<input type="hidden" name="noo_property_feature[attic]" class="" value="0">
<label for="delsts" class="checkbox-label">
<input type="checkbox" id="delsts" name="delsts" class="" value="1">&nbsp;I am not interested in getting response from brokers. <i></i>
</label>
</div>
</div>
</div>
</div>
    <div class="noo-control-group">
<div class="group-title">Listing Location</div>
<div class="group-container row">
 <div class="col-md-6">
<div class="form-group s-prop-location">
<label>City</label>
<div class="dropdown label-select">
<select class="form-control" onChange="getState(this.value);">
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
<label for="_noo_property_gmap_latitude">Latitude (for Maps)</label>
<input type="text" id="_noo_property_gmap_latitude" class="form-control" value="40.714398" name="lat" readonly>
</div>
</div>
<div class="col-md-8">
<div class="form-group s-prop-address">
<label for="lndmrk">LandMark&nbsp;</label>
<textarea id="lndmrk" class="form-control" name="lndmrk" rows="1" required=""></textarea>
</div>
</div>
<div class="col-md-4">
<div class="form-group s-prop-long">
<label for="_noo_property_gmap_longitude">Longitude (for Maps)</label>
<input type="text" id="_noo_property_gmap_longitude" class="form-control" value="-74.005279" name="long" readonly>
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
<div class="group-title">Facilities</div>
<div class="group-container row">
   <div class="col-md-6">
<div class="form-group s-prop-type">
<label>Bed Rooms</label>
<div class="dropdown label-select">
    <select class="form-control" name="bdrm" required>
<option value="">select one</option>
<option value="1">One</option>
<option value="2">Two</option>
<option value="3">Three</option>
<option value="4">Four</option>
<option value="5">Five</option>
</select>
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-bedrooms">
<label>Bath Rooms</label>
<div class="dropdown label-select">
<select class="form-control" name="bthrm">
<option value="">select one</option>
<option value="1">One</option>
<option value="2">Two</option>
<option value="3">Three</option>
<option value="4">Four</option>
<option value="5">Five</option>
</select>
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-bathrooms">
<label>Balcony</label>
<div class="dropdown label-select">
<select class="form-control" name="blcny">
<option value="">select one</option>
<option value="1">One</option>
<option value="2">Two</option>
<option value="3">Three</option>
<option value="4">Four</option>
<option value="5">Five</option>
</select>
</div>
</div>
</div> 

<div class="price col-md-6">
    <div class="form-group s-prop-type">
<label>Kitchen</label>
<div class="dropdown label-select">
<select class="form-control" name="ktchn">
    <option value="">select one</option>
<option value="Y">Yes</option>
<option value="N">No</option>
</select>
</div>
</div>
</div>
<div class="price_label col-md-6">
    <div class="form-group s-prop-type">
<label>Living Room</label>
<div class="dropdown label-select">
<select class="form-control" name="lvrm" required>
    <option value="">select one</option>
<option value="Y">Yes</option>
<option value="N">No</option>
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
    <div class="col-md-6">
<div class="form-group s-prop-bathrooms">
<div class="form-group s-prop-_noo_property_field_lot_area">
<label for="totare">Total Area Covered</label>
<input type="number" id="totare" name="totare" class="form-control" value="" required>
</div>
</div>
</div> 
<div class="price col-md-6">
     <div class="form-group s-prop-type">
<label>Units</label>
<div class="dropdown label-select">
<select class="form-control" name="areunt" required>
  <option value="">select one</option>
<option value="sqr-ft">sqr-ft</option>
<option value="sqr-m">sqr-m</option>
<option value="bigha">bigha</option>
<option value="hectare">hectare</option>
<option value="marla">marla</option>
<option value="kanal">kanal</option>

</select>
</div>
</div>
</div>
</div>
</div>




<div class="noo-control-group">
<div class="group-title">Amenities &amp; Features</div>
<div class="group-container row">

    <?php
                                         $obj= new clsfac();  
                                         $obj->factype='F';
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
<div class="group-title">Rents and Other Charges</div>
<div class="group-container row">
    
<div class="col-md-7">
<div class="form-group s-prop-bedrooms">
<label for="exprnt">Expected Rent&nbsp;(rupees)</label>
<input type="number" id="exprnt" class="form-control" value="" name="exprnt" required>
</div>
</div>
<div class="col-md-5">
<div class="form-group s-prop-status">
<label> Structure</label>
<div class="dropdown label-select">
    <select class="form-control" name="rntfor" >
<option value="M">Monthly</option>
<option value="Q">Quarterly</option>
<option value="Y">Yearly</option>
</select>
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-type">
<label for="scrty">Security Charges (rupees)</label>
<input type="number" id="scrty" class="form-control" value="" name="scrty">
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-bedrooms">
<label for="ocrg">Other Charges (rupees)</label>
<input type="number" id="ocrg" class="form-control" value="" name="ocrg">
</div>
</div>

<div class="col-md-7">
<div class="form-group s-prop-bedrooms">
<label for="mntcrg">Maintenance Charges&nbsp;(rupees)</label>
<input type="number" id="mntcrg" class="form-control" value="" name="mntcrg">
</div>
</div>
<div class="col-md-5">
<div class="form-group s-prop-status">
<label> Structure</label>
<div class="dropdown label-select">
    <select class="form-control" name="mcrgfor" >
    <option value="M">Monthly</option>
<option value="Q">Quarterly</option>
<option value="Y">Yearly</option>


</select>
</div>
</div>
</div>
</div>
</div>

<div class="noo-submit row">
<div class="col-md-12">
<input type="submit" name="property_submit" class="btn btn-lg rounded metro btn-primary" id="property_submit" value="Add Property">
<label></label>
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