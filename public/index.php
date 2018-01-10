<?php

use App\ServiceProvider\ExampleServiceProvider;

require_once __DIR__.'/../vendor/autoload.php';

$diContainer = ExampleServiceProvider::serviceLocator();

$app = $diContainer->get(ExampleServiceProvider::APP);

$app->get('/', $diContainer->get(ExampleServiceProvider::INDEX_ACTION));

$app->run();
