<?php
require_once 'core/dbconfig.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Jun's Silogan House</title>
</head>
<body>

<h1>Jun's Silogan House</h1>

<!-- ADD SHOP -->
<h2>Add Shop</h2>
<form action="shops/insert.php" method="POST">
    Shop Name:
    <input type="text" name="shop_name" required><br><br>

    Owner Name:
    <input type="text" name="owner_name" required><br><br>

    Address:
    <input type="text" name="address"><br><br>

    Contact:
    <input type="text" name="contact_number"><br><br>

    <button type="submit" name="add_shop">Add Shop</button>
</form>

<hr>

<!-- SHOP LIST -->
<h2>Shop List</h2>

<?php

$sql = "SELECT * FROM shops";
$result = $conn->query($sql);

if ($result !== false && $result->num_rows > 0) {

    while ($shop = $result->fetch_assoc()) {

        $shopId = intval($shop['id']);

        echo "<h3>" . htmlspecialchars($shop['shop_name']) . "</h3>";
        echo "Owner: " . htmlspecialchars($shop['owner_name']) . "<br>";
        echo "Address: " . htmlspecialchars($shop['address']) . "<br>";
        echo "Contact: " . htmlspecialchars($shop['contact_number']) . "<br><br>";

        echo "
            <a href='shops/update.php?id=$shopId'>Edit Shop</a> |
            <form action='shops/delete.php' method='POST' style='display:inline;'>
                <input type='hidden' name='id' value='$shopId'>
                <button type='submit' onclick=\"return confirm('Delete this shop?')\">Delete Shop</button>
            </form>
            <br><br>
        ";

        echo "<strong>Menu Items</strong><br>";

        $menuSql = "SELECT * FROM menu_items WHERE shop_id = $shopId";
        $menuResult = $conn->query($menuSql);

        if ($menuResult !== false && $menuResult->num_rows > 0) {

            echo "<ul>";

            while ($item = $menuResult->fetch_assoc()) {

                $itemId = intval($item['id']);

                echo "
                <li>
                    " . htmlspecialchars($item['item_name']) . "
                    - ₱" . htmlspecialchars($item['price']) . "
                    (" . htmlspecialchars($item['category']) . ")

                    <a href='menu_items/update.php?id=$itemId'>Edit</a>

                    <form action='menu_items/delete.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='id' value='$itemId'>
                        <button type='submit' onclick=\"return confirm('Delete this item?')\">Delete</button>
                    </form>
                </li>
                ";
            }

            echo "</ul>";

        } else {
            echo "No menu items yet.<br>";
        }

        echo "<hr>";
    }

} else {
    echo "No shops found.";
}

?>

<!-- ADD MENU ITEM -->
<h2>Add Menu Item</h2>

<form action="menu_items/insert.php" method="POST">

    <label>Shop:</label>
    <select name="shop_id" required>
        <?php

        $shops = $conn->query("SELECT id, shop_name FROM shops");

        if ($shops !== false) {
            while ($row = $shops->fetch_assoc()) {
                echo "
                <option value='{$row['id']}'>
                    " . htmlspecialchars($row['shop_name']) . "
                </option>
                ";
            }
        }

        ?>
    </select><br><br>

    <label>Item Name: <input type="text" name="item_name" required></label><br><br>
    <label>Price: <input type="number" step="0.01" name="price" required></label><br><br>
    <label>Category: <input type="text" name="category" value="silog"></label><br><br>
    <label>Description: <input type="text" name="description"></label><br><br>

    <button type="submit" name="add_item">Add Item</button>

</form>

</body>
</html>
