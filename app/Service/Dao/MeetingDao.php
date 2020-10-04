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
namespace App\Service\Dao;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Model\Meeting;
use HyperfX\Utils\Service;

class MeetingDao extends Service
{
    public function first(int $id, $throw = false): ?Meeting
    {
        $model = Meeting::query()->where('id', $id)->first();

        if (empty($model) && $throw) {
            throw new BusinessException(ErrorCode::MEETING_NOT_EXIST_ERROR);
        }

        return $model;
    }

    public function getUserMeeting(int $userId, int $offset = 0, int $limit = 10)
    {
        $query = Meeting::query()->where('user_id', $userId);

        $query->orderBy('id', 'desc');

        return $this->factory->model->pagination($query, $offset, $limit);
    }
}
