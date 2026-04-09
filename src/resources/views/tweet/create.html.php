<h2>tweet.index</h2>

<div>
    <?= $this->render('partials.message.flash') ?>

    <form method="POST" action="<?= $this->h($this->route('tweets.create')) ?>">
        <?= $this->render('partials.form.csrf') ?>

        <div>
            <label>内容</label>
            <input type="text" name="content" value="<?= $this->h($content ?? '') ?>">
            <?= $this->render('partials.validation.error', ['errors' => $errors ?? null, 'attribute' => 'content']) ?>
        </div>

        <div>
            <button type="submit" name="confirm" value="on">投稿確認</button>
        </div>
    </form>
</div>