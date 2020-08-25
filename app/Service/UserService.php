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
use Hyperf\Di\Annotation\Inject;
use HyperfX\Utils\Service;

class UserService extends Service
{
    /**
     * @Inject
     * @var UserDao
     */
    protected $dao;

    public function register(string $username, string $password)
    {
        $model = $this->dao->firstByUserName($username);
        if ($model !== null) {
            throw new BusinessException(ErrorCode::USERNAME_EXIST_ERROR);
        }

        $model = new User();
        $model->username = $username;
        $model->password = password_hash($password, PASSWORD_DEFAULT);
        $model->save();

        // TODO: 返回用户 Token
        return '';
    }

    public function login(string $username, string $password)
    {
        $model = $this->dao->firstByUserName($username);
        if ($model === null) {
            throw new BusinessException(ErrorCode::USERNAME_OR_PASSWORD_ERROR);
        }

        if (! $model->verify($password)) {
            throw new BusinessException(ErrorCode::USERNAME_OR_PASSWORD_ERROR);
        }

        // TODO: 返回用户 Token
        return '';
    }
}
