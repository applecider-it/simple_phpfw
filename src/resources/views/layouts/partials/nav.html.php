<?php

use SFW\Core\Config;
?>
<header>
    <h1><?= Config::get('applicationName') ?></h1>
    <nav>
        <a href="/">Home</a>
        <a href="/about">About</a>
        <a href="<?= Config::get('adminPrefix') ?>/users">管理画面（ユーザー）</a>
    </nav>
</header>