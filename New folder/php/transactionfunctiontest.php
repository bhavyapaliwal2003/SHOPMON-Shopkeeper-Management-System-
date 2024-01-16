<?php

require_once "config.php";

// Function to insert a new transaction and return the transaction ID
function insert_transaction($user_id, $transaction_type) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO transactions (user_id, transaction_type) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $transaction_type);

    $stmt->execute();

    return $stmt->insert_id;
}


// Function to insert a new transaction detail
function insert_transaction_detail($transaction_id, $product_name, $quantity, $price, $user_id) {
    global $conn;

   
    $stmt = $conn->prepare("INSERT INTO transaction_details (transaction_id, product_name, quantity, price, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issdi", $transaction_id, $product_name, $quantity, $price, $user_id);

    $stmt->execute();
}

// // Function to insert a new transaction history
function insert_transaction_history($transaction_id, $transaction_type, $product_name, $quantity, $price, $user_id) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO transaction_history (transaction_id, transaction_type, product_name, quantity, price, user_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssdi", $transaction_id, $transaction_type, $product_name, $quantity, $price, $user_id);

    $stmt->execute();
}

// // Function to update inventory on purchase
function update_inventory_on_sale($user_id, $product_name, $quantity) {
    global $conn;

    $stmt = $conn->prepare("UPDATE inventory SET quantity = quantity - ?, quantity_sold = quantity_sold + ? WHERE user_id = ? AND product_name = ?");
    $stmt->bind_param("iiss", $quantity, $quantity, $user_id, $product_name);
    $stmt->execute();
}

// // Function to update inventory on sale
function update_inventory_on_purchase($user_id, $product_name, $quantity) {
    global $conn;

    $stmt = $conn->prepare("UPDATE inventory SET quantity = quantity + ? WHERE user_id = ? AND product_name = ?");
    $stmt->bind_param("iss", $quantity, $user_id, $product_name);
    $stmt->execute();
}

 ?>

