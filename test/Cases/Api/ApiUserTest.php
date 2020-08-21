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
namespace HyperfTest\Cases\Api;

use HyperfTest\HttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class ApiUserTest extends HttpTestCase
{
    public function testUserRegister()
    {
        $res = $this->apiClient->post('/api/user/register', [
            'username' => '单侧',
            'password' => '123456',
        ]);

        $this->assertSame(0, $res['code']);
    }

    public function testUserLogin()
    {
        $res = $this->apiClient->post('/api/user/login', [
            'username' => '单侧',
            'password' => '123456',
        ]);

        $this->assertSame(0, $res['code']);
    }
}
