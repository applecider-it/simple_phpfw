<?php

use function SFW\Helpers\html_esc as h;
?>

<div style="margin-top: 1rem;">
    <label class="app-form-label">Updated at</label>
    <div><?= h($data['updated_at']) ?></div>
</div>

<div style="margin-top: 1rem;">
    <label class="app-form-label">Delated at</label>
    <div><?= h($data['deleted_at']) ?></div>
</div>
