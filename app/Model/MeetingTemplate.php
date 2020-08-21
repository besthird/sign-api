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
 * @property int $meeting_id 相关会议ID
 * @property string $title 活动标题
 * @property string $content 活动内容
 * @property int $sign_type 1签到2签退3签到签退
 * @property string $sign_fields 签到所需字段
 * @property string $sign_rules 签到规则
 * @property int $user_limit 参会人数0为无限制
 * @property int $status 是否发布0否1发布
 * @property \Carbon\Carbon $created_at 签到时间
 * @property \Carbon\Carbon $updated_at 更新时间
 */
class MeetingTemplate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'meeting_template';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'meeting_id', 'title', 'content', 'sign_type', 'sign_fields', 'sign_rules', 'user_limit', 'status', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'meeting_id' => 'integer', 'sign_type' => 'integer', 'user_limit' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
