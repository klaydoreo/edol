<?php
session_start();
include("connect.php");

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drop Bottle</title>
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
                    $email = $_SESSION['email'];
                    $query = mysqli_query($conn, "SELECT firstName, lastName FROM users WHERE email='$email'");
                    while ($row = mysqli_fetch_array($query)) {
                        echo $row['firstName'] . ' ' . $row['lastName'];
                    }
                    ?>
                </div>
                <div class="email">
                    <?php echo $_SESSION['email']; ?>
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

    <!-- Points Section -->
    <section class="points-section">
        <h2>My Points</h2>
        <div>12,000</div>
    </section>

    <!-- Main Content -->
    <main>
        <h1>Drop Bottle</h1>
        <div class="button-group">
            <button class="btn green">START</button>
            <button class="btn red">STOP</button>
        </div>
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
