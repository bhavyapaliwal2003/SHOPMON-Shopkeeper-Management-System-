<?php


require_once('config.php');


function get_categories() {
    $conn = get_db_connection();

    $result = $conn->query("SELECT * FROM categories");

    $categories = array();
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    $conn->close();

    return $categories;
}

function get_supplier_name($supplier_id) {
    $conn = get_db_connection();

    $stmt = $conn->prepare("SELECT supplier_name FROM suppliers WHERE id = ?");

    if (!$stmt) {
        die("Error: " . $conn->error);
    }

    $stmt->bind_param("i", $supplier_id);

    if (!$stmt->execute()) {
        die("Error: " . $stmt->error);
    }

    $stmt->bind_result($supplier_name);

    $stmt->fetch();

    $stmt->close();
    $conn->close();

    return $supplier_name;
}


function get_category_name($category_id) {
    $conn = get_db_connection();

    $stmt = $conn->prepare("SELECT category FROM categories WHERE category_id = ?");
    
    if (!$stmt) {
        die("Error: " . $conn->error);
    }

    $stmt->bind_param("i", $category_id);

    $stmt->execute();

    if (!$stmt->execute()) {
        die("Error: " . $stmt->error);
    }

    $stmt->bind_result($category_name);

    $stmt->fetch();

    $stmt->close();
    $conn->close();

    return $category_name;
}


function get_supplier_list_with_category($user_id) {
    $conn = get_db_connection();

    $stmt = $conn->prepare('SELECT s.supplier_id, s.supplier_name, c.category FROM suppliers s
                           INNER JOIN categories c ON s.category_id = c.category_id
                           WHERE s.user_id = ?');
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    $result = $stmt->get_result();

    $suppliers = array();
    while ($row = $result->fetch_assoc()) {
        $suppliers[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $suppliers;
}


function get_supplier_list($user_id) {
    $conn = get_db_connection();

    $stmt = $conn->prepare('SELECT * FROM suppliers WHERE user_id = ?');
    $stmt->bind_param('i', $user_id);

    $stmt->execute();
    $result = $stmt->get_result();

    $suppliers = array();
    while ($row = $result->fetch_assoc()) {
        $suppliers[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $suppliers;
}

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


function get_inventory_list_with_category($user_id) {
    $conn = get_db_connection();

    $stmt = $conn->prepare('SELECT inventory.product_name, inventory.quantity, inventory.price, suppliers.supplier_name, categories.category
    FROM inventory
    INNER JOIN suppliers ON inventory.supplier_id = suppliers.supplier_name
    INNER JOIN categories ON inventory.category_id = categories.category_id
    WHERE inventory.user_id = ?');

    if (!$stmt) {
        die("Error: " . $conn->error);
    }

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


function add_supplier($user_id, $supplier_name, $contact_person, $category_id) {
    $conn = get_db_connection();

    $category_name = get_category_name($category_id);

    $stmt = $conn->prepare("INSERT INTO suppliers (user_id, supplier_name, mobilenumber, category_id, category_name) VALUES (?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Error: " . $conn->error);
    }

    $stmt->bind_param("isiss", $user_id, $supplier_name, $contact_person, $category_id, $category_name);

    if (!$stmt->execute()) {
        die("Error: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();

    return true;
}


// Function to add a new product to the inventory with the user ID and category ID
function add_product_to_inventory($user_id, $product_name, $quantity, $price, $supplier_id, $category_id) {
    $conn = get_db_connection();

    $supplier_name = get_supplier_name($supplier_id);
    $category_name = get_category_name($category_id);


    $stmt = $conn->prepare("INSERT INTO inventory (user_id, product_name, quantity, price, supplier_id, supplier_name, category_id, category_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issdisss", $user_id, $product_name, $quantity, $price, $supplier_id, $supplier_name, $category_id, $category_name);

    $result = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $result;
}




?>
