<?php

use SFW\Core\Config;

$prefix = Config::get('prefix');
?>
<h2 class="app-h2">development.index</h2>

<div style="display:flex; flex-direction:column; gap:1rem;">
    <div>
        <div><a href="{{ $this->route('development.php_test') }}" class="app-link-normal">php_test</a></div>
        <div><a href="{{ $this->route('development.view_test') }}" class="app-link-normal">view_test</a></div>
        <div><a href="{{ $this->route('development.javascript_test') }}" class="app-link-normal">javascript_test</a></div>
    </div>

    <div>
        <div><a href="{{ $this->route('development.render_test') }}" class="app-link-normal">render_test</a></div>
        <div><a href="{{ $this->route('development.template_test') }}" class="app-link-normal">template_test</a></div>
        <div><a href="{{ $this->route('development.param_test', ['id' => 321]) }}?val1=abc" class="app-link-normal">param_test</a></div>
        <div><a href="{{ $this->route('development.database_test') }}" class="app-link-normal">database_test</a></div>
        <div><a href="{{ $this->route('development.validation_test') }}" class="app-link-normal">validation_test</a></div>
    </div>

    <div>
        <div><a href="{{ $this->route('development.redirect_test') }}" class="app-link-normal">redirect_test</a></div>
        <div><a href="{{ $this->route('development.exeption_test') }}" class="app-link-normal">exeption_test</a></div>
        <div><a href="{{ $this->route('development.index') }}/notfoud_test" class="app-link-normal">notfoud_test</a></div>
    </div>

    <div>
        <div><a href="{{ $this->route('development.design') }}" class="app-link-normal">design</a></div>
    </div>
</div>