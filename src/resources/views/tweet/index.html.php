<?php

use SFW\Output\Html;
use SFW\Core\Config;
?>
<h2 class="app-h2">tweet.index</h2>

<div style="display:flex; flex-direction:column; gap:16px;">

    <?= $this->render('partials.message.flash') ?>

    <div>
        <form method="POST" action="/tweets">
            <?= $this->render('partials.form.csrf') ?>

            <div style="margin-top: 1rem;">
                <label class="app-form-label">内容</label>
                <input type="text" name="content" value="<?= Html::esc($data['content'] ?? '') ?>" class="app-form-input">
                <?= $this->render('partials.validation.error', ['errors' => $data['errors'] ?? null, 'attribute' => 'content']) ?>
            </div>

            <div style="margin-top: 1rem;">
                <button type="submit" class="app-btn-primary" name="confirm" value="on">投稿確認</button>
            </div>
        </form>
    </div>

    <?= $this->render('tweet.partials.tweets', ['tweets' => $data['tweets']]) ?>
</div>
