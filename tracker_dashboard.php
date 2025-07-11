<?php
    session_start();
    require_once 'includes/db.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];

    $check = $conn->prepare("SELECT id FROM user_profiles WHERE user_id = ?");
    $check->bind_param("i", $user_id);
    $check->execute();
    $checkResult = $check->get_result();

    if ($checkResult->num_rows > 0) {
        header("Location: tracker/transition.php");
        exit;
    }

    $stmt = $conn->prepare("SELECT gender, birthdate, full_name FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "User not found.";
        exit;
    }

    $gender = $user['gender'];
    $birthdate = new DateTime($user['birthdate']);
    $today = new DateTime();
    $age = $today->diff($birthdate)->y;
    $full_name = htmlspecialchars($user['full_name']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['height'], $_POST['weight'])) {
        $height = floatval($_POST['height']);
        $weight = floatval($_POST['weight']);

        $insert = $conn->prepare("INSERT INTO user_profiles (user_id, height, weight) VALUES (?, ?, ?)");
        $insert->bind_param("idd", $user_id, $height, $weight);
        $insert->execute();

        header("Location: tracker/transition.php");
        exit;
    }
?>

<?php include 'includes/header.php'; ?>

<link rel="stylesheet" href="css/profile.css">
<section class="profile-section animate">
  <div class="profile-container">
    <h2>Welcome, <?= $full_name ?>!</h2>
    <p>Your gender: <strong><?= $gender ?></strong></p>
    <p>Your age: <strong><?= $age ?> years</strong></p>

    <?php if (!empty($success)): ?>
      <div class="success-message"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST" class="profile-form">
      <div class="form-group">
        <label for="height">Height (in cm):</label>
        <input type="number" step="0.1" name="height" id="height" required>
      </div>

      <div class="form-group">
        <label for="weight">Weight (in kg):</label>
        <input type="number" step="0.1" name="weight" id="weight" required>
      </div>

      <button type="submit" class="cta-button">Save Profile</button>
    </form>

  </div>
</section>

<?php include 'includes/footer.php'; ?>
