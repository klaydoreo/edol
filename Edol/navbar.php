<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Get the current page to dynamically exclude it from the dropdown
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<header>
    <div class="header-container">
        <div class="user-container">
            <img alt="Profile picture" class="rounded-full" height="50" src="user.png" width="50"/>
            <div class="user-info">
                <div class="name">
                    <?php 
                    include("connect.php");
                    $email = $_SESSION['email'];
                    $query = mysqli_query($conn, "SELECT firstName, lastName FROM users WHERE email='$email'");
                    if ($row = mysqli_fetch_array($query)) {
                        echo $row['firstName'] . ' ' . $row['lastName'];
                    }
                    ?>
                </div>
                <div class="email"><?php echo $_SESSION['email']; ?></div>
            </div>
        </div>
        <div class="menu">
            <i class="fas fa-bars menu-toggle"></i> Menu
            <div class="menu-content" id="menu">
                <?php if ($currentPage != 'profile.php') { ?>
                    <a href="profile.php">Profile</a>
                <?php } ?>
                <?php if ($currentPage != 'dashboard.php') { ?>
                    <a href="dashboard.php">Dashboard</a>
                <?php } ?>
                <?php if ($currentPage != 'bottle_log.php') { ?>
                    <a href="bottle_log.php">Bottle Log</a>
                <?php } ?>
                <?php if ($currentPage != 'rewards.php') { ?>
                    <a href="rewards.php">Rewards</a>
                <?php } ?>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</header>
<link rel="stylesheet" href="pages.css">
<script>
    document.querySelector('.menu-toggle').addEventListener('click', function() {
        var menu = document.getElementById('menu');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });

    // Prevent going back after logout
    window.history.pushState(null, '', window.location.href);
    window.onpopstate = function() {
        window.history.pushState(null, '', window.location.href);
    };
</script>
