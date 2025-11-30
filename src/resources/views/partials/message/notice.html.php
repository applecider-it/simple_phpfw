<?php

use SFW\Output\Html;
?>
<?php if ($data['message']): ?>
    <ul style="margin:1rem 0; padding-left: 1.2rem; color: #3498db;">
        <li><?= Html::esc($data['message']) ?></li>
    </ul>
<?php endif; ?>