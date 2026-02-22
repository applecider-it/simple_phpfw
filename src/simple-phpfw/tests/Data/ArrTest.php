<?php

declare(strict_types=1);

use SFW\Data\Arr;

// dotValue Test
(function () {
    $checkList = [
        [
            [
                'aaa' => [
                    'bbb' => 'val1',
                ]
            ],
            'aaa.bbb',
            'val1'
        ],
    ];

    foreach ($checkList as $idx => $row) {
        $array = $row[0];
        $key = $row[1];
        $result = $row[2];
        $this->check("dotValue Test {$idx} {$key}", Arr::dotValue($array, $key) === $result);
    }
})();
