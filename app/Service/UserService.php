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
use App\Model\UserOauth;
use App\Service\Dao\UserDao;
use App\Service\Dao\UserOauthDao;
use Hyperf\Di\Annotation\Inject;
use HyperfX\Utils\Service;

class UserService extends Service
{
    /**
     * @Inject
     * @var UserDao
     */
    protected $dao;

    /**
     * @Inject
     * @var UserOauthDao
     */
    protected $oauth;

    /**
     * @Inject
     * @var WeChat
     */
    protected $wechat;

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

        return UserAuth::instance()->init($model);
    }

    public function finishRegister(int $userId, string $username)
    {
        $user = $this->dao->first($userId, true);
        if (empty($user->username)) {
            $user->username = $username;
            $user->save();
        }

        return true;
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

        return UserAuth::instance()->init($model);
    }

    public function wxlogin(string $token)
    {
        $app = $this->wechat->app();
        $data = $app->auth->session($token);
        if (empty($data['openid'])) {
            throw new BusinessException(ErrorCode::WECHAT_TOKEN_INVALID);
        }

        $openid = $data['openid'];
        $userOauth = $this->oauth->firstByOpenId($openid);
        if ($userOauth) {
            $model = $this->dao->first($userOauth->user_id);
        } else {
            $model = $this->dao->create();
            $userOauth = new UserOauth();
            $userOauth->user_id = $model->id;
            $userOauth->type = UserOauth::TYPE_WECHAT;
            $userOauth->oauth = $openid;
            $userOauth->save();
        }

        return UserAuth::instance()->init($model);
    }

    public function info(int $userId)
    {
        return $this->dao->first($userId, true);
    }

    /**
     * 更新用户数据.
     * @param $data = [
     *     'nickname' => '', // 昵称
     *     'mobile' => '', // 手机号
     *     'wechat_code' => '', // 微信号
     *     'profession' => '', // 职业
     *     'gender' => 0, // 性别
     *     'head_img' => '', // 头像
     * ]
     * @return bool
     */
    public function save(int $userId, array $data)
    {
        $model = $this->dao->first($userId, true);

        $model->nickname = $data['nickname'];
        $model->mobile = $data['mobile'] ?? '';
        $model->head_img = $data['head_img'] ?? '';
        $model->wechat_code = $data['wechat_code'] ?? '';
        $model->gender = $data['gender'] ?? 0;
        $model->profession = $data['profession'] ?? '';

        return $model->save();
    }
}
