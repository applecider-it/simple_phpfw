<?php

use SFW\Output\Html;

/** @var string 部品HTML用Style */
$partialStyle = "
    border: 1px solid #555;
    border-radius: 7px;
    padding: 0.7rem;
    margin: 1rem 0;
    background: #eee;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.12);
";

/** @var string meta情報用Style */
$metaStyle = "
    color: #555;
    font-size: 0.8rem;
    border: 1px solid #555;
    border-radius: 5px;
    padding: 0.5rem;
    margin: 0.5rem 0;
";
?>
<h2 class="app-h2">development.view_test</h2>
<div>
    <div style="<?= $metaStyle ?>">
        <div>$name <?= Html::esc($name) ?></div>
        <div>$baseDir <?= Html::esc($baseDir) ?></div>
        <div>$path <?= Html::esc($path) ?></div>
    </div>

    <div>$this->data['id'] <?= Html::esc($this->data['id']) ?></div>
    <div>$data['id'] <?= Html::esc($data['id']) ?></div>
    <div>$data['content'] <?= Html::esc($data['content']) ?></div>
    <div>$data['val1'] <?= Html::esc($data['val1'] ?? 'none') ?></div>

    <div style="<?= $partialStyle ?>">
        <div>partial test</div>
        <div><?= $this->render('development.partials.view_test_parts', [
                    'val1' => '部品用の値',
                    'metaStyle' => $metaStyle,
                ]) ?></div>
    </div>

    <div style="<?= $partialStyle ?>">
        <div>partial test2</div>
        <div><?= $this->render('development.partials.view_test_parts', [
                    'val1' => '部品用の値2',
                    'metaStyle' => $metaStyle,
                ]) ?></div>
    </div>

    <div style="<?= $metaStyle ?>">
        <div>$name <?= Html::esc($name) ?></div>
        <div>$baseDir <?= Html::esc($baseDir) ?></div>
        <div>$path <?= Html::esc($path) ?></div>
    </div>
</div>