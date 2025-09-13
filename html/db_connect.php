<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname ="library_db";

$conn = mysqli_connect(hostname: $host, username: $user, password: $pass, database: $dbname);

if(!$conn) {
    die("Database connection failed.". mysqli_connect_error());
}
?>

