<?php

use SFW\Core\App;

$vite = App::get('vite');
?>
<script type="module" src="<?= $this->h($vite->asset('resources/js/entrypoints/development/javascript-test.ts')) ?>"></script>

<h2 class="app-h2">development.javascript_test</h2>
<div>
    <h3 class="app-h3">Json動作確認</h3>

    <div id="vue"></div>
</div>