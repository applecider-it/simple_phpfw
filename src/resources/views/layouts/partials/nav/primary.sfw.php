<?php

use SFW\Core\Config;
use function SFW\Helpers\route;
use App\Services\User\AuthService as Auth;

$user = Auth::get();
$prefix = Config::get('prefix');
?>
<div class="app-layout-nav-primary">
    <div class="app-layout-nav-menu-container">
        <div>
            <h1 class="app-h1">{{ Config::get('applicationName') }}</h1>
            <a href="{{ route('index') }}">Home</a>
            <a href="{{ route('tweets.index') }}">Tweet</a>
            <a href="{{ route('tweets_js.index') }}">Tweet(JS)</a>
            <a href="{{ route('chat.index') }}">Chat</a>
        </div>
        <div>
            <?php if ($user): ?>
                <span style="margin-right: 1rem;">{{ $user['name'] }}</span>
                <a href="{{ route('logout') }}" onclick="if (confirm('ログアウトしますか？')) document.getElementById('app_nav_logout_form').submit(); return false; ">Logout</a>
                <form method="POST" action="{{ route('logout') }}" id="app_nav_logout_form">
                    <?= $this->render('partials.form.csrf') ?>
                </form>
            <?php else: ?>
                <a href="{{ route('login') }}">Login</a>
            <?php endif ?>
        </div>
    </div>
</div>