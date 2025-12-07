<?php

use SFW\Core\Config;
use SFW\Core\App;
use SFW\Output\Html;

$user = App::get('user');
?>
<header class="app-header">
    <?= $this->render('layouts.partials.nav.primary') ?>
    <?= $this->render('layouts.partials.nav.responsive') ?>
</header>