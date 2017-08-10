<?php
//session_start();
include_once '../buslogic.php';
if(isset($_POST["btnupd"]))
{
    $obj= new clsfac();
    $obj->faccode=$_SESSION["cod"];
    $obj->facname=$_POST["txtloc"];
    $obj->factype=$_POST["cat"];
    $obj->update_fac();
    unset($_SESSION["cod"]);
//    unset($_SESSION["subcatcod"]);
    
}
if(isset($_REQUEST["typ"]))
{
    $_SESSION["typ"]=$_REQUEST["typ"];
}
if(isset($_POST["btnsub"]))
{
    $obj= new clsfac();
    $obj->facname=$_POST["txtloc"];
    $obj->factype=$_POST["cat"];
    $obj->save_fac();

}
if (isset($_REQUEST["cod"]))
{
    if(isset($_REQUEST["mode"])&& $_REQUEST["mode"]=='D')
    {
        $obj=new clsfac();
        $obj->faccode=$_REQUEST["cod"];
        $obj->delete_fac();
    }

if(isset($_REQUEST["mode"]) && $_REQUEST["mode"]=='E')
{
    $obj= new clsfac();
    $obj->faccode=$_REQUEST["cod"];
    $obj->find_fac();
    $subcatnam=$obj->facname;
   // $cod=$obj->faccode;
 $_SESSION["cod"]=$_REQUEST["cod"];
}
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
    window.location="frmfac.php?typ="+e;
    
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
    <form action="frmfac.php" name="fac" method="post">
        
<div class="logreg-title">ADD Facilities</div>
<!--<p class="logreg-desc">Already a member of CitiLights. Please use the form below to log in site.</p>-->
<!--<div class="form-message"></div>-->
<div class="logreg-content">
    <div class="form-group">
        <select name="cat" onchange="abc(this.value)">
                                    <option>Select options</option>
                                        <?php
          
            if(isset($_SESSION["typ"])&&$_SESSION["typ"]=='P')
            {
        echo " <option value=P selected/>PG</option>";
            }
 else {
        echo " <option value=P >PG</option>";
 }
          if(isset($_SESSION["typ"])&&$_SESSION["typ"]=='F')
            {
        echo " <option value=F selected/>FLOOR</option>";
            }
 else {
        echo " <option value=F >FLOOR</option>";
 }
               if(isset($_SESSION["typ"])&&$_SESSION["typ"]=='H')
            {
        echo " <option value=H selected/>HOUSE</option>";
            }
 else {
        echo " <option value=H >HOUSE</option>";
 }
          if(isset($_SESSION["typ"])&&$_SESSION["typ"]=='C')
            {
        echo " <option value=C selected/>COMMERCIAL</option>";
            }
 else {
        echo " <option value=C >COMMERCIAL</option>";
 }
        ?>
         </select> 
<!--<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password *" required="">-->
</div>
<div class="form-group">
<input type="text" class="form-control" id="log" name="txtloc" value="<?php if(isset($subcatnam)) echo $subcatnam; ?> " placeholder="Enter facility *"  required="">
</div>

</div>
<div class="logreg-action">
<!--<input type="submit" value="Submit" name="btnlogin" class="btn navbar-btn" />-->
 <?php
               if(isset($_SESSION["cod"]))
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
    <div class="noo-form property-form col-md-12">
       <?php
             if(isset($_SESSION["typ"]))
             {
            $obj= new clsfac();
            $obj->factype=$_SESSION["typ"];
            $arr = $obj->dsp_fac();
            If (count($arr) > 0) 
            {
        echo "<table><tr><th>facilities</th></tr>";
            }
        for($i=0; $i<count($arr); $i++)
            {
                echo"<tr><td>".$arr[$i][1]."</td>";
                echo"<td><a href=frmfac.php?cod=".$arr[$i][0]."&mode=E&typ=".$_SESSION["typ"]." >Edit</a>";
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                 echo"<a href=frmfac.php?cod=".$arr[$i][0]."&mode=D&typ=".$_SESSION["typ"]." >delete</a> </td></tr>";
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
 
 
<footer class="footer">
 
<div class="footer">

</div>
 
 
<div class="copyright">
<div class="container">
<div class="row">
<div class="col-xs-12 col-sm-6 text-block">
&copy; 2017 EasyRent. All Rights Reserved.
<br/>
<span>Power by <a title="Visit HiddenWebSolutions.com!" href="http://www.hiddenwebsolutions.com"  target="_blank">HiddenWebSolutions.com</a>.</span>
</div>
<div class="col-xs-12 col-sm-6 logo-block">
<div class="logo-image">
<a href="index-2.html"><img src="../images/logo/logo-footer.png" alt="CitiLights"></a>
</div>
</div>
</div>
</div>
 
<div id="back-to-top" class="back-to-top">
<i class="fa fa-angle-up"></i>
</div>
 
</div>
 
</footer>
 
</div>
 
 
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript" src="js/SmoothScroll.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/style.selector.js"></script>
 
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript">
/* <![CDATA[ */
(function(){try{var s,a,i,j,r,c,l=document.getElementsByTagName("a"),t=document.createElement("textarea");for(i=0;l.length-i;i++){try{a=l[i].getAttribute("href");if(a&&a.indexOf("/cdn-cgi/l/email-protection") > -1  && (a.length > 28)){s='';j=27+ 1 + a.indexOf("/cdn-cgi/l/email-protection");if (a.length > j) {r=parseInt(a.substr(j,2),16);for(j+=2;a.length>j&&a.substr(j,1)!='X';j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}j+=1;s+=a.substr(j,a.length-j);}t.innerHTML=s.replace(/</g,"&lt;").replace(/>/g,"&gt;");l[i].setAttribute("href","mailto:"+t.value);}}catch(e){}}}catch(e){}})();
/* ]]> */
</script>
</body>

<!-- Mirrored from html.nootheme.com/citilights/login-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Jun 2015 07:46:40 GMT -->
</html>
