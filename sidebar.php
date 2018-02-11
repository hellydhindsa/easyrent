<div class="noo-sidebar noo-sidebar-right col-xs-12 col-md-4">
<div class="noo-sidebar-inner">
 
<div class="block-sidebar find-property">
<h3 class="title-block-sidebar">Find Property</h3>

<div class="gsearch">
<div class="gsearch-wrap">
<form class="gsearchform" role="search" action="ListWithSidebar.php" onsubmit="return validateMyForm();" name="innersearch" method="post">
<div class="gsearch-content">
<div class="gsearch-field">
<div class="form-group glocation">
<div class="label-select">
<select class="form-control" id="cityDropdown" onChange="getState(this.value);" required>
    <option value="0">Select City</option>
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
<div class="form-group gsub-location">
<div class="label-select">
<select class="form-control" name="SearchLocation" id="pgloc" required>
    <option value="0">Select Location</option>

</select>
</div>
</div>
<div class="form-group gstatus">
<div class="label-select">
<select id="SearchType" class="form-control" name="SearchType" required>
<option value="A">Select Type</option>
<option  value="P">PG</option>
<option value="F">Floor</option>
<option value="H">House</option>
<option value="C">Commercial</option>
</select>
</div>
</div>
    <div id="commercial" class="form-group gstatus">
<div class="label-select">
<select  id="commercialSelect" class="form-control" name="commercialSelect" required>
<option value="A">All Commercial</option>
<option  value="O">Office</option>
<option value="S">Shop</option>
<option value="SH">ShowRoom</option>
<option value="G">Godown</option>
</select>
</div>
</div>
<div class="form-group gtype" id="SelectCategory">
<div class="label-select">
<select id="SearchCategory" class="form-control" name="SearchCategory" required>
<option value="A">Select Category </option>
<option value="B">Boys</option>
<option value="G">Girls</option>
<option value="F">Family</option>
</select>
</div>
</div>
    
<div class="form-group gbed" id="bedroomSelect">
<div class="label-select">
<select  class="form-control" id="bedroomSelect" name="bedroomSelect" >
<option value="0">No. of Bedrooms</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
</div>
</div>

<div class="form-group gbath">
  
<div class="label-select">
<select class="form-control" id="furnishedStatusSelect" name="furnishedStatusSelect">
<option value="N">Furnished Status</option>
<option value="F">Fully-Furnished</option>
<option value="S">Semi-Furnished</option>
<option value="U">Un-Furnished</option>
</select>
</div>
</div>
<div class="form-group gbath">
      <label>Price</label>
      <div class="pricediv">
<div class="col-md-6">
<div class="form-group s-prop-lat">
<!--<label for="lat">start</label>-->
<input type="number" id="lat" class="form-control" placeholder="start"  name="pricestart">
</div>
</div>
<div class="col-md-6">
<div class="form-group s-prop-address">
<!--<label for="lndmrk">end</label>-->
<input type="number" id="long" class="form-control" placeholder="end" name="priceend">
</div>
</div>
<div class="col-md-12">
<div class="form-group s-prop-long">
 <select class="form-control" name="pricefor" required>
<option value="M">Monthly</option>
<option value="Q">Quartly</option>
<option value="Y">Yearly</option>

</select>
</div>
</div>
          </div>
</div>

</div>
<div class="gsearch-action">
    <label id="validationAlert" style="color: red;
    font-weight: bold;" ></label>
<div class="gsubmit">
<!--<a class="btn btn-deault" href="#">Search Property</a>-->
<input class="btn btn-deault" type="submit" value="Search Property" name="SearchResults">
</div>
</div>
</div>
</form>
</div>
</div>
</div>
    <script>
        function validateMyForm()
{
    debugger;
    if($("#cityDropdown").val()==0)
    {
        $("#validationAlert").html("Please select City first");
        return false;
    }
    else if($("#pgloc").val()==0)
    {
          $("#validationAlert").html("Please select LOcation first");
        return false;
    }
     else if($("#SearchType").val()=="A")
    {
          $("#validationAlert").html("Please select Property Type First");
        return false;
    }
     else if($("#SearchType").val()=="C" && $("#commercialSelect").val()=="A")
    {
          $("#validationAlert").html("Please select Commercial Type First");
        return false;
    }
     else if(($("#SearchType").val()=="P" || $("#SearchType").val()=="F" || $("#SearchType").val()=="H") && $("#SearchCategory").val()=="A")
    {
          $("#validationAlert").html("Please select Category First");
        return false;
    }
    else if(($("#SearchType").val()=="F" || $("#SearchType").val()=="H") && $("#bedroomSelect").val()==0)
    {
          $("#validationAlert").html("Please select No of Bedrooms First");
        return false;
    }
    else if($("#furnishedStatusSelect").val()=="N")
    {
             $("#validationAlert").html("Please select Furnished Status First");
        return false;
    }
    else
    {
          return true;
    }
    }

        </script>
 
<div class="block-sidebar recent-property">
<h3 class="title-block-sidebar">Recent Property</h3>
<div class="featured-property">
<ul>
<li>
<div class="featured-image">
<a href="property-details.html"><img src="images/property/property1.jpg" alt=""></a>
</div>
<div class="featured-decs">
<span class="featured-status"><a href="#">For Sale</a></span>
<h4 class="featured-title"><a href="property-details.html" title="Visalia, NJ 93277">Visalia, NJ 93277</a></h4>
</div>
</li>
<li>
<div class="featured-image">
<a href="property-details.html"><img src="images/property/property2.jpg" alt=""></a>
</div>
<div class="featured-decs">
<span class="featured-status"><a href="#">For Sale</a></span>
<h4 class="featured-title"><a href="property-details.html" title="Single Family Residential, NJ">Single Family Residential, NJ</a></h4>
</div>
</li>
<li>
<div class="featured-image">
<a href="property-details.html"><img src="images/property/property3.jpg" alt=""></a>
</div>
<div class="featured-decs">
<span class="featured-status"><a href="#">For Rent</a></span>
<h4 class="featured-title"><a href="property-details.html" title="Peter Cooper Village">Peter Cooper Village</a></h4>
</div>
</li>
</ul>
</div>
</div>
 
</div>
</div>
 