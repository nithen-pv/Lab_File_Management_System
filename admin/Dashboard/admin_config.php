<?php
// Start the session
session_start();
?>

<?php
if (!$_SESSION["username"]) {
  header('Location: http://localhost/MES/admin/');
} ?>


<?php
include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
$isAuthSuccess = true;
$isConfigSuccess = false;
if (isset($_POST['new_username'])) {
  $username = $_POST['new_username'];
  $password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  //   include('./admin/auth.php');
  if ($password === $confirm_password) {

    $sql = "UPDATE admin SET username = '$username' , password = '$password' WHERE id=1";

    if ($conn->query($sql) === TRUE) {
      $isConfigSuccess = true;
    } else {
      echo "Error updating record: " . $conn->error;
    }

    // header('Location: http://localhost/admin/Dashboard/dashboard.php');
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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">




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
    <a href="reports.php" class="h5"><i class="fas fa-arrow-left"></i> Back</a>
    <div class="row">
      <div class="col-sm" style="margin-top: 80px;">
        <form class="form-signin" action="" method="POST">
          <div class="text-center mb-4">
            <!-- <img class="mb-4" src="/docs/4.5/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
            <h1 class="h3 mb-3 font-weight-normal"><i class="fas fa-users-cog"></i>Manage Your Account</h1>
          </div>

          <div class="form-label-group">
            <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="new_username" required autofocus>
            <label for="inputEmail">Username</label>
          </div>

          <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="new_password" required>
            <label for="inputPassword">Password</label>
          </div>

          <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
            <label for="inputPassword">Confirm Password</label>
          </div>
          <div class="d-grid gap-2">
            <button class="btn btn-primary btn-lg" type="submit">Apply Changes <i class="far fa-check-circle"></i></button>
          </div>

          <div class="mb-3" style="color:red;text-align:center">
            <label>
              <?php
              if (!$isAuthSuccess) {
                echo " Password does not match";
              }
              ?>
            </label>
          </div>

          <?php
          if ($isConfigSuccess) {
          ?>
            <div class="alert alert-success mt-1" style="text-align:center" role="alert">
              Account Credentilas Updated Successfully
            </div>
          <?php
          }
          ?>

          <!-- <p class="mt-5 mb-3 text-muted text-center" >&copy; 2019-2021</p> -->
        </form>
      </div>

      <div class="col-sm">
        <img src="/MES/images/Security.gif" alt="">
      </div>

    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  <script src="/MES/Bootstrap/js/bootstrap.min.js"></script>

</body>

</html>