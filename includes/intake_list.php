<div id="intakeDrawer" class="drawer left">
    <div class="drawer-close" onclick="closeIntakeDrawer()">×</div>
    <div class="intake-nav">
        <a class="arrow-nav" href="?date=<?= date('Y-m-d', strtotime("$selectedDate -1 day")) ?>#intake">&lt;</a>
        <strong><?= $displayTitle ?></strong>
        <a class="arrow-nav" href="?date=<?= date('Y-m-d', strtotime("$selectedDate +1 day")) ?>#intake">&gt;</a>
    </div>
    <div>
        <?php if (empty($history)): ?>
            <p>No foods added yet.</p>
        <?php else: ?>
            <?php foreach ($history as $item): ?>
                <div class="intake-item">
                    <strong><?= htmlspecialchars($item['food_name']) ?> - <?= $item['grams'] ?>g</strong><br>
                    <?= intval($item['calories']) ?> kcal<br>
                    Protein: <?= round($item['protein'],1) ?>g &nbsp;
                    Fat: <?= round($item['fat'],1) ?>g &nbsp;
                    Carbs: <?= round($item['carbs'],1) ?>g
                    <form method="post" style="margin-top:8px;">
                        <input type="hidden" name="remove_id" value="<?= $item['id'] ?>">
                        <button type="submit" class="remove-btn">Remove</button>
                    </form>
                </div>
            <?php endforeach; ?>
            <p style="margin-top:10px;">
                Protein Goal: <?= $proteinGoalMet ?><br>
                Calorie Goal: <?= $caloriesGoalMet ?>
            </p>
        <?php endif; ?>
    </div>
</div>
