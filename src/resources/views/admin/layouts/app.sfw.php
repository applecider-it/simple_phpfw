<?php

use SFW\Output\View\Layout;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('admin.layouts.partials.head', ['title' => $title ?? null]) ?>
</head>

<body class="app-layout-body">
    <?= $this->render('admin.layouts.partials.common') ?>
    <?= $this->render('admin.layouts.partials.nav') ?>
    <?= $this->render('admin.layouts.partials.breadcrumbs', [
        'breadcrumbs' => $data[Layout::KEY_LAYOUT_OPTIONS]->breadcrumbs ?? null,
    ]) ?>

    <main class="app-layout-main">
        <?= $data[Layout::KEY_LAYOUT_CONTENT] ?? '' ?>
    </main>

    <?= $this->render('admin.layouts.partials.footer') ?>
</body>

</html>