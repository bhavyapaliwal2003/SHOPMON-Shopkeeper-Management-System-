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

    // Retrieve additional user profile information from the user_profile table
    $query_profile = "SELECT * FROM user_profile WHERE user_id = ?";
    $stmt_profile = $conn->prepare($query_profile);
    $stmt_profile->bind_param("i", $user_id);
    $stmt_profile->execute();
    $result_profile = $stmt_profile->get_result();

    // Fetch user profile data from user_profile table
    $user_profile_additional = $result_profile->fetch_assoc();

    if (!$user_profile_additional) {
        // If the user doesn't have a profile, insert a new record
        $insert_query = "INSERT INTO user_profile (user_id, shop_name) VALUES (?, ?)";
        $stmt_insert = $conn->prepare($insert_query);
        $stmt_insert->bind_param("is", $user_id, $_POST['shop_name']);

        if ($stmt_insert->execute()) {
            $stmt_insert->close();
        } else {
            echo "Error executing insert query: " . $stmt_insert->error;
        }
    } else {
        // If the user already has a profile, update the existing record
        $update_query = "UPDATE user_profile SET shop_name = ? WHERE user_id = ?";
        $stmt_update = $conn->prepare($update_query);
        $stmt_update->bind_param("si", $_POST['shop_name'], $user_id);

        if ($stmt_update->execute()) {
            $stmt_update->close();
        } else {
            echo "Error executing update query: " . $stmt_update->error;
        }
    }

    $stmt_profile->close();
    $conn->close();

    header("Location: profile.php");
    exit();
}
?>
