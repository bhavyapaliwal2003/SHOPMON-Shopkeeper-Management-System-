<?php
session_start();
require_once('php/auth.php');
require_once('php/transactionfunction.php');

if (!is_authenticated()) {
    header("Location: login.php");
    exit();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle the form submission to record a new transaction
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['record_transaction'])) {
        $transaction_type = $_POST['transaction_type'];
        $transaction_details = json_decode($_POST['transaction_details'], true);

        // Validation (add more as needed)
        if (empty($transaction_type) || empty($transaction_details)) {
            $error_message = "Transaction type and details are required.";
        } else {
            // Call the function to record the transaction
            $result = record_transaction($_SESSION['user_id'], $transaction_type, $transaction_details);

            if ($result) {
                $success_message = "Transaction recorded successfully.";
            } else {
                $error_message = "Failed to record the transaction. Please try again.";
            }
        }
    } elseif (isset($_POST['search_transactions'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $transaction_type = $_POST['transaction_type'];

        // Call the function to search transactions
        $transaction_history = search_transactions($_SESSION['user_id'], $start_date, $end_date, $transaction_type);
    } elseif (isset($_POST['reverse_transaction'])) {
        $transaction_id = $_POST['transaction_id'];

        // Call the function to reverse the transaction
        $result = reverse_transaction($transaction_id);

        if ($result) {
            $success_message = "Transaction reversed successfully.";
        } else {
            $error_message = "Failed to reverse the transaction. Please try again.";
        }
    } elseif (isset($_POST['submit'])) {
        // Handle the form submission from the Test Transaction form
        $user_id = $_SESSION['user_id'];
        $transaction_type = $_POST['transaction_type'];
        $product_name = $_POST['product_name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        $transaction_details = array(
            array(
                'product_name' => $product_name,
                'quantity' => $quantity,
                'price' => $price,
            )
        );

        // Call the function to record the transaction
        $result = record_transaction($user_id, $transaction_type, $transaction_details);

        if ($result) {
            $success_message = "Transaction recorded successfully.";
        } else {
            $error_message = "Failed to record the transaction. Please try again.";
        }
    }
}


require "templates/header.php" ;

require('generate.php');


// Get the user's transaction history
$transaction_history = get_transaction_history($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/transaction.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
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
      
        .inventory-table {
            width: 100%;
            margin-top: 30px;
        }

        .inventory-table th,
        .inventory-table td {
            padding: 12px;
            text-align: left;
        }

        .inventory-table th {
            background-color: #2c3e50;
            color: #e74c3c;
        }

        .inventory-table td a {
            color: #e74c3c;
        }

        .no-transactions {
            color: #777;
        }
    </style>
</head>
<body>
<div class="table-responsive inventory-table">
               
    <h2 class="text-center fw-bold mb-5">Transaction History</h2>
    <?php
    if (!empty($transaction_history)) {
        echo "Transaction history is not empty. Count: " . count($transaction_history);
    } else {
        echo "Transaction history is empty.";
    }
    ?>
    <?php if (!empty($transaction_history)): ?>
        <table class="table table-bordered table-striped">
                    <thead class="table-light">
            <tr>
                <th>Transaction ID</th>
                <th>Transaction Type</th>
                <th>Transaction Date</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($transaction_history as $transaction): ?>
                <tr>
                    <td><?php echo $transaction['transaction_id']; ?></td>
                    <td><?php echo $transaction['transaction_type']; ?></td>
                    <td><?php echo $transaction['transaction_date']; ?></td>
                    <td><?php echo $transaction['product_name']; ?></td>
                    <td><?php echo $transaction['quantity']; ?></td>
                    <td><?php echo $transaction['price']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-transactions">No transactions found.</p>
    <?php endif; ?>
</div>


<!-- Search transactions -->
<div class="addinventory-form">  <h2>Search Transactions</h2>
  <form method="post" action="tranasactionsearchresult.php">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date">
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date">
    <label for="transaction_type">Transaction Type:</label>
    <select id="transaction_type" name="transaction_type">
      <option value="">Select Transaction Type</option>
      <option value="purchase">Purchase</option>
      <option value="sale">Sale</option>
    </select>
    <button type="submit" name="submit">Search</button>
  </form>
</div>
</section>

</body>
</html>
<?php require "templates/footer.php" ;?>
