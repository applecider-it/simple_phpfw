<?php

declare(strict_types=1);

namespace App\Services\Nav\BreadcrumbsService;

use App\Services\Nav\BreadcrumbsService;

/**
 * パンくず生成
 */
class MakerService
{
    private array $urls = [];

    function __construct(private BreadcrumbsService $breadcrumbs) {}

    /** パンくずを追加 */
    public function add(string $name, string $url): void
    {
        $this->urls[] = [
            'url' => $url,
            'name' => $name,
        ];
    }

    /** 別の設定をマージする */
    public function merge(string $name, ...$data): void
    {
        $urls = $this->breadcrumbs->get($name, ...$data);
        $this->urls = array_merge($this->urls, $urls);
    }

    public function urls(): array
    {
        return $this->urls;
    }
}
