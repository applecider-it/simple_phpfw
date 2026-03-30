<?php
$this->setLayoutValue('breadcrumbs', ['admin.user.edit', $data]);

$data['exists'] = true;
?>
<h2 class="app-h2">📝 admin.user.edit</h2>

<div>
    <div style="margin-top: 1rem;">
        <a href="<?= $this->h($this->route('admin.user.index')) ?>" class="app-link-normal">一覧</a>
    </div>

    <?= $this->render('partials.validation.errors', ['errors' => $errors ?? null]) ?>

    <?= $this->render('partials.message.flash') ?>

    <div style="margin-top: 1rem;">
        <form method="POST" action="<?= $this->h($this->route('admin.user.edit', ['id' => $data['id']])) ?>">
            <?= $this->render('partials.form.csrf') ?>
            <?= $this->render('admin.user.partials.form', $data) ?>
            <?= $this->render('admin.user.partials.info', $data) ?>
            <div style="margin-top: 1rem;">
                <button type="submit" class="app-btn-primary">更新</button>
            </div>
        </form>
    </div>

    <div style="margin-top: 3rem;">
        <?= $this->render('admin.user.partials.update_ctrl', $data) ?>
    </div>

    <div style="margin-top: 3rem;">
        <?= $this->render('admin.user.partials.tweets', ['tweets' => $tweets]) ?>

        <?= $this->render('partials.pagination.paginator', ['paginator' => $tweetsPaginator]) ?>
    </div>
</div>