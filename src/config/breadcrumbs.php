<?php

use SFW\Core\Config;

use SFW\Web\Breadcrumbs\Maker;

// 管理画面ホーム
$breadcrumbs->set('admin.dashboard', function (Maker $maker) {
    $maker->add('ダッシュボード', Config::get('app.adminPrefix'));
});

// ユーザー一覧
$breadcrumbs->set('admin.users.index', function (Maker $maker) {
    $maker->parent('admin.dashboard');
    $maker->add('ユーザー', Config::get('app.adminPrefix') . '/users');
});

// ユーザー新規作成
$breadcrumbs->set('admin.users.create', function (Maker $maker) {
    $maker->parent('admin.users.index');
    $maker->add('新規作成', Config::get('app.adminPrefix') . '/users/create');
});

// ユーザー編集
$breadcrumbs->set('admin.users.edit', function (Maker $maker, array $user) {
    $maker->parent('admin.users.index');
    $maker->add($user['name'], Config::get('app.adminPrefix') . '/users/' . $user['id'] . '/edit');
});
