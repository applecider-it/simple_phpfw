<?php

namespace App\Controllers\Admin;

use SFW\Data\Arr;
use SFW\Core\App;
use SFW\Core\Lang;
use SFW\Core\Config;
use SFW\Web\Location;
use SFW\Web\Flash;
use SFW\Output\Log;

use App\Models\User;
use App\Models\User\Tweet;

use App\Core\Validator;

use App\Services\Admin\User\ListService;

/**
 * ユーザー管理コントローラー
 */
class UserController extends Controller
{
    /** トップ画面 */
    public function index()
    {
        $listService = new ListService();

        $data = $listService->getListData($this->params);

        return $this->render('admin.user.index', $data + [
            'params' => $this->params,
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

        return $this->render('admin.user.create', $initialData);
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

            return $this->render(
                'admin.user.create',
                $form + ['errors' => $errors]
            );
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

        $form = $user;
        $form['password'] = '';
        $form['password_confirm'] = '';

        return $this->render(
            'admin.user.edit',
            $form + $this->getEditCommon($user)
        );
    }

    /** 更新 */
    public function update()
    {
        $user = $this->user();
        $userId = $user['id'];

        $form = Arr::choise($this->params, ['name', 'email', 'password', 'password_confirm']);

        $rules = [
            'name' => User::validationName(),
            'email' => User::validationEmail($user),
            'password' => User::validationPassword(true),
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

            return $this->render(
                'admin.user.edit',
                $form + ['errors' => $errors] + $user + $this->getEditCommon($user)
            );
        }

        unset($form['password_confirm']);

        if (!empty($form['password'])) {
            $form['password'] = password_hash($form['password'], PASSWORD_DEFAULT);
        } else {
            unset($form['password']);
        }

        User::update($userId, $form);

        Flash::set('notice', '更新しました。');

        Location::redirect(Config::get('adminPrefix') . "/users/{$userId}/edit");
    }

    /** 更新時共通情報 */
    private function getEditCommon(array $user)
    {
        $listService = new ListService();

        $data = $listService->getUserTweetData($user, $this->params);

        return $data;
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
        $user = User::queryIncludeId($this->params['id'])
            ->scope([User::class, 'includeDeleted'])
            ->one();
        if (! $user) throw new \SFW\Exceptions\NotFound;
        return $user;
    }
}
