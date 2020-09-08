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
namespace App\Service;

use EasyWeChat\Factory;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Guzzle\CoroutineHandler;
use HyperfX\Utils\Service;
use Psr\Container\ContainerInterface;

class WeChat extends Service
{
    /**
     * @var HandlerStack
     */
    protected $stack;

    /**
     * @var CoroutineHandler
     */
    protected $handler;

    /**
     * @var array
     */
    protected $config;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->handler = new CoroutineHandler();
        $this->stack = HandlerStack::create($this->handler);
        $this->config = $container->get(ConfigInterface::class)->get('wechat', []);
    }

    public function app()
    {
        $app = Factory::miniProgram($this->config);

        // 设置 HttpClient，部分接口直接使用了 http_client。
        $config = $app['config']->get('http', []);
        $config['handler'] = $this->handler;
        $app->rebind('http_client', new Client($config));

        $app->rebind('guzzle_handler', $this->handler);

        return $app;
    }
}
