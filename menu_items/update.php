<?php
require_once "../core/dbconfig.php";

if (isset($_POST["update_item"])) {
    $id = intval($_POST["id"]);
    $shop_id = intval($_POST["shop_id"]);
    $item_name = $conn->real_escape_string($_POST["item_name"]);
    $price = $conn->real_escape_string($_POST["price"]);
    $category = $conn->real_escape_string($_POST["category"]);
    $description = $conn->real_escape_string($_POST["description"]);

    $conn->query("UPDATE menu_items SET item_name='$item_name', price='$price', category='$category', description='$description' WHERE id=$id");
    $conn->close();
    header("Location: ../index.php");
    exit();
}

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
$result = $conn->query("SELECT * FROM menu_items WHERE id=$id");
if (!$result || $result->num_rows == 0) {
    echo "Item not found.";
    exit();
}
$mi = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu Item</title>
</head>
<body>
    <h1>Edit Menu Item</h1>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $mi["id"]; ?>">
        <input type="hidden" name="shop_id" value="<?php echo $mi["shop_id"]; ?>">
        <label>Item Name: <input type="text" name="item_name" value="<?php echo htmlspecialchars($mi["item_name"]); ?>" required></label><br><br>
        <label>Price: <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($mi["price"]); ?>" required></label><br><br>
        <label>Category: <input type="text" name="category" value="<?php echo htmlspecialchars($mi["category"]); ?>"></label><br><br>
        <label>Description: <input type="text" name="description" value="<?php echo htmlspecialchars($mi["description"]); ?>"></label><br><br>
        <button type="submit" name="update_item">Update Item</button>
        <a href="../index.php">Cancel</a>
    </form>
</body>
</html>