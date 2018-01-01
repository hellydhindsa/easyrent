<?php
include_once '../buslogic.php';
//code check user is login or not
 if(!isset($_SESSION["lcod"])){   header("location:../login.php");}
include_once 'AdminHeader.php';
//code check user is login or not
 if(!isset($_SESSION["lcod"])){ header("location:../login.php");  }
if(isset($_SESSION["MoreDetailAgentno"]))
{
  $AgentCode=$_SESSION["MoreDetailAgentno"];
   unset($_SESSION["MoreDetailAgentno"]);
}
else if($_REQUEST["ano"]){
    $AgentCode=$_REQUEST["ano"];
}
if(isset($AgentCode)){
   
    $obj= new clsprf();
$AgentDetailArray = $obj->DisplayUserByUserId($AgentCode);
if(count($AgentDetailArray)>0)
{
      $pi=$AgentDetailArray[0][4];
             $extension=  substr($pi, strpos($pi, '.'));
              if($extension>3)
                {   $pic='agent5.jpg';   }
               else { $pic=$AgentDetailArray[0][4];  }
    $agentName=$AgentDetailArray[0][0];
  $agentEmail=$AgentDetailArray[0][6];
   $agentPhone=$AgentDetailArray[0][2];
    $agentAddress=$AgentDetailArray[0][3];
}
}

?>

 
 
<div class="noo-wrapper">
 
<div class="container noo-mainbody">
<div class="noo-mainbody-inner">
<div class="row clearfix">
 
<div class="noo-content col-xs-12 col-md-8">
<article class="noo-agent">
 
<h1 class="content-title"><?php if(isset($agentName)) echo $agentName; ?></h1>
 
 

 
<div class="agent-info clearfix">
<div class="content-featured">
<div class="content-thumb">
  <?php echo '<img src="../delpics/'.$pic.'" alt="">' ?>
</div>
</div>
<div class="agent-detail">
<h4 class="agent-detail-title">Contact Info</h4>
<div class="agent-detail-info">
<div class=""><i class="fa fa-phone"></i>&nbsp;
<span>Phone:</span><?php if(isset($agentPhone)) echo $agentPhone; ?></div>

<div class=""><i class="fa fa-envelope-square"></i>&nbsp;
<span>Email:</span><?php if(isset($agentEmail)) echo $agentEmail; ?></div>
<div class=""><i class="fa fa-address-book"></i>&nbsp;
<span>Address:</span><?php if(isset($agentAddress)) echo $agentAddress; ?></div>
</div>

</div>
</div>
 
 

</article>
</div>
 
 

</div>
</div>
</div>
 
</div>
 
 <?php
include_once 'Adminfooter.php';
?>