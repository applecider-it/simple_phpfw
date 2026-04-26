<?php

use App\Services\User\AuthService as Auth;

$user = Auth::get();

$desktopClass = 'hover:text-indigo-500';
?>
<header class="bg-white shadow-md" x-data="{ open:false }">
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
            <a href="<?= $this->h($this->route('index')) ?>" class="<?= $desktopClass ?>">Home</a>
            <a href="<?= $this->h($this->route('tweets.index')) ?>" class="<?= $desktopClass ?>">Tweet</a>

            <?php if ($user): ?>
                <a href="<?= $this->h($this->route('user.edit')) ?>" class="<?= $desktopClass ?>"><?= $this->h($user['name']) ?></a>
                <a
                    href="<?= $this->h($this->route('logout')) ?>"
                    class="<?= $desktopClass ?>"
                    onclick="if (confirm('ログアウトしますか？')) document.getElementById('app_nav_logout_form').submit(); return false; ">
                    Logout
                </a>
                <form method="POST" action="<?= $this->h($this->route('logout')) ?>" id="app_nav_logout_form">
                    <?= $this->render('partials.form.csrf') ?>
                </form>
            <?php else: ?>
                <a href="<?= $this->h($this->route('user.create')) ?>" class="<?= $desktopClass ?>">Sign Up</a>
                <a href="<?= $this->h($this->route('login')) ?>" class="<?= $desktopClass ?>">Login</a>
            <?php endif ?>
        </nav>
    </div>
</header>
