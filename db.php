
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blogit";

$conn = new mysqli($servername, $username, $password,  $dbname);

if($conn ->connect_error){
    die( "Error connecting database" . $conn->connect_error);
}

?>
