<h2 class="app-h2">tweet.index</h2>

<div>
    <form method="POST" action="<?= $this->h($this->route('tweets.create')) ?>">
        <?= $this->render('partials.form.csrf') ?>

        <div style="margin-top: 1rem;">
            <label class="app-form-label">内容</label>
            <div class="h-10"><?= $this->h($content ?? '') ?></div>
            <input type="hidden" name="content" value="<?= $this->h($content ?? '') ?>">
        </div>

        <div style="margin-top: 1rem;">
            <button type="submit" name="back" value="on" class="app-btn-secondary">戻る</button>
            <button type="submit" name="commit" value="on" class="app-btn-primary">投稿確定</button>
        </div>
    </form>
</div>