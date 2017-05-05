<?php

include 'init.php';

$email = 'Casey02@Spencer.com';

/** @var \Neutron\User\Model\User $user */
$user = _model('user')
    ->select()
    ->where('email=?', (string)$email)
    ->first();

$userId = $user->getId();

_model('auth_password')
    ->delete()
    ->where('user_id=?', $userId)
    ->execute();

$salt = _random_string(3);
$input = '123456';
$hashed = (new \Neutron\User\Auth\Pf5PasswordCompatible())->createHash($input,
    $salt);

$password = new \Neutron\User\Model\AuthPassword([
    'user_id'     => $userId,
    'created_at'  => date('Y-m-d H:i:s'),
    'salt'        => $salt,
    'static_salt' => '',
    'hashed'      => $hashed,
    'source_id'   => 'pf5',
]);

$password->save();