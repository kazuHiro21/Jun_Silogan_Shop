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

$schema = "
CREATE TABLE IF NOT EXISTS shops (
  id INT AUTO_INCREMENT PRIMARY KEY,
  shop_name VARCHAR(255) NOT NULL,
  owner_name VARCHAR(255) NOT NULL,
  address VARCHAR(255),
  contact_number VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS menu_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  shop_id INT NOT NULL,
  item_name VARCHAR(255) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  category VARCHAR(100) DEFAULT 'silog',
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (shop_id) REFERENCES shops(id) ON DELETE CASCADE
);
";
foreach (explode(';', $schema) as $stmt) {
    $stmt = trim($stmt);
    if ($stmt !== '') {
        $conn->query($stmt);
    }
}