<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "silogan_db";

mysqli_report(MYSQLI_REPORT_OFF);

$conn = @new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    $conn = @new mysqli($host, $user, $pass);
    if (!$conn->connect_error) {
        $conn->query("CREATE DATABASE IF NOT EXISTS " . $dbname);
        $conn->select_db($dbname);
    }
}
if ($conn->connect_error) {
    // try common ports? but just show
    die("Connection failed: " . $conn->connect_error);
}