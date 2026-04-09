<?php

use App\Services\AdminUser\AuthService as Auth;

$adminUser = Auth::get();
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?= $this->render('partials.form.csrf_meta') ?>

<title><?= $this->h($title ?? $this->config('applicationName')) ?></title>

<link rel="icon" type="image/svg+xml" href="/favicon.svg">

<link rel="stylesheet" href="<?= $this->h($this->file('/css/admin.css')) ?>">

<?php if ($adminUser): ?>
    <meta name="admin-user" data-json="<?= $this->h(json_encode($adminUser)) ?>">
<?php endif; ?>

<?= $this->render('partials.app.meta') ?>

<script type="module" src="<?= $this->h($this->file('/js/app.js')) ?>"></script>
<script type="module">
    console.log("init admin");

    // 動作確認
    console.log("auth admin-user", app.getMetaJson('admin-user'));
</script>
