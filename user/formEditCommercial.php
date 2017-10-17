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
$proparr = $objprop->DisplayMoreDetailProperty($PropertyNO, 'C');
if (count($proparr) > 0) {
    $city = $proparr[0]['city'];
    $citycod = $proparr[0]['citycod'];
    $delerStatus = $proparr[0]['cpdelsts'];
    $Location = $proparr[0]['location'];
    $Locationcod = $proparr[0]['cploc'];
    $IsActive = $proparr[0]['IsActive'];
        $propType= $proparr[0]['cptyp'];
        $rentFor=$proparr[0]['cprntfor'];
        $MntChargesFor= $proparr[0]['cpmntcrgfor'];
        $PropFurnishedStatus=$proparr[0]['cpfursts'];
        $AreaUnits=$proparr[0]['cpareunit'];
       
        $PropDescription=$proparr[0]['cpdsc'];
            $LandMark=$proparr[0]['cplndmrk'];
            $propAddress=$proparr[0]['cpadd'];
            $propRent=$proparr[0]['cprnt'];
            $PropSecurity=$proparr[0]['cpscrty'];
            $PropOtherCharges=$proparr[0]['cpocry']; 
            $AvalibleFrom=$proparr[0]['cpavlfrm'];
            $MainTainCharges=$proparr[0]['cpmntcrg'];
            $WashRooms=$proparr[0]['cppwshrm'];
          $Pentry=$proparr[0]['cpppentry'];
            $Roadfacing=$proparr[0]['cprdfac'];
            $AgeofConstruction=$proparr[0]['cpageofcnst'];
            $TotalArea=$proparr[0]['cptotarecov'];
             $FloorNo=$proparr[0]['cpflono'];
        $TotalFloor=$proparr[0]['cptotflo'];
}
//Approch to get location list by city id
if(isset($citycod))
{
 $objlocation= new clssubcat();
            $LocationArray = $objlocation->dsp_subcat($citycod);
}
if(isset($_POST["property_submit"]))
{
    $obj= new clscp();
    $obj->cptyp=$_POST["cptyp"];
    $obj->cploc=$_POST["pgloc"];
    $obj->cplndmrk=$_POST["lndmrk"];
    $obj->cpadd=$_POST["address"];
   // $obj->husbdrm=$_POST["bdrm"];
    $obj->cppbthrm=$_POST["pwash"];
    $obj->cpppntry=$_POST["ppntry"];
    $obj->cpflono=$_POST["flono"];
    $obj->cptotflo=$_POST["totflo"];
    $obj->cparecov=$_POST["totare"];
   $obj->cprdfac=$_POST["rdfac"];
     $obj->cpagefconst=$_POST["ageofconst"];
    $obj->cprnt=$_POST["rnt"];
    $obj->cprntfor=$_POST["rntfor"];
    $obj->cpocrg=$_POST["ocrg"];
    $obj->cpscrty=$_POST["scrty"];
    $obj->cpmntcrg=$_POST["mntcrg"];
     $obj->cpmntcrgfor=$_POST["mntcrgfor"];
    $obj->cpsts="P";
       $obj->cpregcod=$_SESSION["lcod"];
  //  $obj->cpregcod=2;
       $cls_date = new DateTime($_POST["avlfrm"]);
    $obj->cpavlfrm=$cls_date->format('y-m-d');
   // $obj->cpavlfrm=$_POST["avlfrm"];
    $obj->cpdsc=$_POST["desc"];
    $obj->cpfursts=$_POST["fursts"];
     $obj->cplat=$_POST["lat"];
    $obj->cplong=$_POST["long"];
   // $obj->husstryblt=$_POST["strblt"];
    $obj->cpareunt=$_POST["areunt"];
    $obj->cpregdat=date('y-m-d');
 

    if(isset($_POST["delsts"])&& $_POST["delsts"]==1)
    {
    $obj->cpdelsts="Y";
    }
 else {
        
 {
     $obj->cpdelsts="N";
 }}
    
   $sts= $obj->save_cp();
   if($sts)
   {
 
  
if(isset($_POST["pfac"]))
{
   foreach($_POST["pfac"] as $check) {
       $obj1= new clsfacprp();
    $obj1->faccode=$check; 
     $obj1->prpcod=$_SESSION["cpcod"];
     $obj1->type='C';
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
<h1 class="page-title">Update commercial Property</h1>
</div>
<div class="submit-content">
<form id="new_post" name="new_post" method="post" class="noo-form property-form" role="form">
<div class="noo-control-group">
<div class="group-title">Property Description</div>
<div class="group-container row">
    <div class="col-md-6">
<div class="form-group s-prop-type">
<label>Property Type</label>
<div class="dropdown label-select">
    <select class="form-control" name="cptyp" required>
<option value="">select one</option>
 <?php
                                                    $PGTypeArray = $ObjGeneralFunction->ReturnCommercialTypeArray();
                                                    for ($i = 0; $i < count($PGTypeArray); $i++) {
                                                        if(isset($propType)&& $propType==$PGTypeArray[$i][0]){
                                                        echo " <option value=" . $PGTypeArray[$i][0] . " selected>" . $PGTypeArray[$i][1] . "</option>";
                                                        }
                                                        else
                                                        {
                                                           echo " <option value=" . $PGTypeArray[$i][0] . ">" . $PGTypeArray[$i][1] . "</option>";  
                                                        }
                                                    }
                                                    ?>
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
<?php
$NoOfSeatsArray = $ObjGeneralFunction->ReturnArrayForNumbers();
for ($i = 0; $i < 10; $i++) {
     if(isset($FloorNo)&& $FloorNo==$NoOfSeatsArray[$i][0]){
                                                        echo " <option value=" . $NoOfSeatsArray[$i][0] . " selected>" . $NoOfSeatsArray[$i][1] . "</option>";
                                                        }
 else {
    echo " <option value=" . $NoOfSeatsArray[$i][0] . ">" . $NoOfSeatsArray[$i][1] . "</option>";
 }
}
?>
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
<?php
$NoOfSeatsArray = $ObjGeneralFunction->ReturnArrayForNumbers();
for ($i = 0; $i < 10; $i++) {
     if(isset($TotalFloor)&& $TotalFloor==$NoOfSeatsArray[$i][0]){
                                                        echo " <option value=" . $NoOfSeatsArray[$i][0] . " selected>" . $NoOfSeatsArray[$i][1] . "</option>";
                                                        }
 else {
    echo " <option value=" . $NoOfSeatsArray[$i][0] . ">" . $NoOfSeatsArray[$i][1] . "</option>";
 }
}
?>
</select>
</div>
</div>
</div>
    <div class="col-md-6">
<div class="form-group s-prop-bedrooms">
<label for="avlfrm">Available From</label>
<div class="input-group date datepicker" id="datetimepicker">
<input type="text" id="avlfrm" class="form-control" value="<?php if(isset($AvalibleFrom)) echo $AvalibleFrom; ?>" name="avlfrm" required>
 <span class="input-group-addon">
    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
</div>
</div>
</div>

<div class="col-md-12">
<div class="form-group s-prop-desc">
<label for="textarea">Description&nbsp;</label>
<textarea id="textarea" name="desc" rows="10" required><?php if(isset($PropDescription)) echo $PropDescription; ?></textarea>
</div>
</div>
<div class="col-md-12">
<div class="form-group s-prop-_noo_property_feature_attic">
<input type="hidden" name="noo_property_feature[attic]" class="" value="0">
<label for="_noo_property_feature_attic" class="checkbox-label">
 <?php
    if (isset($delerStatus) && $delerStatus) {
        echo ' <input type="checkbox" id="delsts" name="delsts" class="" value="1" checked>&nbsp;I am not interested in getting response from brokers. <i></i>';
    } else {
        echo ' <input type="checkbox" id="delsts" name="delsts" class="" value="1">&nbsp;I am not interested in getting response from brokers. <i></i>';
    }
    ?>
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
<select class="form-control" onChange="getState(this.value);" required>
<option value="">Select City</option>
    <?php
$obj = new clscat();
$CityArray = $obj->dsp_cat();

for ($i = 0; $i < count($CityArray); $i++) {
    if (isset($citycod) && $citycod == $CityArray[$i][0]) {
        echo " <option value=" . $CityArray[$i][0] . " selected>" . $CityArray[$i][1] . "</option>";
    } else {
        echo " <option value=" . $CityArray[$i][0] . " />" . $CityArray[$i][1] . "</option>";
    }
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
<?php
for ($i = 0; $i < count($LocationArray); $i++) {
    if (isset($Locationcod) && $Locationcod == $LocationArray[$i][0]) {
        echo " <option value=" . $LocationArray[$i][0] . " selected>" . $LocationArray[$i][1] . "</option>";
    } else {
        echo " <option value=" . $LocationArray[$i][0] . ">" . $LocationArray[$i][1] . "</option>";
    }
}
?>
</select>
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-address">
<label for="address">Address&nbsp;&#42;</label>
<textarea id="address" class="form-control" name="address" rows="3" required><?php if(isset($propAddress)) echo $propAddress; ?></textarea>
</div>
</div>

<div class="col-md-6">
<div class="form-group s-prop-address">
<label for="lndmrk">LandMark&nbsp;</label>
<textarea id="lndmrk" class="form-control" name="lndmrk" rows="3" required=""><?php if(isset($LandMark)) echo $LandMark; ?></textarea>
</div>
</div>


</div>
</div>
     <div class="noo-control-group">
<div class="group-title">Facilities</div>
<div class="group-container row">
  
        <div class="col-md-6">

<div class="form-group s-prop-_noo_property_field_lot_area">
<label for="rdfac">Width of road Facing plot(feets)</label>
<input type="number" id="rdfac" name="rdfac" class="form-control" value="<?php if(isset($Roadfacing)) echo $Roadfacing; ?>" required>
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-price row">

<label>Age of Construction</label>
<div class="dropdown label-select">
    <select class="form-control" name="ageofconst" required>
<option value="">select one</option>
  <?php
                                                    $AgeOfConstructionArray = $ObjGeneralFunction->ReturnArrayForNumbers();
                                                    for ($i = 0; $i < 20; $i++) {
                                                          if(isset($AgeofConstruction)&& $AgeofConstruction==$AgeOfConstructionArray[$i][0]){
                                                        echo " <option value=" . $AgeOfConstructionArray[$i][0] . " selected>" . $AgeOfConstructionArray[$i][1] . " Years</option>";
                                                        }
                                                        else{
                                                        echo " <option value=" . $AgeOfConstructionArray[$i][0] . ">" . $AgeOfConstructionArray[$i][1] . " Years</option>";
                                                    }}
                                                    ?>
</select>
</div>
</div>
</div> 
<div class="col-md-6">
<div class="form-group s-prop-bathrooms">
<div class="form-group s-prop-_noo_property_field_lot_area">
<label for="_noo_property_field_lot_area">Total Area Covered</label>
<input type="number" id="_noo_property_field_lot_area" name="totare" class="form-control" value="<?php if(isset($TotalArea)) echo $TotalArea; ?>" required>
</div>
</div>
</div> 
<div class="price col-md-6">
     <div class="form-group s-prop-type">
<label>Units</label>
<div class="dropdown label-select">
    <select class="form-control" name="areunt" required>
    <option value="">select one</option>
  <?php
  $AreaUnitsArray = $ObjGeneralFunction->ReturnAreaUnitsArray();
  for ($i = 0; $i < count($AreaUnitsArray); $i++) {
      if (isset($AreaUnits) && $AreaUnits == $AreaUnitsArray[$i][0]) {
          echo " <option value=" . $AreaUnitsArray[$i][0] . " selected>" . $AreaUnitsArray[$i][1] . "</option>";
      } else {
          echo " <option value=" . $AreaUnitsArray[$i][0] . ">" . $AreaUnitsArray[$i][1] . "</option>";
      }
  }
  ?>
</select>
</div>
</div>
</div>
    <div class="col-md-6">
        <div class="form-group s-prop-status">

<label>Personal Washroom</label>
<div class="dropdown label-select">
    <select class="form-control" name="pwash" required>
<option value="">select one</option>
  <?php
    $WashRoomsArray = $ObjGeneralFunction->ReturnBoolStatusArray();
    for ($i = 0; $i < count($WashRoomsArray); $i++) {
        if (isset($WashRooms) && $WashRooms == $WashRoomsArray[$i][0]) {
            echo " <option value=" . $WashRoomsArray[$i][0] . " selected>" . $WashRoomsArray[$i][1] . "</option>";
        } else {
            echo " <option value=" . $WashRoomsArray[$i][0] . ">" . $WashRoomsArray[$i][1] . "</option>";
        }
    }
    ?>
</select>
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group s-prop-status">

<label>Personal Pentary</label>
<div class="dropdown label-select">
<select class="form-control" name="ppntry" required>
<option value="">select one</option>
 <?php
    $PentryArray = $ObjGeneralFunction->ReturnBoolStatusArray();
    for ($i = 0; $i < count($PentryArray); $i++) {
        if (isset($WashRooms) && $WashRooms == $PentryArray[$i][0]) {
            echo " <option value=" . $PentryArray[$i][0] . " selected>" . $PentryArray[$i][1] . "</option>";
        } else {
            echo " <option value=" . $PentryArray[$i][0] . ">" . $PentryArray[$i][1] . "</option>";
        }
    }
    ?>
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
  <?php
 $FurnishedStatusArray = $ObjGeneralFunction->ReturnFurnishedStatusArray();
 for ($i = 0; $i < count($FurnishedStatusArray); $i++) {
     if (isset($PropFurnishedStatus) && $PropFurnishedStatus == $FurnishedStatusArray[$i][0]) {
         echo " <option value=" . $FurnishedStatusArray[$i][0] . " selected>" . $FurnishedStatusArray[$i][1] . "</option>";
     } else {
         echo " <option value=" . $FurnishedStatusArray[$i][0] . ">" . $FurnishedStatusArray[$i][1] . "</option>";
     }
 }
 ?>
</select>
</div>
</div>
</div>
</div>
</div>





<div class="noo-control-group small-group">
<div class="group-title">Amenities &amp; Features</div>
<div class="group-container row">
 <?php
                                    $objAllFacility = new clsfac();
                                    $objAllFacility->factype = 'C';
                                    $AllFacilityArray = $objAllFacility->dsp_fac();
                                    $objSelectedFacility = new clsfacprp();
                                    $objSelectedFacility->prpcod = $PropertyNO;
                                    $objSelectedFacility->type = 'C';
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
<label for="rnt">Expected Rent&nbsp;(rupees)</label>
<input type="number" id="rnt" class="form-control" value="<?php if(isset($propRent)) echo $propRent; ?>" name="rnt" required>
</div>
</div>
<div class="col-md-5">
<div class="form-group s-prop-status">
<label> Structure</label>
<div class="dropdown label-select">
    <select class="form-control" name="rntfor">
       <?php
$RentChargeArray = $ObjGeneralFunction->ReturnRentStructureArray();
                                                    for ($i = 0; $i < count($RentChargeArray); $i++) {
                                                         if(isset($rentFor)&& $rentFor==$RentChargeArray[$i][0]){
                                                        echo " <option value=" . $RentChargeArray[$i][0] . " selected>" . $RentChargeArray[$i][1] . "</option>";
                                                        } 
                                                        else{
                                                        echo " <option value=" . $RentChargeArray[$i][0] . ">" . $RentChargeArray[$i][1] . "</option>";
                                                    }}
?>
</select>
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-type">
<label for="scrty">Security Charges (rupees)</label>
<input type="number" id="scrty" class="form-control" value="<?php if(isset($PropSecurity)) echo $PropSecurity; ?>" name="scrty" >
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-bedrooms">
<label for="ocrg">Other Charges (rupees)</label>
<input type="number" id="ocrg" class="form-control" value="<?php if(isset($PropOtherCharges)) echo $PropOtherCharges; ?>" name="ocrg" >
</div>
</div>

<div class="col-md-7">
<div class="form-group s-prop-bedrooms">
<label for="mntcrg">Maintenance Charges&nbsp;(rupees)</label>
<input type="number" id="mntcrg" class="form-control" value="<?php if(isset($MainTainCharges)) echo $MainTainCharges; ?>" name="mntcrg" >
</div>
</div>
<div class="col-md-5">
<div class="form-group s-prop-status">
<label> Structure</label>
<div class="dropdown label-select">
    <select class="form-control" name="mcrgfor" >
     <?php
                                                    $MaintainenceChargeArray = $ObjGeneralFunction->ReturnMaintainesStructureArray();
                                                    for ($i = 0; $i < count($MaintainenceChargeArray); $i++) {
                                                         if(isset($MntChargesFor)&& $MntChargesFor==$MaintainenceChargeArray[$i][0]){
                                                        echo " <option value=" . $MaintainenceChargeArray[$i][0] . " selected>" . $MaintainenceChargeArray[$i][1] . "</option>";
                                                        } 
                                                        else{
                                                        echo " <option value=" . $MaintainenceChargeArray[$i][0] . ">" . $MaintainenceChargeArray[$i][1] . "</option>";
                                                    }}
                                                    ?>

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
include_once 'footer.php';
 ?>