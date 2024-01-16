<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop Management System</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
  <link rel="stylesheet" href="css/template.css">
  <link rel="stylesheet" href="theme.css">
</head>

<body>
  <header class="d-flex flex-wrap justify-content-between align-items-center">
    <div class="d-flex align-items-center">
      <a class="navbar-brand" href="dashboard.php">
        <i class="fas fa-store"></i> <span style="font-size: 32px;">SHOPMON</span>
      </a>
      <h1>Welcome, <?php echo $username; ?>!</h1>
    </div>

    <ul class="navbar-nav d-flex align-items-center">
      <li >
          <a  href="profile.php"><i class='fas fa-user-alt' style='font-size:30px;color:red'></i>  </a> </li>
      
          <li>
          <a  href="templates/logout.php">   <i class="fa fa-sign-out" style='font-size:30px;color:red' ></i> </a></li>
    </ul>
  </header>
</body>
</html>
