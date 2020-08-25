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
use HyperfTest\HttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class UserTest extends HttpTestCase
{
    public function testUserRegister()
    {
        $res = $this->apiClient->post('/user/register', [
            'username' => '单侧',
            'password' => '123456',
        ]);

        $this->assertTrue(in_array($res['code'], [0, ErrorCode::USERNAME_EXIST_ERROR]));
    }
}
