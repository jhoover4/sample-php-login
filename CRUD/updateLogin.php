<?php
require_once __DIR__ . '/../inc/bootstrap.php';

$username = request()->get('username');
$curPassword = request()->get('current_password');
$newPassword = request()->get('new_password');
$confirmNewPassword = request()->get('confirm_new_password');

if ($newPassword !== $confirmNewPassword) {
    $session->getFlashBag()->add('error', 'New passwords do not match');
    redirect('/update.php');
}

try {
    $loginInfo = getLogin()[0];
} catch (Exception $e) {
    $session->getFlashBag()->add('error', 'Error finding user. Please re-enter information.');
    redirect('/update.php');
}


// Would be done differently in production, but we need a simple check for our initial password.
if ($curPassword !== $loginInfo['password'] &&
    !password_verify($curPassword, $loginInfo['password'])) {

    var_dump($curPassword);
    var_dump(password_verify($curPassword, $loginInfo['password']));
    $session->getFlashBag()->add('error', 'Password does not match existing login.');
    redirect('/update.php');
}

updatePassword(password_hash($newPassword, PASSWORD_DEFAULT));
updateUsername($username);

$session->getFlashBag()->add('success', 'User information was updated.');
redirect('/');

