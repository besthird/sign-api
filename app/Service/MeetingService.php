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
namespace App\Service;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Model\Meeting;
use App\Service\Dao\MeetingDao;
use App\Service\Formatter\MeetingFormatter;
use Hyperf\Di\Annotation\Inject;
use HyperfX\Utils\Service;

class MeetingService extends Service
{
    /**
     * @Inject
     * @var MeetingDao
     */
    protected $dao;

    /**
     * @Inject
     * @var MeetingFormatter
     */
    protected $formatter;

    /**
     * @Inject
     * @var WeChat
     */
    protected $wechat;

    public function update(int $meetingId, int $userId, array $data)
    {
        if ($meetingId > 0) {
            $model = $this->dao->first($meetingId, true);
            if ($model->user_id !== $userId) {
                throw new BusinessException(ErrorCode::AUTH_INVALID);
            }
        } else {
            $model = new Meeting();
            $model->user_id = $userId;
        }

        $model->title = $data['title'];
        $model->content = $data['content'];
        $model->sign_type = $data['sign_type'];
        $model->user_limit = $data['user_limit'];
        $model->status = $data['status'];
        if ($time = $data['sign_in_btime'] ?? 0) {
            $model->sign_in_btime = $this->factory->date->load($time)->getTimestamp();
        }
        if ($time = $data['sign_in_etime'] ?? 0) {
            $model->sign_in_etime = $this->factory->date->load($time)->getTimestamp();
        }
        if ($time = $data['sign_out_btime'] ?? 0) {
            $model->sign_out_btime = $this->factory->date->load($time)->getTimestamp();
        }
        if ($time = $data['sign_out_etime'] ?? 0) {
            $model->sign_out_etime = $this->factory->date->load($time)->getTimestamp();
        }

        return $model->save();
    }

    public function info(int $id)
    {
        return $this->dao->first($id, true);
    }

    public function qrcode(int $id, bool $isDownload)
    {
        $app = $this->wechat->app();
        $scene = http_build_query([
            'id' => $id,
        ]);
        $result = $app->app_code->getUnlimit($scene);
        if (! $isDownload) {
            $result = $result->withHeader('Content-Disposition', '');
        }
        return $result;
    }

    public function getUserMeeting(int $userId, int $offset, int $limit)
    {
        [$count, $items] = $this->dao->getUserMeeting($userId, $offset, $limit);

        $result = $this->formatter->formatList($items);

        return [$count, $result];
    }
}
