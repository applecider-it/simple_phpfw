<?php

use SFW\Data\Str;

// mb_str_pad_test
(function () {
    $checkList = [
        ['aa', 10, 'aa        '],
        ['ああ', 10, 'ああ      '],
        ['aa', 10, '        aa', STR_PAD_LEFT],
        ['ああ', 10, '      ああ', STR_PAD_LEFT],
        ['aa', 10, '    aa    ', STR_PAD_BOTH],
        ['ああ', 10, '   ああ   ', STR_PAD_BOTH],
    ];

    foreach ($checkList as $idx => $row) {
        $input = $row[0];
        $pad_length = $row[1];
        $result = $row[2];
        $pad_type = $row[3] ?? null;
        if ($pad_type === null) {
            $this->check('mb_str_pad_test ' . $idx, Str::mb_str_pad($input, $pad_length) == $result);
        } else {
            $this->check('mb_str_pad_test ' . $idx, Str::mb_str_pad($input, $pad_length, pad_type: $pad_type) == $result);
        }
    }
})();
