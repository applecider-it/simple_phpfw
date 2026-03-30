<?php

$softDeleteHash = [
    'all' => '全て',
    'kept' => '論理削除を除外',
    'deleted' => '論理削除済み',
];

$softDelete = $data['soft_delete'] ?? 'all';

?>
<?php $idx = 0 ?>
<?php foreach ($softDeleteHash as $value => $text): ?>
    <?php if ($idx !== 0): ?>
        <span style="margin: 0 0.5rem;">|</span>
    <?php endif; ?>

    <?php if ($softDelete === $value): ?>
        <?= $this->h($text) ?>
    <?php else: ?>
        <?php
        $url = $this->route('admin.user.index') . '?'
            . http_build_query(
                ['soft_delete' => $value]
                    + $data
            );
        ?>
        <a href="<?= $this->h($url) ?>" class="app-link-normal"><?= $this->h($text) ?></a>
    <?php endif; ?>
    <?php $idx++ ?>
<?php endforeach; ?>