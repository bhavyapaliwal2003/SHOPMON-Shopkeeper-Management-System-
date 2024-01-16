<?php
session_start();

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
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/theme.css">
    <style>
        .dashboard-card {
            border: 2px solid #ff8c00;
            padding: 20px;
            border-radius: 8px;
            transition: border-color 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .dashboard-header {
            background-color: #333;
            color: white;
            
            padding: 20px;
            font-size: large;
            margin-bottom: 20px;
        }

        .dashboard-header h1 {
            margin: 0;
        }

        .dashboard-content {
            padding: 20px;
        }

        .dashboard-card:hover {
            border-color: #e07b00; /* darker shade of orange for hover effect */
            transform: scale(1.03);
        }

        .dashboard-card h4,
        .dashboard-card p {
            margin: 0;
            color: #333;
        }

        .dashboard-card a {
            text-decoration: none;
            color: #ff8c00; /* set link color to match hover effect */
            transition: color 0.3s ease;
            display: block;
        }

        .dashboard-card a:hover {
            color: #e07b00; /* change link color on hover */
        }
    </style>
</head>

<body>

    <?php require "templates/header.php" ?>

    <main>
        <header class="dashboard-header btn-collab">
            <h1 align  = "center">Your Dashboard</h1>
        </header>

        <section class="content">
            <div class="container">
                <div class="functionality-links row">
                    <div class="col-md-6 col-lg-3 mt-4 text-center text-md-start">
                        <a href="inventory.php" class="dashboard-link">
                            <div class="dashboard-card  btn-collab">
                                <h4 class="mt-5 mb-3 fw-bold">Inventory</h4>
                                <p class="fs-1 lh-sm">Manage your inventory efficiently, track stock levels, and streamline your supply chain.</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3 mt-4 text-center text-md-start">
                        <a href="transaction.php" class="dashboard-link">
                            <div class="dashboard-card btn-collab">
                                <h4 class="mt-5 mb-3 fw-bold">Transactions</h4>
                                <p class="fs-1 lh-sm">Record and manage transactions seamlessly, keeping track of sales and purchases.</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3 mt-4 text-center text-md-start">
                        <a href="reports.php" class="dashboard-link">
                            <div class="dashboard-card btn-collab">
                                <h4 class="mt-5 mb-3 fw-bold">Reports</h4>
                                <p class="fs-1 lh-sm">Generate and analyze detailed reports to gain insights into your
                                     business performance and profit.</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3 mt-4 text-center text-md-start">
                        <a href="suppliers.php" class="dashboard-link">
                            <div class="dashboard-card btn-collab">
                                <h4 class="mt-5 mb-3 fw-bold">Suppliers</h4>
                                <p class="fs-1 lh-sm">Manage your relationships with suppliers and ensure a smooth procurement process.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php require "templates/footer.php" ?>

</body>

</html>
