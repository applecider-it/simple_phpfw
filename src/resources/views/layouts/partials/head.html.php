<?php

use SFW\Core\App;

$config = App::get('config');
?>
<meta charset="UTF-8">
<title><?= $data['title'] ?? $config['applicationName'] ?></title>
<link rel="stylesheet" href="/style.css">