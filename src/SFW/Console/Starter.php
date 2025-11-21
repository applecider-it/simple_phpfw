<?php

namespace SFW\Console;

/**
 * コンソール管理
 */
class Starter
{
    /** 実行 */
    public function dispatch($argv)
    {
        // 実行ファイル除去
        array_shift($argv);

        $commandName = array_shift($argv);

        if (! $commandName) throw new \Exception("command is blank.");

        $path = SFW_PROJECT_ROOT . '/App/Commands';

        // App/CommandsからPHPファイルだけ取得
        $phpFiles = array_filter(scandir($path), fn($f) => str_ends_with($f, '.php'));

        foreach ($phpFiles as $file) {
            $name = pathinfo($file, PATHINFO_FILENAME);
            $class = "App\\Commands\\{$name}";

            $command = $class::$name;

            if ($commandName === $command) {
                return $this->runHandler($class, $argv);
            }
        }

        throw new \Exception("invalid command. {$commandName}");
    }

    /** ハンドラーを実行 */
    private function runHandler($class, $params)
    {
        $obj = new $class();
        return $obj->handle($params);
    }
}
