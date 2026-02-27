<?php

use function SFW\Helpers\route;

$return['breadcrumbs'] = ['admin.users.edit', $data];

$data['exists'] = true;
?>
<h2 class="app-h2">📝 admin.user.edit</h2>

<div>
    <div style="margin-top: 1rem;">
        <a href="<?= route('admin.users.index') ?>" class="app-link-normal">一覧</a>
    </div>

    <?= $this->render('partials.validation.errors', ['errors' => $data['errors'] ?? null]) ?>

    <?= $this->render('partials.message.flash') ?>

    <div style="margin-top: 1rem;">
        <form method="POST" action="<?= route('admin.users.edit', ['id' => $data['id']]) ?>">
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
        <?= $this->render('admin.user.partials.tweets', ['tweets' => $data['tweets']]) ?>

        <?= $this->render('partials.pagination.paginator', ['paginator' => $data['tweetsPaginator']]) ?>
    </div>
</div>