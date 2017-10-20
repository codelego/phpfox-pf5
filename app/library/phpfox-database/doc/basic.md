## Connect Database

Set Adapter Options
```php
$dbOptions = [
    'driver'   => 'mysqli', // mysqli
    'host'     => '127.0.0.1', // required
    'username' => '....', // required
    'password' => '...', // required
    'port'     => 3306, // optional,
    'socket'   => null, // optional,
    'charet'   => 'utf8', // optional, default = utf8,
];
```

Call Instance Directly

```php
$dbAdapter = new MysqlAdapter($dbOptions);
```

Using AdapterFactory

```php
$dbAdapter =  AdapterFactory::factory($dbOptions)
```