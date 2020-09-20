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

use App\Model\Meeting;
use App\Model\User;

class MeetingFormatter extends Formatter
{
    public function base(Meeting $model)
    {
        return [
            'id' => $model->id,
            'user_id' => $model->user_id,
            'title' => $model->title,
            'content' => $model->content,
            'sign_type' => $model->sign_type,
            'user_limit' => $model->user_limit,
            'status' => $model->status,
            'sign_in_btime' => $model->sign_in_btime,
            'sign_in_etime' => $model->sign_in_etime,
            'sign_out_btime' => $model->sign_out_btime,
            'sign_out_etime' => $model->sign_out_etime,
            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at,
        ];
    }

    public function detail(Meeting $model, User $user)
    {
        $data = $this->base($model);

        $data['user'] = di()->get(UserFormatter::class)->base($user);

        return $data;
    }
}
