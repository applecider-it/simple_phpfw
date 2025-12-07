<?php

use SFW\Core\Config;
use SFW\Core\App;
use SFW\Output\Html;

$user = App::get('user');
?>
<div class="app-header-responsive">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div><?= Config::get('applicationName') ?></div>
        <div>
            <div id="app-nav-mobile-menu-button" style="cursor: pointer;">
                <!-- Heroicons: Menu -->
                <svg style="width: 2rem; height: 2rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </div>
        </div>
    </div>
    <div class="app-header-responsive-links" id="app-nav-mobile-menu-area">
        <a href="/">Home</a>
        <a href="/tweets">Tweet</a>
        <a href="/chat">Chat</a>
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