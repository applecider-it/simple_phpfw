<?php

use SFW\View\Layout;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('layouts.partials.head', ['title' => $title ?? null]) ?>
</head>

<body>
    <?= $this->render('layouts.partials.nav') ?>

    <main>
        <?= $data[Layout::KEY_LAYOUT_CONTENT] ?? '' ?>
    </main>

    <?= $this->render('layouts.partials.footer') ?>
</body>

</html>