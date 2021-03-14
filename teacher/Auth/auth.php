<?php
function authUser($username, $password)
{
  include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
  $sql = "SELECT * FROM Teachers WHERE  username = '$username' AND password = '$password' ";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
      $id = $row['id'];
      $batch = $row['batch'];
      $teacher_name = $row['name'];
      $start =  $row['start'];
      $stop =  $row['stop'];
    }

    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
    $_SESSION["id"] = $id;
    $_SESSION["batch"] = $batch;
    $_SESSION["teacher_name"] = $teacher_name;
    $_SESSION["start"] = $start;
    $_SESSION["stop"] = $stop;

    return true;
  } else {

    return false;
  }
}
