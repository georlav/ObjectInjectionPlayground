<?php

use Slim\Http\Request;
use Slim\Http\Response;

error_reporting(E_ALL);
ini_set('display_errors', 1);

/*
 * Home page
 */
$app->get('/', function (Request $request, Response $response, array $args) {
    $args['title'] = "ObjectMap";
    $args['menu']['home'] = true;

    return $this->view->render($response, 'home.html.twig', $args);
})->setName("home");

/*
 * Get parameters example page
 */
$app->get('/params', function ($request, $response, $args) {
    if ($obj = isset($_GET['obj']) ? $_GET['obj'] : false) {
        unserialize($obj);
    }

    $args['title'] = "ObjectMap - Params";
    $args['menu']['params'] = true;

    return $this->view->render($response, 'params.html.twig', $args);
})->setName('params');

/*
 * Cookie example page
 */
$app->get('/cookies', function ($request, $response, $args) {
    if (!isset($_COOKIE['obj'])) {
        setcookie('obj', serialize(['red', 'blue', 'green']));
    } else {
        unserialize(urldecode($_COOKIE['obj']));
    }

    $args['cookie'] = isset($_COOKIE['obj']) ? $_COOKIE['obj'] : "";
    $args['title'] = "ObjectMap - Cookies";
    $args['menu']['cookies'] = true;

    return $this->view->render($response, 'cookies.html.twig', $args);
})->setName("cookies");

/*
 * Headers Page
 */
$app->get('/headers', function ($request, $response, $args) {
    if (count($request->getHeader('X-Obj'))) {
        $header = $request->getHeader('X-Obj');
        $object = array_shift($header);
        unserialize($object);
    }

    return $this->view->render($response, 'headers.html.twig', $args);
})->setName("headers");

$app->get('/forms', function ($request, $response, $args) {
    $args['title'] = "ObjectMap - Forms";
    $args['menu']['forms'] = true;
    return $this->view->render($response, 'forms.html.twig', $args);
});

$app->post('/forms', function ($request, $response, $args) {
    if (isset($_POST['payload'])) {
        unserialize($_POST['payload']);
    }

    $args['title'] = "ObjectMap - Forms";
    $args['menu']['forms'] = true;
    return $this->view->render($response, 'forms.html.twig', $args);
});

$app->put('/forms', function ($request, $response, $args) {
    if (isset($_POST['payload'])) {
        unserialize($_POST['payload']);
    }

    $args['title'] = "ObjectMap - Forms";
    $args['menu']['forms'] = true;
    return $this->view->render($response, 'forms.html.twig', $args);
});


