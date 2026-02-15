<?php

use SFW\Output\Html;

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
    <div style="border: 1px solid #aaa; padding: 1rem;">
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