<?php

use App\Controllers\HomeController;
use App\Controllers\ServiceController;
use App\Controllers\UserController;

session_start();

require_once 'autoloader.php';

$uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

match ($uri) {
    '' => (new HomeController())->home(),
    '/register' => (new UserController())->register(),
    '/login' => (new UserController())->login(),
    '/logout' => (new UserController())->logout(),

    '/services' => (new ServiceController())->services(),
    '/service/create' => (new ServiceController())->create(),
    '/service/manager' => (new ServiceController())->manager(),
    '/service/edit-status' => (new ServiceController())->editStatus(),
    default => (new HomeController())->notFound(),
};