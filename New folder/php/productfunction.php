<?php

require_once "config.php";

function get_all_products($user_id) {
  global $conn;

  $conn = get_db_connection();

  $stmt = $conn->prepare("SELECT * FROM inventory WHERE user_id = ?");
  $stmt->bind_param("i", $user_id);

  $stmt->execute();

  if ($stmt->errno) {
    throw new Exception("Error executing query: " . $stmt->error);
  }
  $result = $stmt->get_result();

  $products = $result->fetch_all(MYSQLI_ASSOC);

  $stmt->close();

  return $products;
}


function get_product_details($user_id, $product_name) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM inventory WHERE user_id = ? AND product_name = ?");
    $stmt->bind_param("is", $user_id, $product_name);

    $stmt->execute();

    $result = $stmt->get_result();

    $product_details = $result->fetch_assoc();

    $stmt->close();

    return $product_details;
}


function get_product_price($user_id, $product_name) {
  global $conn; 

  if (!$conn) {
      $conn = get_db_connection();

      if (!$conn) {
          return null;
      }
  }

  $stmt = $conn->prepare("SELECT price FROM inventory WHERE user_id = ? AND product_name = ?");
  $stmt->bind_param("is", $user_id, $product_name);

  $stmt->execute();

  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row['price'];
  } else {
      return null;
  }

  $stmt->close();
}
?>
