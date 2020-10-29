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
use Hyperf\DbConnection\Db;
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

    public function getMeetingPagination(int $userId, int $offset, int $limit)
    {
        $sql = 'SELECT meeting_id FROM sign WHERE user_id = ? GROUP BY meeting_id ORDER BY meeting_id DESC LIMIT ? OFFSET ?;';
        $res = Db::select($sql, [$userId, $limit, $offset]);
        $ids = [];
        foreach ($res as $item) {
            $ids[] = $item->meeting_id;
        }

        $sql = 'SELECT COUNT(DISTINCT meeting_id) as `count` FROM sign WHERE user_id = ?;';
        $res = Db::selectOne($sql, [$userId]);
        return [$res->count, $ids];
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
