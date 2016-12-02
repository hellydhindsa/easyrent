<?php 
 ob_start();
 include_once 'buslogic.php';
 
if(isset($_POST["SearchResults"]))
{
    $location=$_POST["SearchLocation"];
    $type=$_POST["SearchType"];
    $category=$_POST["SearchCategory"];
 header("location:ListWithSidebar.php?loc=$location&typ=$type&cat=$category");
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
 ob_end_clean();
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
<section id="slideshow-home" class="wrap noo-slideshow slideshow-home">
<div class="property-slider">
<div id="noo-slider-1" class="noo-slider noo-property-slide-wrap">
<ul class="sliders">
<li class="slide-item noo-property-slide">
<img src="images/slideshow/bg-slide1.jpg" class="attachment-property-slider" alt=""/>

</li>

</ul>
<div class="clearfix"></div>
<div id="noo-slider-1-pagination" class="slider-indicators indicators-center-bottom"></div>
<a id="noo-slider-1-prev" class="slider-control prev-btn" role="button" href="#">
<span class="slider-icon-prev"></span>
</a>
<a id="noo-slider-1-next" class="slider-control next-btn" role="button" href="#">
<span class="slider-icon-next"></span>
</a>
</div>
</div>
</section>
 
 
<section id="search-box" class="wrap search-box">
<div class="gsearch">
<div class="container">
 
<div class="gsearch-info">
<h4 class="gsearch-info-title">Find Your Place</h4>
<div class="gsearch-info-content">Instantly find your desired place from your own idea of location, at any price <br> and other elements just by starting your search now</div>
</div>
 
 
<div class="gsearch-wrap">

<form class="gsearchform" action="index.php" name="indexsearch" method="post" role="search">
<div class="gsearch-content">
<div class="gsearch-field">
<div class="form-group glocation">
<div class="label-select">
<select class="form-control" onChange="getState(this.value);" required>
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
<select class="form-control" name="SearchType">
<option value="A">All Types</option>
<option  value="P">PG</option>
<option value="F">Floor</option>
<option value="H">House</option>
<option value="C">Commercial</option>

</select>
</div>
</div>
<div class="form-group gtype">
<div class="label-select">
<select class="form-control" name="SearchCategory">
<option value="A">All Categories </option>
<option value="B">Boys</option>
<option value="G">Girls</option>
<option value="F">Family</option>
</select>
</div>
</div>

</div>
<div class="gsearch-action">
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
</section>
 
 
<section id="recent-properties-slider" class="wrap recent-properties recent-properties-slider">
<div class="container">
<div class="recent-properties-inner">
<div class="section-title">
<h3>Recent Properties</h3>
</div>
<div class="recent-properties-content">
<div class="caroufredsel-wrap">
<ul>
     <?php
      $obj= new clsprop();
        $arr = $obj->DisplayRecentProperties();
       // If(count($arr)>0)
           
        for($i=0; $i<count($arr); $i++)
        // for($i=0; $i<4; $i++)
        {
          //  $type=  substr($arr[$i][2], 0, 1);
            if($i==0||$i==2)
            {
echo'<li>';
echo'<div class="property-row">';
            }
           
echo'<article class="hentry has-featured">';
echo'<div class="property-featured">';
echo'<a class="content-thumb" href="property-details.html">';
echo'<img src="pgpics/'.$arr[$i][7].'" class="attachment-property-thumb" alt=""/></a>';
echo'<span class="property-category">';
echo'<a href="#">'.$arr[$i][0].'</a>';
echo'</span>';
echo'<div class="property-detail">';
echo'<div class="size"><span>'.$arr[$i][4].' sqft</span>';
echo'</div>';
echo'<div class="bathrooms"><span>'.$arr[$i][5].'</span>';
echo'</div>';
echo'<div class="bedrooms"><span>'.$arr[$i][6].'</span>';
echo'</div>';
echo'</div>';
echo'</div>';
echo'<div class="property-wrap">';
echo'<h2 class="property-title"><a href="index.php?pno='.$arr[$i][8].'&typ='.$arr[$i][2].'">'.$arr[$i][2].'</a></h2>';
echo'<div class="property-excerpt">';
echo'<p>'.$arr[$i][1].'</p>';
echo'</div>';
echo'</div>';
echo'<div class="property-summary">';
echo'<div class="property-info">';
echo'<div class="property-price">';
echo'<span><span class="amount">&#8377;'.$arr[$i][3].'</span></span>';
echo'</div>';
echo'<div class="property-action">';
echo'<a <a href="index.php?pno='.$arr[$i][8].'&typ='.$arr[$i][2].'">More Details</a>';
echo'</div>';
echo'</div>';
echo'</div>';
echo'</article>';

if($i==1||$i==3)
{
    echo' </div>';
echo'</li>';
}

        }
?>

</ul>
</div>
<a class="caroufredsel-prev" href="#"></a>
<a class="caroufredsel-next" href="#"></a>
</div>
</div>
</div>
</section>

<section id="our-sevices" class="wrap our-sevices">
<div class="container">
<div class="parallax">
<div class="bg parallax-bg"></div>
<div class="overlay"></div>
<div class="our-sevices-content">
<div class="row clearfix">
<div class="col-xs-12 col-sm-4 our-sevices-col">
<span class="service-icon">
<i class="fa fa-home"></i>
</span>
<hr class="noo-gap">
<div class="text-block">
<h5>Hottest Property List</h5>
<p>Wherever you are and you want to go, we provide you extremely hot and continuously<br>updated property list.</p>
<p><a class="icon-right" href="#">See latest list<i class="fa fa-arrow-circle-o-right"></i></a></p>
</div>
</div>
<div class="col-xs-12 col-sm-4 our-sevices-col">
<span class="service-icon">
<i class="fa fa-thumbs-o-up"></i>
</span>
<hr class="noo-gap">
<div class="text-block">
<h5>Best Price In Market</h5>
<p>Wherever you are and you want to go, we provide you extremely hot and continuously
<br>updated property list.</p>
<p><a class="icon-right" href="#">See latest list<i class="fa fa-arrow-circle-o-right"></i></a>
</p>
</div>
</div>
<div class="col-xs-12 col-sm-4 our-sevices-col">
<span class="service-icon">
<i class="fa fa-star"></i>
</span>
<hr class="noo-gap">
<div class="text-block">
<h5>Guaranteed Service</h5>
<p>Wherever you are and you want to go, we provide you extremely hot and continuously
<br>updated property list.</p>
<p>
<a class="icon-right" href="#">See latest list<i class="fa fa-arrow-circle-o-right"></i></a>
</p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
 

 
<section id="testimonial" class="wrap testimonial">
<div class="container">
<div class="testimonial-inner">
<div class="section-title">
<h3>Testimonial</h3>
</div>
<div class="testimonial-content">
<div class="carousel slide" id="carousel-testimonial">
<ol class="carousel-indicators">
<li data-target="#carousel-testimonial" data-slide-to="0" class="active"></li>
<li data-target="#carousel-testimonial" data-slide-to="1"></li>
<li data-target="#carousel-testimonial" data-slide-to="2"></li>
<li data-target="#carousel-testimonial" data-slide-to="3"></li>
</ol>
<div class="carousel-inner">
 
<div class="item active">
<div class="slide-content">
<div class="testimonial-desc">“I found my current apartment on Citilights with extraordinary help from them and totally satisfied with the choice I made. All I had to do was to tell what I was looking for and I got back property suggestions nearly exact to my imagination. Among those, I finally chose mine now then completed procedure at ease. Highly recommend Citilights for your home search.”</div>
<div class="our-customer-info">
<div class="avatar">
<a href="#"><img src="images/other/customer1.png" alt=""></a>
</div>
<div class="custom-desc">
<h4>Dave Softel</h4>
<p>Happy Buyer of June</p>
</div>
</div>
</div>
</div>
 
 
<div class="item">
<div class="slide-content">
<div class="testimonial-desc">“I found my current apartment on Citilights with extraordinary help from them and totally satisfied with the choice I made. All I had to do was to tell what I was looking for and I got back property suggestions nearly exact to my imagination. Among those, I finally chose mine now then completed procedure at ease. Highly recommend Citilights for your home search.”</div>
<div class="our-customer-info">
<div class="avatar">
<a href="#"><img src="images/other/customer1.png" alt=""></a>
</div>
<div class="custom-desc">
<h4>Dave Softel</h4>
<p>Happy Buyer of June</p>
</div>
</div>
</div>
</div>
 
 
<div class="item">
<div class="slide-content">
<div class="testimonial-desc">“I found my current apartment on Citilights with extraordinary help from them and totally satisfied with the choice I made. All I had to do was to tell what I was looking for and I got back property suggestions nearly exact to my imagination. Among those, I finally chose mine now then completed procedure at ease. Highly recommend Citilights for your home search.”</div>
<div class="our-customer-info">
<div class="avatar">
<a href="#"><img src="images/other/customer1.png" alt=""></a>
</div>
<div class="custom-desc">
<h4>Dave Softel</h4>
<p>Happy Buyer of June</p>
</div>
</div>
</div>
</div>
 
 
<div class="item">
<div class="slide-content">
<div class="testimonial-desc">“I found my current apartment on Citilights with extraordinary help from them and totally satisfied with the choice I made. All I had to do was to tell what I was looking for and I got back property suggestions nearly exact to my imagination. Among those, I finally chose mine now then completed procedure at ease. Highly recommend Citilights for your home search.”</div>
<div class="our-customer-info">
<div class="avatar">
<a href="#"><img src="images/other/customer1.png" alt=""></a>
</div>
<div class="custom-desc">
<h4>Dave Softel</h4>
<p>Happy Buyer of June</p>
</div>
</div>
</div>
</div>
 
</div>
</div>
</div>
</div>
</div>
</section>
 
 
</div>
 
<?php
 include_once 'footer.php';
?>