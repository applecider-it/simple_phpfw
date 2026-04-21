<?php

use SFW\View\Layout;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('admin.layouts.partials.head', ['title' => $title ?? null]) ?>
</head>

<body style="margin: 0;">
    <?= $this->render('admin.layouts.partials.nav') ?>
    <?= $this->render('partials.nav.breadcrumbs', [
        'breadcrumbs' => $this->layoutValue('breadcrumbs'),
    ]) ?>

    <main style="padding: 1rem; padding-bottom: 3rem;">
        <?= $data[Layout::KEY_LAYOUT_CONTENT] ?? '' ?>
    </main>

    <?= $this->render('admin.layouts.partials.footer') ?>
</body>

</html>