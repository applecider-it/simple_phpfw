<?php

use SFW\Output\View\Layout;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('layouts.partials.head', ['title' => $data['title'] ?? null]) ?>
</head>

<body class="app-layout-body">
    <?= $this->render('layouts.partials.common') ?>
    <?= $this->render('layouts.partials.nav') ?>

    <main class="app-layout-main">
        <?= $data[Layout::KEY_LAYOUT_CONTENT] ?? '' ?>
    </main>

    <?= $this->render('layouts.partials.footer') ?>
</body>

</html>