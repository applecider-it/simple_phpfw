<h2 class="app-h2">development.index</h2>

<div class="space-y-5">
    <div>
        <div><a href="<?= $this->h($this->route('development.php_test')) ?>" class="app-link-normal">php_test</a></div>
        <div><a href="<?= $this->h($this->route('development.view_test')) ?>" class="app-link-normal">view_test</a></div>
        <div><a href="<?= $this->h($this->route('development.javascript_test')) ?>" class="app-link-normal">javascript_test</a></div>
    </div>

    <div>
        <div><a href="<?= $this->h($this->route('development.database_test')) ?>" class="app-link-normal">database_test</a></div>
        <div><a href="<?= $this->h($this->route('development.validation_test')) ?>" class="app-link-normal">validation_test</a></div>
        <div><a href="<?= $this->h($this->route('development.render_test')) ?>" class="app-link-normal">render_test</a></div>
    </div>

    <div>
        <div><a href="<?= $this->h($this->route('development.index')) ?>/notfoud_test" class="app-link-normal">notfoud_test</a></div>
        <div><a href="<?= $this->h($this->route('development.exeption_test')) ?>" class="app-link-normal">exeption_test</a></div>
    </div>
</div>