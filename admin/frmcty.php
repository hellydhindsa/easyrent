
<?php
//session_start();
include_once '../buslogic.php';
//code check user is login or not and IS It Admin
 if(!isset($_SESSION["lcod"]) || $_SESSION["lcod"]!=11){header("location:../login.php");}
 
if(isset($_POST["btnsub"]))
{
    $obj= new clscat();
    $obj->catname=$_POST["txtcat"];
    $obj->save_cat();

}
if (isset($_REQUEST["catcod"]))
{
    if(isset($_REQUEST["mode"])&& $_REQUEST["mode"]=='D')
    {
        $obj=new clscat();
        $obj->catcode=$_REQUEST["catcod"];
        $obj->delete_cat();
    }
}
if(isset($_REQUEST["mode"]) && $_REQUEST["mode"]=='E')
{
  
    $obj= new clscat();
    $obj->catcode=$_REQUEST["catcod"];
    $obj->find_cat();
    $catnam=$obj->catname;
  //  echo $catnam;
    $_SESSION["catcod"]=$_REQUEST["catcod"];
}
if(isset($_POST["btnupd"]))
{
    $obj= new clscat();
    $obj->catcode=$_SESSION["catcod"];
    $obj->catname=$_POST["txtcat"];
    $obj->update_cat();
    unset($_SESSION["catcod"]);
    
}
//if(!isset($_SESSION["lcod"]))
//{
//    header("location:../frmlogin.php?sts=S");
//}
include_once 'AdminHeader.php';
?>

 
 
<div class="noo-wrapper">
 
<div class="container-fluid noo-mainbody">
<div class="noo-mainbody-inner">
<div class="row clearfix">
 
<div class="noo-content col-xs-12">
<div class="page-content row">
<div class="col-md-12">
<div class="noo-logreg both">
<div class="logreg-container">
<div class="row clearfix logreg-content">
<div class="abcform col-md-12">
    <form action="frmcty.php" name="login" method="post">
<div class="logreg-title">ADD CITY</div>
<!--<p class="logreg-desc">Already a member of CitiLights. Please use the form below to log in site.</p>-->
<!--<div class="form-message"></div>-->
<div class="logreg-content">
<div class="form-group">
<input type="text" class="form-control" id="log" name="txtcat" value="<?php if(isset($catnam)) echo $catnam; ?> " placeholder="Enter City *" required="">
</div>
<!--<div class="form-group">
<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password *" required="">-->
<!--</div>-->
</div>
<div class="logreg-action">
<!--<input type="submit" value="Submit" name="btnlogin" class="btn navbar-btn" />-->
 <?php
               if(isset($_SESSION["catcod"]))
               {
                   echo "<input type=submit name=btnupd value=Update name=btnlogin class=btn  >";
               }
                   else
                   {
                   echo "<input type=submit name=btnsub value=Save name=btnlogin class=btn  >";
                   }
                   ?>
    <input type="reset" name="btncan" value="Cancel" name="btnlogin" class="btn navbar-btn" />
<?php
//        if(isset($msg))
//            echo "<label>".$msg."</label>";
        ?>
</div>
<!--<p class="logreg-desc">Lost your password? <a href="#">Click here to reset</a>-->
<!--</p>-->
   <div class="abcform col-md-12">
      <?php
        $obj= new clscat();
        $arr = $obj->dsp_cat();
        If(count($arr)>0)
            echo "<table><tr><th>Cities</th></tr>";
        for($i=0; $i<count($arr); $i++)
        {
            echo"<tr><td>".$arr[$i][1]."</td>";
            echo"<td><a href=frmcty.php?catcod=".$arr[$i][0]."&mode=E >Edit</a>";
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
             echo"<a href=frmcty.php?catcod=".$arr[$i][0]."&mode=D >delete</a> </td></tr>";
        }
        echo "</table>";
        ?>
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
</div>
 
</div>
  <?php
include_once 'Adminfooter.php';
?>