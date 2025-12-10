<?php

use SFW\Core\Config;
use SFW\Core\App;
use SFW\Output\Html;

$adminUser = App::get('adminUser');

?>
<div class="app-nav" style="background: #633;">
    <h1 class="app-h1"><?= Config::get('applicationName') ?> Admin</h1>
    <div class="app-nav-menu-container">
        <div>
            <a href="<?= Config::get('adminPrefix') ?>">ダッシュボード</a>
            <a href="<?= Config::get('adminPrefix') ?>/users">ユーザー</a>
        </div>
        <div>
            <?php if ($adminUser): ?>
                (Name: <?= Html::esc($adminUser['name']) ?>)
                <a href="<?= Config::get('adminPrefix') ?>/logout" onclick="if (confirm('ログアウトしますか？')) document.getElementById('app_nav_logout_form').submit(); return false; ">Logout</a>
                <form method="POST" action="<?= Config::get('adminPrefix') ?>/logout" id="app_nav_logout_form">
                    <?= $this->render('partials.form.csrf') ?>
                </form>
            <?php else: ?>
                <a href="<?= Config::get('adminPrefix') ?>/login">Login</a>
            <?php endif ?>
        </div>
    </div>
</div>