<?php

namespace App\Services\Sample;

class SampleService
{
    public function sampleMethod()
    {
        $subService = new SampleService\SubService();
        return $subService->sampleSubMethod();
    }
}
