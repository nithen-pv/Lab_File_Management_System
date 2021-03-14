<?php
// Start the session
session_start();
?>

<?php
if ( !$_SESSION["username"]) {
  header('Location: http://localhost/MES/admin/');
}?>

<?php

include $_SERVER['DOCUMENT_ROOT'].'/MES/mysql_conn/mysql_conn.php';
if (isset($_GET['batch_id'])) {
    echo $_GET['batch_id'];
    $id = $_GET['batch_id'];
    $sql = "DELETE FROM Batch WHERE id= $id";

    if ($conn->query($sql) === TRUE) {
          echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    header('Location: batch.php');
// $conn->close();
}

?>