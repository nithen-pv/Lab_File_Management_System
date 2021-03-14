<?php
include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
$stud_name = '';
if (isset($_POST['updated_name'])) {
  // echo $_POST['student_id'];
  $coord_id = $_POST['coordinator_id'];
  $coord_name = $_POST['updated_name'];
  $coord_batch = $_POST['updated_batch'];
  $coord_username = $_POST['updated_username'];
  $coord_password = $_POST['updated_password'];

  $sql = "UPDATE Coordinators SET Name='$coord_name' , batch= '$coord_batch' , 
username= '$coord_username' , password= '$coord_password' WHERE id='$coord_id' ";

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