<?php

declare(strict_types=1);

namespace SFW\Web;

use SFW\Core\App;
use SFW\Data\Str;

/**
 * ルート管理
 * 
 * /test/{id} などの指定も可能
 */
class Router
{
    /** ルート定義 */
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    /** 名前定義 */
    private array $names = [];

    /** カレントのルート */
    private ?array $currentRoute = null;

    /** ルート定義を返す */
    public function routes(): array
    {
        return $this->routes;
    }

    /** GETメソッドルーツ追加 */
    public function get(string $path, $handler, array $options = []): void
    {
        $this->addRoute('GET', $path, $handler, $options);
    }

    /** POSTメソッドルーツ追加 */
    public function post(string $path, $handler, array $options = []): void
    {
        $this->addRoute('POST', $path, $handler, $options);
    }

    /** 共通ルート追加処理 */
    private function addRoute(string $method, string $path, $handler, array $options = []): void
    {
        // {param} を名前付きキャプチャのある正規表現に変換
        $pattern = preg_replace('#\{([a-zA-Z0-9_]+)\}#', '(?P<$1>[^/]+)', $path);
        $pattern = '#^' . $pattern . '$#';

        $this->routes[$method][] = [
            'path' => $path,
            'pattern' => $pattern,
            'handler' => $handler,
            'options' => $options,
        ];

        $name = $options['name'] ?? null;

        if ($name) {
            !isset($this->names[$name]) ?: throw new \Exception("duplicate route name. [ $name ]");

            $this->names[$name] = $path;
        }
    }

    /** カレントのルートを設定 */
    public function setCurrentRoute(array $value): void
    {
        $this->currentRoute = $value;
    }

    /** カレントのルート */
    public function currentRoute(): ?array
    {
        return $this->currentRoute;
    }

    /** ルート取得 */
    public function route(string $name, array $data = []): string
    {
        isset($this->names[$name]) ?: throw new \Exception("not found route name. [ $name ]");

        return Str::template($this->names[$name], $data);
    }
}
