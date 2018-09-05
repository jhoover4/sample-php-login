<?php
require_once __DIR__ . '/../inc/bootstrap.php';

use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Cookie;

$suppliedUsername = request()->get('username');
$suppliedPassword = request()->get('password');

$hashed = password_hash($password, PASSWORD_DEFAULT);

try {
    $loginInfo = getLogin()[0];
} catch (Exception $e) {
    $session->getFlashBag()->add('error', 'Error processing form.');
    redirect('/login.php');
}

if ($suppliedUsername !== $loginInfo['username']) {
    $session->getFlashBag()->add('error', 'Username does match existing login.');
    redirect('/login.php');
}

// Would be done differently in production, but we need a simple check for our initial password.
if ($suppliedPassword !== $loginInfo['password'] &&
    !password_verify($suppliedPassword, $loginInfo['password'])) {

    $session->getFlashBag()->add('error', 'Password does not match existing login.');
    redirect('/login.php');
}

$expTime = time() + (int)getenv('COOKIE_EXP_TIME');

$key = getenv('SECRET_KEY');
$token = array(
    'iss' => request()->getBaseUrl(),
    'sub' => [$loginInfo['Id']],
    'exp' => $expTime,
    'iat' => time(),
    'nbf' => time(),
    'is_admin' => true
);
$jwt = JWT::encode($token, $key);

$accessToken = new Cookie(
    'access_token',
    $jwt,
    $expTime,
    '/',
    getenv('COOKIE_DOMAIN')
);

$session->getFlashBag()->add('success', 'You have been logged in.');
redirect('/', ['cookies' => [$accessToken]]);