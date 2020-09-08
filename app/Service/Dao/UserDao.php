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
use App\Model\User;
use HyperfX\Utils\Service;

class UserDao extends Service
{
    /**
     * @return null|User
     */
    public function first(int $id, bool $throw = false)
    {
        $model = User::query()->find($id);
        if (empty($model) && $throw) {
            throw new BusinessException(ErrorCode::USER_NOT_EXIST);
        }

        return $model;
    }

    /**
     * @return null|User
     */
    public function firstByUserName(string $username)
    {
        return User::query()->where('username', $username)->first();
    }

    /**
     * 手机号查询.
     * @param false $throw true 不包含$userId  false 所有用户
     * @return null|User
     */
    public function firstByUserMobile(int $userId, string $mobile, $throw = false)
    {
        $user = User::query()->where('mobile', $mobile);

        if ($throw) {
            $user->where('id', '!=', $userId);
        }

        return $user->first();
    }

    public function create(): User
    {
        $model = new User();
        $model->save();
        return $model;
    }
}
