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
class MeetingTest extends HttpTestCase
{
    public function testMeetingCreate()
    {
        $res = $this->post('/meeting/create', [
            'title' => '标题',
            'content' => '会议内容',
            'sign_type' => 1,
            'user_limit' => 100,
            'status' => 1,
            'sign_in_btime' => time(), //签到时间
            'sign_in_etime' => time() + 7200,
            'sign_out_btime' => time(), //签退时间
            'sign_out_etime' => time() + 7200,
        ], [
            UserAuth::X_TOKEN => $this->getToken(),
        ]);

        $this->assertSame(0, $res['code']);
    }

    public function testMeetingInfo()
    {
        $res = $this->get('/meeting/info', [
            'meeting_id' => 1,
        ], [
            UserAuth::X_TOKEN => $this->getToken(),
        ]);

        $this->assertSame(0, $res['code']);
    }

    public function testMeetingGetUserMeeting()
    {
        $res = $this->get('/meeting/get-user-meeting', [], [
            UserAuth::X_TOKEN => $this->getToken(),
        ]);

        $this->assertSame(0, $res['code']);
    }

    public function testMeetingDel()
    {
        $res = $this->post('/meeting/del', [
            'id' => '4',
        ], [
            UserAuth::X_TOKEN => $this->getToken(),
        ]);

        $this->assertTrue(in_array($res['code'], [0, ErrorCode::MEETING_NOT_EXIST_ERROR]));
    }
}
