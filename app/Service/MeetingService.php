<?php


namespace App\Service;

use App\Model\Meeting;
use App\Service\Dao\MeetingDao;
use App\Service\Formatter\MeetingFormatter;
use Hyperf\Di\Annotation\Inject;
use HyperfX\Utils\Service;

class MeetingService extends Service
{
    /**
     * @Inject()
     * @var MeetingDao
     */
    protected $dao;

    /**
     * @Inject()
     * @var MeetingFormatter
     */
    protected $formatter;

    public function create($userId,array $data)
    {
        $model = new Meeting();
        $model->user_id = $userId;
        $model->title = $data['title'];
        $model->content = $data['content'];
        $model->sign_type = $data['sign_type'];
        $model->user_limit = $data['user_limit'];
        $model->status = $data['status'];
        $model->sign_in_btime = $data['sign_in_btime'] ?? 0;
        $model->sign_in_etime = $data['sign_in_etime'] ?? 0;
        $model->sign_out_btime = $data['sign_out_btime'] ?? 0;
        $model->sign_out_etime = $data['sign_out_etime'] ?? 0;

        return $model->save();
    }

    public function info($id)
    {
        return $this->dao->first($id,true);
    }

    public function getUserMeeting(int $userId)
    {
        $model = $this->dao->getUserMeeting($userId);

        $item = [];
        foreach ($model as $k=>$v) {
            $item[$k] = $this->formatter->detail($v,$v->user);
        }

        return $item;
    }
}