<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
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
  <link href="/MES/css/all.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"><i class="fas fa-university fa-2x"></i> MES Marampally</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <form class="input-group" method="post">
      <input class="form-control form-control-dark w-80" name="search_val" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-secondary" type="submit" name="search" id=""><i class="fas fa-search"></i></button>
    </form>

    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Log out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse mt-4">
        <div class="sidebar-sticky pt-3">
          <ul class="nav flex-column">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span> Dashboard</span>
            </h6>

            <li class="nav-item">
              <a class="nav-link " href="dashboard.php" id="dashboard">
                <i class="fas fa-file"></i>
                Files
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link navElement" href="comments.php" id="file">
                <i class="fas fa-bell"></i>
                Notifications
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
                $student_id = $_SESSION["student_id"];
                $sql = "SELECT * FROM Comment WHERE student_id='$student_id'";
                $mysqliStatus = $conn->query($sql);
                $rows_count_value = mysqli_num_rows($mysqliStatus);
                if ($rows_count_value > 0) {
                ?>
                  <span class="numberCircle"><?php echo $rows_count_value;
                                            } ?></span>
              </a>
            </li>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span> Manage Account</span>
            </h6>
            <li class="nav-item">
              <a class="nav-link" href="manage_account.php" id="account">
                <i class="fas fa-user-cog"></i>
                Change Password
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 main-box-size">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Notifications</h1>
          <div class="btn-toolbar mb-2 mb-md-0">

            <i class="fas fa-user-circle fa-2x"></i>
            <span class="fw-normal ms-1 mt-1"> <?php echo $_SESSION["stud_name"]; ?> </span>
          </div>


        </div>

        <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->


        <!-- UPLOAD FILE Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="upload_file.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                    <div class="mb-3">
                      <label for="formFileMultiple" class="form-label"></label>
                      <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" multiple>
                    </div>

                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" value="Upload Image" name="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i>Upload</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- <h2>Section title</h2> -->
        <div>

          <?php
          include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
          $id = $_SESSION["student_id"];
          $sql = "SELECT * FROM Comment WHERE student_id= $id ORDER BY `Comment`.`id` DESC";
          $result = $conn->query($sql);
          $check_file = true;
          ?>


          <?php
          if ($result->num_rows > 0) {
          ?>

            <?php
            while ($row = $result->fetch_assoc()) {
              $file_id = $row['file_id'];
              $sqlComm = "SELECT filename FROM files WHERE student_id= $id AND id='$file_id'";
              $output = $conn->query($sqlComm);

              if ($output->num_rows > 0) {
                // output data of each row
                while ($element = $output->fetch_assoc()) {
                  $check_file = true;
                }
              } else {
                $check_file = false;
              }
              if ($check_file) {

            ?>
                <div class="card  mb-3 table-responsive" style="max-width:100%;border-radius: 7px; box-shadow: 0 1px 30px #ccc;">
                  <div class="card-header bg-primary text-light">
                    <?php
                    $file_id = $row['file_id'];
                    $sqlComm = "SELECT filename FROM files WHERE student_id= $id AND id='$file_id'";
                    $output = $conn->query($sqlComm);

                    if ($output->num_rows > 0) {
                      // output data of each row
                      while ($element = $output->fetch_assoc()) {
                        echo $element['filename'];
                      }
                    } else {
                      echo "0 results";
                    }
                    ?></div>
                  <div class="card-body bg-light">
                    <h5 class="card-title"><i class="far fa-user-circle"></i> <?php echo $row['commentor_name']; ?></h5>
                    <p class="card-text"><?php echo $row['date']; ?></p>
                    <p class="card-text"><?php echo $row['message']; ?></p>
                  </div>
                </div>

            <?php
              }
            }
          } else {
            ?>
            <div class="col-md-6 mx-auto">
              <h2 style="margin-left: 150px;">No Messages </h2>
              <img src="/MES/images/New message.gif" alt="IMAGE" style="text-align: center;">
            </div>
          <?php
          }

          ?>

        </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  <script src="/MES/Bootstrap/js/bootstrap.min.js"></script>

  </script>
</body>

</html>