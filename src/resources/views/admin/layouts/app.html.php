<?php

use SFW\View\Layout;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('admin.layouts.partials.head', ['title' => $title ?? null]) ?>
</head>

<body
    class="bg-gradient-to-br from-indigo-100 via-white to-blue-100 min-h-screen">
    <div class="flex flex-col min-h-screen">
        <div class="flex-grow">
            <?= $this->render('admin.layouts.partials.nav') ?>
            <?= $this->render('partials.nav.breadcrumbs', [
                'breadcrumbs' => $this->layoutValue('breadcrumbs'),
            ]) ?>

            <div class="p-5 pb-40">
                <?= $data[Layout::KEY_LAYOUT_CONTENT] ?? '' ?>
            </div>
        </div>

        <?= $this->render('admin.layouts.partials.footer') ?>
    </div>
</body>

</html>