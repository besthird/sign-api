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

    public function sign(int $id)
    {
        $result = $this->service->sign($id, get_user_id());

        return $this->response->success($result);
    }
}
