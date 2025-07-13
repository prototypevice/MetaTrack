<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  $currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MetaTrack</title>
  <link rel="stylesheet" href="/MetaTrack/css/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
  <nav>
    <div class="logo">
      <a href="<?= isset($_SESSION['user_id']) ? '/MetaTrack/tracker/tracker_dashboard.php' : '/MetaTrack/index.php' ?>">
        <img src="/MetaTrack/assets/images/logo.png" alt="MetaTrack Logo">
      </a>
    </div>

    <?php if (!in_array($currentPage, ['register.php', 'login.php'])): ?>
      <div class="nav-links">
        <?php if (isset($_SESSION['username'])): ?>

          <div class="user-dropdown">

            <button class="user-btn" onclick="toggleDropdown()">
              Hi, <?= htmlspecialchars($_SESSION['username']) ?>
              <i class="fas fa-chevron-down dropdown-icon"></i>
            </button>

            <div class="dropdown-menu" id="userDropdown">

                <a href="/MetaTrack/settings.php" class="dropdown-item">
                  <i class="fas fa-cog"></i>
                  <span>Settings</span>
                </a>

              <div class="dropdown-toggle-item">
                <i class="fas fa-moon"></i>
                <span>Dark Mode</span>
                <label class="switch">
                  <input type="checkbox" id="darkModeToggle">
                  <span class="slider round"></span>
                </label>
              </div>

              <a href="/MetaTrack/auth/logout.php" class="dropdown-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
              </a>

            </div>

          </div>

        <?php else: ?>
          <a href="/MetaTrack/auth/login.php">Login</a>
          <a href="/MetaTrack/auth/register.php">Register</a>
        <?php endif; ?>

      </div>
    <?php endif; ?>
  </nav>
