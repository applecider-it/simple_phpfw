<?php

namespace SFW\Core;

class Container
{
    protected array $singleton = [];

    public function setSingleton(string $key, $value)
    {
        $this->singleton[$key] = $value;
    }

    public function getSingleton(string $key)
    {
        if (isset($this->singleton[$key])) {
            return $this->singleton[$key];
        }

        throw new \Exception("No binding found for key: {$key}");
    }
}
