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

use App\Client\RedisString;
use App\Request\UserLoginRequest;
use App\Service\UserService;
use App\Utils\UserAuth;
use Hyperf\Di\Annotation\Inject;

class UserController extends Controller
{
    /**
     * @Inject
     * @var UserService
     */
    protected $service;

    public function register(UserLoginRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $result = $this->service->register($username, $password);

        return $this->response->success();
    }

    /**
     * 登录.
     */
    public function login(UserLoginRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $result = $this->service->login($username, $password);

        // $token = di()->get(UserAuth::class)->getToken($result['id']);
        //
        // di()->get(RedisString::class)->setString($result['id'], $token);

        return $this->response->success('');
    }
}
