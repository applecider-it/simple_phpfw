<?php

use SFW\Web\Breadcrumbs\Maker;
use function SFW\Helpers\route;

// 管理画面ホーム
$breadcrumbs->set('admin.dashboard', function (Maker $maker) {
    $maker->add('ダッシュボード', route('admin.index'));
});

// ユーザー一覧
$breadcrumbs->set('admin.users.index', function (Maker $maker) {
    $maker->parent('admin.dashboard');
    $maker->add('ユーザー', route('admin.users.index'));
});

// ユーザー新規作成
$breadcrumbs->set('admin.users.create', function (Maker $maker) {
    $maker->parent('admin.users.index');
    $maker->add('新規作成', route('admin.users.create'));
});

// ユーザー編集
$breadcrumbs->set('admin.users.edit', function (Maker $maker, array $user) {
    $maker->parent('admin.users.index');
    $maker->add($user['name'], route('admin.users.edit', ['id' => $user['id']]));
});
