<?php
include_once '../buslogic.php';
//code check user is login or not
if (!isset($_SESSION["lcod"])) {
    header("location:../login.php");
}
//function to set pg type and property code
if (isset($_REQUEST["pno"])) {
    $PropertyNO = $_REQUEST["pno"];
}
//fetch all property details
$objprop = new clsprop();
$ObjGeneralFunction = new GeneralFunction();
$proparr = $objprop->DisplayMoreDetailProperty($PropertyNO, 'P');
if (count($proparr) > 0) {
    $city = $proparr[0]['city'];
     $citycod = $proparr[0]['citycod'];
     $delerStatus=$proparr[0]['pgdelsts'];
    $Location = $proparr[0]['location'];
    $Locationcod = $proparr[0]['pgloc'];
    $IsActive = $proparr[0]['IsActive'];
    $propType = $proparr[0]['pgtyp'];
    $rentFor = $proparr[0]['pgrntfor'];
    $MntChargesFor = $proparr[0]['pgmntcrgfor'];
    $PropFurnishedStatus = $proparr[0]['pgfursts'];
   
    $PropDescription = $proparr[0]['pgdsc'];
    $Title = $proparr[0]['pgtit'];
    $LandMark = $proparr[0]['pglndmrk'];
    $propAddress = $proparr[0]['pgadd'];
    $propRent = $proparr[0]['pgrnt'] ;
    $PropSecurity = $proparr[0]['pgscrty'];
    $PropOtherCharges = $proparr[0]['pgocrg'];
    $NoOfSeats = $proparr[0]['pgnofseats'];
    $AvalibleFrom = $proparr[0]['pgavlfrm'];
    $NoOfPerson = $proparr[0]['pgnoper'];
    $MainTainCharges = $proparr[0]['pgmntcrg'] ;
}

//approch to get lovcation list by city id
if(isset($citycod))
{
 $objlocation= new clssubcat();
            $LocationArray = $objlocation->dsp_subcat($citycod);
}
   // Submit form to update all properety details         
if (isset($_POST["property_submit"])) {
    $obj = new clspg();
    $obj->pgcod=$PropertyNO;
    $obj->pgtit = $_POST["title"];
    $obj->pgtyp = $_POST["pgtyp"];
    $obj->pgloc = $_POST["pgloc"];
    $obj->pglndmrk = $_POST["lndmrk"];
    $obj->pgadd = $_POST["address"];
    $obj->pgrnt = $_POST["ernt"];
    $obj->pgrntfor = $_POST["rntfor"];
    $obj->pgscrty = $_POST["scrg"];
    $obj->pgocrg = $_POST["ocrg"];
    $obj->pgnoofseats = $_POST["noseat"];
    $obj->pgdsc = $_POST["desc"];
    $cls_date = new DateTime($_POST["avlfrm"]);
    $obj->pgavlfrm = $cls_date->format('y-m-d');
   // $obj->pgsts = "Y";
  //  $obj->pgregcod = $_SESSION["lcod"];
    //  $obj->pgregcod=1;
    $obj->pgnoper = $_POST["noperson"];
    $obj->pgfursts = $_POST["fursts"];
    if (isset($_POST["delsts"]) && $_POST["delsts"] == 1) {
        $obj->pgdelsts = "Y";
    } else {
        $obj->pgdelsts = "N";
    }
    //$obj->pglat = $_POST["lat"];
    //$obj->pglong = $_POST["long"];
    $obj->pgmntcrg = $_POST["mcrg"];
    $obj->pgmntcrgfor = $_POST["mcrgfor"];
   // $obj->pgregdat = date('y-m-d');
    $sts = $obj->Update_pg();
    if ($sts) {
        if (isset($_POST["pfac"])) {
        $objPropertFacility=new clsfacprp();
        $objPropertFacility->type='P';
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
         header("location:frmEditProperties.php?pno=$PropertyNO&typ=P");
    } else {
        
    }
}
include_once 'header.php';
?>
<script>
    function getState(val) {

        $.ajax({
            type: "POST",
            url: "get_state.php",
            data: 'country_id=' + val,
            success: function (data) {
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
                        <h1 class="page-title">Update PG </h1>
                    </div>
                    <div class="submit-content">
                        <form id="new_post" name="new_post" method="post" class="noo-form property-form" role="form" action="formEditPG.php?pno=<?php if(isset($PropertyNO)) echo $PropertyNO; ?>">

                            <div class="noo-control-group">
                                <div class="group-title">PG Description</div>
                                <div class="group-container row">
                                    <div class="col-md-8">
                                        <div class="form-group s-prop-title">
                                            <label for="title">Title&nbsp;</label>
                                            <input type="text" id="title" class="form-control" value="<?php if(isset($Title)) echo $Title; ?>" name="title">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group s-prop-type">
                                            <label>PG for</label>
                                            <div class="dropdown label-select">
                                                <select class="form-control" name="pgtyp" required>
                                                    <option value="">select one</option>
                                                   <?php
                                                    $PGTypeArray = $ObjGeneralFunction->ReturnPGTypeArray();
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
                                        <div class="form-group s-prop-type">
                                            <label>Number Of Seats</label>
                                            <div class="dropdown label-select">
                                                <select class="form-control" name="noseat" required>
                                                    <option value="">select one</option>
<?php
$NoOfSeatsArray = $ObjGeneralFunction->ReturnArrayForNumbers();
for ($i = 0; $i < 20; $i++) {
     if(isset($NoOfSeats)&& $NoOfSeats==$NoOfSeatsArray[$i][0]){
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
                                        <div class="form-group s-prop-status">
                                            <label>Persons Sharing Room</label>
                                            <div class="dropdown label-select">
                                                <select class="form-control" required name="noperson">
                                                    <option value="">select one</option>
                                                    <?php
                                                    $NoOfpersonArray = $ObjGeneralFunction->ReturnArrayForNumbers();
                                                    for ($i = 0; $i < 10; $i++) {
                                                          if(isset($NoOfPerson)&& $NoOfPerson==$NoOfpersonArray[$i][0]){
                                                        echo " <option value=" . $NoOfpersonArray[$i][0] . " selected>" . $NoOfpersonArray[$i][1] . "</option>";
                                                        }
                                                        else{
                                                        echo " <option value=" . $NoOfpersonArray[$i][0] . ">" . $NoOfpersonArray[$i][1] . "</option>";
                                                    }}
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
                                    <div class="col-md-6">
                                        <div class="form-group s-prop-status">
                                            <label>Furnished Status</label>
                                            <div class="dropdown label-select">
                                                <select class="form-control" name="fursts" required>
                                                    <option value="">select one</option>
                                                    <?php
                                                    $FurnishedStatusArray = $ObjGeneralFunction->ReturnFurnishedStatusArray();
                                                    for ($i = 0; $i < count($FurnishedStatusArray); $i++) {
                                                         if(isset($PropFurnishedStatus)&& $PropFurnishedStatus==$FurnishedStatusArray[$i][0]){
                                                        echo " <option value=" . $FurnishedStatusArray[$i][0] . " selected>" . $FurnishedStatusArray[$i][1] . "</option>";
                                                        }
                                                        else
                                                        {
                                                        echo " <option value=" . $FurnishedStatusArray[$i][0] . ">" . $FurnishedStatusArray[$i][1] . "</option>";
                                                    }}
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="col-md-12">
                                        <div class="form-group s-prop-desc">
                                            <label for="desc">Description&nbsp;&#42;</label>
                                            <textarea id="desc" name="desc" rows="10" required=""><?php if(isset($PropDescription)) echo $PropDescription; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group s-prop-_noo_property_feature_attic">

                                            <label for="_noo_property_feature_attic" class="checkbox-label">
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




                            <div class="noo-control-group small-group">
                                <div class="group-title">Amenities &amp; Features</div>
                                <div class="group-container row">


                                    <?php
                                    $objAllFacility = new clsfac();
                                    $objAllFacility->factype = 'P';
                                    $AllFacilityArray = $objAllFacility->dsp_fac();
                                    $objSelectedFacility = new clsfacprp();
                                    $objSelectedFacility->prpcod = $PropertyNO;
                                    $objSelectedFacility->type = 'P';
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
                                            <textarea id="address" class="form-control" name="address" rows="1" required=""><?php if(isset($propAddress)) echo $propAddress; ?></textarea>
                                        </div>
                                    </div>

                                    <!--<div class="col-md-4">
                                    <div class="form-group s-prop-lat">
                                    <label for="lat">Latitude (for Maps)</label>
                                    <input type="text" id="lat" class="form-control" value="40.714398" name="lat" readonly>
                                    </div>
                                    </div>-->
                                    <div class="col-md-6">
                                        <div class="form-group s-prop-address">
                                            <label for="lndmrk">LandMark&nbsp;</label>
                                            <textarea id="lndmrk" class="form-control" name="lndmrk" rows="1" required=""><?php if(isset($LandMark)) echo $LandMark; ?></textarea>
                                        </div>
                                    </div>
                                    <!--<div class="col-md-4">
                                    <div class="form-group s-prop-long">
                                    <label for="long">Longitude (for Maps)</label>
                                    <input type="text" id="long" class="form-control" value="-74.005279" name="long" readonly>
                                    </div>
                                    </div>-->

                                    <!--<div class="col-md-12">
                                    <div class="noo_property_google_map">
                                    <div id="noo_property_google_map" class="form-group noo_property_google_map" style="height: 300px; margin-top: 25px; overflow: hidden;position: relative;width: 100%;">
                                    </div>
                                    <div class="noo_property_google_map_search">
                                    <input placeholder="Search your map" type="text" autocomplete="off" id="noo_property_google_map_search_input">
                                    </div>
                                    </div>
                                     
                                    </div>-->
                                </div>
                            </div>

                            <div class="noo-control-group">
                                <div class="group-title">Rents and Other Charges</div>
                                <div class="group-container row">

                                    <div class="col-md-7">
                                        <div class="form-group s-prop-bedrooms">
                                            <label for="ernt">Expected Rent&nbsp;(rupees)</label>
                                            <input type="number" id="ernt" class="form-control" value="<?php if(isset($propRent)) echo $propRent; ?>" name="ernt" required>
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
                                            <label for="scrg">Security Charges (rupees)</label>
                                            <input type="number" id="scrg" class="form-control" value="<?php if(isset($PropSecurity)) echo $PropSecurity; ?>" name="scrg">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group s-prop-bedrooms">
                                            <label for="ocrg">Other Charges (rupees)</label>
                                            <input type="number" id="ocrg" class="form-control" value="<?php if(isset($PropOtherCharges)) echo $PropOtherCharges; ?>" name="ocrg">
                                        </div>
                                    </div>

                                    <div class="col-md-7">
                                        <div class="form-group s-prop-bedrooms">
                                            <label for="mcrg">Maintenance Charges&nbsp;(rupees)</label>
                                            <input type="number" id="mcrg" class="form-control" value="<?php if(isset($MainTainCharges)) echo $MainTainCharges; ?>" name="mcrg">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group s-prop-status">
                                            <label> Structure</label>
                                            <div class="dropdown label-select">
                                                <select class="form-control" name="mcrgfor">
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
include_once 'footer_1.php';
?>