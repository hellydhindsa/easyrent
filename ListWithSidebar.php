<?php
include_once 'buslogic.php';
 if(isset($_POST["SearchResults"]))
{
    $location=$_POST["SearchLocation"];
    $type=$_POST["SearchType"];
    $category=$_POST["SearchCategory"];
    $commercial=$_POST["commercialSelect"];
     $NoOfBedrooms=$_POST["bedroomSelect"];
      $FurnishedStatus=$_POST["furnishedStatusSelect"];
         $PriceStart=$_POST["pricestart"];
            $PriceEnd=$_POST["priceend"];
               $PriceUnits=$_POST["pricefor"];
$obj= new clsprop();
        $arr = $obj->DisplayInnerSearch($location,$type,$category,$FurnishedStatus,$NoOfBedrooms,$commercial,$PriceStart,$PriceEnd,$PriceUnits);
     
}

 if(isset($_REQUEST["pno"]))
{
    $PropertyNO=$_REQUEST["pno"];
    $PropertyType=$_REQUEST["typ"];
      $_SESSION["MoreDetailPno"]=$PropertyNO;
           $_SESSION["MoreDetailPType"]=$PropertyType;
   if(isset($_SESSION["lcod"]))
   {
       header("location:user/FrmMoreDetailView.php");
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
</script>
<div class="noo-wrapper">
 
<div class="container noo-mainbody">
<div class="noo-mainbody-inner">
<div class="row clearfix">
 
<div class="noo-content col-xs-12 col-md-8">
<div class="recent-properties">
<div class="properties list">
 
<div class="properties-header">
<h1 class="page-title">Properties</h1>

</div>
 
 
<div class="properties-content">
    <div id="propertylist">
      <?php
      if(isset($_REQUEST["loc"]))
      {
          $loc=$_REQUEST["loc"];
          $typ=$_REQUEST["typ"];
          $cat=$_REQUEST["cat"];
     
      $obj= new clsprop();
        $arr = $obj->DisplayIndexSearch($loc,$typ,$cat);
       // If(count($arr)>0)
      }
 else { $loc=0;
          $typ="A";
          $cat="A";
     
      $obj= new clsprop();
        $arr = $obj->DisplayIndexSearch($loc,$typ,$cat);
        }
      if(isset($arr))
      {
        for($i=0; $i<count($arr); $i++)
        // for($i=0; $i<4; $i++)
        {
      
echo'<article class="hentry">';
echo'<div class="property-featured">';


echo'<img src="pgpics/'.$arr[$i][7].'" alt="">';

echo'<span class="property-category"><a href="#">'.$arr[$i][2].'</a></span>';
echo'</div>';
echo'<div class="property-wrap">';
echo'<h2 class="property-title">';
echo'<a href="property-details.html" title="'.$arr[$i][10].'">'.$arr[$i][0].' '. $arr[$i][10].'</a>';
echo'</h2>';
echo'<div class="property-excerpt">';
echo'<p>'.$arr[$i][1].'...</p>';

echo'</div>';
echo'<div class="property-summary">';
echo'<div class="property-detail">';
echo'<div class="size">';
echo'<span>'.$arr[$i][4].' sqft</span>';
echo'</div>';
echo'<div class="bathrooms">';
echo'<span>'.$arr[$i][5].'</span>';
echo'</div>';
echo'<div class="bedrooms">';
echo'<span>'.$arr[$i][6].'</span>';
echo'</div>';
echo'</div>';
echo'<div class="property-info">';
echo'<div class="property-price">';
echo'<span>';
echo'<span class="amount">&#8377;'.$arr[$i][3].'</span>';
echo'</span>';
echo'</div>';
echo'<div class="property-action">';
echo'<a href="ListWithSidebar.php?pno='.$arr[$i][8].'&typ='.$arr[$i][2].'">More Details</a>';
echo'</div>';
echo'</div>';

echo'</div>';
echo'</div>';

echo'</article>';
          }
      }
        ?>
</div>
<div class="clearfix"></div>
 
 
</div>
 
</div>
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