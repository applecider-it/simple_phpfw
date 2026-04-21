<?php

use App\Services\AdminUser\AuthService as Auth;

$adminUser = Auth::get();
?>
<div style="background: #eee; padding: 0.5rem;">
    <div>
        <h1><?= $this->h($this->config('applicationName')) ?></h1>
        <a href="<?= $this->h($this->route('admin.index')) ?>">ダッシュボード</a>
        <a href="<?= $this->h($this->route('admin.user.index')) ?>">ユーザー</a>

        <?php if ($adminUser): ?>
            <span><?= $this->h($adminUser['name']) ?></span>
            <a
                href="<?= $this->h($this->route('admin.logout')) ?>"
                onclick="if (confirm('ログアウトしますか？')) document.getElementById('app_nav_logout_form').submit(); return false; "
            >
                Logout
            </a>
            <form method="POST" action="<?= $this->h($this->route('admin.logout')) ?>" id="app_nav_logout_form">
                <?= $this->render('partials.form.csrf') ?>
            </form>
        <?php else: ?>
            <a href="<?= $this->h($this->route('admin.login')) ?>">Login</a>
        <?php endif ?>
    </div>
</div>