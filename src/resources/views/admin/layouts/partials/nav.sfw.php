<?php

use App\Services\AdminUser\AuthService as Auth;

$adminUser = Auth::get();
?>
<div class="app-layout-nav" style="background: #aaa;">
    <div class="app-layout-nav-menu-container">
        <div>
            <h1 class="app-h1">{{ $this->config('applicationName') }}</h1>
            <a href="{{ $this->route('admin.index') }}">ダッシュボード</a>
            <a href="{{ $this->route('admin.users.index') }}">ユーザー</a>
        </div>
        <div>
            <?php if ($adminUser): ?>
                <span style="margin-right: 1rem;">{{ $adminUser['name'] }}</span>
                <a href="{{ $this->route('admin.logout') }}" onclick="if (confirm('ログアウトしますか？')) document.getElementById('app_nav_logout_form').submit(); return false; ">Logout</a>
                <form method="POST" action="{{ $this->route('admin.logout') }}" id="app_nav_logout_form">
                    <?= $this->render('partials.form.csrf') ?>
                </form>
            <?php else: ?>
                <a href="{{ $this->route('admin.login') }}">Login</a>
            <?php endif ?>
        </div>
    </div>
</div>