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
                <button type="submit" class="app-btn-primary">投稿</button>
            </div>
        </form>
    </div>

    <style>
        .tweet-card {
            background: #fff;
            border: 1px solid #dcdcdc;
            border-radius: 12px;
            padding: 14px 18px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.06);
            transition: box-shadow .2s;
        }

        .tweet-card:hover {
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.12);
        }
    </style>

    <div style="display:flex; flex-direction:column; gap:16px;">
        <?php foreach ($data['tweets'] as $tweet): ?>
            <div class="tweet-card">
                <div style="font-size:15px; color:#222; line-height:1.6; white-space:pre-line;">
                    <?= Html::esc($tweet['content']) ?>
                </div>
                <div style="margin-top:8px; font-size:13px; color:#777;">
                    <?= Html::esc($tweet['created_at']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>