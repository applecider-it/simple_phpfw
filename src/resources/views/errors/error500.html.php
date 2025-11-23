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
        <h2>500 Error</h2>
        <div>何らかのエラーが発生しました</div>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> <?= Config::get('applicationName') ?></p>
    </footer>
</body>

</html>