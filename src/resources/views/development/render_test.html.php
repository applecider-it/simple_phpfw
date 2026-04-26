<?php
$partialClass = 'border border-gray-600 rounded-md p-3 my-4 bg-gray-100 shadow';
$metaClass = 'text-gray-200 bg-gray-600 text-xs border border-gray-600 rounded px-2 py-1 my-2';
?>
<h2 class="app-h2">development.render_test</h2>
<div>
    <div class="<?= $this->h($metaClass) ?>">
        <div>$meta['name']: <?= $this->h($meta['name']) ?></div>
        <div>$meta['baseDir']: <?= $this->h($meta['baseDir']) ?></div>
        <div>$meta['path']: <?= $this->h($meta['path']) ?></div>
    </div>

    <div>$this->data['id'] <?= $this->h($this->data['id']) ?></div>
    <div>$data['id'] <?= $this->h($data['id']) ?></div>
    <div>$data['val1'] <?= $this->h($data['val1'] ?? 'none') ?></div>
    <div>$id <?= $this->h($id) ?></div>
    <div>$val1 <?= $this->h($val1 ?? 'none') ?></div>
    <div>$data['data'] <?= $this->h($data['data']) ?></div>
    <div>$data['meta'] <?= $this->h($data['meta']) ?></div>

    <div class="<?= $this->h($partialClass) ?>">
        <div>partial test</div>
        <div><?= $this->render(
                    'development.partials.render_test_parts',
                    [
                        'val1' => '部品用の値',
                        'metaClass' => $metaClass,
                    ]
                ) ?></div>
    </div>

    <div class="<?= $this->h($metaClass) ?>">
        <div>$meta['name']: <?= $this->h($meta['name']) ?></div>
        <div>$meta['baseDir']: <?= $this->h($meta['baseDir']) ?></div>
        <div>$meta['path']: <?= $this->h($meta['path']) ?></div>
    </div>

    <div class="<?= $this->h($partialClass) ?>">
        <div>partial test2</div>
        <div><?= $this->render(
                    'development.partials.render_test_parts',
                    [
                        'val1' => '部品用の値2',
                        'metaClass' => $metaClass,
                    ]
                ) ?></div>
    </div>

    <div class="<?= $this->h($metaClass) ?>">
        <div>$meta['name']: <?= $this->h($meta['name']) ?></div>
        <div>$meta['baseDir']: <?= $this->h($meta['baseDir']) ?></div>
        <div>$meta['path']: <?= $this->h($meta['path']) ?></div>
    </div>
</div>