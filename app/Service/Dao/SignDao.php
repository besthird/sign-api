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

use App\Model\Sign;
use HyperfX\Utils\Service;

class SignDao extends Service
{
    public function first(int $meetingId, int $userId, int $type = Sign::TYPE_IN): ?Sign
    {
        return Sign::query()->where('meeting_id', $meetingId)
            ->where('user_id', $userId)
            ->where('type', $type)
            ->first();
    }

    public function find(int $userId, int $offset, int $limit)
    {
        $query = Sign::query()->with('meeting')->where('user_id', $userId);

        $query->orderBy('id', 'desc');

        return $this->factory->model->pagination($query, $offset, $limit);
    }

    //参与会议
    public function findByUserMeeting(int $userId, int $offset, int $limit)
    {
        $query = Sign::query()->with('meeting')->where('user_id', $userId);

        $query->orderBy('id', 'desc');

        $query->groupBy(['meeting_id']);

        return $this->factory->model->pagination($query, $offset, $limit);
    }

    //会议下的签到数据
    public function findByMeetingSign(int $meetingId, int $offset, int $limit)
    {
        $query = Sign::query()->with('meeting')->where('meeting_id', $meetingId);

        $query->orderBy('id', 'desc');

        return $this->factory->model->pagination($query, $offset, $limit);
    }

    public function findAll()
    {
        $query = Sign::query();

        return $query->orderBy('id', 'asc')->get();
    }
}
