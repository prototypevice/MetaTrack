<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: /MetaTrack/auth/login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Redirecting - MetaTrack</title>
  <link rel="stylesheet" href="/MetaTrack/css/transition.css">
</head>
<body>
  <div class="transition-fullscreen">
    <div class="fade-in-content">
      <img src="/MetaTrack/assets/images/logo.png" alt="MetaTrack Logo" class="transition-logo">
      <h1 class="fade-text">Welcome to <span class="brand">MetaTrack</span></h1>
      <p class="fade-subtext">Track. Achieve. Thrive.</p>
    </div>
  </div>

  <script>
    setTimeout(() => {
      window.location.href = "/MetaTrack/tracker/main_dashboard.php";
    }, 4000);
  </script>
</body>
</html>
