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
 * @property int $sign_id 签到id
 * @property string $field_key 字段名称
 * @property string $field_des 字段描述
 * @property int $is_required 0选填1必填
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
    protected $fillable = ['sign_id', 'field_key', 'field_des', 'is_required'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['sign_id' => 'integer', 'is_required' => 'integer'];
}
