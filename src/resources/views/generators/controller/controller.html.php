<#php

namespace App\Controllers<?= $data['controllerNamespace'] ? '\\' . $data['controllerNamespace'] : '' ?>;

use SFW\Output\View;

/**
 * <?= $data['controllerName'] . "\n" ?>
 */
class <?= $data['controllerName'] ?>Controller extends Controller
{
<?php foreach ($data['actions'] as $idx => $action): ?>
<?= $idx == 0 ? '' : "\n" ?>
    /** <?= $action ?> */
    public function <?= $action ?>()
    {
        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('<?= $data['viewPrefix'] ?>.<?= $action ?>'),
        ]);
    }
<?php endforeach; ?>
}
