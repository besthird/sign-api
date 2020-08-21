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
 * @property int $meeting_id 会议ID
 * @property int $sign_type 1签到 2签退
 * @property int $type 签到类型 0访问1Wifi2geo
 * @property string $data 签到相关数据
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class SignRule extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sign_rule';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'meeting_id', 'sign_type', 'type', 'data', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'meeting_id' => 'integer', 'sign_type' => 'integer', 'type' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
