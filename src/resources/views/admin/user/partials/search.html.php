<?php

$softDeleteHash = [
    'all' => '全て',
    'kept' => '論理削除を除外',
    'deleted' => '論理削除済み',
];

$softDelete = $data['soft_delete'] ?? 'all';

?>
<form action="<?= $this->h($this->route('admin.user.index')) ?>">
    <input type="hidden" name="page" value="<?= $this->h($page ?? 1) ?>" />

    <select name="soft_delete" class="app-form-input w-auto">
        <?php foreach ($softDeleteHash as $value => $text): ?>
            <option
                <?= ($softDelete === $value) ? 'selected' : '' ?>
                value="<?= $this->h($value) ?>">
                <?= $this->h($text) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input
        type="text" name="search" value="<?= $this->h($search ?? '') ?>"
        placeholder="名前・メールで検索"
        class="app-form-input w-auto">

    <button type="submit" class="app-btn-primary">検索</button>
</form>