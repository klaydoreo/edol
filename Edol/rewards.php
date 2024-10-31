<?php
include("navbar.php");


$email = $_SESSION['email'];
$query = mysqli_query($conn, "SELECT points FROM users WHERE email='$email'");
$user = mysqli_fetch_array($query);
$rewards = mysqli_query($conn, "SELECT * FROM rewards");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rewards - Drop Bottle</title>
    <link rel="stylesheet" href="pages.css">
</head>
<body>
    <header>
        <h1>Rewards</h1>
    </header>
    <section class="rewards-container">
        <p>Your Points: <?php echo $user['points']; ?></p>
        <ul>
            <?php while ($reward = mysqli_fetch_array($rewards)) { ?>
                <li>
                    <?php echo $reward['name']; ?> - <?php echo $reward['points_required']; ?> points
                    <?php if ($user['points'] >= $reward['points_required']) { ?>
                        <a href="redeem.php?reward_id=<?php echo $reward['id']; ?>">Redeem</a>
                    <?php } else { ?>
                        <span>Not enough points</span>
                    <?php } ?>
                </li>
            <?php } ?>
        </ul>
        <a href="homepage.php">Back to Home</a>
    </section>
</body>
</html>
