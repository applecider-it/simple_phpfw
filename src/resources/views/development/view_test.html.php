<h2>development.view_test</h2>
<div>
    <h3>フォーム動作確認</h3>
    <div>
        <form method="POST" action="<?= $this->h($this->route('development.view_test_post')) ?>">
            <?= $this->render('partials.form.csrf') ?>
            <div>
                <label for="list_val">リスト動作確認</label>

                <select name="list_val" id="list_val">
                    <option value="">選択してください</option>
                    <?php foreach ($data['list_vals'] as $key => $value): ?>
                        <option value="<?= $this->h($key) ?>"
                            <?= $data['list_val'] == $key ? 'selected' : '' ?>>
                            <?= $this->h($value) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label>ラジオボタン動作確認</label>

                <div>
                    <?php foreach ($data['radio_vals'] as $key => $value): ?>
                        <label>
                            <input type="radio" name="radio_val" value="<?= $this->h($key) ?>"
                                <?= $data['radio_val'] == $key ? 'checked' : '' ?>>
                            <?= $this->h($value) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div>
                <label for="datetime_val">日時動作確認</label>
                <input type="datetime-local" name="datetime_val" value="<?= $this->h($data['datetime_val']) ?>" id="datetime_val" />
            </div>

            <div>
                <button type="submit">送信</button>
            </div>
        </form>
    </div>
</div>