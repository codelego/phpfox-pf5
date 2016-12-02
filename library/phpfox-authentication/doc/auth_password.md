Write your own password validator.
=========================================

Create validator class

```php
class CustomPassword implement AuthPasswordInterface
{
    
    /**
     * @param string $input   user plain text input string
     * @param array  $params  contain [user_id, source_id, hash, salt, static_salt]
     *
     * @return bool
     */
    public function isValid($input, $params)
    {
        if (!$input) {
            return false;
        }
        
        if(!$params['source_id'] == defined_value){
            return false;
        }

        // TODO: your logic implement here.
        
        return false
    }
    
    ...
}
```

Add custom validator to password chain in module.config.php

```php

return [
    'auth_passwords'=>[
        'custom'=> 'YourNameSpace\CustomPasswordValidator',
    ],
    ...
]; 
```
