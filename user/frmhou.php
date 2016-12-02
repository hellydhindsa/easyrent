<?php
include_once '../buslogic.php';
if(isset($_POST["property_submit"]))
{
    $obj= new clshus();
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
     $obj->husmntcrgfor=$_POST["mntcrgfor"];
    $obj->hussts="P";
       $obj->husregcod=$_SESSION["lcod"];
  //  $obj->husregcod=2;
    $obj->husavlfrm=$_POST["avlfrm"];
    $obj->husdsc=$_POST["desc"];
 //   $obj->flodelsts=$_POST["avlfrm"];
     $obj->huslat=$_POST["lat"];
    $obj->huslong=$_POST["long"];
    $obj->husstryblt=$_POST["strblt"];
    $obj->husareunt=$_POST["areunt"];
    $obj->husregdat=date('y-m-d');
 

    if(isset($_POST["delsts"])&& $_POST["delsts"]==1)
    {
    $obj->husdelsts="Y";
    }
 else {
        
 {
     $obj->husdelsts="N";
 }}
    
   $sts= $obj->save_hus();
   if($sts)
   {
 
  
if(isset($_POST["pfac"]))
{
   foreach($_POST["pfac"] as $check) {
       $obj1= new clsfacprp();
    $obj1->faccode=$check; 
     $obj1->prpcod=$_SESSION["huscod"];
     $obj1->type='H';
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
          <h2 class="modal-title"> Upload House Pictures </h2>
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
<!--<h3 class="dashboard-sidebar-title">Abhusan Data 1</h3>
<div class="membership-info dashboard-sidebar">
<div class="sidebar-content">
<p><strong>abc1</strong></p>
<p>abc2:&nbsp;3</p>
<p>abc3:&nbsp;1</p>
<p>abc3:&nbsp;1</p>
<p>abc4:&nbsp;1</p>
<p>abc5:&nbsp;Never</p>
</div>
</div>-->
<!--<h3 id="subscription-sidebar" class="dashboard-sidebar-title">abhushan data 2</h3>
<div class="membership-payment dashboard-sidebar">
<div class="sidebar-content">
<form class="subscription_post">
<div class="form-message">
</div>
<div class="form-group">
<div class="dropdown label-select">
<select class="form-control">
<option>Plu</option>
<option>Premium Plan</option>
<option>Basic Plan</option>
</select>
</div>
</div>
<div class="form-group">
<input type="hidden" name="recurring_payment" class="" value="0">
<label for="recurring_payment" class="checkbox-label">
<input type="checkbox" id="recurring_payment" name="recurring_payment" value="1">xyz1</label>
</div>
<div class="form-group recurring_time" style="display: none;">
<label for="recurring_time">xyz2</label>
<input type="text" id="recurring_time" class="form-control" name="recurring_time" value="3">
</div>
<div class="">
<input type="submit" class="btn btn-secondary" value="PAY WITH PAYPAL">
</div>
<div>
</div>
<div class="package-info">
or&nbsp;
<a href="#">xyz3</a>
</div>
</form>
</div>
</div>-->
</div>
</div>
 
 
<div class="noo-content col-xs-12 col-md-8">
<div class="submit-header">
<h1 class="page-title">Submit House</h1>
</div>
<div class="submit-content">
    <form id="new_post" name="new_post" method="post" class="noo-form property-form" role="form" action="frmhou.php">
<div class="noo-control-group">
<div class="group-title">House Description</div>
<div class="group-container row">
    <div class="col-md-6">
<div class="form-group s-prop-type">
<label>House for</label>
<div class="dropdown label-select">
    <select class="form-control" name="husfor" required>
<option value="">select one</option>
<option value="B">Boys</option>
<option value="G">Girls</option>
<option value="F">Family</option>
</select>
</div>
</div>
</div>
    <div class="col-md-6">
<div class="form-group s-prop-bedrooms">
<label for="avlfrm">Avalable From</label>
<div class="input-group date datepicker" id="datetimepicker">
<input type="text" id="avlfrm" class="form-control" value="" name="avlfrm">
 <span class="input-group-addon">
    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
</div>
</div>
</div>

<!--<div class="col-md-4">
<div class="form-group s-prop-type">
<label>PG for</label>
<div class="dropdown label-select">
<select class="form-control">
<option>select one</option>
<option>Boys</option>
<option>Girls</option>

</select>
</div>
</div>
</div>-->
<!--<div class="col-md-6">
<div class="form-group s-prop-type">
<label>Number Of Seats</label>
<div class="dropdown label-select">
<select class="form-control">
<option>select Option</option>
<option>One</option>
<option>Two</option>
<option>Three</option>
<option>Four</option>
<option>Five</option>
<option>Six</option>
<option>Seven</option>
<option>Eignt</option>
<option>Nine</option>
<option>Ten</option>
<option>Eleven</option>
</select>
</div>
</div>
</div>-->
 


<!--<div class="col-md-4">
<div class="form-group s-prop-bathrooms">
<label for="bathrooms">Bath Rooms</label>
<input type="text" id="bathrooms" class="form-control" value="" name="bathrooms">
</div>
</div>-->
<div class="col-md-12">
<div class="form-group s-prop-desc">
<label for="textarea">Description&nbsp;</label>
<textarea id="textarea" name="desc" rows="10" required=""></textarea>
</div>
</div>
<div class="col-md-12">
<div class="form-group s-prop-_noo_property_feature_attic">
<input type="hidden" name="noo_property_feature[attic]" class="" value="0">
<label for="delsts" class="checkbox-label">
<input type="checkbox" id="delsts" name="delsts" class="" value="1">&nbsp;I am not intrested in in getting response from brokers. <i></i>
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
<label for="lndmrk">LandMark&nbsp;&#42;</label>
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
    <select class="form-control" name="bthrm" required>
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
    <select class="form-control" name="blcny" required>
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
<div class="form-group s-prop-price row">

<label>Kitchen</label>
<div class="dropdown label-select">
    <select class="form-control" name="ktchn" required>
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
        <div class="form-group s-prop-status">

<label>LivingRoom</label>
<div class="dropdown label-select">
    <select class="form-contro" name="lvrm" required>          
<option value="">select one</option>
<option value="Y">Yes</option>
<option value="N">No</option>
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
<option value="Y">Yes</option>
<option value="N">No</option>
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
<option value="1">One</option>
<option value="2">Two</option>
<option value="3">Three</option>
<option value="4">Four</option>
<option value="5">Five</option>
<option value="5">Five</option>
<option value="6">Six</option>
<option value="7">Seven</option>
<option value="8">Eight</option>


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
<option value="U"> UnFurnished</option>
</select>
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-bathrooms">
<div class="form-group s-prop-_noo_property_field_lot_area">
<label for="totare">Total Area Covered</label>
<input type="text" id="totare" name="totare" class="form-control" value="" required>
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
<div>




<div class="noo-control-group small-group">
<div class="group-title">Amenities &amp; Features</div>
<div class="group-container row">


    <?php
                                         $obj= new clsfac();  
                                         $obj->factype='H';
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
<div class="group-title">Rents and Charges</div>
<div class="group-container row">
    
<div class="col-md-7">
<div class="form-group s-prop-bedrooms">
<label for="rnt">Expected Rent&nbsp;(rupees)</label>
<input type="text" id="rnt" class="form-control" value="" name="rnt">
</div>
</div>
<div class="col-md-5">
<div class="form-group s-prop-status">
<label> select one</label>
<div class="dropdown label-select">
    <select class="form-control" name="rntfor" required>
   <option value="M">Monthly</option>
<option value="Q">Quartly</option>
<option value="Y">Yearly</option>


</select>
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-type">
<label for="scrty">Security Charges</label>
<input type="text" id="scrty" class="form-control" value="" name="scrty" required>
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
<label for="mntcrg">Maintainness Charges&nbsp;(rupees)</label>
<input type="text" id="mntcrg" class="form-control" value="" name="mntcrg">
</div>
</div>
<div class="col-md-5">
<div class="form-group s-prop-status">
<label> Select One</label>
<div class="dropdown label-select">
<select class="form-control" name="mntcrgfor">
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