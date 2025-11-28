<?php

use SFW\Output\Html;
?>
<h2>admin.user.index</h2>

<div>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
        <?php foreach ($data['users'] as $user) { ?>
            <tr>
                <td><?= Html::esc($user['name'] ?? '') ?></td>
                <td><?= Html::esc($user['email'] ?? '') ?></td>
            </tr>
        <?php } ?>
    </table>
</div>