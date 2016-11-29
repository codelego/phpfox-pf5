
Request lifecycle

```php
- request executed by index.php
1. Bootstrap
 * invoke config/bootstrap.php
 * instance $config:ConfigContainer
 * instance $serviceContainer:ServiceContainer ($config)
 * invoke: $config::setup
 * Bootstrap Completed.
 
2. Dispatch
 * Create $request: Request from global
 * Create $reponse: Response from global
 * Dipspacher: dispach
 * resulst of dispach send to response.
 * Response output use response strategy.
```



```php
$request  = new Request($uri, $method, $host, $protocol);

$response =  $service->get('app')->run($request);
```

Do not release framework & module with the same namespace.
It's confuse developers from document/guide and difficult to maintenance.

Write your old small custom autoload and test to boot your rule.

My choice: Phpfox Social Networking Scripts
=> Symfony\Component\Cache\CacheInterface

Phpfox\Framework\Cache

Should deliver into 3 level namespace

1. Phpfox\Framework\{$component}
2. Phpfox\App\{$component}
3. Phpfox\Theme\{$component}
4. Phpfox\Framework\

All deliver is provide via Psr4 with a small of class map.

preg_match('Phpfox\Framework\{$extension}')
=> load from delivered content map.
// optimized autoload.


Phpfox\Core\User\
Phpfox\Core\Privacy
Phpfox\App\Blog
Phpfox\App\
Phpfox\Extension