<?php

use SFW\Core\Config;
use SFW\Output\Html;
use App\Services\AdminUser\AuthService as Auth;

$adminUser = Auth::get();
?>
<meta charset="UTF-8">

<?= $this->render('partials.form.csrf_meta') ?>

<title>{{ $data['title'] ?? Config::get('applicationName') }} Admin</title>

<link rel="icon" type="image/svg+xml" href="/favicon.svg">

<link rel="stylesheet" href="{{ Html::file('/css/admin.css') }}">

<?php if ($adminUser): ?>
    <meta name="admin-user" data-json="{{ json_encode($adminUser) }}">
<?php endif; ?>

<?= $this->render('partials.app.meta') ?>

<script type="importmap"><?= json_encode(Config::get('app.importmap.admin')) ?></script>
<script type="module">
    import "@/services/admin/app/setup-app";
</script>