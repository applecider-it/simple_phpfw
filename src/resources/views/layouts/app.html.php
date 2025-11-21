<?php

use SFW\Core\Config;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('layouts.partials.head', ['title' => $data['title'] ?? null]) ?>
</head>

<body>
    <?= $this->render('layouts.partials.nav') ?>

    <main>
        <?= $data['content'] ?? '' ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> <?= Config::get('applicationName') ?></p>
    </footer>
</body>

</html>