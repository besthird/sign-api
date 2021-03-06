<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Request\UserLoginRequest;
use App\Request\UserSaveRequest;
use App\Service\Formatter\UserFormatter;
use App\Service\UserService;
use Hyperf\Di\Annotation\Inject;
use function App\Kernel\get_user_id;

class UserController extends Controller
{
    /**
     * @Inject
     * @var UserService
     */
    protected $service;

    /**
     * @Inject
     * @var UserFormatter
     */
    protected $formatter;

    public function register(UserLoginRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $result = $this->service->register($username, $password);

        return $this->response->success([
            'token' => $result->getToken(),
            'registed' => $result->isRegisted(),
        ]);
    }

    public function finishRegister()
    {
        $username = $this->request->input('username');
        if (empty($username)) {
            throw new BusinessException(ErrorCode::PARAMS_INVALID, 'username is required.');
        }

        $userId = get_user_id();

        $result = $this->service->finishRegister($userId, $username);

        return $this->response->success($result);
    }

    /**
     * 登录.
     */
    public function login(UserLoginRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $result = $this->service->login($username, $password);

        return $this->response->success([
            'token' => $result->getToken(),
            'registed' => $result->isRegisted(),
        ]);
    }

    /**
     * 微信登录.
     */
    public function wxlogin()
    {
        $token = $this->request->input('token');

        $result = $this->service->wxlogin($token);

        return $this->response->success([
            'token' => $result->getToken(),
            'registed' => $result->isRegisted(),
        ]);
    }

    /**
     * 用户信息.
     */
    public function info()
    {
        $userId = get_user_id();

        $model = $this->service->info($userId);

        return $this->response->success(
            $this->formatter->base($model)
        );
    }

    /**
     * 更新用户信息.
     */
    public function save(UserSaveRequest $request)
    {
        $userId = get_user_id();

        $bool = $this->service->save($userId, $request->all());

        return $this->response->success($bool);
    }
}
