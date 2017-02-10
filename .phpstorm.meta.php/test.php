<?php

include '../config/bootstrap.php';

$users = Phpfox::with('auth_password')
    ->select()
    ->all();

foreach($users as $user){
    $user->setCreatedAt(date('Y-m-d H:i:s', (int) $user->__get('created')));
    $user->save();
}