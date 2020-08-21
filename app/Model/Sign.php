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
 * @property string $title 活动标题
 * @property string $content 活动内容
 * @property int $user_id 用户ID
 * @property int $meeting_id 会议id
 * @property int $type 1签到2签退3补签到4补签退
 * @property int $is_push 是否发布0否1发布
 * @property int $number_people 参会人数0为无限制
 * @property string $file 活动文件
 * @property string $start_time 签到开始时间
 * @property string $end_time 签到结束时间
 * @property int $is_del 是否删除0未删除1删除
 * @property \Carbon\Carbon $created_at 签到时间
 * @property \Carbon\Carbon $updated_at 更新时间
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
    protected $fillable = ['id', 'title', 'content', 'user_id', 'meeting_id', 'type', 'is_push', 'number_people', 'file', 'start_time', 'end_time', 'is_del', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'meeting_id' => 'integer', 'type' => 'integer', 'is_push' => 'integer', 'number_people' => 'integer', 'is_del' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
