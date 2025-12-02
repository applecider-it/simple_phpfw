<?php

use SFW\Output\Html;
use SFW\Web\Csrf;
?>
<input type="hidden" name="csrf_token" value="<?= Html::esc(Csrf::get()) ?>">