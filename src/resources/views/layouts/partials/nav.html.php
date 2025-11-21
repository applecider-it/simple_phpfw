<?php

use SFW\Core\App;

$config = App::get('config');
?>
<header>
    <h1><?= $config['applicationName'] ?></h1>
    <nav>
        <a href="/">Home</a>
        <a href="/about">About</a>
    </nav>
</header>