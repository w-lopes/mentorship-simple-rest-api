<?php

namespace Controller;

use Attributes\Middleware;
use Middlewares\Auth;
class User
{
    #[Middleware(Auth::class)]
    public function get()
    {
        return 'qualquer coisa';
    }
    public function post()
    {
        // SEND USER NAME AND PASSWORD
    }
}
