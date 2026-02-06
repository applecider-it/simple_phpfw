<?php

namespace SFW\Test;

use SFW\Data\Path;
use SFW\Output\StdOut;

/**
 * テスト起動管理
 */
class Starter
{
    /** 実行 */
    public function exec(bool $targetIsFramework)
    {
        $targetDir = SFW_PROJECT_ROOT . '/tests';

        if ($targetIsFramework) {
            echo "Framework Test" . PHP_EOL;
            $targetDir = dirname(dirname(__DIR__)) . '/tests';
        }

        echo "targetDir: {$targetDir}" . PHP_EOL;

        $testFilePaths = $this->getTestFilePaths($targetDir);

        $this->execTests($testFilePaths);
    }

    /** 対象ファイルパス取得 */
    private function getTestFilePaths(string $targetDir)
    {
        $testFilePaths = [];

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($targetDir, \RecursiveDirectoryIterator::SKIP_DOTS)
        );
        foreach ($iterator as $file) {
            if ($file->isFile() && str_ends_with($file->getFilename(), 'Test.php')) {
                $testFilePaths[] = $file->getPathname();
            }
        }

        return $testFilePaths;
    }

    /** テスト実行 */
    private function execTests(array $testFilePaths)
    {
        $this->drawLine();
        
        $tester = new Tester();
        $tester->exec($testFilePaths);

        // ...と出力されているので最後に改行
        echo PHP_EOL;

        $okCount = 0;
        $ngCount = 0;
        $ngList = [];
        foreach ($tester->results as $result) {
            if ($result['status']) {
                $okCount++;
            } else {
                $ngCount++;

                $ngList[] = $result;
            }
        }

        $this->outputResults($okCount, $ngCount, $ngList);
    }

    /** 線を出力 */
    private function drawLine()
    {
        echo str_repeat("-", 70) . PHP_EOL;
    }

    /** 結果表示 */
    private function outputResults(int $okCount, int $ngCount, array $ngList)
    {
        $this->drawLine();

        if ($ngList) {
            StdOut::color('red');
            echo "Error List:" . PHP_EOL;
            foreach ($ngList as $result) {
                echo "NG:" . PHP_EOL;
                echo "path: {$result['path']}" . PHP_EOL;
                echo "name: {$result['name']}" . PHP_EOL;
                $this->drawLine();
            }
            StdOut::reset();
        }

        echo "OK: {$okCount}" . PHP_EOL;
        if ($ngList) StdOut::color('red');
        echo "NG: {$ngCount}" . PHP_EOL;
        if ($ngList) StdOut::reset();
    }
}
