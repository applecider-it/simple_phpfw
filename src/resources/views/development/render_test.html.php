<?php

/** @var string 部品HTML用Style */
$partialStyle = implode(
    ';',
    [
        'border: 1px solid #555',
        'border-radius: 7px',
        'padding: 0.7rem',
        'margin: 1rem 0',
        'background: #eee',
        'box-shadow: 0 3px 8px rgba(0, 0, 0, 0.12)',
    ]
);

/** @var string meta情報用Style */
$metaStyle = implode(
    ';',
    [
        'color: #ddd',
        'background-color: #555',
        'font-size: 0.8rem',
        'border: 1px solid #555',
        'border-radius: 5px',
        'padding: 0.5rem',
        'margin: 0.5rem 0',
    ]
);
?>
<h2 class="app-h2">development.render_test</h2>
<div>
    <div style="<?= $this->h($metaStyle) ?>">
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

    <div style="<?= $this->h($partialStyle) ?>">
        <div>partial test</div>
        <div><?= $this->render(
                    'development.partials.render_test_parts',
                    [
                        'val1' => '部品用の値',
                        'metaStyle' => $metaStyle,
                    ]
                ) ?></div>
    </div>

    <div style="<?= $this->h($metaStyle) ?>">
        <div>$meta['name']: <?= $this->h($meta['name']) ?></div>
        <div>$meta['baseDir']: <?= $this->h($meta['baseDir']) ?></div>
        <div>$meta['path']: <?= $this->h($meta['path']) ?></div>
    </div>

    <div style="<?= $this->h($partialStyle) ?>">
        <div>partial test2</div>
        <div><?= $this->render(
                    'development.partials.render_test_parts',
                    [
                        'val1' => '部品用の値2',
                        'metaStyle' => $metaStyle,
                    ]
                ) ?></div>
    </div>

    <div style="<?= $this->h($metaStyle) ?>">
        <div>$meta['name']: <?= $this->h($meta['name']) ?></div>
        <div>$meta['baseDir']: <?= $this->h($meta['baseDir']) ?></div>
        <div>$meta['path']: <?= $this->h($meta['path']) ?></div>
    </div>
</div>