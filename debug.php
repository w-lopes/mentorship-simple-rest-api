<?php

require_once "./autoload.php";

use \Common\Hash;
use \Common\Crypt;

$passwd = "senhaqualquer";
$teste = Hash::makeHash($passwd);
$res = Hash::checkHash($passwd, $teste);

echo "Pass : {$passwd}" . PHP_EOL;
echo "Hash : {$teste}" . PHP_EOL;
echo "Res  : " . ($res ? "Senha válida" : "Senha inválida") . PHP_EOL;

echo "--------------------------------------------" . PHP_EOL;

$obj = (object) [
    "um"   => 1,
    "dois" => "qualquer coisa",
    3      => "3"
];
$enc = Crypt::encrypt($obj);
$dec = Crypt::decrypt($enc);

var_dump(
    $enc,
    $dec
);
