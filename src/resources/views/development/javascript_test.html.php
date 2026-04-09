<script type="module" src="<?= $this->h($this->file('/js/development/javascript-test.js')) ?>"></script>

<h2>development.javascript_test</h2>
<div>
    <h3>Json動作確認</h3>

    <div style="display:flex; flex-direction:row; gap:2rem;">
        <button type="submit" onclick="handle.postJsonTest()">
            Jsonテスト (POST)
        </button>

        <button type="submit" onclick="handle.getJsonTest()">
            Jsonテスト (GET)
        </button>

        <button type="submit" onclick="handle.postNosessionJsonTest()">
            Jsonテスト (POST nosession)
        </button>
    </div>
</div>