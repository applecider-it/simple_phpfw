<div>
    <h3>操作</h3>

    <div>
        <form
            method="POST"
            action="<?= $this->h($this->route('user.destroy')) ?>"
            onsubmit="return confirm('削除しますか？')"
            style="margin:0;">
            <?= $this->render('partials.form.csrf') ?>
            <button type="submit" class="app-btn-danger">
                削除
            </button>
        </form>
    </div>
</div>