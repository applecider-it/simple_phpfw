<h3>development.partials.render_test_parts</h3>
<div>
    <div class="<?= $this->h($metaClass) ?>">
        <div>$meta['name']: <?= $this->h($meta['name']) ?></div>
        <div>$meta['baseDir']: <?= $this->h($meta['baseDir']) ?></div>
        <div>$meta['path']: <?= $this->h($meta['path']) ?></div>
    </div>

    <div>$this->data['id'] <?= $this->h($this->data['id']) ?></div>
    <div>$data['id'] <?= $this->h($data['id'] ?? 'none') ?></div>
    <div>$data['val1'] <?= $this->h($data['val1']) ?></div>
    <div>$id <?= $this->h($id ?? 'none') ?></div>
    <div>$val1 <?= $this->h($val1) ?></div>
</div>