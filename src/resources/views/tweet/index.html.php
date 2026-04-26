<h2 class="app-h2">tweet.index</h2>

<div>
    <?= $this->render('partials.message.flash') ?>

    <div class="my-10">
        <a href="<?= $this->h($this->route('tweets.create')) ?>" class="app-btn-primary">
            新規作成
        </a>
    </div>

    <div class="mt-10">
        <?= $this->render('tweet.partials.tweets', ['tweets' => $tweets]) ?>
    </div>
</div>