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
Router::post('/user/save', App\Controller\UserController::class . '::save');

Router::post('/meeting/{id:\d+}', App\Controller\MeetingController::class . '::update');
Router::get('/meeting/{id:\d+}', App\Controller\MeetingController::class . '::info');
Router::get('/meeting', App\Controller\MeetingController::class . '::index');
Router::post('/meeting/del', App\Controller\MeetingController::class . '::del');

Router::post('/sign/{id:\d+}', App\Controller\SignController::class . '::sign');
Router::get('/sign', App\Controller\SignController::class . '::index');
Router::get('/sign/get-meeting', App\Controller\SignController::class . '::getMeetingSign');
Router::get('/sign/get-user-meeting', App\Controller\SignController::class . '::getUserSignMeeting');
Router::get('/sign/export-excul', App\Controller\SignController::class . '::exportExcul');

