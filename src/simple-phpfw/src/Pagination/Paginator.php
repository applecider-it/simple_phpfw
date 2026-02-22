<?php

declare(strict_types=1);

namespace SFW\Pagination;

use SFW\Database\Query;

/**
 * ページ管理
 */
class Paginator
{
    /** 現在ページ */
    private int $currentPage = 0;

    /** トータル件数 */
    private int $totalCount = 0;

    /** トータルページ数 */
    private int $totalPages = 0;

    /** SQLのOFFSETの値 */
    private int $offset = 0;

    /** 
     * @param array $params リクエストパラメーター
     * @param int $perPage 最大表示行数
     * @param string $pageName 現在ページのパラメーター名
     */
    public function __construct(
        private array $params,
        private int $perPage,
        private string $pageName,
    ) {}

    /** 
     * クエリービルダーからデータを生成
     */
    public function query(Query $query): void
    {
        $this->totalCount = $query->count();

        $this->createInfo();

        $query->limit($this->perPage);
        $query->offset($this->offset);
    }

    /** 
     * ページURL生成
     */
    public function pageUrl(int $page): string
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $params = $this->params;

        $params[$this->pageName] = $page;

        return $path . '?' . http_build_query($params);
    }

    /** 
     * 各種情報生成
     */
    private function createInfo(): void
    {
        $this->totalPages = (int) ceil($this->totalCount / $this->perPage);

        $this->currentPage = (int) ($this->params[$this->pageName] ?? 1);
        $this->currentPage = max(1, min($this->currentPage, $this->totalPages));

        $this->offset = ($this->currentPage - 1) * $this->perPage;
    }

    /** 現在ページ */
    public function currentPage(): int
    {
        return $this->currentPage;
    }

    /** トータル件数 */
    public function totalCount(): int
    {
        return $this->totalCount;
    }

    /** トータルページ数 */
    public function totalPages(): int
    {
        return $this->totalPages;
    }
}
