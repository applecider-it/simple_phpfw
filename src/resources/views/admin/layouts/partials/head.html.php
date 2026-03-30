<?php

use App\Services\AdminUser\AuthService as Auth;

$adminUser = Auth::get();
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

<?= $this->render('partials.form.csrf_meta') ?>

<title><?= $this->h($title ?? $this->config('applicationName')) ?></title>

<link rel="icon" type="image/svg+xml" href="/favicon.svg">

<link rel="stylesheet" href="<?= $this->h($this->file('/css/admin.css')) ?>">

<?php if ($adminUser): ?>
    <meta name="admin-user" data-json="<?= $this->h(json_encode($adminUser)) ?>">
<?php endif; ?>

<?= $this->render('partials.app.meta') ?>

<script type="importmap"><?= json_encode($this->config('app.importmap.admin')) ?></script>
<script type="module">
    import "@/services/admin/app/setup-app";
</script>