<?php

use SFW\Output\Html;
use SFW\Core\Config;
?>
<h2>admin.user.index</h2>

<div>
    <div>
        <a href="<?= Config::get('adminPrefix') ?>/users/create">新規作成</a>
    </div>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>削除日時</th>
        </tr>
        <?php foreach ($data['users'] as $user) { ?>
            <tr>
                <td><?= Html::esc($user['name'] ?? '') ?></td>
                <td><?= Html::esc($user['email'] ?? '') ?></td>
                <td><?= $user['deleted_at'] ?? '' ?></td>
                <td><a href="<?= Config::get('adminPrefix') ?>/users/<?= $user['id'] ?>/edit">更新</a></td>
                <td>
                    <form method="POST" action="<?= Config::get('adminPrefix') ?>/users/<?= $user['id'] ?>/destroy" onsubmit="return confirm('削除しますか？')">
                        <div>
                            <button type="submit">論理削除</button>
                        </div>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>