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

if ($result->num_rows > 0) {

    while ($shop = $result->fetch_assoc()) {

        $shopId = $shop['id'];

        echo "<h3>{$shop['shop_name']}</h3>";
        echo "Owner: {$shop['owner_name']}<br>";
        echo "Address: {$shop['address']}<br>";
        echo "Contact: {$shop['contact_number']}<br><br>";

        echo "
            <a href='shops/update.php?id=$shopId'>Edit Shop</a> |
            <a href='shops/delete.php?id=$shopId'>Delete Shop</a>
            <br><br>
        ";

        echo "<strong>Menu Items</strong><br>";

        $menuSql = "SELECT * FROM menu_items WHERE shop_id = $shopId";
        $menuResult = $conn->query($menuSql);

        if ($menuResult->num_rows > 0) {

            echo "<ul>";

            while ($item = $menuResult->fetch_assoc()) {

                echo "
                <li>
                    {$item['item_name']}
                    - ₱{$item['price']}
                    ({$item['category']})

                    <a href='menu_items/update.php?id={$item['id']}'>Edit</a>

                    <a href='menu_items/delete.php?id={$item['id']}'>
                        Delete
                    </a>
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

<form action="menu_items/insert.php" method="GET">

    <select name="shop_id">

        <?php

        $shops = $conn->query("SELECT id, shop_name FROM shops");

        while ($row = $shops->fetch_assoc()) {
            echo "
            <option value='{$row['id']}'>
                {$row['shop_name']}
            </option>
            ";
        }

        ?>

    </select>

    <button type="submit">
        Add Item
    </button>

</form>

</body>
</html>