<?php
session_start();

require_once "php/config.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'];
    $conn = get_db_connection();

    // Retrieve user information from the users table
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_profile = $result->fetch_assoc();

    $stmt->close();

    $old_password = isset($_POST['old_password']) ? $_POST['old_password'] : null;

    if ($old_password !== null && password_verify($old_password, $user_profile['password'])) {

        // Validate and sanitize new password
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password === $confirm_password) {
            // Hash the new password before updating it in the database
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the users table
            $update_query = "UPDATE users SET password = ? WHERE id = ?";
            $stmt_update = $conn->prepare($update_query);
            $stmt_update->bind_param("si", $hashed_password, $user_id);

            if ($stmt_update->execute()) {
                $stmt_update->close();
                $conn->close();

                // Redirect back to the profile page after the update
                header("Location: profile.php");
                exit();
            } else {
                echo "Error updating password: " . $stmt_update->error;
            }
        } else {
            echo "New password and confirm password do not match.";
        }
    } else {
        echo "Incorrect old password.";
    }

    $conn->close();
}
?>
