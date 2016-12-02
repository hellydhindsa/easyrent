<?php
include_once 'buslogic.php';
include_once 'header.php';
?>

<div class="noo-wrapper">
 
<div class="container noo-mainbody">
<div class="noo-mainbody-inner">
<div class="row clearfix">
 
<div class="noo-content col-xs-12 col-md-8">
 
<div class="recent-properties">
<div class="properties list">
 
<div class="properties-header">
<h1 class="page-title">Properties</h1>
<div class="properties-toolbar">
<!--<a href="grid-with-sidebar.html" data-toggle="tooltip" data-placement="bottom" title="Grid"><i class="fa fa-th-large"></i></a>
<a class="selected" href="list-with-sidebar.html" data-toggle="tooltip" data-placement="bottom" title="List"><i class="fa fa-list"></i></a>
<form class="properties-ordering" method="get">
<div class="properties-ordering-label">Sorted by</div>
<div class="form-group properties-ordering-select">
<div class="label-select">
<select class="form-control">
<option>Date</option>
<option>Bath</option>
<option>Bed</option>
<option>Area</option>
<option>Name</option>
</select>
</div>
</div>
</form>-->
</div>
</div>
 
 
<div class="properties-content">
    
    <?php
    
       $obj= new clsprop();  
                                      
                                                  $arr = $obj->dsp_prpbyuser(1);
     
        for($i=0; $i<count($arr); $i++)
        {   
            $typ=  substr($arr[$i][2],0,1);
echo'<article class="hentry"><div class="property-featured"><span class="featured"><i class="fa fa-star"></i></span><a class="content-thumb" href="property-details.html"><img src="pgpics/';
 echo $arr[$i][7];    
echo'" alt=""></a><span class="property-label">';
echo $arr[$i][2]; 
        echo '</span><span  class="property-category " ><input class="btn" type=button value="edit details"></div><div class="property-wrap"><h2 class="property-title"><a href="#" title="';
    echo $arr[$i][0].' TYPE:'.$arr[$i][2];
            echo'">';
    echo $arr[$i][0].' TYPE:'.$arr[$i][2];
            echo'</a></h2><div class="property-excerpt"><p class="property-fullwidth-excerpt">';
            echo $arr[$i][1];
 echo' </p></div><div class="property-summary"><div class="property-detail"><div class="size"><span>';
                echo $arr[$i][4]; 
                echo'sqft</span></div><div class="bathrooms"><span>';
                 echo $arr[$i][5]; 
                echo'</span></div><div class="bedrooms"><span>';
                      echo $arr[$i][6]; 
                echo'</span></div></div><div class="property-info"><div class="property-price"><span><span class="amount">';
                      echo $arr[$i][3]; 
echo'(rupees)/month</span></span></div><div class="property-action"><a href="frmprpdet.php?typ=';
echo $typ;
    echo '">More Details</a></div></div><div class="property-info property-fullwidth-info">';
    
    
    
//    echo'<div class="property-price"><span><span class="amount">';
//    echo $arr[$i][3];
//    echo'(rupees)/month</span> </span></div><div class="size"><span>';
//       echo $arr[$i][4];  
//    echo'sqft</span></div><div class="bathrooms"><span>';
//        echo $arr[$i][5]; 
//       echo' </span></div><div class="bedrooms"><span>';
//            echo $arr[$i][6]; 
//        echo'</span></div>';
    
    
    
    
    
    
    echo'<div class="property-price"><span><span class="amount">';
    echo $arr[$i][3];
    echo'(rupees)/month</span> </span></div><div class="size"><span>';
       echo $arr[$i][4];  
    echo'sqft</span></div><div class="bathrooms"><span>';
        echo $arr[$i][5]; 
       echo' </span></div><div class="bedrooms"><span>';
            echo $arr[$i][6]; 
        echo'</span></div></div></div></div><div class="property-action property-fullwidth-action"><a href="frmprpdet.php?typ=';
        echo $typ;  
        echo '">More Details</a></div></article>';
        
        
        
        
      


        }     
        ?>

<div class="clearfix"></div>
 
<nav class="pagination-nav">
<ul class="pagination list-center">
<li><a class="prev page-numbers" href="#"><i class="fa fa-angle-left"></i></a></li>
<li><span class="page-numbers current">1</span></li>
<li><a class="page-numbers" href="#">2</a></li>
<li><span class="page-dots"><i class="fa fa-ellipsis-h"></i></span></li>
<li><a class="page-numbers" href="#">7</a></li>
<li><a class="page-numbers" href="#">8</a></li>
<li><a class="next page-numbers" href="#"><i class="fa fa-angle-right"></i></a></li>
</ul>
</nav>
 
</div>
 
</div>
</div>
 
</div>
 
 
<div class="noo-sidebar noo-sidebar-right col-xs-12 col-md-4">
<div class="noo-sidebar-inner">
 
<div class="block-sidebar find-property">
<h3 class="title-block-sidebar">Find Property</h3>
<div class="gsearch">
<div class="gsearch-wrap">
<form class="gsearchform" method="get" role="search">
<div class="gsearch-content">
<div class="gsearch-field">
<div class="form-group glocation">
<div class="label-select">
<select class="form-control">
<option>All Locations</option>
<option>New Jersey</option>
<option>New York</option>
</select>
</div>
</div>
<div class="form-group gsub-location">
<div class="label-select">
<select class="form-control">
<option>All Sub-locations</option>
<option>Central New York</option>
<option>GreenVille</option>
<option>Long Island</option>
<option>New York City</option>
<option>West Side</option>
</select>
</div>
</div>
<div class="form-group gstatus">
<div class="label-select">
<select class="form-control">
<option>All Status</option>
<option>Open house</option>
<option>Rent</option>
<option>Sale</option>
<option>Sold</option>
</select>
</div>
</div>
<div class="form-group gtype">
<div class="label-select">
<select class="form-control">
<option>All Type </option>
<option>Apartment</option>
<option>Co-op</option>
<option>Condo</option>
<option>Single Family Home</option>
</select>
</div>
</div>
<div class="form-group gbed">
<div class="label-select">
<select class="form-control">
<option>No. of Bedrooms</option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
</select>
</div>
</div>
<div class="form-group gbath">
<div class="label-select">
<select class="form-control">
<option>No. of Bathrooms</option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
</select>
</div>
</div>
<div class="form-group gprice">
<span class="gprice-label">Price</span>
<div class="gslider-range gprice-slider-range"></div>
<span class="gslider-range-value gprice-slider-range-value-min"></span>
<span class="gslider-range-value gprice-slider-range-value-max"></span>
</div>
<div class="form-group garea">
<span class="garea-label">Area</span>
<div class="gslider-range garea-slider-range"></div>
<span class="gslider-range-value garea-slider-range-value-min"></span>
<span class="gslider-range-value garea-slider-range-value-max"></span>
</div>
</div>
<div class="gsearch-action">
<div class="gsubmit">
<a class="btn btn-deault" href="#">Search Property</a>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
 
 
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
 
</div>
</div>
</div>
 
</div>
 <?php
include_once 'footer.php';
?>