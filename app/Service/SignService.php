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
namespace App\Service;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Model\Sign;
use App\Service\Dao\MeetingDao;
use App\Service\Dao\SignDao;
use Carbon\Carbon;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Codec\Json;
use HyperfX\Utils\Service;

class SignService extends Service
{
    /**
     * @Inject
     * @var MeetingDao
     */
    protected $meeting;

    /**
     * @Inject
     * @var SignDao
     */
    protected $dao;

    public function index(int $userId, int $offset, int $limit)
    {
        $this->dao->find($userId, $offset, $limit);
    }

    /**
     * @param $input = [
     *     'type' => 1, // 1签到 2签退
     *     'nickname' => '', // 昵称
     *     'mobile' => '', // 手机号
     *     'wechat_code' => '', // 微信号
     *     'data' => [], // 其他字段
     * ]
     */
    public function sign(int $id, int $userId, array $input)
    {
        $type = $input['type'];
        $meeting = $this->meeting->first($id, true);
        $now = Carbon::now();
        if (! $meeting->isOnline($type, $now)) {
            throw new BusinessException(ErrorCode::SIGN_TIME_INVALID);
        }

        $sign = $this->dao->first($id, $userId);
        if (empty($sign)) {
            $sign = new Sign();
            $sign->meeting_id = $id;
            $sign->user_id = $userId;
            $sign->type = $type;
            $sign->last_sign_at = $now;
        } elseif ($type === Sign::TYPE_OUT) {
            $sign->last_sign_at = $now;
        }

        $sign->nickname = $input['nickname'];
        $sign->mobile = $input['mobile'] ?? '';
        $sign->wechat_code = $input['wechat_code'] ?? '';
        $sign->data = Json::encode((object) ($input['data'] ?? []));
        return $sign->save();
    }
}
