<h2 class="app-h2">tweet.index</h2>

<div>
    <?= $this->render('partials.message.flash') ?>

    <form method="POST" action="<?= $this->h($this->route('tweets.create')) ?>">
        <?= $this->render('partials.form.csrf') ?>

        <div>
            <label class="app-form-label">内容</label>
            <input type="text" name="content" value="<?= $this->h($content ?? '') ?>" class="app-form-input">
            <?= $this->render('partials.validation.error', ['errors' => $errors ?? null, 'attribute' => 'content']) ?>
        </div>

        <div class="my-10">
            <button type="submit" name="confirm" value="on" class="app-btn-primary">投稿確認</button>
        </div>
    </form>
</div>