<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('admin.layouts.partials.head', ['title' => $data['title'] ?? null]) ?>
</head>

<body class="app-layout-body">
    <?= $this->render('admin.layouts.partials.common') ?>
    <?= $this->render('admin.layouts.partials.nav') ?>

    <main class="app-layout-main">
        <?= $data['content'] ?? '' ?>
    </main>

    <?= $this->render('admin.layouts.partials.footer') ?>
</body>

</html>