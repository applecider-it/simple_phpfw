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

    <table class="app-table">
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
                        <a href="<?= Config::get('adminPrefix') ?>/users/<?= $user['id'] ?>/edit" class="app-btn-orange">
                            更新
                        </a>
                    </td>
                    <td class="app-table-cell" style="text-align:center;">
                        <form method="POST" action="<?= Config::get('adminPrefix') ?>/users/<?= $user['id'] ?>/destroy" onsubmit="return confirm('削除しますか？')" style="margin:0;">
                            <button type="submit" class="app-btn-danger">
                                論理削除
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>