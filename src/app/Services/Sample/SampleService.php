<?php

namespace App\Services\Sample;

/**
 * サブクラスを利用したサービスクラスの実装例
 */
class SampleService
{
    /** サンプルメソッド */
    public function sampleMethod()
    {
        $subService = new SampleService\SubService();
        return $subService->sampleSubMethod();
    }
}
