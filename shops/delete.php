<?php
require_once "../core/dbconfig.php";

if (isset($_POST["id"])) {
    $id = intval($_POST["id"]);
    $conn->query("DELETE FROM shops WHERE id=$id");
    $conn->close();
}
header("Location: ../index.php");
exit();