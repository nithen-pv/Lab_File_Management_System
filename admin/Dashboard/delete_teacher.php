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
if (isset($_GET['delete'])) {
    echo $_GET['delete'];
    $id = $_GET['delete'];
    $sql = "DELETE FROM Teachers WHERE id= $id";

    if ($conn->query($sql) === TRUE) {
          echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    header('Location: teachers.php');
// $conn->close();
}

?>