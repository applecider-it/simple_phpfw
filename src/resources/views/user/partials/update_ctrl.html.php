<div>
    <h3>操作</h3>

    <div>
        <form
            method="POST"
            action="<?= $this->h($this->route('user.destroy')) ?>"
            onsubmit="return confirm('削除しますか？')">
            <?= $this->render('partials.form.csrf') ?>
            <button type="submit">
                削除
            </button>
        </form>
    </div>
</div>