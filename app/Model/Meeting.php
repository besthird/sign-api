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
 * @property int $user_id 用户ID
 * @property string $title 活动标题
 * @property string $content 活动内容
 * @property int $sign_type 1签到2签退3签到签退
 * @property int $user_limit 参会人数0为无限制
 * @property int $status 是否发布0否1发布
 * @property int $sign_in_btime 签到开始时间
 * @property int $sign_in_etime 签到结束时间
 * @property int $sign_out_btime 签退开始时间
 * @property int $sign_out_etime 签退结束时间
 * @property \Carbon\Carbon $created_at 签到时间
 * @property \Carbon\Carbon $updated_at 更新时间
 */
class Meeting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'meeting';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'title', 'content', 'sign_type', 'user_limit', 'status', 'sign_in_btime', 'sign_in_etime', 'sign_out_btime', 'sign_out_etime', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'sign_type' => 'integer', 'user_limit' => 'integer', 'status' => 'integer', 'sign_in_btime' => 'integer', 'sign_in_etime' => 'integer', 'sign_out_btime' => 'integer', 'sign_out_etime' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}