<?php

namespace App\Commands;

use SFW\Core\App;

/**
 * サンプルのコマンド
 */
class SampleCommand extends Command
{
    /** コマンド名 */
    public static string $name = 'app-samplecommand';

    /** コマンド説明 */
    public static string $desc = 'サンプルコマンド';

    /** ハンドル */
    public function handle()
    {
        echo "params\n";
        print_r($this->params);

        $param0 = $this->params[0] ?? null;
        echo "param0: $param0\n";

        echo "options\n";
        print_r($this->options);

        if (isset($this->options['opt1'])) {
            echo "opt1!!!!\n";
        }

        $opt2 = $this->options['opt2'] ?? null;
        echo "opt2: $opt2\n";

        /** @var DB */
        $db = App::get('db');

        $db->tracable = true;

        $user = $db->one("SELECT * FROM users WHERE id > ? LIMIT 1", 0);

        echo "user\n";
        print_r($user);
    }
}
