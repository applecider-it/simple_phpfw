<?php

use SFW\Core\Config;
?>
<meta charset="UTF-8">
<title><?= $data['title'] ?? Config::get('applicationName') ?></title>
<link rel="stylesheet" href="/style.css">