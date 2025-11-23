<?php

use SFW\Core\Config;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('layouts.partials.head') ?>
</head>

<body>
    <?= $this->render('layouts.partials.nav') ?>

    <main>
        <h2>404 Error</h2>
        <?= $data['e'] ?? '' ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> <?= Config::get('applicationName') ?></p>
    </footer>
</body>

</html>