<?php
require_once "../core/dbconfig.php";

if (isset($_POST["update_shop"])) {
    $id = intval($_POST["id"]);
    $shop_name = $conn->real_escape_string($_POST["shop_name"]);
    $owner_name = $conn->real_escape_string($_POST["owner_name"]);
    $address = $conn->real_escape_string($_POST["address"]);
    $contact_number = $conn->real_escape_string($_POST["contact_number"]);

    $conn->query("UPDATE shops SET shop_name='$shop_name', owner_name='$owner_name', address='$address', contact_number='$contact_number' WHERE id=$id");
    $conn->close();
    header("Location: ../index.php");
    exit();
}

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
$result = $conn->query("SELECT * FROM shops WHERE id=$id");
if (!$result || $result->num_rows == 0) {
    echo "Shop not found.";
    exit();
}
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Shop</title>
</head>
<body>
    <h1>Edit Shop</h1>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
        <label>Shop Name: <input type="text" name="shop_name" value="<?php echo htmlspecialchars($row["shop_name"]); ?>" required></label><br><br>
        <label>Owner Name: <input type="text" name="owner_name" value="<?php echo htmlspecialchars($row["owner_name"]); ?>" required></label><br><br>
        <label>Address: <input type="text" name="address" value="<?php echo htmlspecialchars($row["address"]); ?>"></label><br><br>
        <label>Contact Number: <input type="text" name="contact_number" value="<?php echo htmlspecialchars($row["contact_number"]); ?>"></label><br><br>
        <button type="submit" name="update_shop">Update Shop</button>
        <a href="../index.php">Cancel</a>
    </form>
</body>
</html>