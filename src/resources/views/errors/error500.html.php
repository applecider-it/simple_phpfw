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
        <?= Config::get('debug') ? ($data['e'] ?? '') : '何らかのエラーが発生しました。' ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> <?= Config::get('applicationName') ?></p>
    </footer>
</body>

</html>