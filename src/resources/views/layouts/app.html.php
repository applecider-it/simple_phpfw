<?php

use SFW\Core\App;

$config = App::get('config');
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('layouts.partials.head') ?>
</head>

<body>
    <?= $this->render('layouts.partials.nav') ?>

    <main>
        <?= $data['content'] ?? '' ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> <?= $config['applicationName'] ?></p>
    </footer>
</body>

</html>