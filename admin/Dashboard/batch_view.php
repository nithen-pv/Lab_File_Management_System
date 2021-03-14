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
  <!-- JAVASCRIPT -->
  <script src="/MES/sweetAlert/jquery-3.5.1.min.js"></script>
  <script src="/MES/sweetAlert/sweetalert2.all.min.js"></script>
  <script>
    function student_add() {
      Swal.fire(
        'Student Added!',
        'Student Successfully Created!.',
        'success'
      )
    }

    function student_update() {
      Swal.fire(
        'Updated!',
        'Student Details Successfully Updated!.',
        'success'
      )
    }
  </script>
</head>

<body>
  <?php
  include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
  if (isset($_POST['student_name'])) {
    $stud_name = $_POST['student_name'];
    $stud_rollno = $_POST['roll_no'];
    $stud_batch = $_POST['batch'];
    $stud_username = $_POST['stud_username'];
    $stud_password = $_POST['stud_password'];
    $sql = "INSERT INTO Student (Student_Name, RollNo, Batch, Username, Password)
    VALUES ('$stud_name','$stud_rollno','$stud_batch','$stud_username','$stud_password')";

    if ($conn->query($sql) === TRUE) {
  ?>
      <script type="text/javascript">
        student_add();
      </script>
  <?php
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  include $_SERVER['DOCUMENT_ROOT'] . '/MES/admin/Dashboard/edit_student.php';
  ?>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"><i class="fas fa-university fa-2x"></i> MES Marampally</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <form class="input-group" action="batch_view.php?id=<?php echo $_GET['id'];

                                                        if (isset($_GET['batch'])) {
                                                        ?>&&batch=<?php echo $_GET['batch'];
                                                                }
                                                                  ?>" method="post">
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
              <a class="nav-link" href="reports.php" id="dashboard">
                <i class="fas fa-home"></i>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <i class="fas fa-user-graduate"></i>
                Students
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link navElement" href="batch.php" id="batch">
                <i class="fas fa-project-diagram"></i>
                Batch
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="coordinators.php" id="coordinator">
                <i class="fas fa-chalkboard-teacher"></i>
                Coordinators
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="teachers.php" id="teacher">

                <i class="fas fa-users"></i>
                Teachers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="files.php" id="file">

                <i class="fas fa-file-code"></i>
                Files
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin_config.php" id="account">
                <i class="fas fa-user-cog"></i>
                Manage Account
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 main-box-size">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <!-- <a href="batch.php" class="h5"><i class="fas fa-arrow-left"></i> Back</a> -->
          <?php if ($search) {
          ?>
            <a href="batch_view.php?id=<?php echo $_GET['id'];
                                        if (isset($_GET['batch'])) {
                                        ?>&&batch=<?php echo $_GET['batch'];
                                                } ?>" class="h5"><i class="fas fa-arrow-left"></i> Back</a>
            <h1 class="h2"><?php if (isset($_GET['batch'])) {
                              echo $_GET['batch'];
                            } ?></h1>
          <?php
          } else {
          ?>
            <a href="batch.php" class="h5"><i class="fas fa-arrow-left"></i> Back</a>
            <h1 class="h2"><?php if (isset($_GET['batch'])) {
                              echo $_GET['batch'];
                            } ?></h1>
          <?php
          } ?>
          <div class="btn-toolbar mb-2 mb-md-0">

            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-user-plus"></i> Add Student</button>

            <div class="dropdown">
              <button class="btn ms-2 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-info-circle"></i>              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item del_student"  href="del_all_stud.php?delete=<?php echo $_GET['id']; ?>"><i class="far fa-trash-alt" style="color: red;"></i> Students</a></li>
                <li><a class="dropdown-item del_student" href="del_all_file.php?delete=<?php echo $_GET['id']; ?>"><i class="far fa-trash-alt" style="color: red;"></i> Files</a></li>
                <li><a class="dropdown-item " href="batch_info.php?id=<?php echo $_GET['id']; ?>&batch=<?php echo $_GET['batch']; ?>"><i class="fas fa-info-circle" style="color: green;"></i> Batch info</a></li>
              </ul>
            </div>

          </div>
        </div>

        <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->


        <!-- ADD STUDENT Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="POST">
                <div class="modal-body">
                  <div class="form-group">
                    <label for=""></label>
                    <small id="helpId" class="form-text text-muted">Student Name</small>
                    <input type="text" class="form-control" name="student_name" id="" aria-describedby="helpId" placeholder="" required>

                    <label for=""></label>
                    <small id="helpId" class="form-text text-muted">Roll No</small>
                    <input type="text" class="form-control" name="roll_no" id="" aria-describedby="helpId" placeholder="" required>

                    <label for=""></label>
                    <small id="helpId" class="form-text text-muted">Course</small>
                    <?php
                    include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
                    $sql = "SELECT * FROM Batch ORDER BY id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                      // output data of each row
                    ?>
                      <select name="batch" class="form-select" aria-label="Default select example" required>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                        ?>
                          <option value="<?php echo $row['id']; ?>"><span><?php echo $row['batch_name']; ?> </span> <span><?php echo $row['course']; ?> </span> <span><?php echo $row['year']; ?> </span></option>
                        <?php
                        }
                        ?>
                      </select>
                    <?php
                    } else {
                      echo "0 results";
                    }
                    ?>

                    <label for=""></label>
                    <small id="helpId" class="form-text text-muted">Username</small>
                    <input type="text" class="form-control" name="stud_username" id="" aria-describedby="helpId" placeholder="" required>

                    <label for=""></label>
                    <small id="helpId" class="form-text text-muted">Password</small>
                    <input type="text" class="form-control" name="stud_password" id="" aria-describedby="helpId" placeholder="" required>
                  </div>


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" id="testbtn">Create</button>
                </div>
              </form>
            </div>
          </div>
        </div>



        <!-- EDIT STUDENT Modal -->
        <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Student Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="POST">
                <div class="modal-body">
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="student_id" id="student_id" aria-describedby="helpId" placeholder="" value=''>

                    <label for=""></label>
                    <small id="helpId" class="form-text text-muted">Student Name</small>
                    <input type="text" class="form-control" name="updated_student_name" id="student_name" aria-describedby="helpId" placeholder="" value=''>

                    <label for=""></label>
                    <small id="helpId" class="form-text text-muted">Roll No</small>
                    <input type="text" class="form-control" name="updated_rollno" id="rollno" aria-describedby="helpId" placeholder="" value="">

                    <label for=""></label>
                    <small id="helpId" class="form-text text-muted">Batch</small>
                    <?php
                    include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
                    $sql = "SELECT * FROM Batch ORDER BY id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                      // output data of each row
                    ?>
                      <select name="updated_batch" id="Batch" class="form-select" aria-label="Default select example">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                        ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['batch_name']; ?> <?php echo $row['course']; ?> <?php echo $row['year']; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    <?php
                    } else {
                      echo "0 results";
                    }
                    ?>

                    <label for=""></label>
                    <small id="helpId" class="form-text text-muted">Username</small>
                    <input type="text" class="form-control" name="updated_username" id="username" aria-describedby="helpId" placeholder="">

                    <label for=""></label>
                    <small id="helpId" class="form-text text-muted">Password</small>
                    <input type="text" class="form-control" name="updated_password" id="password" aria-describedby="helpId" placeholder="">
                  </div>


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" onclick="testbtn()">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- <h2>Section title</h2> -->


        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
        $id = $_GET['id'];
        $sql = "SELECT * FROM Student WHERE Batch='$id' AND Student_Name LIKE '%$search%' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        ?>
          <div class="table-responsive" style="border-radius: 7px; box-shadow: 0 1px 10px #ccc;">
            <table class="table table-light table-sm table-hover" style="margin-bottom: 0;">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Student_Name</th>
                  <th>Roll_No</th>
                  <th>Batch</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>


                  <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><a href="student_view.php?id=<?php echo $row["id"]; ?>&b_id=<?php echo $_GET['id'] ?>&batch=<?php echo $_GET['batch'] ?>"> <?php echo $row["Student_Name"]; ?> </a> </td>
                    <td><?php echo $row["RollNo"]; ?></td>
                    <td><?php echo $row["Batch"]; ?></td>
                    <td><?php echo $row["Username"]; ?></td>
                    <td><?php echo $row["Password"]; ?></td>
                    <td>

                      <button type="button" class="btn btn-sm" name='update' data-bs-toggle="modal" data-bs-target="#edit_modal" onclick='edit(<?php echo $row["id"]; ?>,"<?php echo $row["Student_Name"]; ?>",<?php echo $row["RollNo"]; ?>,"<?php echo $row["Batch"]; ?>","<?php echo $row["Username"]; ?>","<?php echo $row["Password"]; ?>")'>
                        <i class="fas fa-edit" style="color:dodgerblue"></i>
                      </button>
                      <a href="delete_student.php?delete=<?php echo $row['id']; ?>" class="del_student">
                        <button type="submit" class="btn btn-sm " name="delete">
                          <i class="far fa-trash-alt" style="color: red;"></i>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  <script src="/MES/sweetAlert/jquery-3.5.1.min.js"></script>
  <script src="/MES/sweetAlert/sweetalert2.all.min.js"></script>
  <script src="/MES/Bootstrap/js/bootstrap.min.js"></script>

  <script>
    function edit(id, name, rollno, batch, username, password) {
      document.getElementById('student_id').value = id;
      document.getElementById('student_name').value = name;
      document.getElementById('rollno').value = rollno;
      document.getElementById('Batch').value = batch;
      document.getElementById('username').value = username;
      document.getElementById('password').value = password;
    }
    $('.del_student').on('click', function(e) {
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
            'Student has been deleted.',
            'success'
          )
        }
      })
    })
  </script>
</body>

</html>