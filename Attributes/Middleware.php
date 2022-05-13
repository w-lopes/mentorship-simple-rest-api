<?php

namespace Attributes;

use Attribute;

#[Attribute]
class Middleware
{
    public static function apply(string $class, string $method)
    {
        $reflection = new \ReflectionClass($class);
        $reflectionMethod = $reflection->getMethod($method);

        foreach ($reflectionMethod->getAttributes() as $attribute) {
            if ($attribute->getName() !== 'Attributes\Middleware') {
                continue;
            }
            $middlewares = $attribute->getArguments();

            foreach ($middlewares as $middleware) {
                self::process($middleware);
            }
        }
    }

    private static function process(string $middleware)
    {
        $instance = new $middleware();
        if (!$instance()) {
            echo json_encode('NOT AUTHORIZED');
            http_response_code(401);
            exit;
        }
    }
}