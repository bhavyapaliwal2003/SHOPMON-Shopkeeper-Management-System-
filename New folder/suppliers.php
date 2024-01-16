<?php
session_start();
require_once('php/function.php');
require_once('php/auth.php');


if (!is_authenticated()) {
    header("Location: login.php");
    exit();
}

// Handle the form submission to add a new supplier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_supplier'])) {
    $supplier_name = $_POST['supplier_name'];
    $contact_person = $_POST['contact_person'];
    $category_id = $_POST['category_id'];  // Add this line to get the category ID

    // Validation (add more as needed)
    if (empty($supplier_name) || empty($contact_person) || empty($category_id)) {
        $error_message = "All fields are required.";
    } else {
// Call the function to add the supplier
$result = add_supplier($_SESSION['user_id'], $supplier_name, $contact_person, $category_id);

        if ($result) {
            $success_message = "Supplier added successfully.";
        } else {
            $error_message = "Failed to add the supplier. Please try again.";
        }
    }
}

// Get the user's supplier list
$supplier_list = get_supplier_list($_SESSION['user_id']);
require "templates/header.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/supplier.css">
    <title>Supplier List</title>
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
<br>
<section id="inventory" class="py-6" style="background:linear-gradient(180deg, #FFFEFC -54.51%, #FFF8F0 99.98%);" class="py-5">
<div class="addinventory-form">
    <h2>Add a New Supplier</h2>
    <?php if (isset($error_message)): ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <?php if (isset($success_message)): ?>
        <p class="success-message"><?php echo $success_message; ?></p>
    <?php endif; ?>
    <form method="post" action="suppliers.php">
        <label for="supplier_name">Supplier Name:</label>
        <input type="text" id="supplier_name" name="supplier_name" required>

        <label for="contact_person">Contact Person:</label>
        <input type="text" id="contact_person" name="contact_person" required>
        <label for="category_id">Category:</label>
    <select id="category_id" name="category_id" required>
        <?php
        $categories = get_categories();
        foreach ($categories as $category):
        ?>
            <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category']; ?></option>
        <?php endforeach; ?>
    </select>
<br> <br>
        <button type="submit" name="add_supplier">Add Supplier</button>
    </form>
</div>
<br>
<div class="table-responsive inventory-table">
<h2 class="text-center fw-bold mb-5">List Of Suppliers</h2><div class="table-responsive inventory-table">
               
<?php if (isset($supplier_list) && is_array($supplier_list) && !empty($supplier_list)): ?>
    <table class="table table-bordered table-striped">
                    <thead class="table-light">
            <tr>
                <th>Supplier Name</th>
                <th>Mobile Number</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($supplier_list as $supplier): ?>
                <tr>
                    <td><?php echo $supplier['supplier_name']; ?></td>
                    <td><?php echo $supplier['mobilenumber']; ?></td>
                    <td><?php echo $supplier['category_name']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="no-suppliers">No suppliers found.</p>
<?php endif; ?>
</div>
</section>
</body>
</html>

<?php require "templates/footer.php"; ?>
