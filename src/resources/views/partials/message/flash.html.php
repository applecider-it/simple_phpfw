<?php

use SFW\Web\Flash;
?>

<?php if (Flash::get('notice')): ?>
    <div class="my-4 px-4 py-3 rounded-lg bg-blue-50 text-blue-700 border border-blue-200">
        <?= $this->h(Flash::get('notice')) ?>
    </div>
<?php endif; ?>

<?php if (Flash::get('alert')): ?>
    <div class="my-4 px-4 py-3 rounded-lg bg-red-50 text-red-700 border border-red-200">
        <?= $this->h(Flash::get('alert')) ?>
    </div>
<?php endif; ?>