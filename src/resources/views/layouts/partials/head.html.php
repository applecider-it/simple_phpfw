<?php

use App\Services\User\AuthService as Auth;

$user = Auth::get();
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?= $this->render('partials.form.csrf_meta') ?>

<title><?= $this->h($title ?? $this->config('applicationName')) ?></title>

<link rel="icon" type="image/svg+xml" href="/favicon.svg">

<link rel="stylesheet" href="<?= $this->h($this->file('/css/app.css')) ?>">

<?php if ($user): ?>
    <meta name="user" data-json="<?= $this->h(json_encode($user)) ?>">
<?php endif; ?>

<?= $this->render('partials.app.meta') ?>

<script type="module" src="<?= $this->h($this->file('/js/app.js')) ?>"></script>
<script type="module">
    console.log("init app");

    // 動作確認
    console.log("auth user", app.getMetaJson('user'));
</script>
