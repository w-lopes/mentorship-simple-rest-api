<?php

namespace Middlewares;

class Auth
{
    public function __invoke(): bool 
    {
        return rand(0,1);
    } 
}