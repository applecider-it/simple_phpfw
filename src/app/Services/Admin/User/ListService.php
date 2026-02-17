<?php

namespace App\Services\Admin\User;

use SFW\Pagination\Paginator;

use App\Models\User;
use App\Models\User\Tweet;

/**
 * 管理画面　ユーザー管理のリスト関連
 */
class ListService
{
    /**
     * 一覧データ取得
     */
    public function getListData(array $params)
    {
        $query = User::query()
            ->scope([User::class, 'includeDeleted'])
            ->order("id desc");

        $softDelete = $params['soft_delete'] ?? 'all';
        if ($softDelete === 'kept') $query->scope([User::class, 'kept']);
        if ($softDelete === 'deleted') $query->scope([User::class, 'deleted']);

        $paginator = new Paginator($params, 8, 'page');

        $paginator->query($query);

        $users = $query->all();

        return compact('paginator', 'users');
    }

    /**
     * ツイート一覧データ取得
     */
    public function getUserTweetData(array $user, array $params)
    {
        $query = User::tweets($user['id'])
            ->scope([Tweet::class, 'includeDeleted'])
            ->order("id desc");

        $tweetsPaginator = new Paginator($params, 5, 'tweets_page');

        $tweetsPaginator->query($query);

        $tweets = $query->all();

        return compact('tweets', 'tweetsPaginator');
    }
}
