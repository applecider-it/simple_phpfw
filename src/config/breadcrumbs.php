<?php

use SFW\Web\Breadcrumbs\Maker;
use function SFW\Helpers\route;

// 管理画面ホーム
$breadcrumbs->set('admin.dashboard', function (Maker $maker) {
    $maker->add('ダッシュボード', route('admin.index'));
});

// ユーザー一覧
$breadcrumbs->set('admin.user.index', function (Maker $maker) {
    $maker->merge('admin.dashboard');
    $maker->add('ユーザー', route('admin.user.index'));
});

// ユーザー新規作成
$breadcrumbs->set('admin.user.create', function (Maker $maker) {
    $maker->merge('admin.user.index');
    $maker->add('新規作成', route('admin.user.create'));
});

// ユーザー編集
$breadcrumbs->set('admin.user.edit', function (Maker $maker, array $user) {
    $maker->merge('admin.user.index');
    $maker->add($user['name'], route('admin.user.edit', ['id' => $user['id']]));
});
