<?php
include_once '../buslogic.php';
include_once 'header_1.php';
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
                                      
                                                  $arr = $obj->dsp_prpbyuser($_SESSION["lcod"]);
     
        for($i=0; $i<count($arr); $i++)
        {   
            $typ=  substr($arr[$i][2],0,1);
echo'<article class="hentry"><div class="property-featured"><span class="featured"><i class="fa fa-star"></i></span><a class="content-thumb" href="property-details.html"><img src="../pgpics/';
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
<h2 class="title-block-sidebar">Control Panel</h3>
<div class="gsearch">
<div class="gsearch-wrap">
<form class="gsearchform" method="get" role="search">
<div class="gsearch-content">
<div class="gsearch-field">

<input type="file">
</div>
<div class="gsearch-action">
<div class="gsubmit">
<a class="btn btn-deault" href="#">Add Pictures</a>
</div>
</div>
</div>
    <div class="gsearch-content">
        <div class="gsearch-field">
            <h5>You can make your Property Public or Private</h5>
</div>
<div class="gsearch-action">
<div class="gsubmit">
<a class="btn btn-deault" href="#">Make Public</a>
</div>
</div>
</div>
    <div class="gsearch-content">
        <div class="gsearch-field">
            <h5>Edit All Other Details</h5>
</div>
<div class="gsearch-action">
<div class="gsubmit">
<a class="btn btn-deault" href="#">Edit</a>
</div>
</div>
</div>
    <div class="gsearch-content">
        <div class="gsearch-field">
            <h5>Delete Property</h5>
</div>
<div class="gsearch-action">
<div class="gsubmit">
<a class="btn btn-deault" href="#">Delete</a>
</div>
</div>
</div>
</form>
<!--</div>-->
</div>
</div>
</div>

 
 
<div class="block-sidebar recent-property">
<!--<h3 class="title-block-sidebar">Recent Property</h3>-->
<div class="featured-property">
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

<!--<ul>
<li>
<div class="featured-image">
<a href="property-details.html"><img src="../images/property/property1.jpg" alt=""></a>
</div>
<div class="featured-decs">
<span class="featured-status"><a href="#">For Sale</a></span>
<h4 class="featured-title"><a href="property-details.html" title="Visalia, NJ 93277">Visalia, NJ 93277</a></h4>
</div>
</li>
<li>
<div class="featured-image">
<a href="property-details.html"><img src="../images/property/property2.jpg" alt=""></a>
</div>
<div class="featured-decs">
<span class="featured-status"><a href="#">For Sale</a></span>
<h4 class="featured-title"><a href="property-details.html" title="Single Family Residential, NJ">Single Family Residential, NJ</a></h4>
</div>
</li>
<li>
<div class="featured-image">
<a href="property-details.html"><img src="../images/property/property3.jpg" alt=""></a>
</div>
<div class="featured-decs">
<span class="featured-status"><a href="#">For Rent</a></span>
<h4 class="featured-title"><a href="property-details.html" title="Peter Cooper Village">Peter Cooper Village</a></h4>
</div>
</li>
</ul>
--></div>
</div>
 
</div>
</div>
 
</div>
</div>
</div>
 
</div>
 <?php
include_once 'footer_1.php';
?>