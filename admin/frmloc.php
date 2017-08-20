<?php
//session_start();
include_once '../buslogic.php';
if(isset($_POST["btnupd"]))
{
    $obj= new clssubcat();
    $obj->subcatcode=$_SESSION["subcatcod"];
    $obj->subcatname=$_POST["txtloc"];
    $obj->subcatcatcode=$_POST["cat"];
    $obj->update_subcat();
    unset($_SESSION["subcatcod"]);
//    unset($_SESSION["subcatcod"]);
    
}
if(isset($_REQUEST["cod"]))
{
    $_SESSION["cod"]=$_REQUEST["cod"];
}
if(isset($_POST["btnsub"]))
{
    $obj= new clssubcat();
    $obj->subcatname=$_POST["txtloc"];
    $obj->subcatcatcode=$_POST["cat"];
    $obj->save_subcat();

}
if (isset($_REQUEST["subcatcod"]))
{
    if(isset($_REQUEST["mode"])&& $_REQUEST["mode"]=='D')
    {
        $obj=new clssubcat();
        $obj->subcatcode=$_REQUEST["subcatcod"];
        $obj->delete_subcat();
    }
}
if(isset($_REQUEST["mode"]) && $_REQUEST["mode"]=='E')
{
    $obj= new clssubcat();
    $obj->subcatcode=$_REQUEST["subcatcod"];
    $obj->find_subcat();
    $subcatnam=$obj->subcatname;
    $subcatcatcod=$obj->subcatcatcode;
    $_SESSION["subcatcod"]=$_REQUEST["subcatcod"];
}
//if(!isset($_SESSION["lcod"]))
//{
//    header("location:../frmlogin.php?sts=S");
//}
include_once 'AdminHeader.php';
?>
<script>
function abc(e)
{
    window.location="frmloc.php?cod="+e;
    
}
</script>

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
    <form action="frmloc.php" name="loc" method="post">
        
<div class="logreg-title">ADD Location</div>
<!--<p class="logreg-desc">Already a member of CitiLights. Please use the form below to log in site.</p>-->
<!--<div class="form-message"></div>-->
<div class="logreg-content">
    <div class="form-group">
        <select name="cat" onchange="abc(this.value)">
                                    <option>Select options</option>
                                        <?php
                                         $obj= new clscat();         
                                                  $arr = $obj->dsp_cat();
     
        for($i=0; $i<count($arr); $i++)
        {
            if(isset($_SESSION["cod"])&&$_SESSION["cod"]==$arr[$i][0])
            {
        echo " <option value=".$arr[$i][0]." selected/>".$arr[$i][1]."</option>";
            }
 else {
        echo " <option value=".$arr[$i][0].">".$arr[$i][1]."</option>";
 }
        }
        ?>
         </select> 
<!--<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password *" required="">-->
</div>
<div class="form-group">
<input type="text" class="form-control" id="log" name="txtloc" value="<?php if(isset($subcatnam)) echo $subcatnam; ?> " placeholder="Enter location *"  required="">
</div>

</div>
<div class="logreg-action">
<!--<input type="submit" value="Submit" name="btnlogin" class="btn navbar-btn" />-->
 <?php
               if(isset($_SESSION["subcatcod"]))
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
</form>
</div>
    <div class="abcform col-md-12">
       <?php
             if(isset($_SESSION["cod"]))
             {
            $obj= new clssubcat();
            $arr = $obj->dsp_subcat($_SESSION["cod"]);
            If (count($arr) > 0) 
            {
        echo "<table><tr><th>Locations</th></tr>";
            }
        for($i=0; $i<count($arr); $i++)
            {
                echo"<tr><td>".$arr[$i][1]."</td>";
                echo"<td><a href=frmloc.php?subcatcod=".$arr[$i][0]."&mode=E&cod=".$_SESSION["cod"]." >Edit</a>";
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                 echo"<a href=frmloc.php?subcatcod=".$arr[$i][0]."&mode=D&cod=".$_SESSION["cod"]." >delete</a> </td></tr>";
            }
            echo "</table>";
                 }
             
        ?>
    
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