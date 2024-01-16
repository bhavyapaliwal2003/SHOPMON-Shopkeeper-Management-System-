<?php

require_once('config.php');

// Function to get the list of products in inventory
function get_inventory_list($user_id) {
    $conn = get_db_connection();

    $stmt = $conn->prepare('SELECT * FROM inventory WHERE user_id = ?');
    $stmt->bind_param('i', $user_id);

    $stmt->execute();
    $result = $stmt->get_result();

    $inventory_list = array();
    while ($row = $result->fetch_assoc()) {
        $inventory_list[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $inventory_list;
}

// Function to add a new product to the inventory
function add_product_to_inventory($user_id, $product_name, $quantity, $price, $supplier_id, $category_id) {
    $conn = get_db_connection();

    $stmt = $conn->prepare("INSERT INTO inventory (user_id, product_name, quantity, price, supplier_id, category_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issdii", $user_id, $product_name, $quantity, $price, $supplier_id, $category_id);

    $result = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $result;
}

// Function to update inventory quantity
function update_inventory($user_id, $product_id, $new_quantity) {
    $conn = get_db_connection();

    $stmt = $conn->prepare("UPDATE inventory SET quantity = ? WHERE user_id = ? AND id = ?");
    $stmt->bind_param("iii", $new_quantity, $user_id, $product_id);

    $result = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $result;
}


?>
