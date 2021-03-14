<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
$check_current_password = true;
$isAuthSuccess = true;
$isConfigSuccess = false;
if (isset($_POST['current_password'])) {
  $current_password = $_POST['current_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];
  $user = $_SESSION["username"];

  if ($new_password === $confirm_password) {
    $select_id = "SELECT id FROM Student WHERE Username='$user' AND Password='$current_password' ";
    $result = $conn->query($select_id);
    // $row = $result->fetch_assoc();


    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $sql = "UPDATE Student SET Password = '$new_password' WHERE id='$id' ";

        if ($conn->query($sql) === TRUE) {
          //  echo "Record updated successfully";
          $isConfigSuccess = true;
        } else {
          echo "Error updating record: " . $conn->error;
        }
      }
    } else {
      $check_current_password = false;
    }
  } else {
    $isAuthSuccess = false;
  }

  $conn->close();
}

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <title>Log In</title>
  <link rel="stylesheet" href="/MES/css/all.css">

  <link rel="stylesheet" type="text/css" href="/MES/Bootstrap/css/bootstrap.min.css">

  <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#563d7c">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="/MES/css/styles.css" rel="stylesheet">
</head>

<body style="background: white;">

  <div class="container">
    <a href="dashboard.php" class="h5"><i class="fas fa-arrow-left"></i> Back</a>
    <div class="row">
      <div class="col-sm" style="margin-top: 80px;">
        <form class="form-signin" action="" method="POST">
          <div class="text-center mb-4">
            <!-- <img class="mb-4" src="/docs/4.5/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
            <h1 class="h3 mb-3 font-weight-normal"><i class="fas fa-user-cog"></i>Change Account Password </h1>
          </div>

          <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="Current Password" name="current_password">
            <label for="inputPassword">Current Password</label>
          </div>

          <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="New Password" name="new_password" required>
            <label for="inputPassword">New Password</label>
          </div>

          <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="Confirm New Password" name="confirm_password" required>
            <label for="inputPassword">Confirm New Password</label>
          </div>

          <div class="d-grid gap-2">
            <button class="btn btn-primary btn-lg" type="submit">Apply Changes <i class="far fa-check-circle"></i></button>
          </div>
          <div class="mb-3" style="color:red;text-align:center">
            <label class="mt-2">
              <?php
              if (!$isAuthSuccess) {
                echo " New and Confirmation Password does not match";
              }
              if (!$check_current_password) {
                echo "Current Password is Invalid ";
              }
              ?>
            </label>
          </div>

          <?php
          if ($isConfigSuccess) {
          ?>
            <div class="alert alert-success mt-1" style="text-align:center" role="alert">
              Password Reset Successfully
            </div>
          <?php
          }
          ?>

          <!-- <p class="mt-5 mb-3 text-muted text-center">&copy; 2019-2021</p> -->
        </form>
      </div>

      <div class="col-sm">
        <img src="/MES/images/Security.gif" alt="">
      </div>

    </div>
  </div>
  <script src="/MES/Bootstrap/js/bootstrap.min.js"></script>

</body>

</html>