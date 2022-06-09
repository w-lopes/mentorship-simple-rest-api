<?php

namespace Controller;

use Attributes\Middleware;
use Middlewares\Auth;
use Database\Connection;
use Common\Hash;
class User
{
    #[Middleware(Auth::class)]
    public function get()
    {
        return "qualquer coisa";
    }
    public function post()
    {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid Email');
        }

        $options = ["options" => ["regexp" => "/.{6,}/"]];

        if (!filter_var($_POST['password'], FILTER_VALIDATE_REGEXP, $options)) {
            throw new \InvalidArgumentException('Invalid Password');
        }

        $connection = new Connection();

        $connection->insert(data: [
            "email" => $_POST['email'],
            "password" => Hash::makeHash($_POST['password'])
        ], table: "users");

        return true;
        // SEND USER NAME AND PASSWORD
    }
}
