<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('admin.layouts.partials.head', ['title' => $data['title'] ?? null]) ?>
</head>

<body class="app-body">
    <?= $this->render('admin.layouts.partials.nav') ?>

    <main class="app-main">
        <?= $data['content'] ?? '' ?>
    </main>

    <?= $this->render('admin.layouts.partials.footer') ?>
</body>

</html>