<?php

namespace Controller;
use Database\Connection;

class Login
{
    public function post()
    {
        $conection = new Connection;
        $user = $conection->select("users", ["email", "password"], ["email" => $_POST['email']]);

    // continuar verificação da senhas
        return $user;
    }
}