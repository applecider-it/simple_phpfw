<h2>development.index</h2>

<div style="display:flex; flex-direction:column; gap:2rem;">
    <div>
        <div><a href="<?= $this->h($this->route('development.php_test')) ?>">php_test</a></div>
        <div><a href="<?= $this->h($this->route('development.view_test')) ?>">view_test</a></div>
        <div><a href="<?= $this->h($this->route('development.javascript_test')) ?>">javascript_test</a></div>
    </div>

    <div>
        <div><a href="<?= $this->h($this->route('development.database_test')) ?>">database_test</a></div>
        <div><a href="<?= $this->h($this->route('development.validation_test')) ?>">validation_test</a></div>
        <div><a href="<?= $this->h($this->route('development.render_test')) ?>">render_test</a></div>
    </div>

    <div>
        <div><a href="<?= $this->h($this->route('development.index')) ?>/notfoud_test">notfoud_test</a></div>
        <div><a href="<?= $this->h($this->route('development.exeption_test')) ?>">exeption_test</a></div>
    </div>
</div>