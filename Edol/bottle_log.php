<?php
session_start();
include("connect.php");

include("navbar.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$query = mysqli_query($conn, "SELECT * FROM bottle_log WHERE email='$email' ORDER BY date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bottle Log - Drop Bottle</title>
    <link rel="stylesheet" href="pages.css">
</head>
<body>
    <header>
        <h1>Bottle Log</h1>
    </header>
    <section class="log-container">
        <ul>
            <?php while ($log = mysqli_fetch_array($query)) { ?>
                <li>
                    Date: <?php echo $log['date']; ?> - 
                    <?php echo $log['bottle_type']; ?>: <?php echo $log['weight']; ?>g - 
                    Points Earned: <?php echo $log['points']; ?>
                </li>
            <?php } ?>
        </ul>
        <a href="homepage.php">Back to Home</a>
    </section>
</body>
</html>
