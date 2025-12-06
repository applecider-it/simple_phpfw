<?php

namespace App\Controllers;

use SFW\Output\View;

/**
 * チャットコントローラー
 */
class ChatController extends Controller
{
    /** チャット画面 */
    public function index()
    {
        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('chat.index'),
        ]);
    }
}
