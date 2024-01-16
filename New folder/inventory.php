<?php
session_start();
require_once('php/function.php');
require_once('php/auth.php');

// Check if the user is authenticated
if (!is_authenticated()) {
    header("Location: login.php");
    exit();
}

// Handle the form submission to add a new product to the inventory
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $supplier_id = $_POST['supplier_id'];
    $category_id = $_POST['category_id'];

    // Validation (add more as needed)
    if (empty($product_name) || empty($quantity) || empty($price) || empty($supplier_id) || empty($category_id)) {
        $error_message = "All fields are required.";
    } else {
        // Call the function to add the product to the inventory
        $result = add_product_to_inventory($_SESSION['user_id'], $product_name, $quantity, $price, $supplier_id, $category_id);

        if ($result) {
            $success_message = "Product added to inventory successfully.";
        } else {
            $error_message = "Failed to add the product to inventory. Please try again.";
        }
    }
}

// Get the user's inventory list
$inventory_list = get_inventory_list($_SESSION['user_id']);
 require "templates/header.php" ;

?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopman - Inventory</title>
    <!-- Add your favicon and other meta tags as needed -->
    <link href="assets/css/theme.css" rel="stylesheet" />
    <!-- Add FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
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

    <!-- Your Navigation Bar -->
    <!-- ... (your existing navigation bar code) ... -->

    <!-- Inventory Table -->
    <section id="inventory" class="py-6" style="background:linear-gradient(180deg, #FFFEFC -54.51%, #FFF8F0 99.98%);" class="py-5">
        <div class="container">

       
 <div class="addinventory-form">
                <h2 class="text-center fw-bold mb-5">Add a New Product to Inventory</h2>

                <?php if (isset($error_message)): ?>
                    <p style="color: red;"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <?php if (isset($success_message)): ?>
                    <p style="color: green;"><?php echo $success_message; ?></p>
                <?php endif; ?>

                <form method="post" action="inventory.php">
                    <label for="product_name">Product Name:</label>
                    <input type="text" id="product_name" name="product_name" required>

                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" required>

                    <label for="price">Price:</label>
                    <input type="number" step="0.01" id="price" name="price" required>

                    <label for="supplier_id">Supplier:</label>
                    <select id="supplier_id" name="supplier_id" required>
                        <?php
                        $suppliers = get_supplier_list($_SESSION['user_id']);
                        foreach ($suppliers as $supplier):
                        ?>
                            <option value="<?php echo $supplier['id']; ?>"><?php echo $supplier['supplier_name']; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="category_id">Category:</label>
                    <select id="category_id" name="category_id" required>
                        <?php
                        $categories = get_categories();
                        foreach ($categories as $category):
                        ?>
                            <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category']; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit" name="add_product">Add Product</button>
                </form>
            </div>

        </div>
        <br><br>
         <h2 class="text-center fw-bold mb-5">Your Inventory</h2> <!-- Add a New Product Form -->
            <!-- Display the inventory list -->
            <div class="table-responsive inventory-table">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($inventory_list as $product): ?>
                            <tr>
                                <td><?php echo $product['product_name']; ?></td>
                                <td><?php echo $product['quantity']; ?></td>
                                <td><?php echo $product['price']; ?></td>
                                <td><?php echo $product['supplier_name']; ?></td>
                                <td><?php echo $product['category_name']; ?></td>
                                <td>
                                    <a href="deleteinventory.php?id=<?php echo $product['id']; ?>">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

           
            </section>

    <!-- Your JavaScript and other scripts -->
    <!-- ... (your existing script includes) ... -->


</body>
</html>
<?php require "templates/footer.php" ;?>
