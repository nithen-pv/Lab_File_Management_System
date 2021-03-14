<?php
include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
$isAuthSuccess = true;
if (isset($_POST['username'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  include('./Auth/auth.php');
  if (authUser($username, $password)) {
    header('Location: http://localhost/MES/coordinator/Dashboard/reports.php');
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

  <link rel="stylesheet" href="/MES/Bootstrap/css/bootstrap.min.css">


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
  <link rel="stylesheet" href="/MES/css/all.css">

</head>

<body style="background: white;">

  <div class="container">
    <a href="http://localhost/MES/" class="h5"><i class="fas fa-arrow-left"></i> Home</a>
    <div class="row">
      <div class="col-sm">
        <img src="/MES/images/Login.gif" alt="">
      </div>


      <div class="col-sm" style="margin-top: 100px;">
        <form class="form-signin" action="" method="POST">
          <div class="text-center mb-4">
            <!-- <img class="mb-4" src="/docs/4.5/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
            <h1 class="h3 mb-3 font-weight-normal">Welcome Back</h1>
          </div>

          <div class="form-label-group">
            <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" required autofocus>
            <label for="inputEmail">Username</label>
          </div>

          <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
            <label for="inputPassword">Password</label>
          </div>

          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <div class="d-grid gap-2">
            <button class="btn btn-primary btn-lg" type="submit">Log in <i class="fas fa-sign-in-alt"></i></button>
          </div>
          <div class="mb-3" style="color:red;text-align:center">
            <label>
              <?php
              if (!$isAuthSuccess) {
                echo " Invalid Username or Password";
              }
              ?>
            </label>
          </div>

          <p class="mt-5 mb-3 text-muted text-center">&copy; 2019-2021</p>
        </form>
      </div>

    </div>
  </div>
</body>

</html>