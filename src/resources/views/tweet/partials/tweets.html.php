<?php

use SFW\Output\Html;
use SFW\Core\Config;
?>

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

<div style="display:flex; flex-direction:column; gap:1rem;">
    <?php foreach ($data['tweets'] as $tweet): ?>
        <div class="tweet-card">
            <div style="font-size:15px; color:#222; line-height:1.6;">
                <?= Html::esc($tweet['content']) ?>
            </div>
            <div style="margin-top:8px; font-size:13px; color:#777;">
                <?= Html::esc($tweet['created_at']) ?>
            </div>
            <div style="margin-top:8px; font-size:13px; color:#777;">
                send by <?= Html::esc($tweet['user']['name']) ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>