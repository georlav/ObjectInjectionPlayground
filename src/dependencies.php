<?php
// DIC configuration

$container = $app->getContainer();

$container['cookies'] = function($c){
    $request = $c->get('request');
    return new \Slim\Http\Cookies($request->getCookieParams());
};

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('../templates', [
        'cache' => false,
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new Slim\Views\TwigExtension($router, $uri));

    $host = "http://" . strstr($_SERVER['HTTP_HOST'], ':', true);

    // Set php container urls
    $env = $view->getEnvironment();
    $env->addGlobal("baseUrl", "http://" . $_SERVER['HTTP_HOST']);
    $env->addGlobal("phpVersions", [
        "php56" =>  $host . ':8056',
        "php71" => $host . ':8071',
        "php73" => $host . ':8073',
    ]);

    $view->getEnvironment()->addGlobal("phpVersion", phpversion());

    return $view;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
