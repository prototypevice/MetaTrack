<?php
// main dash
  session_start();

  if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
  }
?>

<?php include 'includes/header.php'; ?>

  <div class="success-page">
    <div class="success-login-container animate">
      <img src="assets/images/icons/checkmark.svg" alt="Success Icon" class="success-icon">
      <h2>Welcome back to <span class="brand">MetaTrack</span>!</h2>
      <p class="success-message">You’ve successfully logged in. Let’s continue your health journey.</p>
      <a href="tracker_dashboard.php" class="cta-button-alt">Go to Your Dashboard</a>
    </div>
  </div>

<?php include 'includes/footer.php'; ?>
