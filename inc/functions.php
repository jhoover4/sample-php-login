<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Firebase\JWT\JWT;

/**
 * @return \Symfony\Component\HttpFoundation\Request
 */
function request()
{
    return Request::createFromGlobals();
}

/**
 * @param $path
 * @param array $headers
 */
function redirect($path, $headers = [])
{
    $response = Response::create(
        null,
        Response::HTTP_FOUND,
        ['Location' => $path]
    );
    if (key_exists('cookies', $headers)) {
        foreach ($headers['cookies'] as $cookie) {
            $response->headers->setCookie($cookie);
        }
    }

    $response->send();
    exit;
}

/**
 * @param string $type
 * @return string|void
 */
function displayFlash($type = 'error')
{
    global $session;
    $alertCss = $type === 'error' ? 'alert-danger' : "alert-{$type}";

    if (!$session->getFlashBag()->has($type)) {
        return;
    }

    $messages = $session->getFlashBag()->get($type);
    $response = "<div class='alert {$alertCss} alert-dismissable'>";
    foreach ($messages as $message) {
        $response .= "{$message}<br />";
    }
    $response .= "</div>";

    return $response;
}

/**
 * @param int $id
 * @return array
 * @throws Exception
 *
 * Errors will be caught when called.
 *
 */
function getLogin($id = 1)
{
    global $db;

    try {
        $query = "SELECT * FROM login WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll();
    } catch (Exception $e) {
        throw $e;
    }
}

/**
 * @param $password
 * @param int $id
 * @return bool
 */
function updatePassword($password, $id = 1)
{
    global $db;

    try {
        $query = "UPDATE login SET password = :password WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    } catch (Exception $e) {
        return false;
    }

    return true;
}

/**
 * @param $username
 * @param int $id
 * @return bool
 */
function updateUsername($username, $id = 1)
{
    global $db;

    try {
        $query = "UPDATE login SET username = :username WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    } catch (Exception $e) {
        return false;
    }

    return true;
}

/**
 * @return bool
 */
function isAuthenticated()
{
    if (!request()->cookies->has('access_token')) {
        return false;
    }

    try {
        JWT::$leeway = 1;
        JWT::decode(
            request()->cookies->get('access_token'),
            getenv('SECRET_KEY'),
            array('HS256')
        );
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function requireAuth()
{
    if (!isAuthenticated()) {
        $accessToken = new Cookie(
            'access_token',
            'Expired',
            time() - (int)getenv('COOKIE_EXP_TIME'),
            '/',
            getenv('COOKIE_DOMAIN')
        );

        redirect('/login.php', ['cookies' => [$accessToken]]);
    }
}

/**
 * @param string $orderBy
 * @return array
 * @throws Exception
 */
function getAllClients($orderBy = 'id')
{
    global $db;

    if (isset($_GET['sort_by']) &&
        ($_GET['sort_by'] === 'name' || $_GET['sort_by'] === 'id')
    ) {
        $orderBy = ucfirst($_GET['sort_by']);
    }

    try {
        $query = "SELECT * FROM clients ORDER BY $orderBy";
        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    } catch (Exception $e) {
        die('Database error, please try reloading the page or a message to jordan@hoovermld.com.');
    }
}