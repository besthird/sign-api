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
namespace App\Middleware;

use HyperfX\Utils\Middleware\DebugMiddleware as Middleware;
use Psr\Http\Message\ResponseInterface;

class DebugMiddleware extends Middleware
{
    protected function getResponseString(ResponseInterface $response): string
    {
        $contentType = $response->getHeaderLine('Content-Type');
        if (strpos($contentType, 'json')) {
            return (string) $response->getBody();
        }

        return $contentType . ':' . strlen((string) $response->getBody());
    }
}
