<?php

use SFW\Output\Html;
?>

<div style="margin-bottom: 1rem;">
    <label class="app-form-label">Name</label>
    <input type="text" name="name" value="<?= Html::esc($data['name']) ?>" class="app-form-input">
    <?= $this->render('partials.validation.error', ['errors' => $data['errors'] ?? null, 'attribute' => 'name']) ?>
</div>

<div style="margin-bottom: 1rem;">
    <label class="app-form-label">Email</label>
    <input type="text" name="email" value="<?= Html::esc($data['email']) ?>" class="app-form-input">
    <?= $this->render('partials.validation.error', ['errors' => $data['errors'] ?? null, 'attribute' => 'email']) ?>
</div>

<div style="margin-bottom: 1rem;">
    <label class="app-form-label">Updated at</label>
    <div><?= Html::esc($data['updated_at']) ?></div>
</div>
