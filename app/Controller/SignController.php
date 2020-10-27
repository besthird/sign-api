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
     * 会议下的签到
     */
    public function meetingSign()
    {
        $meetingId = $this->request->input('meeting_id',0);
        $offset = $this->request->input('offset', 0);
        $limit = $this->request->input('limit', 10);

        [$count, $items] = $this->service->meetingSign((int) $meetingId,(int) $offset,(int) $limit);

        return $this->response->success([
            'count' => $count,
            'items' => $items,
        ]);
    }
}
