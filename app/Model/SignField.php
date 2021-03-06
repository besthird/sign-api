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
 * @property string $key 签到KEY
 * @property string $title 字段标题
 * @property int $type 0填写1图片
 * @property int $required 是否必填
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class SignField extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sign_field';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'meeting_id', 'key', 'title', 'type', 'required', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'meeting_id' => 'integer', 'type' => 'integer', 'required' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
