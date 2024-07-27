<?php
session_start();
include('include/config.php');
$_SESSION['teclogin']=="";
date_default_timezone_set('America/Guatemala');
$ldate=date( 'd-m-Y h:i:s A', time () );
mysqli_query($con,"UPDATE tcrxlog  SET logout = '$ldate' WHERE uid = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1");
session_unset();
//session_destroy();
$_SESSION['errmsg']="Sesión finalizada con éxito";
?>
<script language="javascript">
document.location="index.php";
</script>
