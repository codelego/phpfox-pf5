Basic Usage
==========================

Get Auth Service

```php
$auth = service('auth');

// get AuthManager
```

Login

```
$params = ['identity'=>'...',
    'credential'=>'..'];
    
$result = $auth->auth($params)
if($result->isValid()){
    
}
$auth->store($result->getIdentity());
```

### Control Flow

1. Auth Manager: init
2. Auth Aware: read 
3. Auth State[]: read 
4. Auth Manager: validate
5. Auth Manager: keep
  
  