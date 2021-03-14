<?php
// Start the session
session_start();
?>
<?php 
function authUser($username,$password){
include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
$sql = "SELECT * FROM Coordinators WHERE  username = '$username' AND password = '$password' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $batch = $row['batch'];
    $cordinator_name = $row['Name'];
  }

    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
    $_SESSION["id"] = $id;
    $_SESSION["batch"] = $batch;
    $_SESSION["cordinator_name"] = $cordinator_name;
  return true;
} else {

  return false;
}
}
?>