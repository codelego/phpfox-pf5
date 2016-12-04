<?php

require_once '../config/bootstrap.php';


$message = Phpfox::get('mailer')->createMessage('user_welcome', [
    'name'  => 'nam nguyen',
    'email' => 'nam.ngvan@gmail.com',
]);

$message->setFrom('nam.ngvan@gmail.com', 'nam nguyen');

$message->addTo('nam.ngvan@gmail.com', 'nam nguyen');

Phpfox::get('mailer')->send(null, $message);