<?php

use SFW\Core\App;
use SFW\Core\Config;
use SFW\Output\Html;

$user = App::get('user');
?>
<meta charset="UTF-8">

<?= $this->render('partials.form.csrf_meta') ?>

<title><?= $data['title'] ?? Config::get('applicationName') ?></title>

<link rel="icon" type="image/svg+xml" href="/favicon.svg">

<link rel="stylesheet" href="<?= Html::file('/css/app.css') ?>">

<?php if ($user): ?>
    <meta name="user" data-json="<?= Html::esc(json_encode($user)) ?>">
<?php endif; ?>

<script type="importmap"><?= json_encode(Config::get('importmap')) ?></script>
<script type="module">
    import "@/app";
</script>