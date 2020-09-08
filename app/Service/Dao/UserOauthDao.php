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

use App\Model\UserOauth;
use HyperfX\Utils\Service;

class UserOauthDao extends Service
{
    /**
     * @return null|UserOauth
     */
    public function firstByOpenId(string $openid)
    {
        return UserOauth::query()->where('oauth', $openid)
            ->where('type', UserOauth::TYPE_WECHAT)
            ->first();
    }
}
