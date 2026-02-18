<?php

namespace App\Services\Admin\User;

use SFW\Security\Hash;

/**
 * 管理画面　ユーザー管理の編集関連
 */
class EditService
{
    /**
     * 更新データの変更
     */
    public function updateForm(array &$form)
    {
        if (!empty($form['password'])) {
            $form['password'] = Hash::make($form['password']);
        } else {
            unset($form['password']);
        }
    }
}
