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
namespace HyperfTest\Cases;

use App\Constants\ErrorCode;
use App\Service\UserAuth;
use HyperfTest\HttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class UserTest extends HttpTestCase
{
    public function testUserRegister()
    {
        $res = $this->json('/user/register', [
            'username' => 'tester',
            'password' => md5('123456'),
        ]);

        $this->assertTrue(in_array($res['code'], [0, ErrorCode::USERNAME_EXIST_ERROR]));
    }

    public function testUserLogin()
    {
        $res = $this->json('/user/login', [
            'username' => 'tester',
            'password' => md5('123456'),
        ]);

        $this->assertSame(0, $res['code']);
    }

    public function testUserInfo()
    {
        $res = $this->get('/user/info', [], [
            UserAuth::X_TOKEN => $this->getToken(),
        ]);

        $this->assertSame(0, $res['code']);
    }
}
