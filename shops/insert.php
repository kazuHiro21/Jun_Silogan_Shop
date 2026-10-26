<?php
require_once "../core/dbconfig.php";

if (isset($_POST["add_shop"])) {
    $shop_name = $conn->real_escape_string($_POST["shop_name"]);
    $owner_name = $conn->real_escape_string($_POST["owner_name"]);
    $address = $conn->real_escape_string($_POST["address"]);
    $contact_number = $conn->real_escape_string($_POST["contact_number"]);

    $conn->query("INSERT INTO shops (shop_name, owner_name, address, contact_number) VALUES ('$shop_name', '$owner_name', '$address', '$contact_number')");
    $conn->close();
    header("Location: ../index.php");
    exit();
}