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
namespace App\Server\Biz\Api;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Server\Dao\UserDao;
use App\Server\Server;
use Hyperf\Di\Annotation\Inject;

class UserBiz extends Server
{
    /**
     * @Inject
     * @var UserDao
     */
    protected $Dao;

    /**
     * @return bool
     */
    public function register(string $username, string $password)
    {
        $this->Dao->findOne($username, true);

        return $this->Dao->save(['username' => $username, 'password' => md5($password)]);
    }

    public function login(string $username, string $password)
    {
        $user = $this->Dao->findOne($username, false);
        if (empty($user)) {
            throw new BusinessException(ErrorCode::USERNAME_EXIST_ERROR);
        }

        if (md5($password) != $user['password']) {
            throw new BusinessException(ErrorCode::PASSWORD_ERROR);
        }

        return $user;
    }
}
