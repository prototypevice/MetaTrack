<div class="circle-grid">
    <div class="circle" style="--percent:<?= abs($percent) ?>;">
        <div class="number"><?= $remaining ?><br><small>kcal left</small></div>
    </div>
    <div class="circle" style="--percent:<?= $proteinPercent ?>;">
        <div class="number"><?= intval($proteinRemaining) ?>g<br><small>protein left</small></div>
    </div>
    <div class="circle" style="--percent:<?= $fatPercent ?>;">
        <div class="number"><?= intval($fatRemaining) ?>g<br><small>fat left</small></div>
    </div>
    <div class="circle" style="--percent:<?= $carbPercent ?>;">
        <div class="number"><?= intval($carbRemaining) ?>g<br><small>carbs left</small></div>
    </div>
</div>
