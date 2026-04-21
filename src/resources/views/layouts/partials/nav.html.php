<?php

use App\Services\User\AuthService as Auth;

$user = Auth::get();
?>
<div style="background: #eee; padding: 0.5rem;">
    <h1><?= $this->h($this->config('applicationName')) ?></h1>
    <a href="<?= $this->h($this->route('index')) ?>">Home</a>
    <a href="<?= $this->h($this->route('tweets.index')) ?>">Tweet</a>

    <?php if ($user): ?>
        <a href="<?= $this->h($this->route('user.edit')) ?>"><?= $this->h($user['name']) ?></a>
        <a
            href="<?= $this->h($this->route('logout')) ?>"
            onclick="if (confirm('ログアウトしますか？')) document.getElementById('app_nav_logout_form').submit(); return false; ">
            Logout
        </a>
        <form method="POST" action="<?= $this->h($this->route('logout')) ?>" id="app_nav_logout_form">
            <?= $this->render('partials.form.csrf') ?>
        </form>
    <?php else: ?>
        <a href="<?= $this->h($this->route('user.create')) ?>">Sign Up</a>
        <a href="<?= $this->h($this->route('login')) ?>">Login</a>
    <?php endif ?>
</div>