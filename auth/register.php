<?php include '../includes/db.php'; ?>
<?php include '../includes/header.php'; ?>

<?php
    $errors = [];
    $success = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $full_name = trim($_POST['full_name']);
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $birthdate = $_POST['birthdate'];

        $passwordPattern = '/^(?=.*[A-Z])(?=.*\d).{8,}$/'; // regex: at least 8 chars, one uppercase, one number

        if (empty($full_name) || empty($username) || empty($password) || empty($gender) || empty($birthdate)) {
            $errors[] = "All fields are required.";

        } elseif (!preg_match($passwordPattern, $password)) {
        $errors[] = "Password must be at least 8 characters long, contain at least one uppercase letter and one number.";
        
        }  else {
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $errors[] = "Username already exists.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (full_name, username, password, gender, birthdate) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $full_name, $username, $hashed_password, $gender, $birthdate);
                if ($stmt->execute()) {
                    $success = "Registration successful! <a href='login.php'>Login here</a>.";
                } else {
                    $errors[] = "Something went wrong. Please try again.";
                }
            }
            $stmt->close();
        }
    }
?>

<section class="form-section animate">
  <div class="form-container">
    <h2>Register for MetaTrack</h2>

    <?php if (!empty($errors)): ?>
      <div class="form-error">
        <ul>
          <?php foreach ($errors as $err): ?>
            <li><?= htmlspecialchars($err) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="form-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST" action="register.php">
      <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="full_name" required>
      </div>

      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" required>
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required>
      </div>

      <div class="form-group">
        <label>Gender</label>
        <select name="gender" required>
          <option value="">Select</option>
          <option>Male</option>
          <option>Female</option>
          <option>Other</option>
        </select>
      </div>

      <div class="form-group">
        <label>Birthdate</label>
        <input type="date" name="birthdate" required>
      </div>

      <button type="submit" class="cta-button">Register</button>
      
      <p class="already-account">
        Already have an account? <a href="login.php">Log in here</a>
      </p>
    </form>
  </div>
</section>

<?php include '../includes/footer.php'; ?>
