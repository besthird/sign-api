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

use App\Model\User;
use HyperfX\Utils\Service;

class UserDao extends Service
{
    public function first()
    {
    }

    /**
     * @return null|User
     */
    public function firstByUserName(string $username)
    {
        return User::query()->where('username', $username)->first();
    }
}
