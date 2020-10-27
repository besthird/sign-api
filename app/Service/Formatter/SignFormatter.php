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

use App\Model\Sign;
use Hyperf\Di\Annotation\Inject;

class SignFormatter extends Formatter
{
    /**
     * @Inject
     * @var MeetingFormatter
     */
    protected $meeting;

    public function base(Sign $sign)
    {
        $result = [
            'id' => $sign->id,
            'meeting_id' => $sign->meeting_id,
            'type' => $sign->type,
            'user_id' => $sign->user_id,
            'nickname' => $sign->nickname,
            'mobile' => $sign->mobile,
            'wechat_code' => $sign->wechat_code,
            'data' => $sign->data_array,
            'last_sign_at' => $sign->last_sign_at->toDateTimeString(),
        ];

        if ($sign->relationLoaded('meeting')) {
            $result['meeting'] = $this->meeting->base($sign->meeting);
        }
        return $result;
    }

    public function formatList($models)
    {
        $result = [];
        foreach ($models as $model) {
            /* @var $model Sign */
            $result[] = $this->base($model);
        }
        return $result;
    }
}
