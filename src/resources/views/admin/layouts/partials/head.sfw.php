<?php

use App\Services\AdminUser\AuthService as Auth;

$adminUser = Auth::get();
?>
<meta charset="UTF-8">

<?= $this->render('partials.form.csrf_meta') ?>

<title>{{ $title ?? $this->config('applicationName') }}</title>

<link rel="icon" type="image/svg+xml" href="/favicon.svg">

<link rel="stylesheet" href="{{ $this->file('/css/admin.css') }}">

<?php if ($adminUser): ?>
    <meta name="admin-user" data-json="{{ json_encode($adminUser) }}">
<?php endif; ?>

<?= $this->render('partials.app.meta') ?>

<script type="importmap"><?= json_encode($this->config('app.importmap.admin')) ?></script>
<script type="module">
    import "@/services/admin/app/setup-app";
</script>