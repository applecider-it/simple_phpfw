<?php

use SFW\Core\Config;
use SFW\Core\App;
use SFW\Output\Html;

$adminUser = App::get('adminUser');

?>
<header class="app-header" style="background: #633;">
    <h1><?= Config::get('applicationName') ?></h1>
    <nav>
        <a href="<?= Config::get('adminPrefix') ?>">ダッシュボード</a>
        <a href="<?= Config::get('adminPrefix') ?>/users">ユーザー</a>
        <?php if ($adminUser): ?>
            (Name: <?= Html::esc($adminUser['name']) ?>)
            <a href="<?= Config::get('adminPrefix') ?>/logout">Logout</a>
        <?php else: ?>
            <a href="<?= Config::get('adminPrefix') ?>/login">Login</a>
        <?php endif ?>
    </nav>
</header>