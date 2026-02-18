<?php

use SFW\Core\Config;
use SFW\Output\Html;
use App\Services\AdminUser\AuthService as Auth;

$adminUser = Auth::get();
?>
<meta charset="UTF-8">

<?= $this->render('partials.form.csrf_meta') ?>

<title><?= $data['title'] ?? Config::get('applicationName') ?> Admin</title>

<link rel="icon" type="image/svg+xml" href="/favicon.svg">

<link rel="stylesheet" href="<?= Html::file('/css/app.css') ?>">

<?php if ($adminUser): ?>
    <meta name="user" data-json="<?= Html::esc(json_encode($adminUser)) ?>">
<?php endif; ?>

<script type="importmap"><?= json_encode(Config::get('importmapAdmin')) ?></script>
<script type="module">import "@/app";</script>