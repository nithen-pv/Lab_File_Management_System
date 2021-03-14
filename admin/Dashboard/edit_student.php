<?php
if (!$_SESSION["username"]) {
  header('Location: http://localhost/MES/admin/');
} ?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
$stud_name = '';
if (isset($_POST['updated_student_name'])) {
  // echo $_POST['student_id'];
  $stud_id = $_POST['student_id'];
  $stud_name = $_POST['updated_student_name'];
  $stud_rollno = $_POST['updated_rollno'];
  $stud_batch = $_POST['updated_batch'];
  $stud_username = $_POST['updated_username'];
  $stud_password = $_POST['updated_password'];

  $sql = "UPDATE Student SET Student_Name='$stud_name' , RollNo='$stud_rollno' , Batch= '$stud_batch' , 
Username= '$stud_username' , Password= '$stud_password' WHERE id='$stud_id' ";

  if ($conn->query($sql) === TRUE) {
?>
    <script type="text/javascript">
      student_update();
    </script>
<?php
  } else {
    echo "Error updating record: " . $conn->error;
  }
}

?>