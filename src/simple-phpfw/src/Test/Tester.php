<?php

namespace SFW\Test;

use SFW\Data\Path;
use SFW\Output\StdOut;

/**
 * テスト管理
 */
class Tester
{
    public $results = [];

    private ?string $currentPath = null;

    /** 実行 */
    public function exec(array $testFilePaths): void
    {
        foreach ($testFilePaths as $path) {
            $this->test($path);
        }
    }

    /** 実行 */
    private function test(string $path): void
    {
        $this->currentPath = $path;

        include($this->currentPath);
    }

    /** チェック(include先で利用する) */
    private function check(string $name, bool $status): void
    {
        if ($status) {
            echo ".";
        } else {
            StdOut::color('red');
            echo "E";
            StdOut::reset();
        }

        $this->results[] = [
            'path' => $this->currentPath,
            'name' => $name,
            'status' => $status,
        ];
    }
}
