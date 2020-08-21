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
namespace App\Server\Dao;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Model\User;
use App\Server\Server;

class UserDao extends Server
{
    public function findOne(string $username, $throw = false)
    {
        $user = User::query()->where('username', $username)->first();
        if (! empty($user) && $throw) {
            throw new BusinessException(ErrorCode::USERNAME_EXIST_ERROR);
        }

        return $user;
    }

    /**
     * @param $data ['username'=>'','password'=>]
     * @return bool
     */
    public function save(array $data)
    {
        $user = new User();
        $user->username = $data['username'];
        $user->password = $data['password'];

        return $user->save();
    }
}
