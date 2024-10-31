<?php
session_start(); // Ensure the session is started
include("navbar.php"); // Include the navigation bar
include("connect.php");

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

session_start();
include("connect.php");

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

$email = $_SESSION['email'];
$query = mysqli_query($conn, "SELECT firstName, lastName, points FROM users WHERE email='$email'");
$user = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Drop Bottle</title>
    <link rel="stylesheet" href="pages.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="user-container">
            <img src="user.png" alt="Profile Picture">
            <div class="user-info">
                <div class="name">
                    <?php 
                    echo htmlspecialchars($user['firstName'] . ' ' . $user['lastName']);
                    ?>
                </div>
                <div class="email">
                    <?php echo htmlspecialchars($email); ?>
                </div>
            </div>
        </div>

        <div class="menu">
            <i class="fas fa-bars menu-toggle"></i> Menu
            <div class="menu-content" id="menu">
                <a href="profile.php">Profile</a>
                <a href="homepage.php">Home</a>
                <a href="dashboard.php">Dashboard</a>
                <a href="bottle_log.php">Bottle Log</a>
                <a href="rewards.php">Rewards</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <h1>My Profile</h1>
        <section class="profile-container">
            <h2><?php echo htmlspecialchars($user['firstName'] . ' ' . $user['lastName']); ?></h2>
            <p>Email: <?php echo htmlspecialchars($email); ?></p>
            <p>Points: <?php echo htmlspecialchars($user['points']); ?></p>
            <a class="btn" href="homepage.php">Back to Home</a>
        </section>
    </main>

    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function () {
            const menu = document.getElementById('menu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });

        // Prevent going back to the previous page after logout
        window.history.pushState(null, '', window.location.href);
        window.onpopstate = function () {
            window.history.pushState(null, '', window.location.href);
        };
    </script>
</body>
</html>
