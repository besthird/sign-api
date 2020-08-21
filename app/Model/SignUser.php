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
 * @property int $sign_id 签到id
 * @property int $meeting_id 会议id
 * @property int $user_id 用户id
 * @property int $type 签到类型1签到2签退3补签到4补签退
 * @property string $filed_text 自定义字段内容
 * @property string $wifi wifi
 * @property string $address 位置签到
 * @property string $photo 拍照签到
 * @property string $qr_code 二维码签到
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class SignUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sign_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'sign_id', 'meeting_id', 'user_id', 'type', 'filed_text', 'wifi', 'address', 'photo', 'qr_code', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'sign_id' => 'integer', 'meeting_id' => 'integer', 'user_id' => 'integer', 'type' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
