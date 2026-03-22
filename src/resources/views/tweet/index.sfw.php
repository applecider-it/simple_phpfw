<h2 class="app-h2">tweet.index</h2>

<div>
    <?= $this->render('partials.message.flash') ?>

    <div>
        <a href="{{ $this->route('tweets.create') }}" class="app-btn-primary">
            新規作成
        </a>
    </div>

    <div style="margin-top: 1rem;">
        <?= $this->render('tweet.partials.tweets', ['tweets' => $tweets]) ?>
    </div>
</div>