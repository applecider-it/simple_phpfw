<?php

declare(strict_types=1);

use SFW\Console\Params;

// makeParams Test
(function () {
    $checkList = [
        [
            ['aaa'],
            [
                'params' => ['aaa'],
                'options' => [],
            ]
        ],
        [
            ['aaa', '--bbb'],
            [
                'params' => ['aaa'],
                'options' => [
                    'bbb' => true,
                ],
            ]
        ],
        [
            ['aaa', '--bbb', 'ccc', '--ddd=eee', 'fff'],
            [
                'params' => ['aaa', 'ccc', 'fff'],
                'options' => [
                    'bbb' => true,
                    'ddd' => 'eee',
                ],
            ]
        ],
    ];

    foreach ($checkList as $idx => $row) {
        $array = $row[0];
        $result = $row[1];
        $ret = Params::makeParams($array);
        $this->check("makeParams Test {$idx} params " . implode(', ', $array), $ret['params'] === $result['params']);
        $this->check("makeParams Test {$idx} options " . implode(', ', $array), $ret['options'] === $result['options']);
    }
})();
