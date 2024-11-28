<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);
$username = $is_logged_in ? htmlspecialchars($_SESSION['username']) : null;
?>


<header>
    <h1>Inventory - Maryjoy</h1>
    <hr>
    <nav>
        <a href="index.php">Home</a>

        <?php  if($is_logged_in) : ?>
            <a href="profile.php">Edit Profile</a>
            <a href="logout.php">Logout</a>

        <?php else : ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>   
        <?php endif; ?>
    </nav>
        <?php if ($is_logged_in) : ?>
            <p>Welcome, <strong> <?= $username ?></p>
        
        <?php endif; ?>

</header>