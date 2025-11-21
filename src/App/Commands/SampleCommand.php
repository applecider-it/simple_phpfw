<?php

namespace App\Commands;

use SFW\Core\App;

/**
 * サンプルのコマンド
 */
class SampleCommand
{
    public static string $name = 'app-samplecommand';

    /** ハンドル */
    public function handle($param)
    {
        print_r($param);

        /** @var DB */
        $db = App::get('db');

        $db->tracable = true;

        $user = $db->one("SELECT * FROM users WHERE id > ? LIMIT 1", 0);
        print_r($user);
    }
}
