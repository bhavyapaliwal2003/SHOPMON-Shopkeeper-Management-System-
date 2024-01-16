<?php
require_once('config.php');

// Function to authenticate user
function authenticate_user($username, $password) {
    // Hash the password before comparing with the database
    $hashed_password = hash_password($password);

    $conn = get_db_connection();

    $stmt = $conn->prepare('SELECT id, username FROM users WHERE username = ? AND password = ?');
    $stmt->bind_param('ss', $username, $hashed_password);

    echo "Attempting to authenticate user<br>";
    echo "Username: $username, Hashed Password: $hashed_password<br>";

    $stmt_result = $stmt->execute();

    if (!$stmt_result) {
        die("Error: " . $stmt->error);
    }

    $stmt->bind_result($user_id, $username);

    $stmt->fetch();
    echo "Stored Hashed Password from Database: $hashed_password<br>";


if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
    echo "Password verification successful<br>";
}

    if ($stmt->num_rows > 0) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;

        session_regenerate_id(true);

        $stmt->close();
        $conn->close();

        echo "Authentication successful<br>";

        return true;
    }

    $stmt->close();
    $conn->close();

    echo "Authentication failed<br>";

    return false;
}

// Function to create a new user in the database
function create_user($username, $hashed_password) {
    $conn = get_db_connection();

    $stmt = $conn->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $stmt->bind_param('ss', $username, $hashed_password);

    $result = $stmt->execute();

    if (!$result) {
        die("Error creating user: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();

    return $result;
}

// Function to check if a user is authenticated
function is_authenticated() {
    return isset($_SESSION['user_id']);
}

// Function to hash a password using the bcrypt algorithm
function hash_password($password) {
    $options = [
        'cost' => 10, 
    ];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

    return $hashed_password;
}
?>
