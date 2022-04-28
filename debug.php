<?php

require_once './autoload.php';

use \Common\Hash;
use \Common\Crypt;

// $teste = Hash::makeHash('senhaqualquer');

// $res = Hash::checkHash('senhaqualquer', $teste);

$obj = (object)['um' => 1, 'dois' => 'qualquer coisa', 3 => '3'];


$teste = Crypt::encrypt($obj);

$testeDois = Crypt::decrypt($teste);

var_dump($testeDois);