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

use App\Model\Sign;
use App\Service\UserAuth;
use HyperfTest\HttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class SignTest extends HttpTestCase
{
    public function testSignIn()
    {
        $res = $this->json('/sign/1', [
            'type' => Sign::TYPE_OUT,
            'nickname' => '棒哥1',
        ], [
            UserAuth::X_TOKEN => $this->getToken(),
        ]);

        $this->assertSame(0, $res['code']);
    }

    public function testSignIndex()
    {
        $res = $this->get('/sign', [], [
            UserAuth::X_TOKEN => $this->getToken(),
        ]);

        $this->assertSame(0, $res['code']);
    }

    public function testSignGetUserMeeting()
    {
        $res = $this->get('/sign/get-user-meeting', [
            'meeting_id' => 1,
        ], [
            UserAuth::X_TOKEN => $this->getToken(),
        ]);

        $this->assertSame(0, $res['code']);
    }

    public function testSignGetMeeting()
    {
        $res = $this->get('/sign/get-meeting', [
            'meeting_id' => 1,
        ], [
            UserAuth::X_TOKEN => $this->getToken(),
        ]);

        $this->assertSame(0, $res['code']);
    }
}
