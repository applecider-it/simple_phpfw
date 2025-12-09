<?php

use SFW\Core\Config;
use SFW\Output\Html;
?>
<meta charset="UTF-8">

<?= $this->render('partials.form.csrf_meta') ?>

<title><?= $data['title'] ?? Config::get('applicationName') ?></title>

<link rel="stylesheet" href="<?= Html::file('/css/app.css') ?>">

<script type="importmap"><?= json_encode(Config::get('importmap')) ?></script>
<script type="module">import "@/app";</script>