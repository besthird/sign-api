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
        $path = BASE_PATH . '/runtime/csv';
        if (! is_dir($path)) {
            mkdir($path, 0777, true);
        }
        $filename = 'sign' . time();
        $format = 'csv';
        $signData = $this->service->download();

        $head = ['id', '微信昵称', '类型', '手机号', '微信号', '创建时间'];  //表头
        foreach ($head as $k => $v) {
            $head[$k] = $this->service->gbk($v);
        }
        $fp = fopen($path . '/' . $filename . '.' . $format, 'w'); //打开
        fputcsv($fp, $head);

        $data = [];
        foreach ($signData as $k => $v) {
            $data['id'] = $v['id'];
            $data['nickname'] = $this->service->gbk($v['nickname']);
            //1签到2签退3补签到4补签退
            $data['type'] = $this->service->gbk($this->service->getSignType($v['type']));
            $data['mobile'] = $v['mobile'];
            $data['wechat_code'] = $v['wechat_code'];
            $data['created_at'] = $v['created_at'];
            fputcsv($fp, $data);
        }
        fclose($fp);
        $this->response->response()->getBody()->write(file_get_contents($path . '/' . $filename . '.' . $format));

        unlink($path . '/' . $filename . '.' . $format);

        return $this->response->response()
            ->withAddedHeader('Content-Type', 'text/csv')
            ->withAddedHeader('Cache-Control', 'must-revalidate,post-check=0,pre-check=0')
            ->withAddedHeader('Content-Disposition', 'attachment;filename=' . $filename . '.' . strtolower($format))
            ->withAddedHeader('Expires', '0')
            ->withAddedHeader('Pragma', 'public');
    }
}
