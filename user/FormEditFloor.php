<?php
include_once '../buslogic.php';
//code check user is login or not
 if(!isset($_SESSION["lcod"])){   header("location:../login.php");}
 
 //function to set  property code
if (isset($_REQUEST["pno"])) {
    $PropertyNO = $_REQUEST["pno"];
}
//fetch all property details
$objprop = new clsprop();
$ObjGeneralFunction = new GeneralFunction();
$proparr = $objprop->DisplayMoreDetailProperty($PropertyNO, 'F');
if (count($proparr) > 0) {
    $city = $proparr[0]['city'];
    $citycod = $proparr[0]['citycod'];
    $delerStatus = $proparr[0]['flodelsts'];
    $Location = $proparr[0]['location'];
    $Locationcod = $proparr[0]['floloc'];
    $IsActive = $proparr[0]['IsActive'];
    $propType = $proparr[0]['flofor'];
    $rentFor = $proparr[0]['florntfor'];
    $MntChargesFor = $proparr[0]['flomntcrgfor'];
    $PropFurnishedStatus = $proparr[0]['flofursts'];
    $PropDescription = $proparr[0]['flodsc'];
    $LandMark = $proparr[0]['flolndmrk'];
    $propAddress = $proparr[0]['floadd'];
    $propRent = $proparr[0]['flornt'];
    $PropSecurity = $proparr[0]['floscrty'];
    $PropOtherCharges = $proparr[0]['floocrg'];
    $AvalibleFrom = $proparr[0]['floavlfrm'];
    $MainTainCharges = $proparr[0]['flomntcrg'];
    $AreaUnits = $proparr[0]['floareunts'];
    $BedRooms = $proparr[0]['flobdrm'];
    $BathRooms = $proparr[0]['flobthrm'];
    $Balcony = $proparr[0]['floblcny'];
    $Kitchen = $proparr[0]['floktchn'];
    $LivingRoom = $proparr[0]['flolvrm'];
    $FloorNo = $proparr[0]['floflono'];
    $TotalFloor = $proparr[0]['floflotot'];
    $TotalArea = $proparr[0]['flototarea'];
}

//Approch to get location list by city id
if(isset($citycod))
{
 $objlocation= new clssubcat();
            $LocationArray = $objlocation->dsp_subcat($citycod);
}
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
    
 
<div class="noo-mainbody">
<div class="row clearfix">
 
<div class="noo-content col-xs-12 col-md-12">
<div class="submit-header">
<h1 class="page-title">Update Floor</h1>
</div>
<div class="submit-content">
    <form id="new_post" name="new_post" method="post" class="noo-form property-form" role="form" action="formEditPG.php?pno=<?php if(isset($PropertyNO)) echo $PropertyNO; ?>">
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
<div class="col-md-6">
<div class="form-group s-prop-address">
<label for="address">Address&nbsp;&#42;</label>
<textarea id="address" class="form-control" name="address" rows="1" required=""></textarea>
</div>
</div>

<div class="col-md-6">
<div class="form-group s-prop-address">
<label for="lndmrk">LandMark&nbsp;</label>
<textarea id="lndmrk" class="form-control" name="lndmrk" rows="1" required=""></textarea>
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
                                    $objAllFacility = new clsfac();
                                    $objAllFacility->factype = 'F';
                                    $AllFacilityArray = $objAllFacility->dsp_fac();
                                    $objSelectedFacility = new clsfacprp();
                                    $objSelectedFacility->prpcod = $PropertyNO;
                                    $objSelectedFacility->type = 'F';
                                    $SelectedFacilityArray = $objSelectedFacility->dsp_facprp();
                                    for ($i = 0; $i < count($AllFacilityArray); $i++) {
                                        $AvalibilitySts=0; 
                                             for($j=0; $j<count($SelectedFacilityArray); $j++)
        {   
                  if($SelectedFacilityArray[$j][1]==$AllFacilityArray[$i][0])
                  {
                      $AvalibilitySts=1; 
    echo'<div class="col-md-6"><div class="form-group s-prop-_noo_property_feature_attic"><label for="_noo_property_feature_attic" class="checkbox-label">';
                                        echo'<input type="checkbox" id="pfac[]" name="pfac[]" class="" value="' . $AllFacilityArray[$i][0] . ' " checked >&nbsp;';
                                        echo $AllFacilityArray[$i][1];
                                        echo'<i></i></label></div></div>';
            }
   
        }
                                        if($AvalibilitySts==0)
                                        {
                                        echo'<div class="col-md-6"><div class="form-group s-prop-_noo_property_feature_attic"><label for="_noo_property_feature_attic" class="checkbox-label">';
                                        echo'<input type="checkbox" id="pfac[]" name="pfac[]" class="" value="' . $AllFacilityArray[$i][0] . ' ">&nbsp;';
                                        echo $AllFacilityArray[$i][1];
                                        echo'<i></i></label></div></div>';
                                        }
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
<input type="submit" name="property_submit" class="btn btn-lg rounded metro btn-primary" id="property_submit" value="Update Property">
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
include_once 'footer_1.php';
 ?>