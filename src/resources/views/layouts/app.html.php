<?php

use SFW\View\Layout;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('layouts.partials.head', ['title' => $title ?? null]) ?>
</head>

<body
    class="bg-gradient-to-br from-indigo-100 via-white to-blue-100 min-h-screen">
    <div class="flex flex-col min-h-screen">
        <div class="flex-grow">
            <?= $this->render('layouts.partials.nav') ?>

            <div class="max-w-4xl mx-auto px-5 pt-10 pb-40">
                <?= $data[Layout::KEY_LAYOUT_CONTENT] ?? '' ?>
            </div>
        </div>

        <?= $this->render('layouts.partials.footer') ?>
    </div>
</body>

</html>