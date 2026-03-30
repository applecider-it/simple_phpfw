<?php

namespace App\Services\User;

use SFW\Security\Hash;

/**
 * ユーザーの編集関連
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
