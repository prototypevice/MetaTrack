<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: /MetaTrack/auth/login.php");
  exit;
}

include($_SERVER['DOCUMENT_ROOT'] . '/MetaTrack/includes/header.php');
?>

<main class="settings-container">
  <h2 class="settings-title">Settings</h2>

  <div class="settings-section">
    <h3><i class="fas fa-user"></i> User Information</h3>
    <a href="/MetaTrack/settings/edit_user.php" class="settings-btn">Edit Name, Username, Password</a>
  </div>

  <div class="settings-section">
    <h3><i class="fas fa-heartbeat"></i> Health Metrics</h3>
    <a href="/MetaTrack/settings/edit_health.php" class="settings-btn">Edit Height & Weight</a>
  </div>

  <div class="settings-section">
    <h3><i class="fas fa-sign-out-alt"></i> Log Out</h3>
    <a href="/MetaTrack/auth/logout.php" class="settings-btn logout">Log Out of MetaTrack</a>
  </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/MetaTrack/includes/footer.php'); ?>
