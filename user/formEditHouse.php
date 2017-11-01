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
$proparr = $objprop->DisplayMoreDetailProperty($PropertyNO, 'H');
if (count($proparr) > 0) {
    $city = $proparr[0]['city'];
    $citycod = $proparr[0]['citycod'];
    $delerStatus = $proparr[0]['husdelsts'];
    $Location = $proparr[0]['location'];
    $Locationcod = $proparr[0]['husloc'];
    $IsActive = $proparr[0]['IsActive'];
      $propType= $proparr[0]['husfor'];
        $rentFor= $proparr[0]['husrntfor'];
        $MntChargesFor= $proparr[0]['husmntcryfor'];
        $PropFurnishedStatus=$proparr[0]['husfursts'];
        $AreaUnits=$proparr[0]['husareunit'];
       
        $PropDescription=$proparr[0]['husdsc'];
            $LandMark=$proparr[0]['huslndmrk'];
            $propAddress=$proparr[0]['husadd'];
            $propRent=$proparr[0]['husrnt'];
            $PropSecurity=$proparr[0]['husscrty'];
            $PropOtherCharges=$proparr[0]['husocrg']; 
            $AvalibleFrom=$proparr[0]['husavlfrm'];
            $MainTainCharges=$proparr[0]['husmntcrg'];
            $BedRooms=$proparr[0]['husbdrm'];
            $BathRooms=$proparr[0]['husbtnrm'];
            $Balcony=$proparr[0]['husblcny'];
            $Kitchen=$proparr[0]['huskitchen'];
            $LivingRoom=$proparr[0]['huslvrm'];
            $Lobby=$proparr[0]['huslby'];
            $propStoriesBuild=$proparr[0]['husstrybuit'];
            $TotalArea=$proparr[0]['hustotare'];
}
//Approch to get location list by city id
if(isset($citycod))
{
 $objlocation= new clssubcat();
            $LocationArray = $objlocation->dsp_subcat($citycod);
}
if(isset($_POST["property_submit"]))
{
    $obj= new clshus();
     $obj->huscode=$PropertyNO;
    $obj->husfor=$_POST["husfor"];
    $obj->husloc=$_POST["pgloc"];
    $obj->huslndmrk=$_POST["lndmrk"];
    $obj->husadd=$_POST["address"];
    $obj->husbdrm=$_POST["bdrm"];
    $obj->husbthrm=$_POST["bthrm"];
    $obj->husblcny=$_POST["blcny"];
    $obj->husktchn=$_POST["ktchn"];
    $obj->huslvrm=$_POST["lvrm"];
    $obj->husfursts=$_POST["fursts"];
   $obj->huslby=$_POST["lby"];
     $obj->hustotare=$_POST["totare"];
    $obj->husrnt=$_POST["rnt"];
    $obj->husrntfor=$_POST["rntfor"];
    $obj->husocrg=$_POST["ocrg"];
    $obj->husscrty=$_POST["scrty"];
    $obj->husmntcrg=$_POST["mntcrg"];
     $obj->husmntcrgfor=$_POST["mcrgfor"];
   // $obj->hussts="P";
    //   $obj->husregcod=$_SESSION["lcod"];
  //  $obj->husregcod=2;
       $cls_date = new DateTime($_POST["avlfrm"]);
    $obj->husavlfrm=$cls_date->format('y-m-d');
   // $obj->husavlfrm=$_POST["avlfrm"];
    $obj->husdsc=$_POST["desc"];
 //   $obj->flodelsts=$_POST["avlfrm"];
   //  $obj->huslat=$_POST["lat"];
   // $obj->huslong=$_POST["long"];
    $obj->husstryblt=$_POST["strblt"];
    $obj->husareunt=$_POST["areunt"];
   // $obj->husregdat=date('y-m-d');
 

    if(isset($_POST["delsts"])&& $_POST["delsts"]==1)
    {
    $obj->husdelsts="Y";
    }
 else {
        
 {
     $obj->husdelsts="N";
 }}
    
   $sts= $obj->Update_house();
   if($sts)
   {
   if (isset($_POST["pfac"])) {
        $objPropertFacility=new clsfacprp();
        $objPropertFacility->type='H';
        $objPropertFacility->prpcod=$PropertyNO;
        $objPropertFacility->DeleteAllFeaturesByUser();
            foreach ($_POST["pfac"] as $check) {
              //  $obj1 = new clsfacprp();
                $objPropertFacility->faccode = $check;
              //  $obj1->prpcod = $_SESSION["pgcod"];
               // $obj1->type = 'P';
                $objPropertFacility->save_facprp();
            }
        }
         header("location:frmEditProperties.php?pno=$PropertyNO&typ=H");
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
<h1 class="page-title">Update House</h1>
</div>
<div class="submit-content">
    <form id="new_post" name="new_post" method="post" class="noo-form property-form" role="form" action="formEditHouse.php?pno=<?php if(isset($PropertyNO)) echo $PropertyNO; ?>">
<div class="noo-control-group">
<div class="group-title">House Description</div>
<div class="group-container row">
    <div class="col-md-6">
<div class="form-group s-prop-type">
<label>House For</label>
<div class="dropdown label-select">
    <select class="form-control" name="husfor" required>
<option value="">select one</option>

 <?php
                                                    $PGTypeArray = $ObjGeneralFunction->ReturnFloorForArray();
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
    <div class="col-md-6">
<div class="form-group s-prop-bedrooms">
<label for="avlfrm">Available From</label>
<div class="input-group date datepicker" id="datetimepicker">
<input type="text" id="avlfrm" class="form-control" value="<?php if(isset($AvalibleFrom)) echo $AvalibleFrom; ?>" name="avlfrm">
 <span class="input-group-addon">
    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
</div>
</div>
</div>

<div class="col-md-12">
<div class="form-group s-prop-desc">
<label for="textarea">Description&nbsp;</label>
<textarea id="textarea" name="desc" rows="10" required=""><?php if(isset($PropDescription)) echo $PropDescription; ?></textarea>
</div>
</div>
<div class="col-md-12">
<div class="form-group s-prop-_noo_property_feature_attic">
<input type="hidden" name="noo_property_feature[attic]" class="" value="0">
<label for="delsts" class="checkbox-label">
 <?php
                                                if(isset($delerStatus) && $delerStatus){
                                                    echo ' <input type="checkbox" id="delsts" name="delsts" class="" value="1" checked>&nbsp;I am not interested in getting response from brokers. <i></i>';
                                                }
                                                else{
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
                                                     if(isset($citycod)&& $citycod==$CityArray[$i][0]){
                                                        echo " <option value=" . $CityArray[$i][0] . " selected>" . $CityArray[$i][1] . "</option>";
                                                        }  
                                                        else
                                                        {
                                                        echo " <option value=" . $CityArray[$i][0] . " />" . $CityArray[$i][1] . "</option>";
                                                    }}
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
<textarea id="address" class="form-control" name="address" rows="2" required=""><?php if(isset($propAddress)) echo $propAddress; ?></textarea>
</div>
</div>

<div class="col-md-6">
<div class="form-group s-prop-address">
<label for="lndmrk">LandMark&nbsp;</label>
<textarea id="lndmrk" class="form-control" name="lndmrk" rows="2" required=""><?php if(isset($LandMark)) echo $LandMark; ?></textarea>
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
 <?php
                                                    $BedroomsArray = $ObjGeneralFunction->ReturnArrayForNumbers();
                                                    for ($i = 0; $i < 5; $i++) {
                                                          if(isset($BedRooms)&& $BedRooms==$BedroomsArray[$i][0]){
                                                        echo " <option value=" . $BedroomsArray[$i][0] . " selected>" . $BedroomsArray[$i][1] . "</option>";
                                                        }
                                                        else{
                                                        echo " <option value=" . $BedroomsArray[$i][0] . ">" . $BedroomsArray[$i][1] . "</option>";
                                                    }}
                                                    ?>
</select>
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-bedrooms">
<label>Bath Rooms</label>
<div class="dropdown label-select">
    <select class="form-control" name="bthrm" required>
<option value="">select one</option>
 <?php
                                                    $BathroomsArray = $ObjGeneralFunction->ReturnArrayForNumbers();
                                                    for ($i = 0; $i < 5; $i++) {
                                                          if(isset($BathRooms)&& $BathRooms==$BathroomsArray[$i][0]){
                                                        echo " <option value=" . $BathroomsArray[$i][0] . " selected>" . $BathroomsArray[$i][1] . "</option>";
                                                        }
                                                        else{
                                                        echo " <option value=" . $BathroomsArray[$i][0] . ">" . $BathroomsArray[$i][1] . "</option>";
                                                    }}
                                                    ?>
</select>
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-bathrooms">
<label>Balcony</label>
<div class="dropdown label-select">
    <select class="form-control" name="blcny" required>
<option value="">select one</option>
  <?php
                                                    $NoOfBalconyArray = $ObjGeneralFunction->ReturnArrayForNumbers();
                                                    for ($i = 0; $i < 5; $i++) {
                                                          if(isset($Balcony)&& $Balcony==$NoOfBalconyArray[$i][0]){
                                                        echo " <option value=" . $NoOfBalconyArray[$i][0] . " selected>" . $NoOfBalconyArray[$i][1] . "</option>";
                                                        }
                                                        else{
                                                        echo " <option value=" . $NoOfBalconyArray[$i][0] . ">" . $NoOfBalconyArray[$i][1] . "</option>";
                                                    }}
                                                    ?>
</select>
</div>
</div>
</div> 
<div class="col-md-6">
<div class="form-group s-prop-price row">

<label>Kitchen</label>
<div class="dropdown label-select">
    <select class="form-control" name="ktchn" required>
<option value="">select one</option>
  <?php
                                                    $KitchensArray = $ObjGeneralFunction->ReturnArrayForNumbers();
                                                    for ($i = 0; $i < 5; $i++) {
                                                          if(isset($Kitchen)&& $Kitchen==$KitchensArray[$i][0]){
                                                        echo " <option value=" . $KitchensArray[$i][0] . " selected>" . $KitchensArray[$i][1] . "</option>";
                                                        }
                                                        else{
                                                        echo " <option value=" . $KitchensArray[$i][0] . ">" . $KitchensArray[$i][1] . "</option>";
                                                    }}
                                                    ?>
</select>
</div>
</div>
</div>
    <div class="col-md-6">
        <div class="form-group s-prop-status">

<label>Living Room</label>
<div class="dropdown label-select">
    <select class="form-contro" name="lvrm" required>          
<option value="">select one</option>
     <?php
    $LivingRoomStatusArray = $ObjGeneralFunction->ReturnBoolStatusArray();
    for ($i = 0; $i < count($LivingRoomStatusArray); $i++) {
        if (isset($LivingRoom) && $LivingRoom == $LivingRoomStatusArray[$i][0]) {
            echo " <option value=" . $LivingRoomStatusArray[$i][0] . " selected>" . $LivingRoomStatusArray[$i][1] . "</option>";
        } else {
            echo " <option value=" . $LivingRoomStatusArray[$i][0] . ">" . $LivingRoomStatusArray[$i][1] . "</option>";
        }
    }
    ?>
</select>
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group s-prop-status">

<label>Lobby</label>
<div class="dropdown label-select">
    <select class="form-control" name="lby" required>
<option value="">select one</option>
     <?php
    $LobbyArray = $ObjGeneralFunction->ReturnBoolStatusArray();
    for ($i = 0; $i < count($LobbyArray); $i++) {
        if (isset($LivingRoom) && $LivingRoom == $LobbyArray[$i][0]) {
            echo " <option value=" . $LobbyArray[$i][0] . " selected>" . $LobbyArray[$i][1] . "</option>";
        } else {
            echo " <option value=" . $LobbyArray[$i][0] . ">" . $LobbyArray[$i][1] . "</option>";
        }
    }
    ?>
</select>
</div>
</div>
    </div>
    <div class="price_label col-md-6">
    <div class="form-group s-prop-type">
<label>Stories Built</label>
<div class="dropdown label-select">
    <select class="form-control" name="strblt" required>
<option value="">select one</option>
  <?php
                                                    $NoOfStoriesBuildArray = $ObjGeneralFunction->ReturnArrayForNumbers();
                                                    for ($i = 0; $i < 8; $i++) {
                                                          if(isset($Balcony)&& $Balcony==$NoOfStoriesBuildArray[$i][0]){
                                                        echo " <option value=" . $NoOfStoriesBuildArray[$i][0] . " selected>" . $NoOfStoriesBuildArray[$i][1] . "</option>";
                                                        }
                                                        else{
                                                        echo " <option value=" . $NoOfStoriesBuildArray[$i][0] . ">" . $NoOfStoriesBuildArray[$i][1] . "</option>";
                                                    }}
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
<div class="col-md-6">
<div class="form-group s-prop-bathrooms">
<div class="form-group s-prop-_noo_property_field_lot_area">
<label for="totare">Total Area Covered</label>
<input type="number" id="totare" name="totare" class="form-control" value="<?php if(isset($TotalArea)) echo $TotalArea; ?>" required>
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
</div>
<div>




<div class="noo-control-group small-group">
<div class="group-title">Amenities &amp; Features</div>
<div class="group-container row">


    <?php
                              $objAllFacility = new clsfac();
                                    $objAllFacility->factype = 'H';
                                    $AllFacilityArray = $objAllFacility->dsp_fac();
                                    $objSelectedFacility = new clsfacprp();
                                    $objSelectedFacility->prpcod = $PropertyNO;
                                    $objSelectedFacility->type = 'H';
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
<input type="number" id="rnt" class="form-control" value="<?php if(isset($propRent)) echo $propRent; ?>" name="rnt">
</div>
</div>
<div class="col-md-5">
<div class="form-group s-prop-status">
<label> Structure</label>
<div class="dropdown label-select">
    <select class="form-control" name="rntfor" >
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
<input type="number" id="mntcrg" class="form-control" value="<?php if(isset($MainTainCharges)) echo $MainTainCharges; ?>" name="mntcrg">
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