<?php
$data['exists'] = true;
?>
<h2 class="app-h2">📝 user.edit</h2>

<div class="mt-10">
    <?= $this->render('partials.validation.errors', ['errors' => $errors ?? null]) ?>

    <?= $this->render('partials.message.flash') ?>

    <div class="mt-10">
        <form method="POST" action="<?= $this->h($this->route('user.edit')) ?>">
            <?= $this->render('partials.form.csrf') ?>
            <?= $this->render('user.partials.form', $data) ?>
            <?= $this->render('user.partials.info', $data) ?>
            <div>
                <button type="submit" class="app-btn-primary">更新</button>
            </div>
        </form>
    </div>

    <div class="mt-10">
        <?= $this->render('user.partials.update_ctrl', $data) ?>
    </div>
</div>