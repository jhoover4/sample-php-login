<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

require_once __DIR__ . '/connection.php';

$session = new Symfony\Component\HttpFoundation\Session\Session();
$session->start();