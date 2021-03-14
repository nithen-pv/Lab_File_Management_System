<?php
if (!$_SESSION["username"]) {
  header('Location: http://localhost/MES/admin/');
} ?>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
$stud_name = '';
if (isset($_POST['updated_name'])) {
  $id = $_POST["teacher_id"];
  $name = $_POST['updated_name'];
  $batch = $_POST['updated_batch'];
  $username = $_POST['updated_username'];
  $password = $_POST['updated_password'];
  $start = $_POST["From"];
  $stop = $_POST["To"];

  $sql = "UPDATE Teachers SET name='$name', batch= '$batch' , 
username= '$username' , password= '$password', start='$start', stop='$stop' WHERE id='$id' ";

  if ($conn->query($sql) === TRUE) {
?>
    <script type="text/javascript">
      update_user();
    </script>
<?php
  } else {
    echo "Error updating record: " . $conn->error;
  }
}

?>