<?php
    $currentPage = basename($_SERVER['PHP_SELF']);
?>

<?php if (!in_array($currentPage, ['login.php', 'register.php'])): ?>
  <footer class="site-footer">
    <div class="footer-container">

      <div class="footer-brand">
        <img src="assets/images/logo.png" alt="MetaTrack Logo">
        <p>Your wellness journey, simplified.</p>
      </div>

      <div class="footer-links">
        <h4>Quick Links</h4>

        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="register.php">Register</a></li>
          <li><a href="login.php">Login</a></li>
          <li><a href="#faq">FAQs</a></li>
        </ul>

      </div>

      <div class="footer-contact">
        <h4>Contact</h4>
        <p>Email: support@metatrack.com</p>
        <p>Made with 💚 for your health</p>
      </div>

    </div>

    <div class="footer-bottom">
      <p>&copy; <?= date("Y") ?> MetaTrack. All rights reserved.</p>
    </div>

  </footer>

<?php endif; ?>

    <script src="js/scripts.js"></script>
    </body>
</html>
