<?php

namespace SFW\Output;

use SFW\Data\Json;
use SFW\Output\View;

/**
 * ジェネレーター共通
 */
class Generator
{
    /** 出力 */
    public static function output(string $viewName, string $path, array $viewData, bool $dryrun)
    {
        $line = str_repeat("-", 50) . PHP_EOL;

        $dir = dirname($path);

        $exists = file_exists($path);
        $isDir = is_dir($dir);

        echo $line;
        echo "dryrun: $dryrun\n";
        echo "path: {$path}" . PHP_EOL;
        echo "viewName: {$viewName}" . PHP_EOL;
        echo "dir: {$dir}" . PHP_EOL;
        echo "isDir: {$isDir}" . PHP_EOL;
        echo "exists: {$exists}" . PHP_EOL;

        if ($exists) return;

        $view = new View;
        $value = $view->render($viewName, $viewData);

        $value = str_replace('<#', '<?', $value);
        $value = str_replace('#>', '?>', $value);

        if ($dryrun) {
            echo $line;
            echo $value . PHP_EOL;
            echo $line;

            return;
        }

        if (! $isDir) {
            echo "mkdir" . PHP_EOL;
            mkdir($dir, 0777, true);
        }

        echo "output" . PHP_EOL;
        file_put_contents($path, $value);
        echo $line;
    }
}
