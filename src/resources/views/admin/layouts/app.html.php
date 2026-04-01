<?php

use SFW\View\Layout;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('admin.layouts.partials.head', ['title' => $title ?? null]) ?>
</head>

<body class="app-layout-body">
    <?= $this->render('admin.layouts.partials.nav') ?>
    <?= $this->render('partials.nav.breadcrumbs', [
        'breadcrumbs' => $this->layoutValue('breadcrumbs'),
    ]) ?>

    <main class="app-layout-main">
        <?= $data[Layout::KEY_LAYOUT_CONTENT] ?? '' ?>
    </main>

    <?= $this->render('admin.layouts.partials.footer') ?>
</body>

</html>