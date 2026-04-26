<?php
$data['exists'] = false;
?>
<h2 class="app-h2">ユーザー登録</h2>

<div class="mt-10">
    <?= $this->render('partials.validation.errors', ['errors' => $errors ?? null]) ?>

    <div>
        <form method="POST" action="<?= $this->h($this->route('user.create')) ?>">
            <?= $this->render('partials.form.csrf') ?>
            <?= $this->render('user.partials.form', $data) ?>
            <div class="mt-10">
                <button type="submit" class="app-btn-primary">登録</button>
            </div>
        </form>
    </div>
</div>