<?php
$this->setLayoutValue('breadcrumbs', ['admin.user.edit', $data]);

$data['exists'] = true;
?>
<h2>📝 admin.user.edit</h2>

<div>
    <div>
        <a href="<?= $this->h($this->route('admin.user.index')) ?>">一覧</a>
    </div>

    <?= $this->render('partials.validation.errors', ['errors' => $errors ?? null]) ?>

    <?= $this->render('partials.message.flash') ?>

    <div>
        <form method="POST" action="<?= $this->h($this->route('admin.user.edit', ['id' => $data['id']])) ?>">
            <?= $this->render('partials.form.csrf') ?>
            <?= $this->render('admin.user.partials.form', $data) ?>
            <?= $this->render('admin.user.partials.info', $data) ?>
            <div>
                <button type="submit">更新</button>
            </div>
        </form>
    </div>

    <div>
        <?= $this->render('admin.user.partials.update_ctrl', $data) ?>
    </div>

    <div>
        <?= $this->render('admin.user.partials.tweets', ['tweets' => $tweets]) ?>

        <?= $this->render('partials.pagination.paginator', ['paginator' => $tweetsPaginator]) ?>
    </div>
</div>