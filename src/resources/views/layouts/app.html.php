<?php

use SFW\Core\App;
$config = App::get('config');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?= $data['title'] ?? $config['applicationName'] ?></title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <header>
        <h1><?= $config['applicationName'] ?></h1>
        <nav>
            <a href="/">Home</a>
            <a href="/about">About</a>
        </nav>
    </header>

    <main>
        <?= $data['CONTENT'] ?? '' ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> <?= $config['applicationName'] ?></p>
    </footer>
</body>
</html>
