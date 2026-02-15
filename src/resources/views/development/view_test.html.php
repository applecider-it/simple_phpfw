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

$list_val = 2;
$radio_val = 'val2';
$datetime_val = '2026-02-15T14:30';
$list_vals = [
    1 => 'No. 1',
    2 => 'No. 2',
    3 => 'No. 3',
];
$radio_vals = [
    'val1' => 'Value 1',
    'val2' => 'Value 2',
];

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

    <div style="margin-top: 1rem; border: 1px solid #aaa; padding: 1rem;">
        <div>
            フォーム動作確認
        </div>
        <form method="POST" action="/development/view_test">
            <?= $this->render('partials.form.csrf') ?>
            <div style="margin-top: 1rem">
                <label for="list_val" class="app-form-label">リスト動作確認</label>

                <select name="list_val" id="list_val">
                    <option value="">選択してください</option>
                    <?php foreach ($list_vals as $key => $value): ?>
                        <option value="<?= Html::esc($key) ?>"
                            <?= $list_val == $key ? 'selected' : '' ?>>
                            <?= Html::esc($value) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="margin-top: 1rem">
                <label class="app-form-label">ラジオボタン動作確認</label>

                <div class="space-x-3">
                    <?php foreach ($radio_vals as $key => $value): ?>
                        <label>
                            <input type="radio" name="radio_val" value="<?= Html::esc($key) ?>"
                                <?= $radio_val == $key ? 'checked' : '' ?>>
                            <?= Html::esc($value) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div style="margin-top: 1rem">
                <label for="datetime_val" class="app-form-label">日時動作確認</label>
                <input type="datetime-local" name="datetime_val" value="<?= Html::esc($datetime_val) ?>" id="datetime_val"
                 class="app-form-input" style="width: auto;" />
            </div>

            <div style="margin-top: 1rem">
                <button type="submit" class="app-btn-primary">送信</button>
            </div>
        </form>
    </div>
</div>