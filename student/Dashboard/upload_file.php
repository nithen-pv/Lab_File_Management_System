<!-- <?php
      // Start the session
      session_start();
      ?> -->

    <?php
    if (isset($_FILES["fileToUpload"]["name"])) {
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      $checkFileUploaded = false;
      $error_Msg = "";


      // Check if file already exists
      if (file_exists($target_file)) {
        $error_Msg = "Sorry, file already exists.";
        $uploadOk = 0;
      }

      // Check file size

      // if ($_FILES["fileToUpload"]["size"] > 500000) {
      //   $error_Msg = "Sorry, your file is too large.";
      //   $uploadOk = 0;
      // }

      // Allow certain file formats


      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        header('Location: error.php');
        // if everything is ok, try to upload file
      } else {
        define('SITE_ROOT', realpath(dirname(__FILE__)));
        // echo SITE_ROOT . '/' . $target_file;
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], SITE_ROOT . '/' . $target_file)) {
          // echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
          $checkFileUploaded = true;
        } else {
        ?>
          <div class="col-md-6 mx-auto">
            <h2 style="margin-left: 50px;">Sorry, there was an error uploading your file.</h2>
            <img src="/MES/images/No data.gif" alt="IMAGE" style="text-align: center;">
          </div>
        <?php
        }
      }


      include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';

      if ($checkFileUploaded) {
        $name = $_FILES["fileToUpload"]["name"];
        $size = $_FILES["fileToUpload"]["size"];
        $stud_id = $_SESSION['student_id'];
        $batch = $_SESSION['Batch'];
        $sql = "INSERT INTO files (student_id, filename,file_size, batch)
      VALUES ('$stud_id','$name','$size','$batch')";
        if ($conn->query($sql) === TRUE) {
        ?>
          <script type="text/javascript">
            upload_file();
          </script>
    <?php
          // header('Location: dashboard.php');
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
    }

    ?>
  <!-- </div> -->
