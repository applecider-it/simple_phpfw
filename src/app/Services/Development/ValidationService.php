<?php

namespace App\Services\Development;

/**
 * 開発者向けのバリデーション関連のサービス
 */
class ValidationService
{
    /** テストデータ */
    public function testData()
    {
        $data = [
            'originaltest' => 'a',
            'emailtest' => 'testexample.com',
            'numerictest' => '1a23',
            'requiredtest' => '',
            'mintest' => '9',
            'maxtest' => '11',
            'confirmtest' => 'abcd',
            'confirmtest_confirm' => 'abxcd',
        ];

        $rules = [
            'originaltest' => [['original', 'emailtest', 'numerictest']],
            'emailtest' => ['required', 'email'],
            'numerictest' => ['numeric'],
            'requiredtest' => ['required'],
            'mintest' => ['required', 'numeric', ['min', 10]],
            'maxtest' => [['max', 10]],
            'confirmtest' => ['confirm'],
        ];

        $labels = [
            'originaltest' => 'オリジナルテスト',
            'emailtest' => 'メールアドレステスト',
            'numerictest' => '数値テスト',
            'requiredtest' => '空白テスト',
            'mintest' => '最小値テスト',
            'maxtest' => '最大値テスト',
            'confirmtest' => '確認テスト',
        ];

        return [
            'data' => $data,
            'rules' => $rules,
            'labels' => $labels,
        ];
    }
}
