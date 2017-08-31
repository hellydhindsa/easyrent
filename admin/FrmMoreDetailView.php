<?php
include_once '../buslogic.php';
include_once 'AdminHeader.php';
//code check user is login or not
 if(!isset($_SESSION["lcod"])){ header("location:../login.php");  }
if ($_REQUEST["pno"] && $_REQUEST["typ"]) {
    $PropertyNO=$_REQUEST["pno"];
  $PropertyType=$_REQUEST["typ"];  
  $type=substr($PropertyType,0,1);
}
$obj= new clsprf();
$picarr = $obj->DisplayProfileByPropertyID($PropertyNO,$type);
if(count($picarr)>0)
{
$pi=$picarr[0][7];
$extension=  substr($pi, strpos($pi, '.'));
 if($extension>3)
   {
   $pic='agent5.jpg'; 
   }
 else {
      $pic=$picarr[0][7];
 }
 $agentName=$picarr[0][2];
  $agentEmail=$picarr[0][0];
   $agentPhone=$picarr[0][3];
    $agentAddress=$picarr[0][5];
}                                                
$objprop= new clsprop();
$ObjGeneralFunction=new GeneralFunction();
$proparr = $objprop->DisplayMoreDetailProperty($PropertyNO,$type);
if(count($proparr)>0)
{
            $city=$proparr[0]['city'];
            $Location=$proparr[0]['location'];
    if($type=='P')
    {
            $propType= $ObjGeneralFunction->ReturnPropertyFor($proparr[0]['pgtyp']);
            $rentFor= $ObjGeneralFunction->ReturnRentFor($proparr[0]['pgrntfor']);
            $MntChargesFor= $ObjGeneralFunction->ReturnRentFor($proparr[0]['pgmntcrgfor']);
            $PropFurnishedStatus=$ObjGeneralFunction->ReturnFurnishedStatus($proparr[0]['pgfursts']);
            $PageHeaader=$proparr[0]['pgtit'].' PG';;
            $PageHeaderSmall=$proparr[0]['pglndmrk'].', '.$city;
            $PropDescription=$proparr[0]['pgdsc'];
            $Title=$proparr[0]['pgtit'];
            $LandMark=$proparr[0]['pglndmrk'];
            $propAddress=$proparr[0]['pgadd'];
            $propRent=$proparr[0]['pgrnt'].'/'.$rentFor;
            $PropSecurity=$proparr[0]['pgscrty'];
            $PropOtherCharges=$proparr[0]['pgocrg'];  
            $NoOfSeats=$proparr[0]['pgnofseats'];
            $AvalibleFrom=$proparr[0]['pgavlfrm'];
            $NoOfPerson=$proparr[0]['pgnoper'];
            $MainTainCharges=$proparr[0]['pgmntcrg'].'/'.$MntChargesFor;
    }
    elseif($type=='F')
    {
        $propType= $ObjGeneralFunction->ReturnPropertyFor($proparr[0]['flofor']);
        $rentFor= $ObjGeneralFunction->ReturnRentFor($proparr[0]['florntfor']);
        $MntChargesFor= $ObjGeneralFunction->ReturnRentFor($proparr[0]['flomntcrgfor']);
        $PropFurnishedStatus=$ObjGeneralFunction->ReturnFurnishedStatus($proparr[0]['flofursts']);
        $AreaUnits=$proparr[0]['floareunts'];
        $PageHeaader='Floor';;
        $PageHeaderSmall=$proparr[0]['flolndmrk'].', '.$city;
        $PropDescription=$proparr[0]['flodsc'];
        $LandMark=$proparr[0]['flolndmrk'];
        $propAddress=$proparr[0]['floadd'];
        $propRent=$proparr[0]['flornt'].'/'.$rentFor;
        $PropSecurity=$proparr[0]['floscrty'];
        $PropOtherCharges=$proparr[0]['floocrg']; 
        $AvalibleFrom=$proparr[0]['floavlfrm'];
        $MainTainCharges=$proparr[0]['flomntcrg'].'/'.$MntChargesFor;
        $BedRooms=$ObjGeneralFunction->ReturnNumber($proparr[0]['flobdrm']);
        $BathRooms=$ObjGeneralFunction->ReturnNumber($proparr[0]['flobthrm']);
        $Balcony=$ObjGeneralFunction->ReturnNumber($proparr[0]['floblcny']);
        $Kitchen=$ObjGeneralFunction->ReturnNumber($proparr[0]['floktchn']);
        $LivingRoom=$ObjGeneralFunction->ReturnBoolStatus($proparr[0]['flolvrm']);
        $FloorNo=$ObjGeneralFunction->ReturnNumber($proparr[0]['floflono']);
        $TotalFloor=$ObjGeneralFunction->ReturnNumber($proparr[0]['floflotot']);
        $TotalArea=$proparr[0]['flototarea'].'/'.$AreaUnits;
    }
    elseif($type=='H')
    {
        $propType= $ObjGeneralFunction->ReturnPropertyFor($proparr[0]['husfor']);
        $rentFor= $ObjGeneralFunction->ReturnRentFor($proparr[0]['husrntfor']);
        $MntChargesFor= $ObjGeneralFunction->ReturnRentFor($proparr[0]['husmntcryfor']);
        $PropFurnishedStatus=$ObjGeneralFunction->ReturnFurnishedStatus($proparr[0]['husfursts']);
        $AreaUnits=$proparr[0]['husareunit'];
        $PageHeaader='House';;
        $PageHeaderSmall=$proparr[0]['huslndmrk'].', '.$city;
        $PropDescription=$proparr[0]['husdsc'];
            $LandMark=$proparr[0]['huslndmrk'];
            $propAddress=$proparr[0]['husadd'];
            $propRent=$proparr[0]['husrnt'].'/'.$rentFor;
            $PropSecurity=$proparr[0]['husscrty'];
            $PropOtherCharges=$proparr[0]['husocrg']; 
            $AvalibleFrom=$proparr[0]['husavlfrm'];
            $MainTainCharges=$proparr[0]['husmntcrg'].'/'.$MntChargesFor;
            $BedRooms=$ObjGeneralFunction->ReturnNumber($proparr[0]['husbdrm']);
            $BathRooms=$ObjGeneralFunction->ReturnNumber($proparr[0]['husbtnrm']);
            $Balcony=$ObjGeneralFunction->ReturnNumber($proparr[0]['husblcny']);
            $Kitchen=$ObjGeneralFunction->ReturnNumber($proparr[0]['huskitchen']);
            $LivingRoom=$ObjGeneralFunction->ReturnBoolStatus($proparr[0]['huslvrm']);
            $Lobby=$ObjGeneralFunction->ReturnBoolStatus($proparr[0]['huslby']);
            $propStoriesBuild=$ObjGeneralFunction->ReturnNumber($proparr[0]['husstrybuit']);
            $TotalArea=$proparr[0]['hustotare'].'/'.$AreaUnits;
    }
     elseif($type=='C')
    {
        $propType= $ObjGeneralFunction->ReturnCommercialType($proparr[0]['cptyp']);
        $rentFor= $ObjGeneralFunction->ReturnRentFor($proparr[0]['cprntfor']);
        $MntChargesFor= $ObjGeneralFunction->ReturnRentFor($proparr[0]['cpmntcrgfor']);
        $PropFurnishedStatus=$ObjGeneralFunction->ReturnFurnishedStatus($proparr[0]['cpfursts']);
        $AreaUnits=$proparr[0]['cpareunit'];
        $PageHeaader='Commercial Property';;
        $PageHeaderSmall=$proparr[0]['cplndmrk'].', '.$city;
        $PropDescription=$proparr[0]['cpdsc'];
            $LandMark=$proparr[0]['cplndmrk'];
            $propAddress=$proparr[0]['cpadd'];
            $propRent=$proparr[0]['cprnt'].'/'.$rentFor;
            $PropSecurity=$proparr[0]['cpscrty'];
            $PropOtherCharges=$proparr[0]['cpocry']; 
            $AvalibleFrom=$proparr[0]['cpavlfrm'];
            $MainTainCharges=$proparr[0]['cpmntcrg'].'/'.$MntChargesFor;
            $WashRooms=$ObjGeneralFunction->ReturnBoolStatus($proparr[0]['cppwshrm']);
          $Pentry=$ObjGeneralFunction->ReturnBoolStatus($proparr[0]['cpppentry']);
            $Roadfacing=$proparr[0]['cprdfac'];
            $AgeofConstruction=$ObjGeneralFunction->ReturnNumber($proparr[0]['cpageofcnst']).' Years';
            $TotalArea=$proparr[0]['cptotarecov'].'/'.$AreaUnits;
             $FloorNo=$ObjGeneralFunction->ReturnNumber($proparr[0]['cpflono']);
        $TotalFloor=$ObjGeneralFunction->ReturnNumber($proparr[0]['cptotflo']);
       //
        //
        //
    }
    
  }

?>

<div class="noo-wrapper">
 
<div class="container noo-mainbody">
<div class="noo-mainbody-inner">
<div class="row clearfix">
 
<div class="noo-content col-xs-12 col-md-8">
 
<article class="property">
<h1 class="property-title">
<?php if(isset($PageHeaader)) echo $PageHeaader; ?>
<small><?php if(isset($PageHeaderSmall)) echo $PageHeaderSmall; ?></small>
</h1>
<ul class="social-list property-share clearfix">
<li><a href="#" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
<li><a href="#" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
<li><a href="#" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a></li>
</ul>
<div class="property-featured clearfix">
<div class="images">
<div class="caroufredsel-wrap">
<ul>
      <?php
      
      $obj= new clspgpic();
        $arr = $obj->DisplayPicsByIdAndType($PropertyNO,$type);
       // If(count($arr)>0)
        if( isset($arr) && count($arr)<4)
        {
         $arrayActualLength=count($arr);
         $leftElements=4-$arrayActualLength;
         for($i=$arrayActualLength; $i<4; $i++)
         {
            $arr[$i][0]='noimg'; 
            $arr[$i][1]='.jpeg'; 
         }
        }
      
      if(isset($arr))
      {
        for($i=0; $i<4; $i++)
        // for($i=0; $i<4; $i++)
        {
echo'<li><img src="../pgpics/'.$arr[$i][0].$arr[$i][1].'" height="200" width="300" alt=""/></li>';
        }}
        ?>
</ul>
</div>
</div>
<div class="thumbnails">
<div class="thumbnails-wrap">
<ul>
    <?php
     if(isset($arr))
      {
     //   for($i=0; $i<4; $i++)
         for($i=0; $i<4; $i++)
        {
echo'<li><a href="#"><img src="../pgpics/'.$arr[$i][0].$arr[$i][1].'" height="20" width="30" alt=""/></a></li>';
         }}
      ?>
<!--    <li><a href="#"><img src="../pgpics/27.jpg" height="20" width="30" alt=""/></a></li>-->
</ul>
</div>
<a class="caroufredsel-prev" href="#"></a>
<a class="caroufredsel-next" href="#"></a>
</div>
</div>
<div class="property-summary">
<div class="row">
<div class="col-md-4">
<div class="property-detail">
<h4 class="property-detail-title">Other Detail</h4>
<div class="property-detail-content">
<div class="detail-field row">
    <?php if(isset($Title))
 echo '<span class="col-xs-6 col-md-5 detail-field-label">Title</span>
<span class="col-xs-6 col-md-7 detail-field-value"> '.$Title.' </span> ';?>
    <?php if(isset($propType))
   echo' <span class="col-xs-6 col-md-5 detail-field-label">For</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$propType .'</span>'; ?>
<span class="col-xs-6 col-md-5 detail-field-label">Avalible From</span>
<span class="col-xs-6 col-md-7 detail-field-value"><?php if(isset($AvalibleFrom)) echo $AvalibleFrom; ?></span>
<?php if(isset($NoOfSeats))
echo'<span class="col-xs-6 col-md-5 detail-field-label">Number of Seats</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$NoOfSeats.' </span>'?>
<?php if(isset($NoOfPerson))
echo'<span class="col-xs-6 col-md-5 detail-field-label">Number of Person Sharing Room</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$NoOfPerson.' </span>'; ?>
<span class="col-xs-6 col-md-5 detail-field-label">Furnished Status</span>
<span class="col-xs-6 col-md-7 detail-field-value"><?php if(isset($PropFurnishedStatus)) echo $PropFurnishedStatus; ?></span>
<?php if(isset($BedRooms))
echo'<span class="col-xs-6 col-md-5 detail-field-label">Bedrooms</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$BedRooms.' </span>'; ?>
<?php if(isset($BathRooms))
echo'<span class="col-xs-6 col-md-5 detail-field-label">BathRooms</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$BathRooms.' </span>'; ?>
<?php if(isset($Balcony))
echo'<span class="col-xs-6 col-md-5 detail-field-label">Balcony</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$Balcony.' </span>'; ?>
<?php if(isset($Kitchen))
echo'<span class="col-xs-6 col-md-5 detail-field-label">Kitchen</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$Kitchen.' </span>'; ?>
<?php if(isset($LivingRoom))
echo'<span class="col-xs-6 col-md-5 detail-field-label">Living Room</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$LivingRoom.' </span>'; ?>
<?php if(isset($Lobby))
echo'<span class="col-xs-6 col-md-5 detail-field-label">Lobby</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$Lobby.' </span>'; ?>
<?php if(isset($WashRooms))
echo'<span class="col-xs-6 col-md-5 detail-field-label">Wash Room</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$WashRooms.' </span>'; ?>
<?php if(isset($Pentry))
echo'<span class="col-xs-6 col-md-5 detail-field-label">Pentry</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$Pentry.' </span>'; ?>
<?php if(isset($Roadfacing))
echo'<span class="col-xs-6 col-md-5 detail-field-label">Width of road Facing plot(feets)</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$Roadfacing.' </span>'; ?>
<?php if(isset($AgeofConstruction))
echo'<span class="col-xs-6 col-md-5 detail-field-label">Age of Construction</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$AgeofConstruction.' </span>'; ?>
<?php if(isset($FloorNo))
echo'<span class="col-xs-6 col-md-5 detail-field-label">Floor No</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$FloorNo.' </span>'; ?>
<?php if(isset($TotalFloor))
echo'<span class="col-xs-6 col-md-5 detail-field-label">Total Floors</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$TotalFloor.' </span>'; ?>
<?php if(isset($TotalArea))
echo'<span class="col-xs-6 col-md-5 detail-field-label">Total Area</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$TotalArea.' </span>'; ?>
<?php if(isset($propStoriesBuild))
echo'<span class="col-xs-6 col-md-5 detail-field-label">Stories Build</span>
<span class="col-xs-6 col-md-7 detail-field-value">  '.$propStoriesBuild.' </span>'; ?>
</div>
</div>
</div>
</div>
<div class="col-md-8">
<div class="property-desc">
<h4 class="property-detail-title">Property Description</h4>
<p><?php if(isset($PropDescription)) echo $PropDescription; ?>
</p>

</div>
</div>
</div>
</div>
<div class="property-feature">
<h4 class="property-feature-title">Property Features</h4>
<div class="property-feature-content clearfix">
       <?php
      
      $obj= new clsfac();
      $obj1= new clsfacprp();
      $obj->factype=$type;
      $obj1->prpcod=$PropertyNO;
      $obj1->type=$type;
      $arr1=$obj1->dsp_facprp();
        $arr = $obj->dsp_fac();
       // If(count($arr)>0)
      
      if(isset($arr))
      {
        for($i=0; $i<count($arr); $i++)
        {
         $sts=0;  
              for($j=0; $j<count($arr1); $j++)
        {   
                  if($arr1[$j][1]==$arr[$i][0])
                  {
                      $sts=1; 
echo'<div class="has"><i class="fa fa-check-circle"></i>'.$arr[$i][1].'</div>';
            }
   
        }
          if($sts==0)
          {
             echo'<div class="has"><i class="fa fa-times-circle"></i>'.$arr[$i][1].'</div>';
          }

        }
        
                  }
        ?>


</div>
</div>

</article>
 
 


</div>
 
 
<div class="noo-sidebar noo-sidebar-right col-xs-12 col-md-4">
<div class="noo-sidebar-inner">
 
<div class="block-sidebar find-property">
<h3 class="title-block-sidebar">Details</h3>
<div class="gsearch">
<div class="gsearch-wrap">
<form class="gsearchform" method="get" role="search">
<div class="gsearch-content">
    <h4 class="property-detail-title">Agent Detail</h4>
<div class="gsearch-field">
    <div class="user-avatar content-thumb">
        
        <img src="../delpics/<?php if(isset($pic)) echo $pic; ?>" alt="">
</div>
<div class="form-group glocation">

</div>
<div class="form-group gsub-location">
<!--<div class="label">
Name: preet
</div>-->
    <div class="detail-field row">
<span class="col-xs-6 col-md-3 detail-field-label"><b>Name:</b></span>
<span class="col-xs-6 col-md-9 detail-field-value"><?php if(isset($agentName)) echo $agentName; ?></span>
<span class="col-xs-6 col-md-3 detail-field-label"><b>Email:</b></span>
<span class="col-xs-6 col-md-9 detail-field-value"><?php if(isset($agentEmail)) echo $agentEmail; ?></span>
<span class="col-xs-6 col-md-5 detail-field-label"><b>Phone No:</b></span>
<span class="col-xs-6 col-md-7 detail-field-value"><?php if(isset($agentPhone)) echo $agentPhone; ?></span>
<span class="col-xs-6 col-md-4 detail-field-label"><b>Address:</b></span>
<span class="col-xs-6 col-md-7 detail-field-value"><?php if(isset($agentAddress)) echo $agentAddress; ?></span>

</div>

    </div>
<div class="form-group gstatus">
     <h4 class="property-detail-title">Rent Detail</h4>
  <div class="detail-field row">
<span class="col-xs-6 col-md-3 detail-field-label"><b>Rent:</b></span>
<span class="col-xs-6 col-md-9 detail-field-value"><?php if(isset($propRent)) echo $propRent; ?></span>
<span class="col-xs-6 col-md-6 detail-field-label"><b>Maintenance:</b></span>
<span class="col-xs-6 col-md-6 detail-field-value"><?php if(isset($MainTainCharges)) echo $MainTainCharges; ?></span>
<span class="col-xs-6 col-md-6 detail-field-label"><b>Security:</b></span>
<span class="col-xs-6 col-md-6 detail-field-value"><?php if(isset($PropSecurity)) echo $PropSecurity; ?></span>
<span class="col-xs-6 col-md-6 detail-field-label"><b>Other Charges:</b></span>
<span class="col-xs-6 col-md-6 detail-field-value"><?php if(isset($PropOtherCharges)) echo $PropOtherCharges; ?></span>

  </div>
</div>
    <div class="form-group gstatus">
     <h4 class="property-detail-title">Address Detail</h4>
  <div class="detail-field row">
      <span class="col-xs-6 col-md-5 detail-field-label"><b>city</b></span>
<span class="col-xs-6 col-md-7 detail-field-value"><?php if(isset($city)) echo $city; ?></span>
<span class="col-xs-6 col-md-5 detail-field-label"><b>Location</b></span>
<span class="col-xs-6 col-md-7 detail-field-value"><?php if(isset($Location)) echo $Location; ?></span>
<span class="col-xs-6 col-md-5 detail-field-label"><b>LandMark</b></span>
<span class="col-xs-6 col-md-7 detail-field-value">
<?php if(isset($LandMark)) echo $LandMark; ?>
</span>
<span class="col-xs-6 col-md-5 detail-field-label"><b>Address</b></span>
<span class="col-xs-6 col-md-7 detail-field-value"><?php if(isset($propAddress)) echo $propAddress; ?></span>

  </div>
</div>
</div>

</div>
</form>
</div>
</div>
</div>

</div>
</div>
 
</div>
</div>
</div>
 
</div>
<script>
$(document).ready(function(){
    $('body').removeClass("home page-fullwidth").addClass("page-right-sidebar");
//    $('#commercial').hide();
//    $('#bedroomSelect').hide();
    
 
});
</script>
 <?php
include_once 'Adminfooter.php';
?>