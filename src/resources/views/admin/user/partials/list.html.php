<?php

use SFW\Output\Html;
use SFW\Core\Config;
?>
<div class="app-table-wrap">
    <table style="margin-top: 1rem;" class="app-table">
        <thead>
            <tr class="app-table-row-header">
                <th class="app-table-cell" style="text-align: left;">Name</th>
                <th class="app-table-cell" style="text-align: left;">Email</th>
                <th class="app-table-cell" style="text-align: left;">削除日時</th>
                <th class="app-table-cell">更新</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['users'] as $user): ?>
                <tr class="app-table-row-data">
                    <td class="app-table-cell"><?= Html::esc($user['name'] ?? '') ?></td>
                    <td class="app-table-cell"><?= Html::esc($user['email'] ?? '') ?></td>
                    <td class="app-table-cell"><?= $user['deleted_at'] ?? '' ?></td>
                    <td class="app-table-cell" style="text-align:center;">
                        <a href="<?= Config::get('adminPrefix') ?>/users/<?= $user['id'] ?>/edit" class="app-btn-primary">
                            更新
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>