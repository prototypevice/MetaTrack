<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    $db = new PDO('mysql:host=localhost;dbname=calorie_tracker;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $foods = $db->query("SELECT * FROM foods ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['food'], $_POST['grams'])) {
        $foodName = trim($_POST['food']);
        $grams = floatval($_POST['grams']);
        $stmt = $db->prepare("SELECT * FROM foods WHERE name = ?");
        $stmt->execute([$foodName]);
        if ($food = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $m = $grams / 100;
            $db->prepare("INSERT INTO intake_history (user_id, date, food_name, grams, calories, protein, fat, carbs)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)")
                ->execute([$_SESSION['user_id'], $selectedDate, $foodName, $grams, $food['calories'] * $m, $food['protein'] * $m, $food['fat'] * $m, $food['carbs'] * $m]);
        }
        header("Location: index.php#intake");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add Food</title>
        <link rel="stylesheet" href="css/style_food_popup.css">
    </head>

    <body>

    <div class="sidebar">
        <?php foreach ($foods as $food): ?>
            <div class="food-item" onclick="selectFood('<?= htmlspecialchars($food['name']) ?>')">
                <?= htmlspecialchars($food['name']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="content">
        <div class="nutrition" id="nutritionDisplay">Select food</div>
        <form method="post">
            <input type="hidden" name="food" id="foodInput">
            <input type="number" name="grams" placeholder="Grams" required style="padding:10px;font-size:20px;">
            <button type="submit" class="add-btn">Add</button>
        </form>
        <button onclick="window.close()" class="close-btn">Close</button>
    </div>

    <script>
    function selectFood(name) {
        document.getElementById('foodInput').value = name;
        document.getElementById('nutritionDisplay').innerHTML = "<strong>" + name + "</strong>";
    }
    </script>
    
    </body>
</html>
