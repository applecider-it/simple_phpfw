<?php

use function SFW\Helpers\route;
?>
<div>
    <h3>操作</h3>

    <div>
        <?php if ($data['deleted_at']): ?>
            <form
                method="POST"
                action="<?= route('admin.users.restore', ['id' => $data['id']]) ?>"
                onsubmit="return confirm('復元しますか？')"
                style="margin:0;">
                <?= $this->render('partials.form.csrf') ?>
                <button type="submit" class="app-btn-orange">
                    復元
                </button>
            </form>
        <?php else: ?>
            <form
                method="POST"
                action="<?= route('admin.users.destroy', ['id' => $data['id']]) ?>"
                onsubmit="return confirm('論理削除しますか？')"
                style="margin:0;">
                <?= $this->render('partials.form.csrf') ?>
                <button type="submit" class="app-btn-danger">
                    論理削除
                </button>
            </form>
        <?php endif; ?>
    </div>
</div>