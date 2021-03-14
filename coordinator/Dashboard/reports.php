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

<body style="background: #eee;">
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"><i class="fas fa-university fa-2x"></i> MES Marampally</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <form class="input-group" action="" method="post">
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
                            <a class="nav-link navElement" href="reports.php" id="report">
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
                    <h1 class="h2"><i class="fas fa-home"></i> Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <i class="fas fa-user-circle fa-2x"></i>
                        <span class="fw-normal ml-1 mt-1"> <?php echo $_SESSION["cordinator_name"]; ?> </span>
                    </div>

                </div>

                <div class="container px-5">
                    <div class="row">
                        <div class="col-4">
                            <a href="files.php" style="text-decoration: none;">
                                <div class="p-4 border bg-info dashboard_element" style="border-radius:15px;text-align:center">
                                    <i class="fas fa-file-code fa-7x" style="color: white;"></i>
                                    <?php
                                    $batch = $_SESSION["batch"];
                                    $sql = "SELECT * FROM files WHERE batch='$batch'";
                                    $mysqliStatus = $conn->query($sql);
                                    $rows_count_value = mysqli_num_rows($mysqliStatus);
                                    ?>
                                    <br>
                                    <span style="color: white;font-size:1.6rem;"><?php echo $rows_count_value; ?> Files </span>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="dashboard.php" style="text-decoration: none;">
                                <div class="p-4 border bg-warning dashboard_element" style="border-radius:15px;text-align:center">
                                    <i class="fas fa-users fa-7x" style="color: white;"></i>
                                    <?php
                                    $sql = "SELECT * FROM Student WHERE Batch='$batch'";
                                    $mysqliStatus = $conn->query($sql);
                                    $rows_count_value = mysqli_num_rows($mysqliStatus);
                                    ?>
                                    <br>
                                    <span style="color: white;font-size:1.6rem"><?php echo $rows_count_value; ?> Students </span>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="teachers.php" style="text-decoration: none;">
                                <div class="p-4 border bg-secondary dashboard_element" style="border-radius:15px;text-align:center">
                                    <i class="fas fa-chalkboard-teacher fa-7x" style="color: white;"></i>
                                    <?php
                                    $sql = "SELECT * FROM Teachers WHERE Batch='$batch'";
                                    $mysqliStatus = $conn->query($sql);
                                    $rows_count_value = mysqli_num_rows($mysqliStatus);
                                    ?>
                                    <br>
                                    <span style="color: white;font-size:1.6rem"><?php echo $rows_count_value; ?> Teachers </span>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>


                <!-- <h2>Section title</h2> -->

            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="/MES/Bootstrap/js/bootstrap.min.js"></script>

</body>

</html>