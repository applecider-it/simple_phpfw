<h2 class="app-h2">tweet.index</h2>

<div>
    <form method="POST" action="{{ $this->route('tweets.create') }}">
        <?= $this->render('partials.form.csrf') ?>

        <div style="margin-top: 1rem;">
            <label class="app-form-label">内容</label>
            {{ $content ?? '' }}
            <input type="hidden" name="content" value="{{ $content ?? '' }}">
        </div>

        <div style="margin-top: 1rem;">
            <button type="submit" class="app-btn-secondary" name="back" value="on">戻る</button>
            <button type="submit" class="app-btn-primary" name="commit" value="on">投稿確定</button>
        </div>
    </form>
</div>