<?php

declare(strict_types=1);

namespace SFW\Web\Breadcrumbs;

use SFW\Web\Breadcrumbs;

/**
 * パンくず生成
 */
class Maker
{
    private array $urls = [];

    function __construct(private Breadcrumbs $breadcrumbs) {}

    /** パンくずを追加 */
    public function add(string $name, string $url): void
    {
        $this->urls[] = [
            'url' => $url,
            'name' => $name,
        ];
    }

    /** 親データ追加 */
    public function parent(string $name, ...$data): void
    {
        $urls = $this->breadcrumbs->get($name, ...$data);
        $this->urls = array_merge($this->urls, $urls);
    }

    public function urls(): array
    {
        return $this->urls;
    }
}
