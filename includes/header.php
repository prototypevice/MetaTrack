<?php
  $currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>MetaTrack</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>

<body>
  <nav>
    <div class="logo">
      <a href="<?= isset($_SESSION['user_id']) ? 'tracker_dashboard.php' : 'index.php' ?>">
        <img src="assets/images/logo.png" alt="MetaTrack Logo">
      </a>
    </div>

    <?php if (!in_array($currentPage, ['register.php', 'login.php'])): ?>
    <div class="nav-links">

    <?php if (isset($_SESSION['username'])): ?>
      <span class="greeting">Hi, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
    <?php else: ?>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    <?php endif; ?>
    
  </div>
<?php endif; ?>
  </nav>
