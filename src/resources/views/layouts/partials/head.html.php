<?php

use SFW\Core\Config;
?>
<meta charset="UTF-8">
<title><?= $data['title'] ?? Config::get('applicationName') ?></title>
<link rel="stylesheet" href="/css/app.css">
<script type="importmap"><?= json_encode(Config::get('importmap')) ?></script>
<script type="module">
  import "@/app";
</script>