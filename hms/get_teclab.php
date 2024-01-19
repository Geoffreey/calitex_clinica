<?php
include('include/config.php');
if(!empty($_POST["laboratorioid"])) 
{

 $sql=mysqli_query($con,"select tecnicoName,id from tecnico_lab where laboratorio='".$_POST['laboratorioid']."'");?>
 <option selected="selected">seleccionar tecnico </option>
 <?php
 while($row=mysqli_fetch_array($sql))
 	{?>
  <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['tecnicoName']); ?></option>
  <?php
}
}


if(!empty($_POST["tecnicolab"])) 
{

 $sql=mysqli_query($con,"select tecfees from tecnico_lab where id='".$_POST['tecnicolab']."'");
 while($row=mysqli_fetch_array($sql))
 	{?>
 <option value="<?php echo htmlentities($row['tecfees']); ?>"><?php echo htmlentities($row['tecfees']); ?></option>
  <?php
}
}

?>

