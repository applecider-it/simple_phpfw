<?php

declare(strict_types=1);

namespace SFW\Web;

/**
 * パンくず管理
 */
class Breadcrumbs
{
    private array $funcs = [];

    /** パンくず登録 */
    public function set(string $name, \Closure $func): void
    {
        $this->funcs[$name] = $func;
    }

    /** パンくずデータ取得 */
    public function get(string $name, ...$data): array
    {
        isset($this->funcs[$name]) ?: throw new \Exception('Not found Breadcrumbs name. ' . $name);

        $func = $this->funcs[$name];

        $maker = new Breadcrumbs\Maker($this);

        $func($maker, ...$data);

        $arr = $maker->urls();

        return $arr;
    }
}
