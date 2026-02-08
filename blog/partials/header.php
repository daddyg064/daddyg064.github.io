<?php
require_once __DIR__ . '/../config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$logged_in = !empty($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars(SITE_NAME); ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/style.css">
</head>
<body>
    <div class="app">
        <aside class="sidebar">
            <div class="brand">
                <div class="logo">B</div>
                <div>
                    <h1><?php echo htmlspecialchars(SITE_NAME); ?></h1>
                    <p><?php echo htmlspecialchars(SITE_TAGLINE); ?></p>
                </div>
            </div>
            <nav class="menu">
                <a href="<?php echo BASE_URL; ?>/index.php">Home</a>
                <?php if ($logged_in) : ?>
                    <a href="<?php echo BASE_URL; ?>/dashboard.php">Dashboard</a>
                    <a href="<?php echo BASE_URL; ?>/logout.php">Log out</a>
                <?php else : ?>
                    <a href="<?php echo BASE_URL; ?>/login.php">Log in</a>
                <?php endif; ?>
            </nav>
            <button class="theme-toggle" type="button" data-theme-toggle>
                <span>Toggle dark mode</span>
            </button>
        </aside>
        <main class="content">
