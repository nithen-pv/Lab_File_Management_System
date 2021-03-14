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
    <link rel="stylesheet" href="/MES/css/all.css">
    <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">

    <link href="/MES/css/dashboard.css" rel="stylesheet">
    <!-- JAVASCRIPT -->
    <script src="/MES/sweetAlert/jquery-3.5.1.min.js"></script>
    <script src="/MES/sweetAlert/sweetalert2.all.min.js"></script>
    <script>
        function add_user() {
            Swal.fire(
                'New Teacher Added!',
                'Teacher Successfully Created!.',
                'success'
            )
        }

        function update_user() {
            Swal.fire(
                'Updated!',
                'Teacher Details Updated Successfully!.',
                'success'
            )
        }
    </script>
</head>

<body>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
    if (isset($_POST['coordinator_name'])) {
        $coord_name = $_POST['coordinator_name'];
        $coord_batch = $_POST['batch'];
        $coord_username = $_POST['coord_username'];
        $coord_password = $_POST['coord_password'];
        $start = $_POST["From"];
        $stop = $_POST["To"];
        $sql = "INSERT INTO Teachers (Name, username, password, batch,start,stop)
    VALUES ('$coord_name','$coord_username','$coord_password','$coord_batch','$start','$stop')";

        if ($conn->query($sql) === TRUE) {
    ?>
            <script type="text/javascript">
                add_user();
            </script>
    <?php
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    include $_SERVER['DOCUMENT_ROOT'] . '/MES/admin/Dashboard/edit_teacher.php';
    ?>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="dashboard.php"><i class="fas fa-university fa-2x"></i> MES Marampally</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <form class="input-group" action="teachers.php" method="post">
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
                            <a class="nav-link" href="reports.php">
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
                            <a class="nav-link" href="batch.php">
                                <i class="fas fa-project-diagram"></i>
                                Batch
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="coordinators.php">
                                <i class="fas fa-chalkboard-teacher"></i>
                                Coordinators
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navElement" href="teachers.php">

                                <i class="fas fa-users"></i>
                                Teachers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="files.php">

                                <i class="fas fa-file-code"></i>
                                Files
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_config.php">
                                <i class="fas fa-user-cog"></i>
                                Manage Account
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 main-box-size">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> <?php if ($search) {
                                                                                                                                        ?>
                        <a href="teachers.php" class="h5"><i class="fas fa-arrow-left"></i> Back</a>
                    <?php
                                                                                                                                        } else {
                    ?>
                        <h1 class="h2"><i class="fas fa-users"></i> Teachers</h1>
                    <?php
                                                                                                                                        } ?>
                    <div class="btn-toolbar mb-2 mb-md-0">

                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#CoordinatorModal"><i class="fas fa-user-plus"></i> Add Teachers</button>
                    </div>
                </div>

                <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

                <!-- ADD COORDINATOR Modal -->
                <div class="modal fade" id="CoordinatorModal" tabindex="-1" aria-labelledby="CoordinatorModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-usersr"></i> Add Teacher</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for=""></label>
                                        <small id="helpId" class="form-text text-muted">Teacher Name</small>
                                        <input type="text" class="form-control" name="coordinator_name" id="" aria-describedby="helpId" placeholder="">

                                        <label for=""></label>
                                        <small id="helpId" class="form-text text-muted">Batch</small>
                                        <?php
                                        include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
                                        $sql = "SELECT * FROM Batch ORDER BY id";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                        ?>
                                            <select name="batch" class="form-select" aria-label="Default select example">
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
                                        <div class="input-group">
                                            <span class="input-group-text">Allocate Students</span>
                                            <input type="text" aria-label="First name" class="form-control" name="From" placeholder="From">
                                            <input type="text" aria-label="Last name" class="form-control" name="To" placeholder="To">
                                        </div>

                                        <label for=""></label>
                                        <small id="helpId" class="form-text text-muted">Username</small>
                                        <input type="text" class="form-control" name="coord_username" id="" aria-describedby="helpId" placeholder="">

                                        <label for=""></label>
                                        <small id="helpId" class="form-text text-muted">Password</small>
                                        <input type="text" class="form-control" name="coord_password" id="" aria-describedby="helpId" placeholder="">
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                <!-- EDIT COORDINATOR Modal -->
                <div class="modal fade" id="coordinator_edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Teacher Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="teacher_id" id="coordinator_id" aria-describedby="helpId" placeholder="" value=''>

                                        <label for=""></label>
                                        <small id="helpId" class="form-text text-muted">Teacher Name</small>
                                        <input type="text" class="form-control" name="updated_name" id="coordinator_name" aria-describedby="helpId" placeholder="" value=''>

                                        <label for=""></label>
                                        <small id="helpId" class="form-text text-muted">Batch</small>
                                        <?php
                                        include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
                                        $sql = "SELECT * FROM Batch ORDER BY id";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                        ?>
                                            <select name="updated_batch" id="batch" class="form-select" aria-label="Default select example">
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
                                        <small id="helpId" class="form-text text-muted">Allocate Students</small>
                                        <div class="input-group">
                                            <span class="input-group-text">Roll No</span>
                                            <input type="text" aria-label="First name" class="form-control" id="start" name="From" placeholder="From">
                                            <input type="text" aria-label="Last name" class="form-control" id="stop" name="To" placeholder="To">
                                        </div>

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
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- <h2>Section title</h2> -->


                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
                $sql = "SELECT * FROM Teachers wHERE Name LIKE '%$search%' ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                ?>
                    <div class="table-responsive" style="border-radius: 7px; box-shadow: 0 1px 10px #ccc;">
                        <table class="table table-light table-sm table-hover" style="text-align: center;margin-bottom: 0;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Teacher Name</th>
                                    <th>Batch</th>
                                    <th>Allocated Students</th>
                                    <th>Username</th>
                                    <th>Password</th>
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
                                        <td><a href="teacher_stud.php?b_id=<?php echo $row['batch'] ?>&start=<?php echo $row['start'] ?>&stop=<?php echo $row['stop'] ?>&t_name=<?php echo $row["name"]; ?>"> <?php echo $row["name"]; ?> </a> </td>
                                        <td>
                                            <?php
                                            $batch_id = $row["batch"];
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
                                        <td><?php echo $row["start"]; ?>-<?php echo $row["stop"]; ?></td>
                                        <td><?php echo $row["username"]; ?></td>
                                        <td><?php echo $row["password"]; ?></td>
                                        <td>

                                            <button type="button" class="btn btn-sm " name='update' data-bs-toggle="modal" data-bs-target="#coordinator_edit_modal" onclick='edit(<?php echo $row["id"]; ?>,"<?php echo $row["name"]; ?>","<?php echo $row["batch"]; ?>","<?php echo $row["username"]; ?>","<?php echo $row["password"]; ?>"
                                            ,<?php echo $row["start"]; ?>,<?php echo $row["stop"]; ?>)'>
                                                <i class="fas fa-edit" style="color:dodgerblue"></i>
                                            </button>
                                            <a href="delete_teacher.php?delete=<?php echo $row['id']; ?>" class="del_user">
                                                <button type="submit" class="btn btn-sm" name="delete">
                                                    <i class="far fa-trash-alt" style="color: red;"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>

                                <?php
                                }
                            } elseif ($search != '') {
                                ?>
                                <div class="col-md-6 mx-auto">
                                    <h2 style="margin-left: 100px;">Oops!... no results found</h2>
                                    <img src="/MES/images/Search.gif" alt="IMAGE" style="text-align: center;">
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="col-md-6 mx-auto">
                                    <h2 style="margin-left: 120px;">Add Teachers</h2>
                                    <img src="/MES/images/Teacher.gif" alt="IMAGE" style="text-align: center;">
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
        function edit(id, name, batch, username, password, start, stop) {
            document.getElementById('coordinator_id').value = id;
            document.getElementById('coordinator_name').value = name;
            document.getElementById('batch').value = batch;
            document.getElementById('username').value = username;
            document.getElementById('password').value = password;
            document.getElementById('start').value = start;
            document.getElementById('stop').value = stop;

        }
        $('.del_user').on('click', function(e) {
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
                        'Teacher has been deleted.',
                        'success'
                    )
                }
            })
        })
    </script>
</body>

</html>