<?php
$btnList = [
    'primary',
    'orange',
    'danger',
];
?>
<h2 class="app-h2">development.design</h2>
<div>
    <h3>app-btn</h3>
    <?php foreach ($btnList as $type): ?>
        <h4>app-btn-<?= $type ?></h4>
        <div>
            buttonタグ
            <button type="submit" class="app-btn-<?= $type ?>">ボタン</button>
            aタグ
            <a href="/" class="app-btn-<?= $type ?>">ボタン</a>
        </div>
    <?php endforeach; ?>
</div>