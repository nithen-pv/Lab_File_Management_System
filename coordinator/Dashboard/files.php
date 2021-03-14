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
}
if (!isset($_POST['search_val'])) {
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
  <!-- JAVASCRIPT -->
  <script src="/MES/sweetAlert/jquery-3.5.1.min.js"></script>
  <script src="/MES/sweetAlert/sweetalert2.all.min.js"></script>
  <script>
    function post_comment() {
      Swal.fire(
        'Comment Posted!',
        'Message has been send!.',
        'success'
      )
    }
  </script>
</head>

<body>
  <?php
  include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
  if (isset($_POST['comment'])) {
    $file_id = $_POST['file_id'];
    $student_id = $_POST['student_id'];
    $message = $_POST['comment'];
    $commenter_name = $_SESSION["cordinator_name"];
    $sql = "INSERT INTO Comment (file_id,student_id, commentor_name, message)
  VALUES ('$file_id','$student_id', '$commenter_name', '$message')";

    if ($conn->query($sql) === TRUE) {
  ?>
      <script type="text/javascript">
        post_comment();
      </script>
  <?php
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  ?>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"><i class="fas fa-university fa-2x"></i> MES Marampally</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <form class="input-group" action="files.php" method="post">
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
            <li class="nav-item">
              <a class="nav-link " href="reports.php" id="report">
                <i class="fas fa-home"></i>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="dashboard.php" id="dashboard">
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
              <a class="nav-link navElement" href="files.php" id="file">
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
            <a href="files.php" class="h5"><i class="fas fa-arrow-left"></i> Back</a>
          <?php
          } else {
          ?>
            <h1 class="h2"> <i class="fas fa-file-code"></i> Files</h1>
          <?php
          } ?>
          <div class="btn-toolbar mb-2 mb-md-0">
            <i class="fas fa-user-circle fa-2x"></i>
            <span class="fw-normal ml-1 mt-1"> <?php echo $_SESSION["cordinator_name"]; ?> </span>
          </div>
        </div>

        <!-- COMMENT MODAL -->
        <div class="modal fade " id="commentModal" tabindex="1" aria-labelledby="CoordinatorModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-comment-dots"></i> Add Comments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="POST">
                <div class="modal-body">

                  <input type="hidden" class="form-control" name="file_id" id="file_id" aria-describedby="helpId" placeholder="" value=''>
                  <input type="hidden" class="form-control" name="student_id" id="student_id" aria-describedby="helpId" placeholder="" value=''>
                  <script>
                    function getFileID() {
                      var elem = document.getElementById('file_id').value;
                      // alert(elem);
                      console.log(elem);
                      return elem;
                    }
                    getFileID();
                  </script>
                  <div class="form-group">
                    <label for=""></label>
                    <small id="helpId" class="form-text text-muted">Message</small>
                    <textarea class="form-control" aria-label="With textarea" name="comment"></textarea>
                  </div>


                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                  </div>

                  <!---qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq-->


                  <div class="table-responsive">
                    <?php
                    include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
                    if (isset($_POST['transfer_id'])) {
                      echo $_POST['transfer_id'];
                    }

                    $id = '<script>var ab=getFileID(); document.write(ab);</script>';
                    echo $id;
                    ?>

                    <!-- <?php
                    $sql = "SELECT * FROM Comment WHERE file_id = $id ORDER BY `Comment`.`id` DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                      while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="card text-dark border-primary mb-3">
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
                          <div class="card-body">
                            <h5 class="card-title"><i class="far fa-user-circle"></i> <?php echo $row['commentor_name']; ?></h5>
                            <p class="card-text"><?php echo $row['date']; ?></p>
                            <p class="card-text"><?php echo $row['message']; ?></p>
                          </div>
                        </div>

                      <?php
                      }
                    } else {
                      ?>
                      <div class="col-md-6 mx-auto">
                        No comments
                      </div>
                    <?php
                    }

                    ?> -->

                  </div>


                  <!-- qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq -->
              </form>
            </div>
          </div>
        </div>
    </div>

    <!-- <h2>Section title</h2> -->


    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
    $batch_id = $_SESSION["batch"];
    $sql = "SELECT * FROM files wHERE batch='$batch_id' AND filename LIKE '%$search%' ";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
    ?>
      <div class="table-responsive" style="border-radius: 7px; box-shadow: 0 1px 10px #ccc;">
        <table class="table table-light table-sm table-hover" style="margin-bottom: 0;">
          <thead>
            <tr>
              <th>File_Id</th>
              <th>File_Name</th>
              <th>File_Size</th>
              <th>Uploaded Date</th>
              <th>Actions</th>
              <!-- <th></th> -->
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>

              <tr>
                <td><?php echo $row["id"]; ?></td>
                <td style="color:dodgerblue"> <?php echo $row["filename"]; ?></td>
                <td><?php echo $row["file_size"] * 0.000977; ?> KiB</td>
                <td><?php echo $row["date"]; ?></td>
                <td>

                  <!-- <form action="" method="POST" class="getFileID">
                    <input type="hidden" name="transfer_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-sm btn-warning" onclick="message(<?php echo $row['id']; ?>,<?php echo $row['student_id']; ?>)" data-bs-toggle="modal" data-bs-target="#commentModal">
                      <i class="fas fa-bell"></i>
                    </button>
                  </form> -->

                  <button type="submit" class="btn btn-sm " onclick="message(<?php echo $row['id']; ?>,<?php echo $row['student_id']; ?>)" data-bs-toggle="modal" data-bs-target="#commentModal">
                    <i class="fas fa-bell" style="color:midnightblue;"></i>
                  </button>

                  <a href="http://localhost/MES/student/Dashboard/uploads/<?php echo $row['filename'] ?>">
                    <button type="button" class="btn btn-sm">
                      <i class="fas fa-download" style="color:dodgerblue"></i>
                    </button>
                  </a>

                  <a href="delete_file.php?delete=<?php echo $row['id']; ?>&&filename=<?php echo $row['filename']; ?>" class="del_file">
                    <button type="submit" class="btn btn-sm " name="delete">
                      <i class="far fa-trash-alt" style="color:red"></i>
                    </button>
                  </a>

                </td>
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
  <script src="/MES/sweetAlert/jquery-3.5.1.min.js"></script>
  <script src="/MES/sweetAlert/sweetalert2.all.min.js"></script>
  <script>
    function message(file_id, student_id) {
      document.getElementById("file_id").value = file_id;
      document.getElementById("student_id").value = student_id;
      getFileID();
    }
    $('.del_file').on('click', function(e) {
      e.preventDefault();
      const href = $(this).attr('href')
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          document.location.href = href;
          e.preventDefault();
          Swal.fire(
            'Deleted!',
            'File has been deleted.',
            'success'
          )
        }
      })
    })

    $('.getFileID').on('click', function(e) {
      e.preventDefault();
    })
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  <script src="/MES/Bootstrap/js/bootstrap.min.js"></script>

</body>

</html>