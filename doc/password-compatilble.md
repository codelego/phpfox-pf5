```php
if( null === $this->_authAdapter ) {
      $db = Engine_Db_Table::getDefaultAdapter();
      $tablePrefix = Engine_Db_Table::getTablePrefix();
      $salt = Engine_Api::_()->getApi('settings', 'core')->getSetting('core.secret', 'staticSalt');

      $this->_authAdapter = new Zend_Auth_Adapter_DbTable(
        $db,
        Engine_Api::_()->getItemTable('user')->info('name'),
        'user_id',
        'password',
        "MD5(CONCAT('".$salt."', ?, salt))"
      );
    }
```