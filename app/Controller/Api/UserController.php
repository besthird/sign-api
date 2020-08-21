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
namespace App\Controller\Api;

use App\Client\RedisString;
use App\Constants\ErrorCode;
use App\Controller\IndexController;
use App\Exception\BusinessException;
use App\Server\Biz\Api\UserBiz;
use App\Utils\UserAuth;
use Hyperf\Di\Annotation\Inject;

class UserController extends IndexController
{
    /**
     * @Inject
     * @var UserBiz
     */
    protected $Biz;

    /**
     * 注册.
     */
    public function register()
    {
        $username = $this->request->input('username');
        $password = $this->request->input('password');

        if (empty($username)) {
            throw new BusinessException(ErrorCode::USERNAME_EMPTY_ERROR);
        }
        if (empty($password)) {
            throw new BusinessException(ErrorCode::PASSWORD_EMPTY_ERROR);
        }

        $result = $this->Biz->register($username, $password);

        return $this->response->success($result);
    }

    /**
     * 登录.
     */
    public function login()
    {
        $data = $this->request->all();
        $username = $this->request->input('username');
        $password = $this->request->input('password');
        if (empty($username)) {
            throw new BusinessException(ErrorCode::USERNAME_EMPTY_ERROR);
        }
        if (empty($password)) {
            throw new BusinessException(ErrorCode::PASSWORD_EMPTY_ERROR);
        }

        $result = $this->Biz->login($username, $password);

        $token = di()->get(UserAuth::class)->getToken($result['id']);

        di()->get(RedisString::class)->setString($result['id'], $token);

        return $this->response->success($token);
    }
}
