<?php
  session_start();

  if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
  }
?>

<?php include 'includes/header.php'; ?>
  <meta http-equiv="refresh" content="5;URL='tracker_dashboard.php'">

  <link rel="stylesheet" href="css/login-success.css">
  <script src="js/login-timer.js" defer></script>

  <div class="success-page">
    <div class="success-login-container animate">
      <img src="assets/images/icons/checkmark.svg" alt="Success Icon" class="success-icon">
      <h2>Welcome back to <span class="brand">MetaTrack</span>!</h2>
      <p class="success-message">You've successfully logged in. Let's continue your health journey.</p>

      <div class="redirect-timer">

        <svg width="80" height="80" viewBox="0 0 100 100">
          <circle class="circle-bg" cx="50" cy="50" r="45" />
          <circle class="circle-progress" cx="50" cy="50" r="45" />
        </svg>

        <div class="timer-text" id="timer">5</div>

      </div>


      <a href="tracker_dashboard.php" class="cta-button-alt" style="margin-top: 20px;">Go to Your Dashboard</a>
    </div>
  </div>

<?php include 'includes/footer.php'; ?>
