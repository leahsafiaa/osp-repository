<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db.php'; ?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<header class="navbar">
    <div class="nav-left">
        <a href="index.php" class="logo">GHB</a>

        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="shop.php">Shop</a>
            <a href="farmprofiles.php">Farm Profiles</a>
            <a href="about.php">About Us</a>
        </nav>
    </div>

    <div class="nav-right">
        <a href="search.php" class="icon-link" aria-label="Search">
            <i class="fa-solid fa-magnifying-glass"></i>
        </a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="profile.php" class="icon-link" aria-label="Profile">
                <i class="fa-solid fa-user"></i>
            </a>
            <a href="logout.php" class="login-link">Log Out</a>
        <?php else: ?>
            <a href="login.php" class="login-link">Log In</a>
            <a href="signup.php" class="signup-btn">Sign Up For Free</a>
        <?php endif; ?>
    </div>
</header>