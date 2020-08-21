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
 * @property int $meeting_id 会议id
 * @property int $user_id 用户id
 * @property int $type 签到类型1签到2签退3补签到4补签退
 * @property string $nickname 姓名
 * @property string $mobile 手机号
 * @property string $wechat_code 微信号
 * @property string $data 自定义字段内容
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Sign extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sign';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'meeting_id', 'user_id', 'type', 'nickname', 'mobile', 'wechat_code', 'data', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'meeting_id' => 'integer', 'user_id' => 'integer', 'type' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
