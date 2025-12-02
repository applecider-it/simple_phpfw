<?php

namespace App\ModelsAnother;

use App\Models\Model;

/**
 * 外部テーブル実装例モデル
 */
class Another extends Model
{
    protected static string $table = 'anothers';
    protected static string $database = 'db_another';
}
