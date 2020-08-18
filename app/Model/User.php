<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Model;

/**
 * @property int $id
 * @property string $username 用户名
 * @property string $wechat_code 微信号
 * @property string $profession 职业
 * @property string $openid openid
 * @property string $phone 手机号
 * @property string $email 邮件
 * @property string $password 密码
 * @property int $sex 性别1男2女
 * @property string $nikename 微信昵称
 * @property string $head_img 微信头像
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
    protected $fillable = ['id', 'username', 'wechat_code', 'profession', 'openid', 'phone', 'email', 'password', 'sex', 'nikename', 'head_img', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'sex' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
