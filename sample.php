<?php

require_once('./vendor/autoload.php');

use Octopus\Client;
use Dotenv\Dotenv;

$dotenv = new Dotenv(__DIR__ . '/');
$dotenv->load();

$octopusClient = new Client(
    getenv('AUTH_KEY')
);

$result = $octopusClient->SearchByKeyword('www', 1);

var_dump($result);