<div>
    <h3>操作</h3>

    <div>
        <?php if ($deleted_at): ?>
            <form
                method="POST"
                action="<?= $this->h($this->route('admin.user.restore', ['id' => $data['id']])) ?>"
                onsubmit="return confirm('復元しますか？')">
                <?= $this->render('partials.form.csrf') ?>
                <button type="submit">
                    復元
                </button>
            </form>
        <?php else: ?>
            <form
                method="POST"
                action="<?= $this->h($this->route('admin.user.destroy', ['id' => $data['id']])) ?>"
                onsubmit="return confirm('論理削除しますか？')">
                <?= $this->render('partials.form.csrf') ?>
                <button type="submit">
                    論理削除
                </button>
            </form>
        <?php endif; ?>
    </div>
</div>