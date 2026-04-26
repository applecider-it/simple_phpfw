<?php

use App\Services\User\AuthService as Auth;
use SFW\Core\App;

$vite = App::get('vite');

$user = Auth::get();
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?= $this->render('partials.form.csrf_meta') ?>

<title><?= $this->h($title ?? $this->config('applicationName')) ?></title>

<link rel="icon" type="image/svg+xml" href="/favicon.svg">

<?php if ($user): ?>
    <meta name="user" data-json="<?= $this->h(json_encode($user)) ?>">
<?php endif; ?>

<?= $this->render('partials.app.meta') ?>

<?= $vite->init() ?>
<link rel="stylesheet" href="<?= $this->h($vite->asset('resources/css/app.css')) ?>">
<script type="module" src="<?= $this->h($vite->asset('resources/js/entrypoints/app.ts')) ?>"></script>
