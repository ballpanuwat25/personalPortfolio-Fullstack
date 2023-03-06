<?php

$servername = "localhost";
$username = "root";
$password = " ";
$database = "personalportfolio";
$port = "3307";

$connection = new mysqli($servername, $username, $password, $database, $port);

    $project_id = "";
    $project_name = "";
    $project_category = "";
    $project_description = "";
    $project_address = "";

    $errorMessage = "";
    $successMessage = "";

    if ($_SERVER['REQUEST_METHOD'] == 'GET' ) {

        if ( !isset($_GET["project_id"]) ) {
        header("location: index.php");
        exit;

        }

        $project_id = $_GET["project_id"];

        $sql = "SELECT * FROM projects WHERE project_id=$project_id";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();

        if (!$row) {
            header("location: index.php");
            exit;
        }
        
        $project_name = $row["project_name"];
        $project_category = $row["project_category"];
        $project_description = $row["project_description"];
        $project_address = $row["project_address"];

    } else {

        $project_id = $_POST["project_id"];
        $project_name = $_POST["project_name"];
        $project_category = $_POST["project_category"];
        $project_description = $_POST["project_description"];
        $project_address = $_POST["project_address"];

        do {
            if (empty($project_id) || empty($project_name) || empty($project_category) || empty($project_description) || empty($project_address)) {
                $errorMessage = "All the fields are required";
                break;
            }

            $sql = " UPDATE projects " .
                "SET project_name = '$project_name', project_category = '$project_category', project_description = '$project_description', project_address = '$project_address' " .
                " WHERE project_id = $project_id ";

            $result = $connection->query($sql);

            if (!$result) {
                $errorMessage = " Invalid query : " . $connection->error;
                break;
            }

            $successMessage = "Client updated correctly";

            header("location: projectlist.php");
            exit;

        } while (false);
    }

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

  <header class="p-3 mb-3 border-bottom shadow-sm p-3 mb-5 bg-body rounded">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="projectlist.php" class="nav-link px-2 link-dark"><h4 class="fw-bolder">Project List</h4></a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" method="get" action="">
          <input type="search" class="form-control" placeholder="Search Project..." aria-label="Search" name="search" style="border : solid 1px grey;">
        </form>

        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../assets/img/profile.png" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="create.php">New project...</a></li>
            <li><a class="dropdown-item" href="http://localhost/phpmyadmin/">Database</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../index.php">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
    
    <div class="container my-5">
        <h2> Updated Client </h2> <br>

        <?php
            if ( !empty($errorMessage) ) {
            echo "
                <div class='alert alert-secondary alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-lable='Close'></button>
                </div>
                ";
            }
        ?>

        <form class="shadow p-3 mb-5 bg-body rounded" method="post">
            <input type="hidden" name="project_id" value=" <?php echo $project_id; ?> ">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> project_Name </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="project_name" value="<?php echo $project_name; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> project_Category </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="project_category" value="<?php echo $project_category; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> project_Description </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="project_description" value="<?php echo $project_description; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> project_Address </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="project_address" value="<?php echo $project_address; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-secondary"> Submit </button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-secondary" href="projectlist.php" role="button"> Cancel </a>
                </div>
            </div>

        </form>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>
</html>