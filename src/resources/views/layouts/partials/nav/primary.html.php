<?php

use SFW\Core\Config;
use SFW\Core\App;
use SFW\Output\Html;

$user = App::get('user');
?>
<div class="app-layout-nav-primary">
    <h1 class="app-h1"><?= Config::get('applicationName') ?></h1>
    <div class="app-layout-nav-menu-container">
        <div>
            <a href="/">Home</a>
            <a href="/tweets">Tweet</a>
            <a href="/chat">Chat</a>
        </div>
        <div>
            <?php if ($user): ?>
                (Name: <?= Html::esc($user['name']) ?>)
                <a href="/logout" onclick="if (confirm('ログアウトしますか？')) document.getElementById('app_nav_logout_form').submit(); return false; ">Logout</a>
                <form method="POST" action="/logout" id="app_nav_logout_form">
                    <?= $this->render('partials.form.csrf') ?>
                </form>
            <?php else: ?>
                <a href="/login">Login</a>
            <?php endif ?>
        </div>
    </div>
</div>