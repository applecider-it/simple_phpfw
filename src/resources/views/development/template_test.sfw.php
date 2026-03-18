<?php

use function SFW\Helpers\html_esc as h;

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
        <div>
            エスケープあり1:<br />
            {{ $data['val1'] }} - {{ $data['val2'] }}<br />
            {{ $data['val2'] }} - {{ $data['val1'] }}<br />
            {{ $val1 }} - {{ $val2 }}<br />
            {{ $val2 }} - {{ $val1 }}<br />
        </div>

        <div>
            エスケープあり2:<br />
            {{ $data['val1'] }} - {{ $data['val1'] }}<br />
            {{ $data['val2'] }} - {{ $data['val2'] }}<br />
            {{ $val1 }} - {{ $val1 }}<br />
            {{ $val2 }} - {{ $val2 }}<br />
        </div>

        <div>
            エスケープあり3:<br />
            {{ $data['val1'] }} - {{ $data['val2'] }}<br />
            {{ $data['val1'] }} - {{ $data['val2'] }}<br />
            {{ $val1 }} - {{ $val2 }}<br />
            {{ $val1 }} - {{ $val2 }}<br />
        </div>

        <div>
            エスケープなし:<br />
            <?= $data['val2'] ?> - <?= $data['val1'] ?><br />
            <?= $val2 ?> - <?= $val1 ?><br />
        </div>
    </div>

    <div style="<?= h($metaStyle) ?>">
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
        <pre style="<?= h($codeStyle) ?>">{{ file_get_contents($meta['srcPath']) }}</pre>
    </div>

    <div>
        <div>テンポラリーファイル</div>
        <pre style="<?= h($codeStyle) ?>">{{ file_get_contents($meta['path']) }}</pre>
    </div>
</div>
