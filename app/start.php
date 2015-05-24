<?php

require '../vendor/autoload.php';

date_default_timezone_set('America/Mexico_City');

$app = new \Slim\Slim();

$app = new \Slim\Slim(array(
    'view' => new \Slim\Views\Twig(),
    'templates.path' => '../app/templates'
));

$view = $app->view();

$view->parserOptions = array(
    'debug' => true
);

$view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
);

$app->get('/', function () use($app) {
    $app->render('home.twig');
});

$app->get('/contact', function () use($app) {
    $app->render('contact.twig');
});

$app->run();