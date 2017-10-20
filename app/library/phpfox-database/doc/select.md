Using SqlSelect
=============================

### Create Select

From Adapter

```php
    $sqlSelect  = $dbAdapter
        ->select('*")
        ->from('phpfox_user')
        ->where('email=?', $email)
```

Constructor

```php
    $sqlSelect= (new SqlSelect($dbAdapter))
        ->select('*')
        ->from('phpfox_user')
        ->where('email=?', $email)
        ->limit(10)
        ->offset(5)
        ->order('email',1)
```

### Execute Query

call `execute()` then return instance of SqlResultInterface.

```php
$sqlResult  = $sqlSelect->execute();
```

### Fetch Result

```php
    $result  = $sqlResult->fetchRow();
    var_export($result);
    
    // print
    ['user_id'=>1, 'username'=>'...', ...];
    
    $result =  $sqlResult->fetchAll()
    var_export($result);
    
    // print
    [
        ['user_id'=>1, 'username'=>'...', ...],
        ['user_id'=>2, 'username'=>'...', ...],
    ]
```
 
### Inject Result To Class
```php
    $result  = $sqlResult->fetchRow();
    var_export($result);
    
    // print
    ['user_id'=>1, 'username'=>'...', ...];
    
    $result =  $sqlResult->fetchAll()
    var_export($result);
    
    // print
    [
        ['user_id'=>1, 'username'=>'...', ...],
        ['user_id'=>2, 'username'=>'...', ...],
    ]
```

### In Deep

Using table prefix short code `:`.

```php
    $sqlSelect->from(':user');
    // absolute equal
    $sqlSelect->from(TABLE_PREFIX. 'user');
```

Using resource prefix short code `@`.
If you are define resource 'user' map to table name 'phpfox_user'.
```php
    $sqlSelect->from('@user');
    // absolute equal
    $sqlSelect->from('phpfox_user');
```


Count total result of query

```php
   $sqlSelect->count()
   // return number of entry match criterial on database.
```
