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
namespace App\Service\Formatter;

use App\Model\User;

class UserFormatter extends Formatter
{
    public function base(User $model)
    {
        return [
            'id' => $model->id,
            'username' => $model->username,
            'nickname' => $model->nikename,
            'mobile' => $model->mobile,
            'wechat_code' => $model->wechat_code,
            'profession' => $model->profession,
            'gender' => $model->gender,
            'head_img' => $model->head_img,
        ];
    }
}
