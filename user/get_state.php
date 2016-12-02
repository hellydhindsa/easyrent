<?php
include_once '../buslogic.php';

if(!empty($_POST["country_id"])) {
    $id=$_POST["country_id"];
	 $obj= new clssubcat();
            $arr = $obj->dsp_subcat($id);;
?>
	<option value="0">Select Location</option>
<?php
If (count($arr) > 0) 
            {
	 for($i=0; $i<count($arr); $i++)
            {
?>
	<option value="<?php echo $arr[$i][0]; ?>"><?php echo $arr[$i][1]; ?></option>
<?php
	}
            }
}
?>

        
        
        
        
        
        
         
          