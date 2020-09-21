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
namespace App\Controller;

use App\Model\Meeting;
use App\Request\MeetingCreateRequest;
use App\Service\Dao\MeetingDao;
use App\Service\Formatter\MeetingFormatter;
use App\Service\MeetingService;
use App\Service\UserAuth;
use Hyperf\Di\Annotation\Inject;

class MeetingController extends Controller
{
    /**
     * @Inject
     * @var MeetingService
     */
    protected $service;

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
     * 创建会议.
     */
    public function update(int $id, MeetingCreateRequest $request)
    {
        $userId = UserAuth::instance()->build()->getUserId();

        $data = $request->all();

        $bool = $this->service->update($id, $userId, $data);

        return $this->response->success($bool);
    }

    /**
     * 用户会议数据.
     */
    public function getUserMeeting()
    {
        $userId = UserAuth::instance()->build()->getUserId();
        $offset = intval($this->request->input('offset'));
        $limit = intval($this->request->input('limit'));

        [$count,$items] = $this->service->getUserMeeting($userId,$offset,$limit);

        return $this->response->success(['count'=>$count,'items'=>$items]);
    }

    /**
     * 会议详情.
     */
    public function info(int $id)
    {
        /** @var Meeting $model */
        $model = $this->service->info($id);

        return $this->response->success(
            $this->formatter->base($model)
        );
    }

    /**
     * 删除会议.
     */
    public function del()
    {
        $id = $this->request->input('id');

        /** @var Meeting $model */
        $model = $this->dao->first((int) $id, true);

        $bool = $model->delete();

        return $this->response->success($bool);
    }
}