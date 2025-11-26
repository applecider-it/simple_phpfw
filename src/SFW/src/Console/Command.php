<?php

namespace SFW\Console;

/**
 * ベースコマンド
 */
abstract class Command
{
    /** コマンド名 */
    public static string $name = '';

    /** コマンド説明 */
    public static string $desc = '';

    /** コマンドラインから渡された値 */
    public array $params = [];

    /** コマンドラインから渡されたオプション */
    public array $options = [];

    /** ハンドル */
    public function handle() {}
}
