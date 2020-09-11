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
            'username' => 'tester1',
            'password' => md5('123456'),
        ]);

        $this->assertTrue(in_array($res['code'], [0, ErrorCode::USERNAME_EXIST_ERROR]));
    }

    public function testUserFinishRegister()
    {
        $res = $this->json('/user/finish-register', [
            'username' => 'tester',
        ], [
            UserAuth::X_TOKEN => $this->getToken(),
        ]);

        $this->assertSame(0, $res['code']);
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

    public function testUserSave()
    {
        $res = $this->post('/user/save', [
            'nickname' => 'tester',
            'wechat_code' => 'wx54934',
            'profession' => 'php',
            'gender' => '1',
            'head_img' => 'https://dss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=106057627,1188041136&fm=26&gp=0.jpg',
            'mobile' => '15988669988',
        ], [
            UserAuth::X_TOKEN => $this->getToken(),
        ]);

        $this->assertSame(0, $res['code']);

        $res = $this->post('/user/save', [
            'nickname' => 'tester',
            'wechat_code' => 'wx54934',
            'profession' => 'php',
            'gender' => '1',
            'head_img' => 'https://dss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=106057627,1188041136&fm=26&gp=0.jpg',
        ], [
            UserAuth::X_TOKEN => $this->getToken(),
        ]);

        $this->assertSame(0, $res['code']);
    }
}
