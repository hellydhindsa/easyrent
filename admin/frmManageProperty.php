
<?php
//session_start();
include_once '../buslogic.php';

if (isset($_REQUEST["prpcod"]))
{
    if(isset($_REQUEST["mode"])&& $_REQUEST["mode"]=='A')
    {
        $obj=new clsprop();
        $obj->UpdatePropertyStatus($_REQUEST["prpcod"], $_REQUEST["typ"], 0);
       
    }
    else if(isset($_REQUEST["mode"])&& $_REQUEST["mode"]=='NA')
    {
       $obj=new clsprop();
        $obj->UpdatePropertyStatus($_REQUEST["prpcod"], $_REQUEST["typ"], 1);
       
    }
else if(isset($_REQUEST["mode"]) && $_REQUEST["mode"]=='S')
{
  
    $obj=new clsprop();
        $obj->UpdatePropertyIndexStatus($_REQUEST["prpcod"], $_REQUEST["typ"], 0);
       
}
else if(isset($_REQUEST["mode"]) && $_REQUEST["mode"]=='NS')
{
  
   $obj=new clsprop();
        $obj->UpdatePropertyIndexStatus($_REQUEST["prpcod"], $_REQUEST["typ"], 1);
       
}
}
//if(!isset($_SESSION["lcod"]))
//{
//    header("location:../frmlogin.php?sts=S");
//}
include_once 'AdminHeader.php';
?>

 
<div class="noo-wrapper">
 
    
   
<div class="container noo-mainbody">

<div class="noo-mainbody-inner">
<div class="row clearfix">
 

 
 
<div class="noo-content col-xs-12 col-md-12">

<div class="submit-content">
<form id="new_post"  class="noo-form property-form" >
 <div class=" col-md-12">
      <?php
        $obj= new clsprop();
        $arr = $obj->dsp_propertiesForAdmin();
        If(count($arr)>0)
            echo "<table width='90%'><tr><th>Properties</th><th>Discription</th><th>Type</th><th>Rent</th><th>Date</th><th>Activate</th><th>Show to Index</th></tr>";
        for($i=0; $i<count($arr); $i++)
        {
            $type=  substr($arr[$i][2], 0, 1);
            echo"<tr width='10%'><td>".$arr[$i][0]."</td>";
            echo"<td width='10%'>".$arr[$i][1]."</td>";
            echo"<td width='20%'>".$arr[$i][2]."</td>";
            echo"<td width='10%'>".$arr[$i][3]."</td>";
             echo"<td width='10%'>".$arr[$i][9]."</td>";
            if($arr[$i][10]==1)
            {
            echo"<td width='10%'><a href=frmManageProperty.php?prpcod=".$arr[$i][8]."&mode=A&typ=".$type." >Active</a></td>";
        }
 else {
      echo"<td width='10%'><a href=frmManageProperty.php?prpcod=".$arr[$i][8]."&mode=NA&typ=".$type." >Not Active</a></td>";
 }
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            if($arr[$i][11]==1)
            {
             echo"<td width='10%'><a href=frmManageProperty.php?prpcod=".$arr[$i][8]."&mode=S&typ=".$type." >Shown</a> </td></tr>";
            }
            else
            {
             echo"<td width='10%'><a href=frmManageProperty.php?prpcod=".$arr[$i][8]."&mode=NS&typ=".$type." > Not Shown</a> </td></tr>";   
            }
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
