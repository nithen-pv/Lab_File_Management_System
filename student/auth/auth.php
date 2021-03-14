<?php
function authUser($username, $password)
{
  include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
  $sql = "SELECT * FROM Student WHERE  Username = '$username' AND Password = '$password' ";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $id = $row['id'];
      $batch = $row['Batch'];
      $stud_name = $row['Student_Name'];
    }

    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
    $_SESSION["student_id"] = $id;
    $_SESSION["Batch"] = $batch;
    $_SESSION["stud_name"] = $stud_name;
    return true;
  } else {

    return false;
  }
}
