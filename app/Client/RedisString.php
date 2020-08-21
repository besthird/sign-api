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
namespace App\Client;

use Hyperf\Redis\Redis;

class RedisString
{
    protected $prefix = 'user.token';

    protected $redis;

    public function reload()
    {
        $this->redis = di()->get(Redis::class);
    }

    public function setString($userId, $token)
    {
        $this->reload();
        $this->redis->set($this->prefix . $userId, $token, 7200);
    }
}
