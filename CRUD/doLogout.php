<?php
require_once __DIR__ . '/../inc/bootstrap.php';

$accessToken = new Symfony\Component\HttpFoundation\Cookie(
    'access_token',
    'Expired',
    time() - (int)getenv('COOKIE_EXP_TIME'),
    '/',
    getenv('COOKIE_DOMAIN')
);

redirect('/login.php', ['cookies' => [$accessToken]]);