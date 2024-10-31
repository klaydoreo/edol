<?php

include("navbar.php");

$email = $_SESSION['email'];
$query = mysqli_query($conn, "SELECT * FROM bottle_log WHERE email='$email' ORDER BY date DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Drop Bottle</title>
    <link rel="stylesheet" href="pages.css">
</head>
<body>
    <header>
        <h1>Dashboard</h1>
    </header>
    <section class="dashboard-container">
        <h2>Recent Activity</h2>
        <ul>
            <?php while ($log = mysqli_fetch_array($query)) { ?>
                <li><?php echo $log['bottle_type']; ?> bottle: <?php echo $log['weight']; ?>g - <?php echo $log['points']; ?> points</li>
            <?php } ?>
        </ul>
        <a href="homepage.php">Back to Home</a>
    </section>
</body>
</html>
