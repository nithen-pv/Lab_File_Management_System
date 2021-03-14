<?php
// Start the session
session_start();
?>
<?php
if (!$_SESSION["username"]) {
  header('Location: http://localhost/MES/coordinator/');
}
?>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
if (isset($_POST['search_val'])) {
  $search = $_POST['search_val'];
} else {
  $search = '';
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <title>Dashboard</title>

  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <link rel="stylesheet" href="/MES/Bootstrap/css/bootstrap.min.css"> 

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/MES/css/all.css">
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
  <link href="/MES/css/dashboard.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"><i class="fas fa-university fa-2x"></i> MES Marampally</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <form class="input-group" action="dashboard.php" method="post">
      <input class="form-control form-control-dark w-80" name="search_val" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-secondary" type="submit" name="search" id=""><i class="fas fa-search"></i></button>
    </form>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log out </a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse mt-4">
        <div class="sidebar-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link " href="reports.php" id="report">
                <i class="fas fa-home"></i>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link navElement" href="dashboard.php" id="dashboard">
                <i class="fas fa-user-graduate"></i>
                Students
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link " href="teachers.php" id="teacher">
                <i class="fas fa-users"></i>
                Teachers
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link " href="files.php" id="file">
                <i class="fas fa-file-code"></i>
                Files
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="manage_account.php" id="account">
                <i class="fas fa-user-cog"></i>
                Manage Account
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 main-box-size">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <?php if ($search) {
          ?>
            <a href="dashboard.php" class="h5"><i class="fas fa-arrow-left"></i> Back</a>
          <?php
          } else {
          ?>
            <h1 class="h2"><i class="fas fa-user-graduate"></i> Students</h1>
          <?php
          } ?>
          <div class="btn-toolbar mb-2 mb-md-0">
            <i class="fas fa-user-circle fa-2x"></i>
            <span class="fw-normal ml-1 mt-1"> <?php echo $_SESSION["cordinator_name"]; ?> </span>
          </div>

        </div>

        <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

        <!-- <h2>Section title</h2> -->

        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
        $batch = $_SESSION["batch"];
        $sql = "SELECT * FROM Student WHERE Batch='$batch' AND Student_Name LIKE '%$search%'";
        $result = $conn->query($sql);

        ?>

        <?php
        if ($result->num_rows > 0) {
        ?>
          <div class="table-responsive" style="border-radius: 7px; box-shadow: 0 1px 10px #ccc;">
            <table class="table table-light table-sm table-hover" style="text-align: center;margin-bottom: 0;">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Student_Name</th>
                  <th>Roll_No</th>
                  <th>Batch</th>
                  <th>Username</th>
                  <th>Password</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>


                  <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><a href="view.php?id=<?php echo $row["id"]; ?>"> <?php echo $row["Student_Name"]; ?> </a> </td>
                    <td><?php echo $row["RollNo"]; ?></td>
                    <td>
                      <?php
                      $batch_id = $row["Batch"];;
                      $sqlComm = "SELECT * FROM Batch WHERE id='$batch_id'";
                      $output = $conn->query($sqlComm);

                      if ($output->num_rows > 0) {
                        // output data of each row
                        while ($element = $output->fetch_assoc()) {
                          echo $element['batch_name'] . " ", $element['course'] . " ", $element['year'];
                        }
                      } else {
                        echo "0 results";
                      }
                      ?>
                    </td>
                    <td><?php echo $row["Username"]; ?></td>
                    <td><?php echo $row["Password"]; ?></td>
                  </tr>

                <?php
                }
              } else {
                ?>
                <div class="col-md-6 mx-auto">
                  <h2 style="margin-left: 100px;"> Oops!... no results found </h2>
                  <img src="/MES/images/Search.gif" alt="IMAGE" style="text-align: center;">
                </div>
              <?php
              }

              ?>

              </tbody>
            </table>
          </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  <script src="/MES/Bootstrap/js/bootstrap.min.js"></script>

  <script>
    function edit(id, name, rollno, batch, username, password) {

      document.getElementById('student_id').value = id;
      document.getElementById('student_name').value = name;
      document.getElementById('rollno').value = rollno;
      document.getElementById('batch').value = batch;
      document.getElementById('username').value = username;
      document.getElementById('password').value = password;

    }
  </script>
</body>

</html>