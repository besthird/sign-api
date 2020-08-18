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
 * @property string $title
 * @property string $content
 * @property int $user_id
 * @property int $meeting_id
 * @property int $type
 * @property int $is_push
 * @property int $number_people
 * @property string $file
 * @property string $start_time
 * @property string $end_time
 * @property int $is_del
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
    protected $fillable = ['id', 'title', 'content', 'user_id', 'meeting_id', 'type', 'is_push', 'number_people', 'file', 'start_time', 'end_time', 'is_del', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'meeting_id' => 'integer', 'type' => 'integer', 'is_push' => 'integer', 'number_people' => 'integer', 'is_del' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
