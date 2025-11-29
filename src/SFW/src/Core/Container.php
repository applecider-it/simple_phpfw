<?php

namespace SFW\Core;

/**
 * サービスコンテナ
 */
class Container
{
    protected array $singleton = [];

    /** シングルトン設定 */
    public function setSingleton(string $key, $value)
    {
        $this->singleton[$key] = $value;
    }

    /** シングルトン取得 */
    public function getSingleton(string $key)
    {
        if (array_key_exists($key, $this->singleton)) {
            return $this->singleton[$key];
        }

        throw new \Exception("No binding found for key: {$key}");
    }
}
