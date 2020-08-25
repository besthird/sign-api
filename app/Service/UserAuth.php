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
use App\Model\User;
use Hyperf\Redis\Redis;
use Hyperf\Utils\Codec\Json;
use Hyperf\Utils\Traits\StaticInstance;

class UserAuth
{
    use StaticInstance;

    const X_TOKEN = 'X-Token';

    /**
     * @var int
     */
    protected $userId = 0;

    /**
     * @var null|string
     */
    protected $token;

    public function init(User $user)
    {
        $this->userId = $user->id;
        $this->token = md5(uniqid());

        di()->get(Redis::class)->set($this->getRedisKey(), Json::encode([
            'id' => $user->id,
        ]));

        return $this;
    }

    public function reload($token)
    {
        $this->token = $token;
        $string = di()->get(Redis::class)->get($this->getRedisKey());
        if ($string && $data = Json::decode($string)) {
            $this->userId = intval($data['id'] ?? 0);
        }

        return $this;
    }

    public function build()
    {
        if ($this->getUserId() === 0) {
            throw new BusinessException(ErrorCode::TOKEN_INVALID);
        }

        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    protected function getRedisKey(): string
    {
        if (empty($this->token)) {
            throw new BusinessException(ErrorCode::SERVER_ERROR, 'TOKEN 未正常初始化');
        }
        return 'auth:' . $this->token;
    }
}
