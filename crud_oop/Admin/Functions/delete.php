<?php 
    if ( isset($_GET["project_id"]) ) {
    $project_id = $_GET["project_id"];
    
    $servername = "localhost";
    $username = "root";
    $password = " ";
    $database = "personalportfolio";
    $port = "3307";

    $connection = new mysqli($servername, $username, $password, $database, $port);

    $sql = "DELETE FROM projects WHERE project_id=$project_id";
    $connection->query($sql);
}

header("location: projectlist.php");
exit;
?>