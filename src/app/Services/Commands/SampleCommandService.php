<?php

namespace App\Services\Commands;

use SFW\Core\App;

/**
 * サンプルコマンド用サービス
 */
class SampleCommandService
{
    public function exec(array $params, array $options)
    {
        echo "params\n";
        print_r($params);

        $param0 = $params[0] ?? null;
        echo "param0: $param0\n";

        echo "options\n";
        print_r($options);

        if (isset($options['opt1'])) {
            echo "opt1!!!!\n";
        }

        $opt2 = $options['opt2'] ?? null;
        echo "opt2: $opt2\n";

        /** @var DB */
        $db = App::get('db');

        $user = $db->one("SELECT * FROM users WHERE id > ? LIMIT 1", 0);

        echo "user\n";
        print_r($user);
    }
}
