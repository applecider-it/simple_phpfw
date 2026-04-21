<?php

use SFW\View\Layout;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('layouts.partials.head', ['title' => $title ?? null]) ?>
</head>

<body style="margin: 0;">
    <?= $this->render('layouts.partials.nav') ?>

    <main style="padding: 1rem; padding-bottom: 3rem;">
        <?= $data[Layout::KEY_LAYOUT_CONTENT] ?? '' ?>
    </main>

    <?= $this->render('layouts.partials.footer') ?>
</body>

</html>