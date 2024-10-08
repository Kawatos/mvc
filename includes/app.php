<?php

require __DIR__. '/../vendor/autoload.php';


use \App\Utils\View;
use \WilliamCosta\DotEnv\Environment;
use \WilliamCosta\DatabaseManager\Database;
use \App\Http\Middleware\Queue as MiddlewareQueue;


Environment::load(__DIR__.'/../');

Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT')
);


define('URL', getenv('URL'));

//Define o valor padrao das variaveis
View::initi([
    'URL' => URL
]);

//define o mapeamento de middlewares padroes (executados em todas as rotas)

MiddlewareQueue::setMap([
    'maintenance' => \App\Http\Middleware\Maintenance::class
    //adicione mais middlewares aqui
]);

MiddlewareQueue::setDefault([
    'maintenance'
    //adicione mais middlewares aqui
]);