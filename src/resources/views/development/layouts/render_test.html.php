<?php

use SFW\Output\View\Layout;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('layouts.partials.head', ['title' => $title ?? null]) ?>
</head>

<body class="app-layout-body">
    <?= $this->render('layouts.partials.nav') ?>

    <main class="app-layout-main">
        <div class="app-card" style="margin-bottom: 2rem;">layouts.render_test</div>

        <?= $data[Layout::KEY_LAYOUT_CONTENT] ?? '' ?>
    </main>
</body>

</html>