<?php

use App\Services\AdminUser\AuthService as Auth;

$adminUser = Auth::get();

$desktopClass = 'hover:text-indigo-500';
?>
<header class="bg-gray-100 shadow-md" x-data="{ open:false }">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <!-- Logo -->
        <a href="/">
            <div
                class="text-2xl font-bold bg-gradient-to-r from-indigo-500 to-purple-500 bg-clip-text text-transparent">
                <?= $this->h($this->config('applicationName')) ?>
            </div>
        </a>

        <!-- Desktop Menu -->
        <nav class="flex space-x-8 text-gray-700 font-medium">
            <a href="<?= $this->h($this->route('admin.index')) ?>" class="<?= $desktopClass ?>">ダッシュボード</a>
            <a href="<?= $this->h($this->route('admin.user.index')) ?>" class="<?= $desktopClass ?>">ユーザー</a>

            <?php if ($adminUser): ?>
                <span class="<?= $desktopClass ?>"><?= $this->h($adminUser['name']) ?></span>
                <a
                    href="<?= $this->h($this->route('admin.logout')) ?>"
                    class="<?= $desktopClass ?>"
                    onclick="if (confirm('ログアウトしますか？')) document.getElementById('app_nav_logout_form').submit(); return false; ">
                    Logout
                </a>
                <form method="POST" action="<?= $this->h($this->route('admin.logout')) ?>" id="app_nav_logout_form">
                    <?= $this->render('partials.form.csrf') ?>
                </form>
            <?php else: ?>
                <a href="<?= $this->h($this->route('admin.login')) ?>" class="<?= $desktopClass ?>">Login</a>
            <?php endif ?>
        </nav>
    </div>
</header>
