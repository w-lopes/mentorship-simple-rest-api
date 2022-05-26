<?php

namespace Controller;

use Attributes\Middleware;
use Middlewares\Auth;
class User
{
    #[Middleware(Auth::class)]
    public function get()
    {
        return "qualquer coisa";
    }
    public function post()
    {
        return 'insert data aqui';
        // SEND USER NAME AND PASSWORD
    }
}
