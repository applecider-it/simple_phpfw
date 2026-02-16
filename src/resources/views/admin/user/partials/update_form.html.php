<?php

use function SFW\Helpers\html_esc as h;
?>

<div style="margin-top: 1rem;">
    <label class="app-form-label">Name</label>
    <input type="text" name="name" value="<?= h($data['name']) ?>" class="app-form-input">
    <?= $this->render('partials.validation.error', ['errors' => $data['errors'] ?? null, 'attribute' => 'name']) ?>
</div>

<div style="margin-top: 1rem;">
    <label class="app-form-label">Email</label>
    <input type="text" name="email" value="<?= h($data['email']) ?>" class="app-form-input">
    <?= $this->render('partials.validation.error', ['errors' => $data['errors'] ?? null, 'attribute' => 'email']) ?>
</div>

<div style="margin-top: 1rem;">
    <label class="app-form-label">Updated at</label>
    <div><?= h($data['updated_at']) ?></div>
</div>

<div style="margin-top: 1rem;">
    <label class="app-form-label">Delated at</label>
    <div><?= h($data['deleted_at']) ?></div>
</div>
