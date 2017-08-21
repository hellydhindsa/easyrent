<?php
include_once '../buslogic.php';
//code check user is login or not and IS It Admin
 if(!isset($_SESSION["lcod"]) || $_SESSION["lcod"]!=11){header("location:../login.php");}
   
if(isset($_POST["Testimonial_submit"]))
{
    $obj= new classUserTestimonials();
   // $obj->FurnishedStatus=$_POST["fursts"];
    $obj->Month=$_POST["month"];
    $pic=$_FILES["fil"]["name"];
    $pic=  substr($pic, strpos($pic, '.'));
   $obj->Picture=$pic;
    $obj->UserName=$_POST["username"];
     $obj->Text=$_POST["text"];
   $Testimonialcode= $obj->SaveTestimonial();
   if($Testimonialcode)
   {
 move_uploaded_file ($_FILES["fil"]["tmp_name"],"../testimonialpics/".$Testimonialcode.$pic);
  $msg="your Testimonial Added Sucessfully";
   }
   else
   {

      $msg="your Testimonial Not Added Sucessfully";  
   }
    
}
if (isset($_REQUEST["testimonialCod"]))
{
    if(isset($_REQUEST["mode"])&& $_REQUEST["mode"]=='D')
    {
        $obj=new classUserTestimonials();
        $obj->Code=$_REQUEST["testimonialCod"];
        $obj->DeleteTestimonial();
    }
}


include_once 'AdminHeader.php';
?>

<div class="noo-wrapper">
 
<div class="container noo-mainbody">

<div class="row clearfix">
 
<div class="noo-content col-xs-12 col-md-12">
<div class="submit-header">
<h1 class="page-title">Manage TESTIMONIAL</h1>
</div>
<div class="submit-content">
    <form id="new_post" name="new_post" method="post" class="noo-form property-form" role="form" action="frmManageTestimonials.php" enctype="multipart/form-data">
   
<div class="noo-control-group">
<div class="group-title">Add TESTIMONIAL</div>
<div class="group-container row">
  <div class="col-md-6">
<div class="form-group s-prop-location">
<label>User Name</label>
<input type="text" id="title" class="form-control" value="" name="username">
</div>
</div>
    
    <div class="col-md-6">
<div class="form-group s-prop-sub_location">
<label>Text</label>
<input type="text" id="title" class="form-control" value="" name="text">
</div>
</div> 
<div class="col-md-6">
<div class="form-group s-prop-type">
<label>Month</label>
<div class="dropdown label-select">
    <select class="form-control" name="month" required>
    <option selected value='Janaury'>Janaury</option>
    <option value='February'>February</option>
    <option value='March'>March</option>
    <option value='April'>April</option>
    <option value='May'>May</option>
    <option value='June'>June</option>
    <option value='July'>July</option>
    <option value='August'>August</option>
    <option value='September'>September</option>
    <option value='October'>October</option>
    <option value='November'>November</option>
    <option value='December'>December</option>
</select>
</div>
</div>
</div>
      <div class="col-md-6">
<div class="form-group s-prop-sub_location">
<label>User Picture</label>
<input type="file" id="fil" name="fil">
</div>
</div> 
</div>
</div>

<div class="noo-submit row">
<div class="col-md-12">
    <input type="submit" name="Testimonial_submit" class="btn btn-lg rounded metro btn-primary" id="property_submit" value="Submit">
<?php
        if(isset($msg))
            echo '<label style="color: red;
    font-weight: bold;" >'.$msg.'</label>';
        ?>
</div>
    <div class="noo-control-group">
<div class="group-title">TESTIMONIAL</div>
 <?php
        $objDispay= new classUserTestimonials();
        $arr = $objDispay->DispalyActiveTestimonials();
        If(count($arr)>0)
                for($i=0; $i<count($arr); $i++)
        {
 echo'<div class="group-container row">
  
<div class="col-md-9">
<div class="form-group s-prop-type">
<div class="form-message">
  <img src="../testimonialpics/'.$arr[$i][0].$arr[$i][3].'" class="img-rounded" alt="Cinque Terre" width="50" height="50">
  <span class="form-control"> <b>USERNAME </b>';
echo $arr[$i][1].",<b>MONTH </b>".$arr[$i][4]."<b>TEXT </b>".$arr[$i][2]." ";
 echo'</span>
</div>
</div>
</div>
<div class="col-md-3"> <a href=frmManageTestimonials.php?testimonialCod=';
echo $arr[$i][0];
echo'&mode=D >
<input type="button" name="Alert_submit12" class="btn btn-lg rounded metro btn-primary" id="property_submit" value="Delete">
</a></div>

</div>';


        }
     
        ?>




</div>
</div>
</form>
</div>
</div>
 
</div>

</div>
 
</div>
 <?php
 
include_once 'Adminfooter.php';
 ?>