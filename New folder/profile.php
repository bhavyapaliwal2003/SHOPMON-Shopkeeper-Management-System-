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

$query_profile = "SELECT * FROM user_profile WHERE user_id = ?";
$stmt_profile = $conn->prepare($query_profile);
$stmt_profile->bind_param("i", $user_id);
$stmt_profile->execute();
$result_profile = $stmt_profile->get_result();

if ($result_profile->num_rows > 0) {
    $user_profile_additional = $result_profile->fetch_assoc();

    $shop_name = isset($user_profile_additional['shop_name']) ? $user_profile_additional['shop_name'] : "N/A";
    $email_id = isset($user_profile_additional['email_id']) ? $user_profile_additional['email_id'] : "N/A";
    $other_detail = isset($user_profile_additional['other_detail']) ? $user_profile_additional['other_detail'] : "N/A";

    $stmt_profile->close();
} else {
    $shop_name = "N/A";
    $email_id = "N/A";
    $other_detail = "N/A";
}

$conn->close();


require "templates/header.php" ;
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/profile.css">
  <link rel="stylesheet" href="css/theme.css">
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

  <title>User Profile</title>

</head>

<body>
<br>
       
 <div class="addinventory-form">
    <h2>User Profile</h2>

    <div class="profile-info">
      <p><strong>Name:</strong> <?php echo $user_profile['username']; ?></p>
      <p><strong>Shop Name:</strong> <?php echo $shop_name; ?></p>
      <p><strong>Email ID:</strong> <?php echo $email_id; ?></p>
      <p><strong>Other Detail:</strong> <?php echo $other_detail; ?></p>
    </div>

    <div class="profile-actions">
      <a href="edit_profile.php" class="btn hover-top btn-collab">Edit Profile</a>
      <a href="change_password.php" class="btn hover-top btn-collab">Change Password</a>
    </div>
  </div>
  <br>
</body>

</html>

<?php require "templates/footer.php" ;?>