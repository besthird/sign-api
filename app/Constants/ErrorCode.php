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
     * @Message("Token 已失效")
     */
    const TOKEN_INVALID = 700;

    /**
     * @Message("参数错误")
     */
    const PARAMS_INVALID = 1000;

    /**
     * @Message("用户名已存在")
     */
    const USERNAME_EXIST_ERROR = 1001;

    /**
     * @Message("用户不存在")
     */
    const USER_NOT_EXIST = 1002;

    /**
     * @Message("微信 Token 已失效")
     */
    const WECHAT_TOKEN_INVALID = 1003;

    /**
     * @Message("用户名或密码错误")
     */
    const USERNAME_OR_PASSWORD_ERROR = 1006;

    /**
     * @Message("手机号已存在")
     */
    const MOBILE_EXIST_ERROR = 1010;

    /**
     * @Message("会议不存在")
     */
    const MEETING_NOT_EXIST_ERROR = 1014;
}
