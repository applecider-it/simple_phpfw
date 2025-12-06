<?php

namespace App\Controllers\Admin;

use SFW\Output\View;
use SFW\Data\Arr;
use SFW\Core\App;
use SFW\Core\Lang;
use SFW\Core\Config;
use SFW\Web\Location;
use SFW\Web\Flash;
use SFW\Output\Log;
use SFW\Pagination\Paginator;

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
        $query = User::query()
            ->order("id desc");

        $softDelete = $this->params['soft_delete'] ?? 'all';
        if ($softDelete === 'kept') $query->scope([User::class, 'kept']);
        if ($softDelete === 'deleted') $query->scope([User::class, 'deleted']);

        $paginator = new Paginator($this->params, 8, 'page');

        $paginator->query($query);

        $users = $query->all();

        $view = new View();
        return $view->render('admin.layouts.app', [
            'content' => $view->render('admin.user.index', [
                'users' => $users,
                'params' => $this->params,
                'paginator' => $paginator,
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
        return $view->render('admin.layouts.app', [
            'content' => $view->render('admin.user.create', $initialData),
        ]);
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
            'name' => Lang::get('models.user.attributes.name'),
            'email' => Lang::get('models.user.attributes.email'),
            'password' => Lang::get('models.user.attributes.password'),
        ];

        $v = Validator::make($form, $rules, $labels);

        $errors = null;

        if ($v->fails()) {
            $errors = $v->errors();

            $view = new View();
            return $view->render('admin.layouts.app', [
                'content' => $view->render(
                    'admin.user.create',
                    $form + ['errors' => $errors]
                ),
            ]);
        }

        unset($form['password_confirm']);

        $form['password'] = password_hash($form['password'], PASSWORD_DEFAULT);

        $newId = User::insert($form);
        Log::info('New User', [$newId]);

        Flash::set('notice', '登録しました。');

        Location::redirect(Config::get('adminPrefix') . "/users/{$newId}/edit");
    }

    /** 更新画面 */
    public function edit()
    {
        $user = $this->user();

        $view = new View();
        return $view->render('admin.layouts.app', [
            'content' => $view->render('admin.user.edit', $user + $this->getRelationInfo($user)),
        ]);
    }

    /** 更新 */
    public function update()
    {
        $user = $this->user();
        $userId = $user['id'];

        $form = Arr::choise($this->params, ['name', 'email']);

        $rules = [
            'name' => User::validationName(),
            'email' => User::validationEmail($user),
        ];

        $labels = [
            'name' => Lang::get('models.user.attributes.name'),
            'email' => Lang::get('models.user.attributes.email'),
        ];

        $v = Validator::make($form, $rules, $labels);

        $errors = null;

        if ($v->fails()) {
            $errors = $v->errors();

            $view = new View();
            return $view->render('admin.layouts.app', [
                'content' => $view->render(
                    'admin.user.edit',
                    $form + ['errors' => $errors] + $user + $this->getRelationInfo($user)
                ),
            ]);
        }

        User::update($userId, $form);

        Flash::set('notice', '更新しました。');

        Location::redirect(Config::get('adminPrefix') . "/users/{$userId}/edit");
    }

    /** 関連情報 */
    private function getRelationInfo($user)
    {
        $tweets = User::tweets($user['id'])
            ->order("id desc")
            ->limit(5)
            ->all();

        return [
            'tweets' => $tweets,
        ];
    }

    /** 論理削除 */
    public function destroy()
    {
        $user = $this->user();
        $userId = $user['id'];

        $db = App::get('db');

        $db->startTransaction();
        User::deleteRelations($userId);
        User::softDelete($userId);
        $db->commitTransaction();

        Flash::set('notice', '論理削除しました。');

        Location::redirect(Config::get('adminPrefix') . "/users/{$userId}/edit");
    }

    /** 復元 */
    public function restore()
    {
        $user = $this->user();
        $userId = $user['id'];

        User::restore($userId);

        Flash::set('notice', '復元しました。');

        Location::redirect(Config::get('adminPrefix') . "/users/{$userId}/edit");
    }

    /** ユーザー取得 */
    private function user()
    {
        $user = User::find($this->params['id']);
        if (! $user) throw new \SFW\Exceptions\NotFound;
        return $user;
    }
}
