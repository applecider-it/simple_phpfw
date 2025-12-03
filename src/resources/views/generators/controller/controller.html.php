<#php

namespace App\Controllers;

use SFW\Output\View;

/**
 * <?= $data['controller'] . "\n" ?>
 */
class <?= $data['controller'] ?>Controller extends Controller
{
<?php foreach ($data['actions'] as $idx => $action): ?>
<?= $idx == 0 ? '' : "\n" ?>
    /** <?= $action ?> */
    public function <?= $action ?>()
    {
        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('<?= $data['controllerSnake'] ?>.<?= $action ?>'),
        ]);
    }
<?php endforeach; ?>
}
