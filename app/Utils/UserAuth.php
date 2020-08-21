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
namespace App\Utils;

use Firebase\JWT\JWT;

class UserAuth
{
    protected $key = 'sign';

    protected $userId;

    public function getToken($userId)
    {
        $payload = [
            'iss' => 'sign',
            'aud' => 'user',
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + 7200,
            'data' => [
                'user_id' => $userId,
            ],
        ];

        /*
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
         */
        return JWT::encode($payload, $this->key);
    }

    public function verifyToken($token)
    {
        try {
            $decoded = JWT::decode($token, $this->key, ['HS256']);
            return $decoded->data->user_id;
        } catch (\Throwable $exception) {
            return 0;
        }
    }
}
