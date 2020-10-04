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
use Hyperf\Di\Annotation\Inject;
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

    public function sign(int $id, int $userId, int $type)
    {
        $meeting = $this->meeting->first($id, true);
        $sign = $this->dao->first($id, $userId);
        if ($sign) {
            if ($type === Sign::TYPE_IN) {
                // 不允许重复签到
                throw new BusinessException(ErrorCode::SIGN_AGAIN);
            }
        } else {
            $sign = new Sign();
            $sign->meeting_id = $id;
            $sign->user_id = $userId;
            $sign->type = $type;
        }
    }
}
