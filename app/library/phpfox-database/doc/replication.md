Database Replication
===================================

### What's Database Replication.

> Almost application will run with single one database server. 
> If you have a huge of data set. You might need more database server.
> There are some approach for this domain, the simplest is "Add more database servers".
> 
> When using replication, the app will separate read/write task from another database.

Example

```php
$dbOptions = [
    'driver'   => 'mysqli', // mysqli
    'host'     => '192.168.1.12', // required
    'username' => '....', // required
    'password' => '...', // required
    'port'     => 3306, // optional,
    'socket'   => null, // optional,
    'charet'   => 'utf8', // optional, default = utf8,
    'masters'=> [192.168.1.12,192.168.1.13,..],
    'slaves'=> [192.168.1.12,192.168.1.13...],
]
```

+ `masters` describes list of server addresses that data will write to.
+ `slaves`  describes list of server addresses that data will read from.