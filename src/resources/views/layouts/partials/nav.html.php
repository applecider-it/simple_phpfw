<?php

use SFW\Core\Config;
?>
<header class="app-header">
    <h1><?= Config::get('applicationName') ?></h1>
    <nav>
        <a href="/">Home</a>
        <a href="/about">About</a>
        <?php if (isset($_SESSION["user_id"])): ?>
            <a href="/logout">Logout</a>
        <?php else: ?>
            <a href="/login">Login</a>
        <?php endif ?>
    </nav>
</header>