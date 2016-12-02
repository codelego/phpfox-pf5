Service Manager
=================================================================

>
> Framework define interface & control flow of big picture.
>
> Class & Behavior working together using interface construct.
>

```php
interface Auth: 
    + login()
    + getId()
    + getUser()
    + logout()
```

```php
interface UserService: 
    + findById: User
    + findByEmail: User
    + findByPhone: User
    + findByUsername : User
    + get($params):  User[]
```

origin
[
    'factories'=>[
        'user.auth'=> 'Phpfox_User_Auth'
        'user.process'=> 'YouNet_User_Auth'
    ]
]

=> service overwrite.
[
    'factories'=>[
        'user.auth'=> 'YouNet_User_Auth',
    ]
]


Container Inter

```php
ServiceContainer:
    + get($id)
    + set($id)
    + build($id)
```

service($id): get service instance from container.

phpfox::getService('user.auth');

Phpfox_Auth::instance() 

```
+ module confirguration:

namespace YouNet\Store;

return [
    'router.routes'=>[
        ....
    ],
    'events'=>[
        ....
    ],
    'controllers'=>[
    
    ],
    'factories'=> [
        'product'=>ProductService:class,
        ....
    ]
]
```


