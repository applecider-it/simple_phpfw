<?php
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

$codeStyle = implode(
    ';',
    [
        'color: #444',
        'background-color: #ddd',
        'font-size: 0.8rem',
        'border: 1px solid #555',
        'border-radius: 5px',
        'padding: 1rem',
        'margin: 0.5rem 0',
        'white-space: pre-wrap',
    ]
);
?>
<h2 class="app-h2">development.template_test</h2>
<div>
    <div>
        <div>$data['val1']:</div>

        <div>
            エスケープあり1:
            {{ $data['val1'] }} - {{ $data['val2'] }} |
            {{ $data['val2'] }} - {{ $data['val1'] }} |
        </div>

        <div>
            エスケープあり2:
            {{ $data['val1'] }} - {{ $data['val1'] }} |
            {{ $data['val2'] }} - {{ $data['val2'] }} |
        </div>

        <div>
            エスケープあり3:
            {{ $data['val1'] }} - {{ $data['val2'] }} |
            {{ $data['val1'] }} - {{ $data['val2'] }} |
        </div>

        <div>
            エスケープなし:
            <?= $data['val2'] ?> - <?= $data['val1'] ?>
        </div>
    </div>

    <div style="{{ $metaStyle }}">
        <div>$meta['name']: {{ $meta['name'] }}</div>
        <div>$meta['baseDir']: {{ $meta['baseDir'] }}</div>
        <div>$meta['path']: {{ $meta['path'] }}</div>
        <div>$meta['srcPath']: {{ $meta['srcPath'] }}</div>
        <div>$meta['type']: {{ $meta['type'] }}</div>
        <div>ソース更新日時: {{ date('Y-m-d H:i:s', filemtime($meta['srcPath'])) }}</div>
        <div>テンポラリーファイル更新日時: {{ date('Y-m-d H:i:s', filemtime($meta['path'])) }}</div>
    </div>

    <div>
        <div>ソース</div>
        <pre style="{{ $codeStyle }}">{{ file_get_contents($meta['srcPath']) }}</pre>
    </div>

    <div>
        <div>テンポラリーファイル</div>
        <pre style="{{ $codeStyle }}">{{ file_get_contents($meta['path']) }}</pre>
    </div>
</div>
