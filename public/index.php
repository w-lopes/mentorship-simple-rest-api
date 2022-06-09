<?php

require_once '../autoload.php';

use Attributes\Middleware;

$requestUri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$pieces = explode('/', trim($requestUri, '/'));
$class = ucfirst($pieces[0] ?: 'Home');
$params = array_slice($pieces, 1);

$controllerNamespace = "Controller\\{$class}";

// header('Content-Type: application/json');

try {
    Middleware::apply($controllerNamespace, $method);
    $newClass = new $controllerNamespace();
    $result = $newClass->{$method}(...$params);
} catch (\InvalidArgumentException $res) {
    $result = [
        'result' => $res->getMessage()
    ];

    http_response_code(400);
} catch (\Throwable $th) {
    $result = [
        'result' => 'Not found'
    ];

    http_response_code(404);
}

echo json_encode($result);
