<?php

use SFW\Core\Config;
?>
<footer class="app-layout-footer" style="background: #ddd;">
    <p>&copy; <?= date('Y') ?> <?= Config::get('applicationName') ?></p>
</footer>