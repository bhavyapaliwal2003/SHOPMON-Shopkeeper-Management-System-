<?php
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;


require_once('php/config.php');
require_once('php/transactionfunction.php');
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$transaction_type = $_POST['transaction_type'];

$results = search_transactions($user_id, $start_date, $end_date, $transaction_type);

if (isset($conn)) {
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/transaction.css">
    <title>Search Transactions</title>
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
</style>
</head>
<body>


<?php require "templates/header.php" ?>
<br>

<section id="inventory" class="py-6" style="background:linear-gradient(180deg, #FFFEFC -54.51%, #FFF8F0 99.98%);" class="py-5">
<div class="addinventory-form">

    <h2 class="text-center fw-bold mb-5">Search Transactions</h2>
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
    <hr>
    <div class="table-responsive inventory-table">
                
    <h2 class="text-center fw-bold mb-2">Search Result</h2>
    <table class="table table-bordered table-striped">
                    <thead class="table-light">
    <?php
    if ($results) {
        echo ' <table class="table table-bordered table-striped">';
        echo '<tr><th>Transaction ID</th><th>User ID</th><th>Transaction Type</th><th>Amount</th><th>Date</th></tr>';
        foreach ($results as $result) {
            echo '<tr>';
            echo '<td>' . $result['transaction_id'] . '</td>';
            echo '<td>' . $result['user_id'] . '</td>';
            echo '<td>' . $result['transaction_type'] . '</td>';
            echo '<td>' . $result['price'] . '</td>';
            echo '<td>' . $result['transaction_date'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No transactions found.</p>';
    }
    ?>
    </div>
</section>
</body>
</html>

<?php require "templates/footer.php" ?>
