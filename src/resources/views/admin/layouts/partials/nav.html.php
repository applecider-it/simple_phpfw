<?php

use SFW\Core\Config;
?>
<header class="app-header" style="background: #633;">
    <h1><?= Config::get('applicationName') ?></h1>
    <nav>
        <a href="<?= Config::get('adminPrefix') ?>">ダッシュボード</a>
        <a href="<?= Config::get('adminPrefix') ?>/users">ユーザー</a>
    </nav>
</header>