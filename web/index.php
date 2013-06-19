<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->get('/', function() use ($app) {
    return 'Hello <a href="/switch/1/on">switch</a>';
});

$app->get('/switch/{id}/{state}', function($id, $state) use ($app) {
    sprintf(
        'Switching unit %u in state %s',
        $app->escape($id),
        $app->escape($state)
    );
    $ls = new \App\Send\LightSwitch();
    return $ls->execute($id, $state);
});

$app->run();
