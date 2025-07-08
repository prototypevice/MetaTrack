<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
?>

<?php
    include 'includes/header.php';

    try {
        $db = new PDO('mysql:host=localhost;dbname=calorie_tracker;charset=utf8', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die('Database error: ' . $e->getMessage());
    }

    // Default macro goals
    $_SESSION['proteinGoal'] = $_SESSION['proteinGoal'] ?? 100;
    $_SESSION['fatGoal'] = $_SESSION['fatGoal'] ?? 70;
    $_SESSION['carbGoal'] = $_SESSION['carbGoal'] ?? 300;
    $_SESSION['bmr'] = $_SESSION['bmr'] ?? 2000;
    $_SESSION['bmrAdjustment'] = $_SESSION['bmrAdjustment'] ?? 1.0;

    $selectedDate = $_GET['date'] ?? date('Y-m-d');

    // REMOVE FOOD
    if (isset($_POST['remove_id'])) {
        $db->prepare("DELETE FROM intake_history WHERE id = ? AND user_id = ?")
        ->execute([intval($_POST['remove_id']), $_SESSION['user_id']]);
        header("Location: tracker_dashboard.php?date=$selectedDate#intake");
        exit;
    }

    // ADD FOOD
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['food'], $_POST['grams'])) {
        $foodName = trim($_POST['food']);
        $grams = floatval($_POST['grams']);
        $stmt = $db->prepare("SELECT * FROM foods WHERE name = ?");
        $stmt->execute([$foodName]);
        if ($food = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $m = $grams / 100;
            $db->prepare("INSERT INTO intake_history (user_id, date, food_name, grams, calories, protein, fat, carbs)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)")
            ->execute([$_SESSION['user_id'], $selectedDate, $foodName, $grams,
                        $food['calories'] * $m, $food['protein'] * $m,
                        $food['fat'] * $m, $food['carbs'] * $m]);
        }
        header("Location: tracker_dashboard.php?date=$selectedDate#intake");
        exit;
    }

    // UPDATE BMR and MACROS
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['weight'], $_POST['height'], $_POST['age'], $_POST['gender'])) {
            $w = floatval($_POST['weight']);
            $h = floatval($_POST['height']);
            $a = intval($_POST['age']);
            $_SESSION['bmr'] = ($_POST['gender'] === "male")
                ? 10*$w + 6.25*$h - 5*$a + 5
                : 10*$w + 6.25*$h - 5*$a -161;
        }
        if (isset($_POST['proteinGoal'], $_POST['fatGoal'], $_POST['carbGoal'])) {
            $_SESSION['proteinGoal'] = floatval($_POST['proteinGoal']);
            $_SESSION['fatGoal'] = floatval($_POST['fatGoal']);
            $_SESSION['carbGoal'] = floatval($_POST['carbGoal']);
        }
        if (isset($_POST['adjustBMR'])) {
            $_SESSION['bmrAdjustment'] = floatval($_POST['adjustBMR']);
        }
    }

    // LOAD FOOD AND HISTORY
    $foods = $db->query("SELECT * FROM foods ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
    $totals = ['calories'=>0,'protein'=>0,'fat'=>0,'carbs'=>0];
    $history = [];
    $stmt = $db->prepare("SELECT * FROM intake_history WHERE user_id = ? AND date = ? ORDER BY id DESC");
    $stmt->execute([$_SESSION['user_id'], $selectedDate]);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $history[] = $row;
        $totals['calories'] += $row['calories'];
        $totals['protein'] += $row['protein'];
        $totals['fat'] += $row['fat'];
        $totals['carbs'] += $row['carbs'];
    }

    $bmr = $_SESSION['bmr'] * $_SESSION['bmrAdjustment'];

    if ($bmr > 0) {
        $percent = min(100, ($totals['calories']/$bmr)*100);
        $remaining = intval($bmr - $totals['calories']);
    } else {
        $percent = 0;
        $remaining = 0;
    }

    $proteinPercent = ($_SESSION['proteinGoal'] > 0) ? min(100, ($totals['protein']/$_SESSION['proteinGoal'])*100) : 0;
    $fatPercent = ($_SESSION['fatGoal'] > 0) ? min(100, ($totals['fat']/$_SESSION['fatGoal'])*100) : 0;
    $carbPercent = ($_SESSION['carbGoal'] > 0) ? min(100, ($totals['carbs']/$_SESSION['carbGoal'])*100) : 0;

    $proteinRemaining = max(0, $_SESSION['proteinGoal'] - $totals['protein']);
    $fatRemaining = max(0, $_SESSION['fatGoal'] - $totals['fat']);
    $carbRemaining = max(0, $_SESSION['carbGoal'] - $totals['carbs']);



    $today = date('Y-m-d');
    $yesterday = date('Y-m-d', strtotime('-1 day'));
    $tomorrow = date('Y-m-d', strtotime('+1 day'));
    $displayTitle = ($selectedDate == $today) ? 'Today' : (($selectedDate == $yesterday) ? 'Yesterday' : (($selectedDate == $tomorrow) ? 'Tomorrow' : $selectedDate));

    $caloriesGoalMet = $totals['calories'] <= $bmr ? '✅ Met' : '❌ Exceeded';
    $proteinGoalMet = $totals['protein'] >= $_SESSION['proteinGoal'] ? '✅ Met' : '❌ Not Met';
?>

<?php include 'includes/header_tracker.php'; ?>
<?php include 'includes/macro_circles.php'; ?>

<button onclick="openDrawer()" class="input-form-button">Add Food</button>
<button onclick="openIntakeDrawer()" class="input-form-button" style="position:fixed;bottom:20px;left:20px;">View Intake</button>
<a href="index.php" class="input-form-button" style="display:inline-block;margin-left:10px;">Log-Out</a>

<div class="forms-section">
    <h2>Calculate BMR</h2>
    <form method="post" class="input-form">
        <input type="number" name="weight" step="0.1" placeholder="Weight (kg)" required>
        <input type="number" name="height" placeholder="Height (cm)" required>
        <input type="number" name="age" placeholder="Age" required>
        <select name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        <button type="submit">Calculate</button>
    </form>
    <div><strong>Your BMR:</strong> <?= intval($bmr) ?> kcal/day </div>

    <h2>Set Macro Goals</h2>
    <form method="post" class="macro-goals-form">
        <div>
            <label for="proteinGoal">Protein (g)</label>
            <input type="number" step="0.1" id="proteinGoal" name="proteinGoal" placeholder="Protein (g)" value="<?= $_SESSION['proteinGoal'] ?>">
        </div>
        <div>
            <label for="fatGoal">Fat (g)</label>
            <input type="number" step="0.1" id="fatGoal" name="fatGoal" placeholder="Fat (g)" value="<?= $_SESSION['fatGoal'] ?>">
        </div>
        <div>
            <label for="carbGoal">Carbs (g)</label>
            <input type="number" step="0.1" id="carbGoal" name="carbGoal" placeholder="Carbs (g)" value="<?= $_SESSION['carbGoal'] ?>">
        </div>
        <button type="submit">Save Goals</button>
    </form>

    <h2>Adjust Calories</h2>
    <form method="post" class="macro-goals-form">
        <button type="submit" name="adjustBMR" value="0.8">Major Deficit</button>
        <button type="submit" name="adjustBMR" value="0.9">Slight Deficit</button>
        <button type="submit" name="adjustBMR" value="1.0">Maintenance</button>
        <button type="submit" name="adjustBMR" value="1.1">Slight Surplus</button>
        <button type="submit" name="adjustBMR" value="1.2">Major Surplus</button>
    </form>
</div>

<div id="drawer" class="drawer">
    <div class="drawer-close" onclick="closeDrawer()">×</div>
    <input type="text" id="foodSearch" placeholder="Search food." oninput="filterFoods()" 
           style="width:80%;padding:8px;margin-bottom:10px;border-radius:5px;border:1px solid #ccc;">
    <div class="drawer-food-list" id="foodList">
        <?php foreach ($foods as $food): ?>
            <button class="food-btn" data-name="<?= strtolower(htmlspecialchars($food['name'])) ?>"
                    onclick='showNutrition(<?= json_encode($food) ?>)'>
                <?= htmlspecialchars($food['name']) ?>
            </button>
        <?php endforeach; ?>
    </div>
</div>

<div id="nutritionDrawer" class="nutrition-drawer">
    <div class="nutrition-header">
        <h3>Nutrition</h3>
        <span onclick="closeNutritionDrawer()">×</span>
    </div>
    <div class="nutrition" id="nutritionDetails"></div>
    <form method="post" id="addFoodForm" style="margin-top:20px;">
        <input type="hidden" name="food" id="foodInput">
        <input type="number" name="grams" placeholder="Grams" required 
               style="padding:8px;border-radius:5px;border:1px solid #ccc;">
        <button type="submit" class="add-btn">Add</button>
    </form>
</div>

<?php include 'includes/intake_list.php'; ?>
<?php include 'includes/footer_tracker.php'; ?>
