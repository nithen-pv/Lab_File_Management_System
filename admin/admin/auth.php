<?php
function authUser($username, $password)
{
  include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
  $sql = "SELECT * FROM admin WHERE  username = '$username' AND password = '$password' ";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {

    $_SESSION["username"] = '$username';
    $_SESSION["password"] = '$password';
    return true;
  } else {

    return false;
  }
}
