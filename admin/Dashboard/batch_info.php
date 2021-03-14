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

                    <a href="batch_view.php?id=<?php echo $_GET['id'];
                                                if (isset($_GET['batch'])) {
                                                ?>&&batch=<?php echo $_GET['batch'];
                                                        } ?>" class="h5"><i class="fas fa-arrow-left"></i> Back</a>
                    <h1 class="h2"><?php if (isset($_GET['batch'])) {
                                        echo $_GET['batch'];
                                    } ?></h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <!-- top right elements -->
                    </div>
                </div>

                <!-- <h2>Section title</h2> -->


                <div>


                    <div class="card  mb-3 table-responsive" style="max-width:100%;border-radius: 7px; box-shadow: 0 1px 30px #ccc;">
                        <div class="card-header bg-primary text-light"></div>
                        <div class="card-body bg-light">
                            <h5 class="card-title"><i class="fas fa-info-circle"></i> Batch info</h5><br>
                            <?php
                            include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
                            $b_id = $_GET['id'];
                            $sql = "SELECT * FROM Coordinators WHERE batch='$b_id'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <h6 class="card-title ms-3"><i class="fas fa-chalkboard-teacher"></i> Coordinator : <?php echo $row['Name']; ?></h6><br>
                                <?php
                                }
                            } else { ?>
                                <h6 class="card-title ms-3"><i class="fas fa-chalkboard-teacher"></i> Coordinator : </h6><br>
                            <?php }
                            ?>

                            <h6 class="card-title ms-3"><i class="fas fa-users"></i> Teachers :</h6>
                            <?php
                            include $_SERVER['DOCUMENT_ROOT'] . '/MES/mysql_conn/mysql_conn.php';
                            $b_id = $_GET['id'];
                            $sql = "SELECT * FROM Teachers WHERE batch='$b_id'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <p class="card-text ms-5"><?php echo $row['name']; ?></p>
                                <?php
                                }
                            } else { ?>
                                
                            <?php } ?>
                        </div>
                    </div>

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