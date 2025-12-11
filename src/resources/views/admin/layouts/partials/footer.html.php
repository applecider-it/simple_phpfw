<?php

use SFW\Core\Config;
?>
<footer class="app-layout-footer" style="background: #fee;">
    <p>&copy; <?= date('Y') ?> <?= Config::get('applicationName') ?></p>
</footer>