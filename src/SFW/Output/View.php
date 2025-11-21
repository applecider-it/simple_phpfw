<?php

namespace SFW\Output;

class View
{
    public array $data = [];

    public function render(string $view, array $data = [])
    {
        $path = SFW_PROJECT_ROOT . '/resources/views/' . str_replace('.', '/', $view) . '.html.php';

        if (!file_exists($path)) {
            throw new \Exception("View not found: $view. path: $path.");
        }

        ob_start();
        include $path;
        return ob_get_clean();
    }
}
