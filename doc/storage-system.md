### Support Local
```php
$fileStorage = new LocalFileStorage([
    'basePath'   => '/var/www/html/namnv/',
    'baseUrl'    => PHPFOX_BASE_URL,
    'baseCdnUrl' => 'http:///example.max-cdn.com/'
]);
```

### Support Ftp/Ftps
```php
$fileStorage = new FtpFileStorage([
    'basePath'   => PHPFOX_DIR . 'public',
    'baseUrl'    => PHPFOX_BASE_URL,
    'baseCdnUrl' => 'http:///example.max-cdn.com/',
    'host'       => 'localhost',
    'username'   => 'namnv',
    'password'   => 'namnv123',
    'port'       => 21,
]);
```

### Support Ssh2
required `ssh2` extension.

```php
$fileStorage =new Ssh2FileStorage([
    'basePath'   => '/var/www/html/namnv/',
    'baseUrl'    => PHPFOX_BASE_URL,
    'baseCdnUrl' => 'http:///example.max-cdn.com/',
    'host'       => 'host',
    'username'   => 'your_username',
    'password'   => 'your_password',
    'port'       => 22,
]);
```

```php
$local = PHPFOX_DIR . 'data/temp/temp.txt';
file_put_contents($local, '200 0k' . PHP_EOL . get_class($fileStorage));
$name = (new FilePathGenerator())->generate('doc', '.txt');

$fileStorage->putFile($local, $name);
```