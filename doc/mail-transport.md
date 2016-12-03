```php
$transportConfigs =[
    'host'     => 'smtp.sendgrid.net',
    'port'     => 587,
    'username' => 'sendgrid-username',
    'password' => 'sendgrid-password',
    'auth'     => true,
    'secure'   => 'tls',
];

$mesasge = new Message([
   'fromAddress' => 'nam.ngvan@gmail.com',
   'fromName'    => 'nam nguyen',
   'subject'     => 'test subject',
   'body'        => 'test body',
   'altBody'     => 'test alt body',
]);
$mesasge->addTo('namnv@younetco.com', 'Nam Nguyen');
$transport = new SmtpTransport($transportConfigs);
$transport->send($mesasge);

// don't forget.
$transport->release();
```