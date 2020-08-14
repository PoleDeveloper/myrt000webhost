<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myrt";

$conn = mysqli_connect($servername,$username,$password,$dbname)or die(header("Location: http://localhost/myrt000webhost/error/connection_error.html"));
?>