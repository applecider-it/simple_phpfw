<?php
$data['exists'] = false;
?>
<h2>📝 user.create</h2>

<div>
    <?= $this->render('partials.validation.errors', ['errors' => $errors ?? null]) ?>

    <div>
        <form method="POST" action="<?= $this->h($this->route('user.create')) ?>">
            <?= $this->render('partials.form.csrf') ?>
            <?= $this->render('user.partials.form', $data) ?>
            <div>
                <button type="submit">登録</button>
            </div>
        </form>
    </div>
</div>