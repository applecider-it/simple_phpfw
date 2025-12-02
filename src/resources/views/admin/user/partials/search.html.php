<?php

use SFW\Output\Html;
use SFW\Core\Config;

$softDeleteList = [
    ['全て', 'all'],
    ['論理削除を除外', 'kept'],
    ['論理削除済み', 'deleted'],
];

$softDelete = $data['soft_delete'] ?? 'all';

?>
<?php foreach ($softDeleteList as $idx => $row): ?>
    <?php if ($idx !== 0): ?>
        <span style="margin: 0 0.5rem;">|</span>
    <?php endif; ?>

    <?php if ($softDelete === $row[1]): ?>
        <?= $row[0] ?>
    <?php else: ?>
        <?php
        $url = Config::get('adminPrefix') . '/users?'
            . http_build_query(
                ['soft_delete' => $row[1]]
                    + $data
            );
        ?>
        <a href="<?= $url ?>" class="app-link-normal"><?= $row[0] ?></a>
    <?php endif; ?>
<?php endforeach; ?>