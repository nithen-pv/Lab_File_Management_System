<?php
include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
if (isset($_GET['delete'])) {
    // echo $_GET['delete'];
    $path = "uploads/" . $_GET['filename'];
    echo $path;
    if (!unlink($path)) {
        echo 'You have an error';
    } else {
        // echo "successfully deleted";
        $id = $_GET['delete'];
        $sql = "DELETE FROM files WHERE id= $id";

        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }

        $sqlcomm = "DELETE FROM Comment WHERE file_id= $id";
        if ($conn->query($sqlcomm) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
        header('Location: dashboard.php');
    }
}
