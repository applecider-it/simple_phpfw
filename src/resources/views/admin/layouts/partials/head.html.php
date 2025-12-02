<?php

use SFW\Core\Config;
?>
<meta charset="UTF-8">

<?= $this->render('partials.form.csrf_meta') ?>

<title><?= $data['title'] ?? Config::get('applicationName') ?> Admin</title>

<link rel="stylesheet" href="/css/app.css">

<script type="importmap"><?= json_encode(Config::get('importmap')) ?></script>
<script type="module">import "@/app";</script>