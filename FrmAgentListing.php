<?php
include_once 'buslogic.php';
// if(isset($_POST["SearchResults"]))
//{
//    $location=$_POST["SearchLocation"];
//    $type=$_POST["SearchType"];
//    $category=$_POST["SearchCategory"];
//    $commercial=$_POST["commercialSelect"];
//     $NoOfBedrooms=$_POST["bedroomSelect"];
//      $FurnishedStatus=$_POST["furnishedStatusSelect"];
//         $PriceStart=$_POST["pricestart"];
//            $PriceEnd=$_POST["priceend"];
//               $PriceUnits=$_POST["pricefor"];
//$obj= new clsprop();
//        $arr = $obj->DisplayInnerSearch($location,$type,$category,$FurnishedStatus,$NoOfBedrooms,$commercial,$PriceStart,$PriceEnd,$PriceUnits);
//     
//}

  if(isset($_REQUEST["Agentno"]))
{
    $Agentno=$_REQUEST["Agentno"];
      $_SESSION["MoreDetailAgentno"]=$Agentno;
           
   if(isset($_SESSION["lcod"]))
   {
       header("location:user/agentsdetail.php?ano=$Agentno");
   }
   else
   {
       header("location:login.php");
   }

}
// session_start();
include_once 'header.php';
?>
<script>
function getState(val) {
   
	$.ajax({
	type: "POST",
	url: "user/get_state.php",
	data:'country_id='+val,
	success: function(data){
		$("#pgloc").html(data);
	}
	});
}

function getLocation(val) {
       var baseurl = window.location.origin+window.location.pathname;
    var UrltoHit= baseurl+'?loc='+val;
window.location = UrltoHit;
	// window.location = 'http://localhost:8080/property/FrmAgentListing.php?loc=' + val;
}
</script>
<div class="noo-wrapper">
 
<div class="container noo-mainbody">
<div class="noo-mainbody-inner">
<div class="row clearfix">
 
<div class="noo-content col-xs-12 col-md-8">
<div class="agents grid clearfix">
<div class="agents-header">
<h1 class="page-title">Agents Listing</h1>
<div class="properties-toolbar">
      <form class="properties-ordering">
<div class="properties-ordering-label">City</div>
<div class="form-group properties-ordering-select">
<div class="label-select">
<select class="form-control" onChange="getState(this.value);" required>
    <option value="0">Select City</option>
 <?php
  $objCity= new clscat();         
  $arrCity = $objCity->dsp_cat();
     for($i=0; $i<count($arrCity); $i++)
        {
          echo " <option value=".$arrCity[$i][0]." />".$arrCity[$i][1]."</option>";
         }
        ?>
</select>
</div>
    </div>

</form>
    
 <form class="properties-ordering">
<div class="properties-ordering-label">Locations</div>
<div class="form-group properties-ordering-select">
<div class="label-select">

    <select class="form-control" name="SearchLocationAgent" onChange="getLocation(this.value);" id="pgloc" required>
    <option value="0">Select Location</option>

</select>
</div>
    </div>
</form>
 </div>
</div>
         <?php
      if(isset($_REQUEST["loc"]))
      {
          $loc=$_REQUEST["loc"];
         
      $ObjAgentData= new clsprf();
        $agentDataArray = $ObjAgentData->DisplayAllAgentsByLocationID($loc);
       // If(count($arr)>0)
      }
      if(isset($agentDataArray))
      {
        for($i=0; $i<count($agentDataArray); $i++)
        // for($i=0; $i<4; $i++)
        {
            $pi=$agentDataArray[$i][2];
             $extension=  substr($pi, strpos($pi, '.'));
              if($extension>3)
                {   $pic='agent5.jpg';   }
               else { $pic=$agentDataArray[$i][2];  }
      
echo'<article class="hentry">';
echo'<div class="agent-featured">';
echo'<a class="content-thumb" href="agents-detail.html" title="Adam Scooter">';
echo'<img src="delpics/'.$pic.'" class="attachment-agent-thumb" alt="">';
echo'</a>';
echo'</div>';
echo'<div class="agent-wrap">';
echo'<div class="agent-summary">';
echo'<div class="agent-info">';
echo'<div><i class="fa fa-user"></i>&nbsp;'.$agentDataArray[$i][0].'</div>';
echo'<div><i class="fa fa-industry"></i>&nbsp;'.$agentDataArray[$i][1].'</div>';
echo'<div><i class="fa fa-building"></i>&nbsp;'.$agentDataArray[$i][4].'</div>';
echo'<div><i class="fa fa-map-marker"></i>&nbsp;'.$agentDataArray[$i][5].'</div>';
echo'</div>';
echo'<div class="agent-desc">';

echo'<div class="agent-action">';

echo'<a href="FrmAgentListing.php?Agentno='.$agentDataArray[$i][3].'">More Details</a>';
echo'</div>';
echo'</div>';
echo'</div>';
echo'</div>';
echo'</article>';
        }
      }
        ?>

<div class="clearfix"></div>
 

 
</div>
</div>
 
 
<?php
include_once 'sidebar.php';
?>
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
$( "#SearchType" ).change(function() {
    var value = $('#SearchType').val();
    if(value=='C')
    {
       $('#commercial').show(); 
       $('#SelectCategory').hide();
       $('#bedroomSelect').hide();
    }
    else if(value=='H'||value=='F')
    {
      $('#bedroomSelect').show();  
    }
    else
    {
        $('#commercial').hide(); 
            $('#bedroomSelect').hide();
             $('#SelectCategory').show(); 
    }
    })

</script>
  <?php
include_once 'footer.php';
?>