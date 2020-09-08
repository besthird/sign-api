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
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController::index');
Router::post('/user/register', App\Controller\UserController::class . '::register');
Router::post('/user/login', App\Controller\UserController::class . '::login');
Router::post('/user/wxlogin', App\Controller\UserController::class . '::wxlogin');
Router::get('/user/info', App\Controller\UserController::class . '::info');
Router::post('/user/finish-register', App\Controller\UserController::class . '::finishRegister');
Router::post('/user/save', App\Controller\UserController::class . '::userSave');

