<?php
require_once('config.php'); 


function record_transaction($user_id, $transaction_type, $transaction_details) {
    $conn = get_db_connection();

    try {
        $stmt = $conn->prepare("INSERT INTO transactions (user_id, transaction_type) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $transaction_type);
        $stmt->execute();
        $transaction_id = $stmt->insert_id;
        $stmt->close();

        foreach ($transaction_details as $detail) {
            $stmt = $conn->prepare("INSERT INTO transaction_details (transaction_id, product_name, quantity, price, user_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issdi", $transaction_id, $detail['product_name'], $detail['quantity'], $detail['price'], $user_id);
            $stmt->execute();
            $stmt->close();
        }

        $stmt = $conn->prepare("INSERT INTO transaction_history (transaction_id, transaction_type, transaction_date, product_name, quantity, price, user_id) VALUES (?, ?, NOW(), ?, ?, ?, ?)");
        $stmt->bind_param("isssid", $transaction_id, $transaction_type, $detail['product_name'], $detail['quantity'], $detail['price'], $user_id);
        $stmt->execute();
        $stmt->close();

        $conn->commit();

        echo "Transaction recorded successfully.";

        $conn->close();

        return true;
    } catch (Exception $e) {
        echo "Error recording transaction: " . $e->getMessage();

        $conn->rollback();

        $conn->close();

        return false;
    }
}


// Function to update inventory
function update_inventory($user_id, $product_name, $quantity, $price) {
    $conn = get_db_connection();

    try {
        $stmt = $conn->prepare("SELECT id FROM inventory WHERE user_id = ? AND product_name = ?");
        $stmt->bind_param("is", $user_id, $product_name);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($result) {
            $stmt = $conn->prepare("UPDATE inventory SET quantity = quantity + ?, price = ? WHERE user_id = ? AND product_name = ?");
            $stmt->bind_param("disi", $quantity, $price, $user_id, $product_name);
        } else {
            $stmt = $conn->prepare("INSERT INTO inventory (user_id, product_name, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isdi", $user_id, $product_name, $quantity, $price);
        }

        if (!$stmt->execute()) {
            die('Error updating inventory: ' . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        die('Exception updating inventory: ' . $e->getMessage());
    } finally {
        $conn->close();
    }
}


// Function to get transaction history
function get_transaction_history($user_id) {
    $conn = get_db_connection();

    $stmt = $conn->prepare("
        SELECT th.history_id, th.transaction_id, th.transaction_type, th.transaction_date,
               td.product_name, td.quantity, td.price, th.user_id
        FROM transaction_history th
        JOIN transaction_details td ON th.transaction_id = td.transaction_id
        WHERE th.user_id = ?
        ORDER BY th.transaction_date DESC
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    if ($stmt->error) {
        echo "Error executing query: " . $stmt->error;
    }

    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();

    return $result;
}

// Function to reverse a transaction
function reverse_transaction($transaction_id) {
    $conn = get_db_connection();

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("SELECT product_name, quantity, price FROM transaction_details WHERE transaction_id = ?");
        $stmt->bind_param("i", $transaction_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        foreach ($result as $detail) {
            $stmt = $conn->prepare("INSERT INTO transaction_details (transaction_id, product_name, quantity, price, user_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issdi", $transaction_id, $detail['product_name'], -$detail['quantity'], $detail['price'], $user_id);
            $stmt->execute();
            $stmt->close();
        }

        $stmt = $conn->prepare("INSERT INTO transaction_history (transaction_id, transaction_type, transaction_date, product_name, quantity, price, user_id) VALUES (?, 'reversal', NOW(), '', 0, 0, 0)");
        $stmt->bind_param("i", $transaction_id);
        $stmt->execute();
        $stmt->close();

        $conn->commit();

        return true;
    } catch (Exception $e) {
        $conn->rollback();
        return false;
    } finally {
        $conn->close();
    }
}


function search_transactions($user_id, $start_date, $end_date, $transaction_type) {
    $conn = get_db_connection();

    $query = "SELECT * FROM transaction_history WHERE user_id = ?";
    $types = "i";
    $params = array($user_id);

    if ($start_date) {
        $query .= " AND transaction_date >= ?";
        $types .= "s";
        $params[] = $start_date;
    }

    if ($end_date) {
        $query .= " AND transaction_date <= ?";
        $types .= "s";
        $params[] = $end_date;
    }

    if ($transaction_type) {
        $query .= " AND transaction_type = ?";
        $types .= "s";
        $params[] = $transaction_type;
    }

    $stmt = $conn->prepare($query);

    $stmt->bind_param($types, ...$params);

    $stmt->execute();

    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    $conn->close();

    return $result;
}




?>



