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

use App\Request\SignRequest;
use App\Service\SignService;
use Hyperf\Di\Annotation\Inject;
use function App\Kernel\get_user_id;

class SignController extends Controller
{
    /**
     * @Inject
     * @var SignService
     */
    protected $service;

    public function index()
    {
        $userId = get_user_id();
        $offset = $this->request->input('offset', 0);
        $limit = $this->request->input('limit', 10);

        [$count, $items] = $this->service->index($userId, (int) $offset, (int) $limit);

        return $this->response->success([
            'count' => $count,
            'items' => $items,
        ]);
    }

    public function sign(int $id, SignRequest $request)
    {
        $input = $request->all();

        $result = $this->service->sign($id, get_user_id(), $input);

        return $this->response->success($result);
    }

    /**
     * 用户参与的会议.
     */
    public function getUserSignMeeting()
    {
        $userId = get_user_id();
        $offset = $this->request->input('offset', 0);
        $limit = $this->request->input('limit', 10);

        [$count, $items] = $this->service->getUserMeeting($userId, (int) $offset, (int) $limit);

        return $this->response->success([
            'count' => $count,
            'items' => $items,
        ]);
    }

    /**
     * 会议下的签到.
     */
    public function getMeetingSign()
    {
        $meetingId = $this->request->input('meeting_id', 0);
        $offset = $this->request->input('offset', 0);
        $limit = $this->request->input('limit', 10);

        [$count, $items] = $this->service->getMeetingSign((int) $meetingId, (int) $offset, (int) $limit);

        return $this->response->success([
            'count' => $count,
            'items' => $items,
        ]);
    }

    //导出所有的签到数据
    public function exportExcul()
    {
        $file = BASE_PATH.'/runtime/excul/';
        if (!is_dir($file)) {
            mkdir($file,0777,true);
        }
        $name = 'sign'.time();
        $filename = $file.$name;
        $format = 'xlsx';
        $this->service->download($filename,$format);
        $this->response->response()
            ->getBody()->write(file_get_contents($filename.'.'.$format));
        return $this->response->response()
            ->withAddedHeader('Content-Type','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->withAddedHeader('Cache-Control','max-age=0')
            ->withAddedHeader('Content-Disposition','inline;filename='.$name.'.'.strtolower($format));
    }
}
