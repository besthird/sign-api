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
use App\Service\Dao\UserDao;
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

    /**
     * @var User
     */
    protected $user;

    public function init(User $user, ?string $token = null)
    {
        $this->user = $user;
        $this->userId = $user->id;
        $this->token = $token ?? md5(uniqid());

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

    public function getUser(): User
    {
        if ($this->user) {
            return $this->user;
        }

        $userId = $this->build()->getUserId();

        return $this->user = di()->get(UserDao::class)->first($userId, true);
    }

    public function isRegisted(): bool
    {
        return $this->getUser()->isRegisted();
    }

    protected function getRedisKey(): string
    {
        if (empty($this->token)) {
            throw new BusinessException(ErrorCode::SERVER_ERROR, 'TOKEN 未正常初始化');
        }
        return 'auth:' . $this->token;
    }
}
