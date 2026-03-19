<h3 class="app-h3" style="margin-top: 1rem;">development.partials.render_test_parts</h3>
<div>
    <div style="<?= $this->h($metaStyle) ?>">
        <div>$meta['name']: {{ $meta['name'] }}</div>
        <div>$meta['baseDir']: {{ $meta['baseDir'] }}</div>
        <div>$meta['type']: {{ $meta['type'] }}</div>
        <div>$meta['path']: {{ $meta['path'] }}</div>
        <div>$meta['srcPath']: {{ $meta['srcPath'] }}</div>
        <div>ソース更新日時: {{ date('Y-m-d H:i:s', filemtime($meta['srcPath'])) }}</div>
        <div>テンポラリーファイル更新日時: {{ date('Y-m-d H:i:s', filemtime($meta['path'])) }}</div>
    </div>

    <div>$this->data['id'] {{ $this->data['id'] }}</div>
    <div>$data['id'] {{ $data['id'] ?? 'none' }}</div>
    <div>$data['val1'] {{ $data['val1'] }}</div>
    <div>$id {{ $id ?? 'none' }}</div>
    <div>$val1 {{ $val1 }}</div>
</div>