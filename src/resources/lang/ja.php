<?php

return [
    // バリデーション用
    'validation' => [
        'errors' => [
            'required' => '{label}は必須です。',
            'email' => '{label}は正しい形式で入力してください。',
            'numeric' => '{label}は数値でなければなりません。',
            'min' => '{label}は{min}以上でなければなりません。',
            'max' => '{label}は{max}以下でなければなりません。',
            'confirm' => '{label}と{label}の確認の値が一致しません。',
            'unique' => '{label}がすでに利用されています。',

            'original' => '{label}は{validValue}でなければなりません。',
        ],
    ],

    // アプリケーション独自の言語データ
    'app' => [
        'errors' => [
            'loginRequired' => 'ログインしてください。',
            'LoginFailed' => 'ログインに失敗しました。',
        ],

        // モデル用
        'models' => [
            'user' => [
                'attributes' => [
                    'name' => '名前',
                    'email' => 'メールアドレス',
                    'password' => 'パスワード',
                ],
            ],
            'user/tweet' => [
                'attributes' => [
                    'content' => '投稿内容',
                ],
            ],
        ],
    ],
];
