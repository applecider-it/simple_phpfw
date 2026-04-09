<h2>tweet.index</h2>

<div>
    <?= $this->render('partials.message.flash') ?>

    <div>
        <a href="<?= $this->h($this->route('tweets.create')) ?>">
            新規作成
        </a>
    </div>

    <div>
        <?= $this->render('tweet.partials.tweets', ['tweets' => $tweets]) ?>
    </div>
</div>