<?php 
session_start();
?>

<?php 
session_unset();
session_destroy();
header("Location: http://localhost/MES/coordinator/index.php");
?>
