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
        {{ $text }}
    <?php else: ?>
        <?php
        $url = $this->route('admin.users.index') . '?'
            . http_build_query(
                ['soft_delete' => $value]
                    + $data
            );
        ?>
        <a href="{{ $url }}" class="app-link-normal">{{ $text }}</a>
    <?php endif; ?>
    <?php $idx++ ?>
<?php endforeach; ?>