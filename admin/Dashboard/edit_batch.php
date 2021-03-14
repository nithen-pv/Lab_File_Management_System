<?php
if (!$_SESSION["username"]) {
  header('Location: http://localhost/MES/admin/');
} ?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
$stud_name = '';
if (isset($_POST['updated_batch'])) {
  $batch_id = $_POST['batch_id'];
  $updated_batch = $_POST['updated_batch'];
  $updated_course = $_POST['updated_course'];
  $updated_year = $_POST['updated_year'];

  $sql = "UPDATE Batch SET batch_name='$updated_batch' , course='$updated_course' , year= '$updated_year' WHERE id='$batch_id' ";

  if ($conn->query($sql) === TRUE) {
?>
    <script type="text/javascript">
      update_batch();
    </script>
<?php
  } else {
    echo "Error updating record: " . $conn->error;
  }
}

?>