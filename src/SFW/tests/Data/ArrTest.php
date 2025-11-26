<?php

use SFW\Data\Arr;

// dotValueTest
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
        $this->check('dotValueTest ' . $idx, Arr::dotValue($array, $key) == $result);
    }
})();
