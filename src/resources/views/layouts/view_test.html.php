<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('layouts.partials.head', ['title' => $data['title'] ?? null]) ?>
</head>

<body class="app-layout-body">
    <?= $this->render('layouts.partials.common') ?>
    <?= $this->render('layouts.partials.nav') ?>

    <div>layouts.view_test</div>

    <main class="app-layout-main">
        <?= $data['content'] ?? '' ?>
    </main>
</body>

</html>