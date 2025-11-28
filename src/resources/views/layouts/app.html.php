<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('layouts.partials.head', ['title' => $data['title'] ?? null]) ?>
</head>

<body class="app-body">
    <?= $this->render('layouts.partials.nav') ?>

    <main class="app-main">
        <?= $data['content'] ?? '' ?>
    </main>

    <?= $this->render('layouts.partials.footer') ?>
</body>

</html>