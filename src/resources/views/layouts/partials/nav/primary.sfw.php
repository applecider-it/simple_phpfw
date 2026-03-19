<?php

use App\Services\User\AuthService as Auth;

$user = Auth::get();
?>
<div class="app-layout-nav-primary">
    <div class="app-layout-nav-menu-container">
        <div>
            <h1 class="app-h1">{{ $this->config('applicationName') }}</h1>
            <a href="{{ $this->route('index') }}">Home</a>
            <a href="{{ $this->route('tweets.index') }}">Tweet</a>
            <a href="{{ $this->route('tweets_js.index') }}">Tweet(JS)</a>
            <a href="{{ $this->route('chat.index') }}">Chat</a>
        </div>
        <div>
            <?php if ($user): ?>
                <span style="margin-right: 1rem;">{{ $user['name'] }}</span>
                <a href="{{ $this->route('logout') }}" onclick="if (confirm('ログアウトしますか？')) document.getElementById('app_nav_logout_form').submit(); return false; ">Logout</a>
                <form method="POST" action="{{ $this->route('logout') }}" id="app_nav_logout_form">
                    <?= $this->render('partials.form.csrf') ?>
                </form>
            <?php else: ?>
                <a href="{{ $this->route('login') }}">Login</a>
            <?php endif ?>
        </div>
    </div>
</div>