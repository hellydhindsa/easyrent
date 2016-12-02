<?php
include_once '../buslogic.php';
include_once 'header_1.php';
if(isset($_SESSION["MoreDetailPno"]))
{
  $PropertyNO=$_SESSION["MoreDetailPno"];
  $PropertyType=$_SESSION["MoreDetailPType"];  
  $type=substr($PropertyType,0,1);
    unset($_SESSION["MoreDetailPno"]);
     unset($_SESSION["MoreDetailPType"]);
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
$proparr = $objprop->DisplayMoreDetailProperty($PropertyNO,$type);
if(count($proparr)>0)
{
    if($type=='P')
    {
        if($proparr[0]['pgtyp']=='B')
        {
          $propType='Boys';
        }
        elseif ($proparr[0]['pgtyp']=='G')
        {
          $propType='Girls';
        }
         else
        {
          $propType=''; 
        }
        if($proparr[0]['pgrntfor']=='M')
        {
          $rentFor='Monthly';
        }
        elseif ($proparr[0]['pgrntfor']=='Q')
        {
          $rentFor='Quartly';
        }
         elseif ($proparr[0]['pgrntfor']=='Y')
        {
          $rentFor='Yearly';
        }
         else
        {
          $rentFor=''; 
        }
               if($proparr[0]['pgmntcrgfor']=='M')
        {
          $MntChargesFor='Monthly';
        }
        elseif ($proparr[0]['pgmntcrgfor']=='Q')
        {
          $MntChargesFor='Quartly';
        }
         elseif ($proparr[0]['pgmntcrgfor']=='Y')
        {
          $MntChargesFor='Yearly';
        }
         elseif ($proparr[0]['pgmntcrgfor']=='O')
        {
          $MntChargesFor='One-Time';
        }
         else
        {
          $MntChargesFor=''; 
        }
       
    $PageHeaader=$proparr[0]['pgtit'].' PG';;
            $PageHeaderSmall=$proparr[0]['pglndmrk'].' '.$proparr[0]['pgadd'];
    $PropDescription=$proparr[0]['pgdsc'];
    $Title=$proparr[0]['pgtit'];
   // $propType=$proparr[0]['pgtyp'];
            $LandMark=$proparr[0]['pglndmrk'];
            $propAddress=$proparr[0]['pgadd'];
            $propRent=$proparr[0]['pgrnt'].' '.$rentFor;
            $PropSecurity=$proparr[0]['pgscrty'];
            $NoOfSeats=$proparr[0]['pgnofseats'];
            $AvalibleFrom=$proparr[0]['pgavlfrm'];
            $NoOfPerson=$proparr[0]['pgnoper'];
            $FurStatus=$proparr[0]['pgfursts'];
            $otherCharges=$proparr[0]['pgocrg'];
   $MainTainCharges=$proparr[0]['pgmntcrg'].' '.$MntChargesFor;
    }
    elseif($type=='F')
    {
        if($proparr[0]['flofor']=='B')
        {
          $propType='Boys';
        }
        elseif ($proparr[0]['flofor']=='G')
        {
          $propType='Girls';
        }
         elseif ($proparr[0]['flofor']=='F')
        {
          $propType='Family';
        }
         else
        {
          $propType=''; 
        }
        if($proparr[0]['florntfor']=='M')
        {
          $rentFor='Monthly';
        }
        elseif ($proparr[0]['florntfor']=='Q')
        {
          $rentFor='Quartly';
        }
         elseif ($proparr[0]['florntfor']=='Y')
        {
          $rentFor='Yearly';
        }
         else
        {
          $rentFor=''; 
        }
               if($proparr[0]['flomntcrgfor']=='M')
        {
          $MntChargesFor='Monthly';
        }
        elseif ($proparr[0]['flomntcrgfor']=='Q')
        {
          $MntChargesFor='Quartly';
        }
         elseif ($proparr[0]['flomntcrgfor']=='Y')
        {
          $MntChargesFor='Yearly';
        }
         elseif ($proparr[0]['flomntcrgfor']=='O')
        {
          $MntChargesFor='One-Time';
        }
         else
        {
          $MntChargesFor=''; 
        }
       
    $PageHeaader='Floor';;
            $PageHeaderSmall=$proparr[0]['flolndmrk'].' '.$proparr[0]['floadd'];
    $PropDescription=$proparr[0]['flodsc'];
    $Title='';
   // $propType=$proparr[0]['pgtyp'];
            $LandMark=$proparr[0]['flolndmrk'];
            $propAddress=$proparr[0]['floadd'];
            $propRent=$proparr[0]['flornt'].' '.$rentFor;
            $PropSecurity=$proparr[0]['floscrty'];
            $NoOfSeats='';
            $AvalibleFrom=$proparr[0]['floavlfrm'];
            $NoOfPerson='';
            $FurStatus=$proparr[0]['flofursts'];
            $otherCharges=$proparr[0]['floocrg'];
            $MainTainCharges=$proparr[0]['flomntcrg'].' '.$MntChargesFor;
            $BedRooms=$proparr[0]['flobdrm'];
            $BathRooms=$proparr[0]['flobthrm'];
            $Balcony=$proparr[0]['floblcny'];
            $Kitchen=$proparr[0]['floktchn'];
            $LivingRoom=$proparr[0]['flolvrm'];
            $FloorNo=$proparr[0]['floflono'];
            $TotalFloor=$proparr[0]['floflotot'];
            $TotalArea=$proparr[0]['flototarea'];
            $AreaUnits=$proparr[0]['floareunts'];
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
      
      if(isset($arr))
      {
        for($i=0; $i<count($arr); $i++)
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
        for($i=0; $i<count($arr); $i++)
        // for($i=0; $i<4; $i++)
        {
echo'<li><a href="#"><img src="../pgpics/'.$arr[$i][0].$arr[$i][1].'" height="20" width="30" alt=""/></a></li>';
         }}
      ?>
</ul>
</div>
<a class="caroufredsel-prev" href="#"></a>
<a class="caroufredsel-next" href="#"></a>
</div>
</div>
<div class="property-summary">
<div class="row">
<!--<div class="col-md-4">
<div class="property-detail">
<h4 class="property-detail-title">Property Detail</h4>
<div class="property-detail-content">
<div class="detail-field row">
<span class="col-xs-6 col-md-5 detail-field-label">Type</span>
<span class="col-xs-6 col-md-7 detail-field-value"><a href="#" rel="tag">Apartment</a></span>
<span class="col-xs-6 col-md-5 detail-field-label">Status</span>
<span class="col-xs-6 col-md-7 detail-field-value"><a href="#" rel="tag">Sold</a></span>
<span class="col-xs-6 col-md-5 detail-field-label">Location</span>
<span class="col-xs-6 col-md-7 detail-field-value"><a href="#" rel="tag">New York</a></span>
<span class="col-xs-6 col-md-5 detail-field-label">Price</span>
<span class="col-xs-6 col-md-7 detail-field-value">
<span class="amount">&#36;3,515</span> /month
</span>
<span class="col-xs-6 col-md-5 detail-field-label">Area</span>
<span class="col-xs-6 col-md-7 detail-field-value">762 sqft</span>
<span class="col-xs-6 col-md-5 detail-field-label">Bedrooms</span>
<span class="col-xs-6 col-md-7 detail-field-value">3</span>
<span class="col-xs-6 col-md-5 detail-field-label">Bathrooms</span>
<span class="col-xs-6 col-md-7 detail-field-value">3</span>
<span class="col-xs-6 col-md-5 detail-field-label">Lot Area</span>
<span class="col-xs-6 col-md-7 detail-field-value">880 ftsq</span>
<span class="col-xs-6 col-md-5 detail-field-label">Year Built</span>
<span class="col-xs-6 col-md-7 detail-field-value">2002</span>
<span class="col-xs-6 col-md-5 detail-field-label">Flooring</span>
<span class="col-xs-6 col-md-7 detail-field-value">Stone</span>
<span class="col-xs-6 col-md-5 detail-field-label">Roofling</span>
<span class="col-xs-6 col-md-7 detail-field-value">Tile</span>
<span class="col-xs-6 col-md-5 detail-field-label">Parking</span>
<span class="col-xs-6 col-md-7 detail-field-value">5 slots</span>
<span class="col-xs-6 col-md-5 detail-field-label">Style</span>
<span class="col-xs-6 col-md-7 detail-field-value">Spanish</span>
</div>
</div>
</div>
</div>-->
<div class="col-md-12">
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
     <h4 class="property-detail-title">Property Detail</h4>
  <div class="detail-field row">
<span class="col-xs-6 col-md-2 detail-field-label"><b>Title:</b></span>
<span class="col-xs-6 col-md-10 detail-field-value"><?php if(isset($Title)) echo $Title; ?></span>
<span class="col-xs-6 col-md-2 detail-field-label"><b>Type:</b></span>
<span class="col-xs-6 col-md-10 detail-field-value"><?php if(isset($propType)) echo $propType; ?></span>
<span class="col-xs-6 col-md-5 detail-field-label"><b>Land Mark:</b></span>
<span class="col-xs-6 col-md-7 detail-field-value"><?php if(isset($LandMark)) echo $LandMark; ?></span>
<span class="col-xs-6 col-md-3 detail-field-label"><b>Address:</b></span>
<span class="col-xs-6 col-md-9 detail-field-value"><?php if(isset($propAddress)) echo $propAddress; ?></span>
<span class="col-xs-6 col-md-2 detail-field-label"><b>Rent:</b></span>
<span class="col-xs-6 col-md-10 detail-field-value"><?php if(isset($propRent)) echo $propRent; ?></span>
<span class="col-xs-6 col-md-3 detail-field-label"><b>Security:</b></span>
<span class="col-xs-6 col-md-9 detail-field-value"><?php if(isset($PropSecurity)) echo $PropSecurity; ?></span>
<span class="col-xs-6 col-md-6 detail-field-label"><b>Other charges:</b></span>
<span class="col-xs-6 col-md-6 detail-field-value"><?php if(isset($otherCharges)) echo $otherCharges; ?></span>
<span class="col-xs-6 col-md-7 detail-field-label"><b>Number of Seats:</b></span>
<span class="col-xs-6 col-md-5 detail-field-value"><?php if(isset($NoOfSeats)) echo $NoOfSeats; ?></span>
<span class="col-xs-6 col-md-7 detail-field-label"><b>Avalable From:</b></span>
<span class="col-xs-6 col-md-5 detail-field-value"><?php if(isset($AvalibleFrom)) echo $AvalibleFrom; ?></span>
<span class="col-xs-6 col-md-8 detail-field-label"><b>Number of Persons:</b></span>
<span class="col-xs-6 col-md-4 detail-field-value"><?php if(isset($NoOfPerson)) echo $NoOfPerson; ?></span>
<span class="col-xs-6 col-md-8 detail-field-label"><b>Furnished Status:</b></span>
<span class="col-xs-6 col-md-4 detail-field-value"><?php if(isset($FurStatus)) echo $FurStatus; ?></span>
<span class="col-xs-6 col-md-6 detail-field-label"><b>Other charges:</b></span>
<span class="col-xs-6 col-md-6 detail-field-value"><?php if(isset($otherCharges)) echo $otherCharges; ?></span>
<span class="col-xs-6 col-md-8 detail-field-label"><b>Maintainess Charges:</b></span>
<span class="col-xs-6 col-md-4 detail-field-value"><?php if(isset($MainTainCharges)) echo $MainTainCharges; ?></span>
<span class="col-xs-6 col-md-6 detail-field-label"><b>Bedrooms:</b></span>
<span class="col-xs-6 col-md-6 detail-field-value"><?php if(isset($MainTainCharges)) echo $MainTainCharges; ?></span>
<span class="col-xs-6 col-md-6 detail-field-label"><b>Bathrooms:</b></span>
<span class="col-xs-6 col-md-6 detail-field-value"><?php if(isset($MainTainCharges)) echo $MainTainCharges; ?></span>
  <span class="col-xs-6 col-md-6 detail-field-label"><b>Livingroom:</b></span>
<span class="col-xs-6 col-md-6 detail-field-value"><?php if(isset($MainTainCharges)) echo $MainTainCharges; ?></span>
<span class="col-xs-6 col-md-6 detail-field-label"><b>Balcony:</b></span>
<span class="col-xs-6 col-md-6 detail-field-value"><?php if(isset($MainTainCharges)) echo $MainTainCharges; ?></span>
  </div>
</div>

</div>
<!--<div class="gsearch-action">
<div class="gsubmit">
<a class="btn btn-deault" href="#">Search Property</a>
</div>
</div>-->
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
    $('#commercial').hide();
    $('#bedroomSelect').hide();
    
 
});
</script>
 <?php
include_once 'footer_1.php';
?>