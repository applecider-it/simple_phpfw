<?php

namespace App\Controllers;

use SFW\Data\Arr;
use SFW\Core\App;
use SFW\Core\Lang;
use SFW\Core\Config;
use SFW\Web\Location;
use SFW\Web\Flash;
use SFW\Output\Log;
use SFW\Security\Hash;

use function SFW\Helpers\route;

use App\Models\User;
use App\Models\User\Tweet;

use App\Validations\Validator;

use App\Services\User\EditService;
use App\Services\User\AuthService as Auth;

/**
 * ユーザーコントローラー
 */
class UserController extends Controller
{
    /** 新規作成画面 */
    public function create()
    {
        $initialData = [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirm' => '',
        ];

        return $this->render('user.create', $initialData);
    }

    /** 新規作成 */
    public function store()
    {
        $form = Arr::choise($this->params, ['name', 'email', 'password', 'password_confirm']);

        $rules = [
            'name' => User::validationName(),
            'email' => User::validationEmail(),
            'password' => User::validationPassword(),
        ];

        $labels = [
            'name' => Lang::get('app.models.user.attributes.name'),
            'email' => Lang::get('app.models.user.attributes.email'),
            'password' => Lang::get('app.models.user.attributes.password'),
        ];

        $v = Validator::make($form, $rules, $labels);

        $errors = null;

        if ($v->fails()) {
            $errors = $v->errors();

            return $this->render(
                'user.create',
                $form + ['errors' => $errors]
            );
        }

        unset($form['password_confirm']);

        $form['password'] = Hash::make($form['password']);

        $newId = User::insert($form);
        Log::info('New User', [$newId]);

        Flash::set('notice', '登録しました。');

        Location::redirect(route('login'));
    }

    /** 更新画面 */
    public function edit()
    {
        $user = Auth::get();

        $form = $user;
        $form['password'] = '';
        $form['password_confirm'] = '';

        return $this->render(
            'user.edit',
            $form
        );
    }

    /** 更新 */
    public function update()
    {
        $editService = new EditService();

        $user = Auth::get();
        $userId = $user['id'];

        $form = Arr::choise($this->params, ['name', 'email', 'password', 'password_confirm']);

        $rules = [
            'name' => User::validationName(),
            'email' => User::validationEmail($user),
            'password' => User::validationPassword(true),
        ];

        $labels = [
            'name' => Lang::get('app.models.user.attributes.name'),
            'email' => Lang::get('app.models.user.attributes.email'),
            'password' => Lang::get('app.models.user.attributes.password'),
        ];

        $v = Validator::make($form, $rules, $labels);

        $errors = null;

        if ($v->fails()) {
            $errors = $v->errors();

            return $this->render(
                'user.edit',
                $form + ['errors' => $errors] + $user
            );
        }

        unset($form['password_confirm']);

        $editService->updateForm($form);

        User::update($userId, $form);

        Flash::set('notice', '更新しました。');

        Location::redirect(route('user.edit'));
    }

    /** 論理削除 */
    public function destroy()
    {
        $user = Auth::get();
        $userId = $user['id'];

        $db = App::get('db');

        $db->startTransaction();
        User::deleteRelations($userId);
        User::softDelete($userId);
        $db->commitTransaction();

        $authService = new Auth;

        $authService->logout();

        Flash::set('notice', '削除しました。');

        Location::redirect(route('index'));
    }
}
