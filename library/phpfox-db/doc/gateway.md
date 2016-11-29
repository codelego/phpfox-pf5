Database Table Gateway
================================
> Mixing SQL in application logic can cause several problems. Many developers aren't comfortable with SQL, and many who are comfortable may not write it well. Database administrators need to be able to find SQL easily so they can figure out how to tune and evolve the database.
>
> A Table Data Gateway holds all the SQL for accessing a single table or view: selects, inserts, updates, and deletes. Other code calls its methods for all interaction with the database.

![Pattern]:(http://martinfowler.com/eaaCatalog/dbgateTable.gif)


### Configuration

In module.config.php

```php
return [
    'tables'=>[
        'user' => [
               `User\Model\UserTable`,
               'User\Model\User',
               ':user'
        ],
    ]
];
```

In service

```php
$user = $serviceManager->get('tables')
        ->get('user')
        ->findById(1);
var_export(user);
```
