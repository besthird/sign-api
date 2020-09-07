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
namespace App\Model;

/**
 * @property int $id
 * @property string $username 用户名
 * @property string $password 密码
 * @property string $nikename 姓名
 * @property string $mobile 手机号
 * @property string $wechat_code 微信号
 * @property string $profession 职业
 * @property int $gender 性别0未知1男2女
 * @property string $head_img 头像
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'username', 'password', 'nikename', 'mobile', 'wechat_code', 'profession', 'gender', 'head_img', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'gender' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function verify(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    public function isRegisted(): bool
    {
        return ! empty($this->username);
    }
}
