<?php
session_start();

require_once "php/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$conn = get_db_connection();

$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_profile = $result->fetch_assoc();
$stmt->close();
$conn->close();
require "templates/header.php" ;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/profile.css">
    <style>
        /* Reset some default styles */
body, h1, h2, p, ul, li {
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
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
/* Form styles */
form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 8px;
    color: #333;
}

input {
    padding: 10px;
    margin-bottom: 15px;
    box-sizing: border-box;
}

button {
    background-color: #3498db;
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #2980b9;
}

/* Responsive styles */
@media (max-width: 768px) {
    .profile-info {
        padding: 10px;
    }

    input {
        width: calc(100% - 20px);
    }
}
    </style>
    </head>

        <body>
            <br>
            <div class="addinventory-form">
                <h2>Change Password</h2>
                    <form action="update_password.php" method="post">

                        <label for="old_password">Old Password:</label>
                        <input type="password" id="old_password" name="old_password" required>

                        <label for="new_password">New Password:</label>
                        <input type="password" id="new_password" name="new_password" required>

                        <label for="confirm_password">Confirm New Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
<br>
                        <button type="submit" class="btn hover-top btn-collab">  Change Password </button>

                    </form>
                </div>
            <br>
        </body>
    </html>
<?php require "templates/footer.php" ;?>
