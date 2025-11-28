<?php

namespace App\Controllers\Admin;

use SFW\Output\View;
use SFW\Data\Arr;
use SFW\Core\Lang;
use SFW\Core\Config;
use SFW\Routing\Location;
use SFW\Output\Log;

use App\Controllers\Controller;

use App\Models\User;

use App\Core\Validator;

/**
 * ユーザー管理コントローラー
 */
class UserController extends Controller
{
    /** トップ画面 */
    public function index()
    {
        $users = User::query()
            ->order("id desc")
            ->all();

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('admin.user.index', [
                'users' => $users,
            ]),
        ]);
    }

    /** 新規作成画面 */
    public function create()
    {
        $initialData = [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirm' => '',
        ];

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('admin.user.create', $initialData),
        ]);
    }

    /** 新規作成 */
    public function store()
    {
        $user = Arr::choise($this->params, ['name', 'email', 'password', 'password_confirm']);

        $rules = [
            'name' => User::validationName(),
            'email' => User::validationEmail(),
            'password' => User::validationPassword(),
        ];

        $labels = [
            'name' => Lang::get('models.user.attributes.name'),
            'email' => Lang::get('models.user.attributes.email'),
            'password' => Lang::get('models.user.attributes.password'),
        ];

        $v = Validator::make($user, $rules, $labels);

        $errors = null;

        if ($v->fails()) {
            $errors = $v->errors();

            $view = new View();
            return $view->render('layouts.app', [
                'content' => $view->render(
                    'admin.user.create',
                    $user + ['errors' => $errors]
                ),
            ]);
        }

        unset($user['password_confirm']);

        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

        $newId = User::insert($user);
        Log::info('New User', [$newId]);

        Location::redirect(Config::get('adminPrefix') . "/users/{$newId}/edit");
    }

    /** 更新画面 */
    public function edit()
    {
        $user = $this->user();

        $user = Arr::choise($user, ['name', 'email']);

        $view = new View();
        return $view->render('layouts.app', [
            'content' => $view->render('admin.user.edit', $user),
        ]);
    }

    /** 更新 */
    public function update()
    {
        $user = $this->user();
        $id = $user['id'];

        $user = Arr::choise($this->params, ['name', 'email']);

        $rules = [
            'name' => User::validationName(),
            'email' => User::validationEmail(),
        ];

        $labels = [
            'name' => Lang::get('models.user.attributes.name'),
            'email' => Lang::get('models.user.attributes.email'),
        ];

        $v = Validator::make($user, $rules, $labels);

        $errors = null;

        if ($v->fails()) {
            $errors = $v->errors();

            $view = new View();
            return $view->render('layouts.app', [
                'content' => $view->render(
                    'admin.user.edit',
                    $user + ['errors' => $errors]
                ),
            ]);
        }

        User::update($id, $user);

        Location::redirect(Config::get('adminPrefix') . "/users/{$id}/edit");
    }

    /** 削除 */
    public function destroy()
    {
        $user = $this->user();
        $id = $user['id'];

        User::softDelete($id);

        Location::redirect(Config::get('adminPrefix') . "/users");
    }

    /** ユーザー取得 */
    private function user()
    {
        $user = User::find($this->params['id']);
        if (! $user) throw new \Exception('Not found.');
        return $user;
    }
}
