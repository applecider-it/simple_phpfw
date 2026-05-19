<?php

namespace App\Services\Development;

/**
 * 開発者向けページのJavascriptテスト管理
 */
class JavascriptService
{
    /** POST APIデータ */
    public function apiPostData(array $user, array $params)
    {
        return [
            'data' => [
                'user' => $user,
                'params.aaa' => $params['aaa'],
            ]
        ];
    }

    /** GET APIデータ */
    public function apiGetData(array $user, array $params)
    {
        return [
            'data' => [
                'user' => $user,
                'params.val1' => $params['get_val'],
                '111' => [
                    '222' => [
                        '333' => '444',
                    ]
                ]
            ]
        ];
    }

    /** セッションがないPOST APIデータ */
    public function apiPostNosessionData(?array $user, array $params)
    {
        return [
            'data' => [
                'type' => 'nosession',
                'user' => $user,
                'params.aaa' => $params['aaa'],
            ]
        ];
    }
}
