<?php

declare(strict_types=1);

namespace SFW\Generator;

/**
 * ベースジェネレーター
 */
abstract class Generator
{
    /** ジェネレーターコマンド名 */
    public static string $name = '';

    /** ジェネレーターコマンド説明 */
    public static string $desc = '';

    /** ジェネレーターコマンド説明の詳細 */
    public static string $descDetail = '';

    /** 生成情報を作成 */
    public function conf(array $params, array $options) {
        return [];
    }
}
