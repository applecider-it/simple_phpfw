<?php
$data['exists'] = false;
?>
<h2 class="app-h2">📝 user.create</h2>

<div>
    <?= $this->render('partials.validation.errors', ['errors' => $errors ?? null]) ?>

    <div style="margin-top: 1rem;">
        <form method="POST" action="<?= $this->h($this->route('user.create')) ?>">
            <?= $this->render('partials.form.csrf') ?>
            <?= $this->render('user.partials.form', $data) ?>
            <div style="margin-top: 1rem;">
                <button type="submit" class="app-btn-primary">登録</button>
            </div>
        </form>
    </div>
</div>