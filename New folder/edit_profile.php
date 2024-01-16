<?php
session_start();

require_once "php/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$conn = get_db_connection();

// Retrieve user profile information from the users table
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_profile = $result->fetch_assoc();
$stmt->close();

// Retrieve additional user profile information from the user_profile table
$query_profile = "SELECT * FROM user_profile WHERE user_id = ?";
$stmt_profile = $conn->prepare($query_profile);
$stmt_profile->bind_param("i", $user_id);
$stmt_profile->execute();
$result_profile = $stmt_profile->get_result();

// Fetch user profile data from user_profile table
$user_profile_additional = $result_profile->fetch_assoc();

$stmt_profile->close();

$conn->close();

require "templates/header.php" ;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">
    <title>Edit Profile</title>
</head>

<body>
    <br>
    <div class="container">
        <h2>Edit Profile</h2>

        <form action="update_profile.php" method="post">
            <!-- You can include the existing user profile data in the form for editing -->
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $user_profile['username']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($user_profile_additional['email_id']) ? $user_profile_additional['email_id'] : ''; ?>">

            <!-- Check if $user_profile_additional is set before accessing its values -->
            <?php if (isset($user_profile_additional)): ?>
                <label for="shop_name">Shop Name:</label>
                <input type="text" id="shop_name" name="shop_name" value="<?php echo $user_profile_additional['shop_name']; ?>">
            <?php else: ?>
                <p>Additional profile information not available.</p>
            <?php endif; ?>
<br> <br>
            <button type="submit" class="btn hover-top btn-collab">Save Changes</button>
        </form>
    </div>
    <br>
</body>

</html>
<?php require "templates/footer.php" ;?>
