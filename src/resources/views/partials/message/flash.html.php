<?php

use SFW\Output\Html;
use SFW\Web\Flash;
?>
<?php if (Flash::get('notice')): ?>
    <ul style="margin:1rem 0; padding-left: 1.2rem; color: #3498db;">
        <li><?= Html::esc(Flash::get('notice')) ?></li>
    </ul>
<?php endif; ?>

<?php if (Flash::get('alert')): ?>
    <ul style="margin:1rem 0; padding-left: 1.2rem; color: #ff3333;">
        <li><?= Html::esc(Flash::get('alert')) ?></li>
    </ul>
<?php endif; ?>
