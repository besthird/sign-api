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
namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
class ErrorCode extends AbstractConstants
{
    /**
     * @Message("Server Error")
     */
    const SERVER_ERROR = 500;

    /**
     * @Message("用户已存在")
     */
    const USERNAME_EXIST_ERROR = 501;

    /**
     * @Message("用户不能为空")
     */
    const USERNAME_EMPTY_ERROR = 502;

    /**
     * @Message("密码不能为空")
     */
    const PASSWORD_EMPTY_ERROR = 503;

    /**
     * @Message("用户不存在")
     */
    const USERNAME_NOT_EXIST_ERROR = 504;

    /**
     * @Message("密码错误")
     */
    const PASSWORD_ERROR = 505;
}
