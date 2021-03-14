<?php
// Start the session
session_start();
?>
<?php
if (!$_SESSION["username"]) {
  header('Location: http://localhost/MES/coordinator/');
}
?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
$user = $_GET['user'];
if (isset($_GET['delete'])) {
  echo $_GET['delete'];
  $path = "/opt/lampp/htdocs/MES/student/Dashboard/uploads/" . $_GET['filename'];
  echo $path;
  if (!unlink($path)) {
    echo 'You have an error';
  } else {
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
    header('Location: files.php' . '?user=' . $user);
  }
}

?>