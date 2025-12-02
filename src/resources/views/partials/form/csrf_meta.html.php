<?php

use SFW\Output\Html;
use SFW\Web\Csrf;
?>
<meta name="csrf-token" content="<?= Html::esc(Csrf::get()) ?>">