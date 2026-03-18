<?php

use SFW\Core\Config;
use function SFW\Helpers\route;
use App\Services\AdminUser\AuthService as Auth;

$adminUser = Auth::get();
?>
<div class="app-layout-nav" style="background: #aaa;">
    <div class="app-layout-nav-menu-container">
        <div>
            <h1 class="app-h1">{{ Config::get('applicationName') }}</h1>
            <a href="{{ route('admin.index') }}">ダッシュボード</a>
            <a href="{{ route('admin.users.index') }}">ユーザー</a>
        </div>
        <div>
            <?php if ($adminUser): ?>
                <span style="margin-right: 1rem;">{{ $adminUser['name'] }}</span>
                <a href="{{ route('admin.logout') }}" onclick="if (confirm('ログアウトしますか？')) document.getElementById('app_nav_logout_form').submit(); return false; ">Logout</a>
                <form method="POST" action="{{ route('admin.logout') }}" id="app_nav_logout_form">
                    <?= $this->render('partials.form.csrf') ?>
                </form>
            <?php else: ?>
                <a href="{{ route('admin.login') }}">Login</a>
            <?php endif ?>
        </div>
    </div>
</div>