
<?php
//session_start();
include_once '../buslogic.php';
//code check user is login or not and IS It Admin
 if(!isset($_SESSION["lcod"]) || $_SESSION["lcod"]!=11){header("location:../login.php");}
 
if (isset($_REQUEST["Agentcod"]))
{
    if(isset($_REQUEST["mode"])&& $_REQUEST["mode"]=='A')
    {
        $obj=new clsprf();
        $obj->UpdateUserStatus($_REQUEST["Agentcod"], 0);
       
    }
    else if(isset($_REQUEST["mode"])&& $_REQUEST["mode"]=='NA')
    {
       $obj=new clsprf();
        $obj->UpdateUserStatus($_REQUEST["Agentcod"], 1);
       
    }
else if(isset($_REQUEST["mode"])&& $_REQUEST["mode"]=='MD')
    {
     $Agentno=$_REQUEST["Agentcod"];
         header("location:agentsdetail.php?ano=$Agentno");
    }

}
//if(!isset($_SESSION["lcod"]))
//{
//    header("location:../frmlogin.php?sts=S");
//}
function GetAgentType($agentTyp) {
        $FinalAgent="PG";
        if($agentTyp =='O')
        {
          $FinalAgent="Owner";
        }
        else if ($agentTyp =='B')
        {
             $FinalAgent="Agent";
        }
        
           
            return $FinalAgent;
         }
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
        $obj= new clsprf();
        $arr = $obj->DisplayUsersAdmin();
        If(count($arr)>0)
            echo "<table width='90%'><tr><th>City</th><th>Location</th><th>Name</th><th>Company</th><th>Type</th><th>Activate</th><th>More Detail</th></tr>";
        for($i=0; $i<count($arr); $i++)
        {
           // $type=  substr($arr[$i][2], 0, 1);
            echo"<tr width='10%'><td>".$arr[$i][0]."</td>";
            echo"<td width='10%'>".$arr[$i][1]."</td>";
            echo"<td width='20%'>".$arr[$i][2]."</td>";
            echo"<td width='10%'>".$arr[$i][3]."</td>";
             echo"<td width='10%'>".GetAgentType($arr[$i][7])."</td>";
            if($arr[$i][6]==1)
            {
            echo"<td width='10%'><a href=frmManageAgent.php?Agentcod=".$arr[$i][5]."&mode=A>Active</a></td>";
        }
 else {
      echo"<td width='10%'><a href=frmManageAgent.php?Agentcod=".$arr[$i][5]."&mode=NA>Not Active</a></td>";
 }
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
           echo"<td width='10%'><a href=frmManageAgent.php?Agentcod=".$arr[$i][5]."&mode=MD>Click Here</a></td></tr>";
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
   <?php
include_once 'Adminfooter.php';
?>