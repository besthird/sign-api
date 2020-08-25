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
     * @Message("参数错误")
     */
    const PARAMS_INVALID = 1000;

    /**
     * @Message("用户已存在")
     */
    const USERNAME_EXIST_ERROR = 1001;

    /**
     * @Message("用户不能为空")
     */
    const USERNAME_EMPTY_ERROR = 1002;

    /**
     * @Message("密码不能为空")
     */
    const PASSWORD_EMPTY_ERROR = 1003;

    /**
     * @Message("用户不存在")
     */
    const USERNAME_NOT_EXIST_ERROR = 1004;

    /**
     * @Message("密码错误")
     */
    const PASSWORD_ERROR = 1005;

    /**
     * @Message("用户名或密码错误")
     */
    const USERNAME_OR_PASSWORD_ERROR = 1006;
}
