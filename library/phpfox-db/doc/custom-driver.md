Write Your Own Driver
====================================

Edit module.config.php

```php
    return [
        'db_drivers'=>[
            'mysqli'=> 'Phpfox\Db\MysqliAdapter',
        ]
    ];
```

### Implementation
- Adapter class must implement Phpfox\Db\AdapterInterface. See `MysqliAdapter`.
- Adapter result class must implement Phpfox\Db\SqlResultInterface. 
  * `execute` failure: must throw exception to break control follow instead of returning false/null.
  * `execute` success: must return See `SqlResultInterface`.
- Your Adapter should support replication mechanist, but the feature is not required.
- Your options should follow default options see `$dbOptions`

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