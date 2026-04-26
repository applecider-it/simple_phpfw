<?php

use SFW\View\Layout;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('layouts.partials.head', ['title' => $title ?? null]) ?>
</head>

<body class="bg-gray-50 text-gray-900">

    <?= $this->render('layouts.partials.nav') ?>

    <main class="max-w-3xl mx-auto px-4 py-6 pb-12">

        <div class="mb-6 p-4 border-2 border-gray-200 rounded-xl bg-white shadow-sm">
            development.layouts.render_test
        </div>

        <?= $data[Layout::KEY_LAYOUT_CONTENT] ?? '' ?>

    </main>
</body>

</html>