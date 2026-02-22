<?php

declare(strict_types=1);

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

    /** コマンド説明の詳細 */
    public static string $descDetail = '';

    /** コマンドラインから渡された値 */
    public array $params = [];

    /** コマンドラインから渡されたオプション */
    public array $options = [];

    /** ハンドル */
    public function handle() {}
}
