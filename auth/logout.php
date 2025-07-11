<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logging Out | MetaTrack</title>
  <link rel="stylesheet" href="/MetaTrack/css/styles.css">
  <link rel="stylesheet" href="/MetaTrack/css/styles.css">
  <link rel="stylesheet" href="/MetaTrack/css/logout.css">
</head>
<body>
  <div class="logout-modal" id="logoutModal">
    <h1>You’ve been logged out</h1>
    <p>Stay strong. Keep moving. You’re one step closer to your goals! 💪</p>

    <svg class="svg-spinner" viewBox="25 25 50 50">
      <circle cx="50" cy="50" r="20"></circle>
    </svg>

    <a href="/MetaTrack/auth/login.php">
      <button class="login-again-btn">Login Again</button>
    </a>
  </div>
  <script src="/MetaTrack/js/logout.js"></script>
</body>
</html>
