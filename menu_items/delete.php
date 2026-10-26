<?php
require_once "../core/dbconfig.php";

$id = isset($_POST["id"]) ? intval($_POST["id"]) : (isset($_GET["id"]) ? intval($_GET["id"]) : 0);
if ($id > 0) {
    $conn->query("DELETE FROM menu_items WHERE id=$id");
    $conn->close();
}
header("Location: ../index.php");
exit();