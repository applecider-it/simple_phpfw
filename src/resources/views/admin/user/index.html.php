<?php

use SFW\Output\Html;
use SFW\Core\Config;
?>
<h2 class="app-h2">Admin Users</h2>

<div style="margin-top: 1rem;">
    <div style="margin-bottom: 1rem;">
        <a href="<?= Config::get('adminPrefix') ?>/users/create" class="app-btn-primary">
            新規作成
        </a>
    </div>

    <div style="margin-top: 1rem;">
        <a href="<?= Config::get('adminPrefix') ?>/users" class="app-link-normal">全て</a>
        <a href="<?= Config::get('adminPrefix') ?>/users?soft_delete=kept" class="app-link-normal">論理削除を除外</a>
        <a href="<?= Config::get('adminPrefix') ?>/users?soft_delete=deleted" class="app-link-normal">論理削除済み</a>
    </div>

    <table style="margin-top: 1rem;" class="app-table">
        <thead>
            <tr style="background-color: #ecf0f1;">
                <th class="app-table-cell" style="text-align: left;">Name</th>
                <th class="app-table-cell" style="text-align: left;">Email</th>
                <th class="app-table-cell" style="text-align: left;">削除日時</th>
                <th class="app-table-cell">更新</th>
                <th class="app-table-cell">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['users'] as $user): ?>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td class="app-table-cell"><?= Html::esc($user['name'] ?? '') ?></td>
                    <td class="app-table-cell"><?= Html::esc($user['email'] ?? '') ?></td>
                    <td class="app-table-cell"><?= $user['deleted_at'] ?? '' ?></td>
                    <td class="app-table-cell" style="text-align:center;">
                        <a href="<?= Config::get('adminPrefix') ?>/users/<?= $user['id'] ?>/edit" class="app-btn-primary">
                            更新
                        </a>
                    </td>
                    <td class="app-table-cell" style="text-align:center;">
                        <?php if ($user['deleted_at']): ?>
                            <form method="POST" action="<?= Config::get('adminPrefix') ?>/users/<?= $user['id'] ?>/restore" onsubmit="return confirm('復元しますか？')" style="margin:0;">
                                <button type="submit" class="app-btn-orange">
                                    復元
                                </button>
                            </form>
                        <?php else: ?>
                            <form method="POST" action="<?= Config::get('adminPrefix') ?>/users/<?= $user['id'] ?>/destroy" onsubmit="return confirm('削除しますか？')" style="margin:0;">
                                <button type="submit" class="app-btn-danger">
                                    論理削除
                                </button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>