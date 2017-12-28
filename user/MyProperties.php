<?php
include_once '../buslogic.php';

include_once 'header.php';
?>
<div class="noo-wrapper">
 
<div class="container noo-mainbody">
<div class="noo-mainbody-inner">
<div class="row clearfix">
 
<div class="noo-sidebar noo-sidebar-left col-xs-12 col-md-4">
<div class="noo-sidebar-inner">
<div class="user-sidebar-menu dashboard-sidebar">
<?php 
include_once 'leftpanel.php';
?>
<!--<div class="user-menu-submit">
<a href="#" class="btn btn-secondary">SUBMIT PROPERTY</a>
</div>-->
</div>

</div>
</div>
 
 
<div class="noo-content col-xs-12 col-md-8">
<div class="properties list my-properties">
<div class="properties-header">
<h1 class="page-title">My Properties</h1>
</div>
<div class="properties-content">
        <?php
    
       $obj= new clsprop();  
                                      
                                                  $arr = $obj->dsp_prpbyuser($_SESSION["lcod"]);
     
        for($i=0; $i<0; $i++)
        {   
            $typ=  substr($arr[$i][2],0,1);
echo'<article class="hentry">';
echo'<div class="property-featured">';
echo'<span class="featured">';
echo'<i class="fa fa-star">';
echo'</i>';
echo'</span>';
echo'<a class="content-thumb" href="property-details.html">';
echo'<img src="../pgpics/'.$arr[$i][7].'" alt="">';
echo'</a>';
echo'<span class="property-label">';
echo $arr[$i][2]; 
        echo '</span><span  class="property-category " ><input class="btn" type=button value="edit details"></div><div class="property-wrap"><h2 class="property-title"><a href="#" title="';
    echo ' TYPE:'.$arr[$i][2];
            echo'">';
    echo ' TYPE:'.$arr[$i][2];
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
echo'(rupees)/';
if($arr[$i][10]=='M')
{ echo'Monthly';}
elseif($arr[$i][10]=='Q')
{ echo'Quarterly';}
elseif($arr[$i][10]=='Y')
{ echo'Yearly';}
elseif($arr[$i][10]=='O')
{ echo'One-Time';}
else
{ echo'Monthly';}
echo'</span></span></div><div class="property-action"><a href="frmEditProperties.php?typ='.$typ.'&pno='.$arr[$i][8].'">More Details</a></div></div><div class="property-info property-fullwidth-info">';
   echo'<div class="property-price"><span><span class="amount">';
    echo $arr[$i][3];
    echo'(rupees)/';
    if($arr[$i][10]=='M')
{ echo'Monthly';}
elseif($arr[$i][10]=='Q')
{ echo'Quarterly';}
elseif($arr[$i][10]=='Y')
{ echo'Yearly';}
elseif($arr[$i][10]=='O')
{ echo'One-Time';}
else
{ echo'Monthly';}
    echo'</span> </span></div><div class="size"><span>'.$arr[$i][4].'  
   sqft</span></div><div class="bathrooms"><span>'.$arr[$i][5].'
   </span></div><div class="bedrooms"><span>'.$arr[$i][6].' 
  </span></div></div></div></div><div class="property-action property-fullwidth-action">
  <a href="frmEditProperties.php?typ='.$typ.'&pno='.$arr[$i][8].'">More Details</a></div></article>';
        
        }     
      
    
       $objMyproperty= new clsprop();  
                                      
                                                  $ArrayMyProperty = $objMyproperty->dsp_prpbyuser($_SESSION["lcod"]);
     
        for($i=0; $i<count($ArrayMyProperty); $i++)
        {   
            $typ=  substr($ArrayMyProperty[$i][2],0,1);
 echo '<article class="hentry">
<div class="property-featured">
<span class="featured"><i class="fa fa-star"></i></span>
<a class="content-thumb" href="property-details.html">
<img src="../pgpics/'.$ArrayMyProperty[$i][7].'" alt="">
</a>
<span class="property-label sold">Sold</span>
<span class="property-category"><a href="#">Apartment</a>
</span>
</div>
<div class="property-wrap">
<h2 class="property-title">
<a href="property-details.html" title="The Helux">The Helux</a>
</h2>
<div class="property-labels"></div>
<div class="property-excerpt">
<p>Located on 43rd Street between 10th and 11th Avenue in the hot Midtown West neighborhood...</p>
<p class="property-fullwidth-excerpt">Located on 43rd Street between 10th and 11th Avenue in the hot Midtown West neighborhood of Hell?s Kitchen is The Helux. These no-fee apartments feature...</p>
</div>
<div class="property-summary">
<div class="property-detail">
<div class="size">
<span>762 sqft</span>
</div>
<div class="bathrooms">
<span>3</span>
</div>
<div class="bedrooms">
<span>3</span>
</div>
</div>
<div class="property-info">
<div class="property-price">
<span><span class="amount">&#36;3,515</span> /month</span>
</div>
<div class="property-action">
<div class="agent-action four-buttons">
<a href="#" data-toggle="tooltip" data-placement="top" title="Edit this Property"><i class="fa fa-pencil"></i>More Detail</a>

</div>
</div>
</div>
</div>
</div>
</article>';
        }
?>
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