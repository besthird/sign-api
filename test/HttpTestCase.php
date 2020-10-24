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
namespace HyperfTest;

use App\Service\Dao\UserDao;
use App\Service\UserAuth;
use Hyperf\Testing;
use PHPUnit\Framework\TestCase;

/**
 * Class HttpTestCase.
 * @method get($uri, $data = [], $headers = [])
 * @method post($uri, $data = [], $headers = [])
 * @method json($uri, $data = [], $headers = [])
 * @method file($uri, $data = [], $headers = [])
 */
abstract class HttpTestCase extends TestCase
{
    /**
     * @var string
     */
    public static $token;

    /**
     * @var Testing\HttpClient
     */
    protected $client;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = make(Testing\HttpClient::class, ['baseUri' => 'http://127.0.0.1:9501']);
        // $this->client = make(Testing\Client::class);
    }

    public function __call($name, $arguments)
    {
        return $this->client->{$name}(...$arguments);
    }

    public function getToken()
    {
        if (self::$token) {
            return self::$token;
        }

        $userAuth = UserAuth::instance()->init(
            di()->get(UserDao::class)->first(1),
            'phpunit'
        );

        return self::$token = $userAuth->getToken();
    }
}
