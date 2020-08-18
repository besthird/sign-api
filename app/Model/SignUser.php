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
 * @property int $sign_id
 * @property int $meeting_id
 * @property int $user_id
 * @property int $type
 * @property string $filed_text
 * @property string $wifi
 * @property string $address
 * @property string $photo
 * @property string $qr_code
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
