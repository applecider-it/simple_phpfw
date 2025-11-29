<?php

use SFW\Core\Config;
use SFW\Core\App;
use SFW\Output\Html;

$user = App::get('user');
?>
<header class="app-header">
    <h1><?= Config::get('applicationName') ?></h1>
    <nav>
        <a href="/">Home</a>
        <a href="/about">About</a>
        <?php if ($user): ?>
            (Name: <?= Html::esc($user['name']) ?>)
            <a href="/logout">Logout</a>
        <?php else: ?>
            <a href="/login">Login</a>
        <?php endif ?>
    </nav>
</header>