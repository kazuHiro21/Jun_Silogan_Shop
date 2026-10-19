<?php
require_once "../core/dbconfig.php";

if (isset($_POST["add_item"])) {
    $shop_id = intval($_POST["shop_id"]);
    $item_name = $conn->real_escape_string($_POST["item_name"]);
    $price = $conn->real_escape_string($_POST["price"]);
    $category = $conn->real_escape_string($_POST["category"]);
    $description = $conn->real_escape_string($_POST["description"]);

    $conn->query("INSERT INTO menu_items (shop_id, item_name, price, category, description) VALUES ($shop_id, '$item_name', '$price', '$category', '$description')");
    $conn->close();
    header("Location: ../index.php");
    exit();
}

$shop_id = isset($_GET["shop_id"]) ? intval($_GET["shop_id"]) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Menu Item</title>
</head>
<body>
    <h1>Add Menu Item to Shop</h1>
    <form action="insert.php" method="POST">
        <input type="hidden" name="shop_id" value="<?php echo $shop_id; ?>">
        <label>Item Name: <input type="text" name="item_name" required></label><br><br>
        <label>Price: <input type="number" step="0.01" name="price" required></label><br><br>
        <label>Category: <input type="text" name="category" value="silog"></label><br><br>
        <label>Description: <input type="text" name="description"></label><br><br>
        <button type="submit" name="add_item">Add Item</button>
        <a href="../index.php">Cancel</a>
    </form>
</body>
</html>