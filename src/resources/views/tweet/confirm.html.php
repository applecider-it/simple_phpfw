<h2>tweet.index</h2>

<div>
    <form method="POST" action="<?= $this->h($this->route('tweets.create')) ?>">
        <?= $this->render('partials.form.csrf') ?>

        <div style="margin-top: 1rem;">
            <label>内容</label>
            <?= $this->h($content ?? '') ?>
            <input type="hidden" name="content" value="<?= $this->h($content ?? '') ?>">
        </div>

        <div style="margin-top: 1rem;">
            <button type="submit" name="back" value="on">戻る</button>
            <button type="submit" name="commit" value="on">投稿確定</button>
        </div>
    </form>
</div>