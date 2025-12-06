<?php

use SFW\Output\Html;
use SFW\Core\Config;
?>
<h2 class="app-h2">tweet.index</h2>

<div style="display:flex; flex-direction:column; gap:16px;">
    <div>
        <form method="POST" action="/tweets">
            <?= $this->render('partials.form.csrf') ?>

            <div style="margin-top: 1rem;">
                <label class="app-form-label">内容</label>
                <?= Html::esc($data['content'] ?? '') ?>
                <input type="hidden" name="content" value="<?= Html::esc($data['content'] ?? '') ?>">
            </div>

            <div style="margin-top: 1rem;">
                <button type="submit" class="app-btn-secondary" name="back" value="on">戻る</button>
                <button type="submit" class="app-btn-primary" name="commit" value="on">投稿確定</button>
            </div>
        </form>
    </div>

    <?= $this->render('tweet.partials.tweets', ['tweets' => $data['tweets']]) ?>
</div>