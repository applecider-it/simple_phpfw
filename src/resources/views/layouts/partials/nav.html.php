<?php

use SFW\Core\Config;
?>
<header class="app-header">
    <h1><?= Config::get('applicationName') ?></h1>
    <nav>
        <a href="/">Home</a>
        <a href="/about">About</a>
    </nav>
</header>