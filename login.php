<?php
    session_start();
    include 'includes/db.php';
    include 'includes/header.php';

    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            $errors[] = "Username and password are required.";
        } else {
            $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($user_id, $hashed_password);
                $stmt->fetch();

                if (password_verify($password, $hashed_password)) {
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $username;
                    header("Location: dashboard.php");
                    exit;
                } else {
                    $errors[] = "Incorrect password.";
                }
            } else {
                $errors[] = "User not found.";
            }

            $stmt->close();
        }
    }
?>

<section class="form-section animate">
  <div class="form-container">
    <h2>Login to MetaTrack</h2>

    <?php if (!empty($errors)): ?>
      <div class="form-error">
        <?php foreach ($errors as $err) echo "<p>$err</p>"; ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="login.php">
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" required>
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required>
      </div>

      <button type="submit" class="cta-button">Login</button>

      <p class="already-account">
        Don’t have an account? <a href="register.php">Register here</a>
      </p>
    </form>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
