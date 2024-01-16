<?php

require_once "php/config.php"; 
require_once "php/productfunction.php"; 
require_once "php/transactionfunctiontest.php"; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}

// Get user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch product names from the inventory
$products = get_all_products($user_id);

// Assuming you have the selected product name in a variable
$product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';

// Call the function to get the product price
$product_price = get_product_price($user_id, $product_name);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $transaction_type = $_POST["transaction_type"];
    $product_name = $_POST["product_name"];
    $quantity = $_POST["quantity"];

    // Fetch product details from inventory
    $product_details = get_product_details($user_id, $product_name);
        if ($transaction_type === "purchase") {
            $price =$product_details["price"] * $quantity;
        } elseif ($transaction_type === "sale") {
            $price = $product_details["price"] * $quantity;
        } else {
            $price = 0;
        }

    // Insert data into transactions table
    $transaction_id = insert_transaction($user_id, $transaction_type);

    // Insert data into transaction_details table
    insert_transaction_detail($transaction_id, $product_name, $quantity, $price, $user_id);

    // Insert data into transaction_history table
    insert_transaction_history($transaction_id, $transaction_type, $product_name, $quantity, $price, $user_id);

    // Update inventory based on the transaction type
    if ($transaction_type === "purchase") {
        update_inventory_on_purchase($user_id, $product_name, $quantity);
    } elseif ($transaction_type === "sale") {
        update_inventory_on_sale($user_id, $product_name, $quantity);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaction Form</title>
  <style>
   
  .addinventory-form {
      width: 100%;
     
      padding: 2rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #fff;
            max-width: 600px;
            margin: 0 auto;
        }

        .addinventory-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .addinventory-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .addinventory-form input,
        .addinventory-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .addinventory-form button {
            background-color:  #e74c3c;
            color: #ffffff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 20px auto 0;
        }

        .addinventory-form button:hover {
            background-color: #1a252f;
        }
  </style>
</head>

<body>
<br>
   <section id="inventory" class="py-6" style="background:linear-gradient(180deg, #FFFEFC -54.51%, #FFF8F0 99.98%);" class="py-5">
        <div class="container">

        <h2 class="text-center fw-bold mb-5">Transaction Form </h2> <!-- Add a New Product Form -->
 <div class="addinventory-form">

    <form method="post" action="">
      <label for="transaction_type">Transaction Type:</label>
      <select id="transaction_type" name="transaction_type">
        <option value="purchase">Purchase</option>
        <option value="sale">Sale</option>
      </select>

      <label for="product_name">Product Name:</label>
      <select id="product_name" name="product_name">
        <?php foreach ($products as $product) : ?>
          <option value="<?php echo $product['product_name']; ?>"><?php echo $product['product_name']; ?></option>
        <?php endforeach; ?>
      </select>

      <label for="price">Price:</label>
      <input type="text" id="price" name="price" value="<?php echo $product_price; ?>" readonly>

      <label for="quantity">Quantity:</label>
      <input type="number" id="quantity" name="quantity" required>
      <br>
      <button type="submit">Submit</button>
    </form>
  </div>
  <br>
</body>

</html>

