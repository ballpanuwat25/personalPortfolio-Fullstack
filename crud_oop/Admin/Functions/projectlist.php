<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="function.css" rel="stylesheet">
  </head>

  <body>
  <header class="p-3 mb-3 border-bottom shadow-sm p-3 mb-5 bg-body rounded">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 link-dark"><h4 class="fw-bolder">Project List</h4></a></li>
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
        <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
            <table class="my-table">
                <thead>
                    <tr class="text-center align-middle">
                        <th style="white-space: nowrap;"> Project ID </th>
                        <th> Project Name </th>
                        <th style="white-space: nowrap;"> Project Category </th>
                        <th> Project Description </th>
                        <th> Project Address </th>
                        <th> Created At </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>

                <?php

                    $servername = "localhost";
                    $username = "root";
                    $password = " ";
                    $database = "personalportfolio";
                    $port = "3307";

                $connection = new mysqli($servername, $username, $password, $database, $port);

                if ($connection->connect_error){
                    die("Connection failed : " . $connection->connect_error);
                }

                if (isset($_GET['search'])) {
                  $search = $_GET['search'];
                  $sql = "SELECT * FROM projects WHERE project_name LIKE '%$search%' OR project_category LIKE '%$search%' OR project_description LIKE '%$search%'";
                } else {
                  $sql = "SELECT * FROM projects";
                }
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query : " . $connection->error);
                }

                while($row = $result->fetch_assoc()) {
                    echo " <tr>
                    <td> $row[project_id] </td>
                    <td> $row[project_name] </td>
                    <td> $row[project_category] </td>
                    <td> $row[project_description] </td>
                    <td> $row[project_address] </td>
                    <td> $row[created_at] </td>
                    <td>
                      <div class='d-flex' style='gap: 5px;'>
                        <a class='btn btn-secondary btn-sm' href='edit.php?project_id=$row[project_id]'> Edit </a>
                        <a class='btn btn-outline-secondary btn-sm' href='delete.php?project_id=$row[project_id]'> Delete </a>
                      </div>
                    </td>
                </tr> ";
                }
                
                ?>

            </tbody>
        </table>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>

</html>