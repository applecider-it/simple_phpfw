<?php

use App\Models\User;

// user example
(function () {
    $rows = User::query()
        ->where("id > ?", 100)
        ->where("id < ?", 200)
        ->order("id desc")
        ->order("email asc")
        ->all();

    $this->check('user example', is_array($rows));
})();
