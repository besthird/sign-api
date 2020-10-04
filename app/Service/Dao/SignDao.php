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
        $query = Sign::query()->where('user_id', $userId);

        return $this->factory->model->pagination();
    }
}
