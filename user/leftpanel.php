     <?php 
 
                                         $obj= new clsprf();  
                                       
                                                  $picarr = $obj->dsp_prfbyusercod($_SESSION["lcod"]);
                                                  if(isset($picarr) && count($picarr)>0 ){
                                                  $pi=$picarr[0][7];
                                                  $extension=  substr($pi, strpos($pi, '.'));
                                                  if($extension>3)
                                                  {
                                                     $pic='agent5.jpg'; 
                                                  }
 else {
      $pic=$picarr[0][7];
 }
                                                  }
 else {
      $pic='agent5.jpg'; 
 }
                                                  
 ?>
<div class="user-avatar content-thumb">
<img src="../delpics/<?php echo $pic; ?>" alt="">
</div>
<div class="user-menu-links">
<a href="frmprf.php" class="user-link active"><i class="fa fa-user"></i>My Profile</a>
<a href="frmmyprp.php" class="user-link "><i class="fa fa-home"></i>My Properties</a>
</div>
<div class="user-menu-links user-menu-logout">
    <a href="../login.php?sts=S" class="user-link" title="Logout"><i class="fa fa-sign-out"></i>Log Out</a>
</div>