<?php

require_once '../autoload.php';

$requestUri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$pieces = explode('/', trim($requestUri, '/'));
$class = ucfirst($pieces[0] ?: 'Home');
$params = array_slice($pieces, 1);

$controllerNamespace = "Controller\\{$class}";

$newClass = new $controllerNamespace();

$result = $newClass->{$method}(...$params);

header('Content-Type: application/json');

echo json_encode($result);
