<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->render('layouts.partials.head', ['title' => $data['title'] ?? null]) ?>
</head>

<body>
    <?= $this->render('layouts.partials.nav') ?>

    <main>
        <?= $data['content'] ?? '' ?>
    </main>

    <?= $this->render('layouts.partials.footer') ?>
</body>

</html>