<?php

include __DIR__ . '/../config/bootstrap.php';


if (true) {
    _println('Generate routes map ...');
    $configs = Phpfox::get('package.loader')
        ->loadRouterConfigs();

    $contents = '<?php namespace PHPSTORM_META { override(\_url(0), map([';

    $routes = array_keys($configs['routes']);
    ksort($routes);

    $array = [];
    foreach ($routes as $route) {
        $array[] = sprintf('\'%s\'=>AsString::class', $route);
    }

    foreach (['profile'] as $route) {
        $array[] = sprintf('\'%s\'=>AsString::class', $route);
    }

    $contents .= implode(', ' . PHP_EOL, $array) . ']));}';

    file_put_contents('.router.phpstorm.meta.php', $contents);

    _println('Done {0} routes', [count($array)]);
}


if (true) {

    _println('Generate model map...');

    $configs = Phpfox::get('models.provider')->all();

    ksort($configs);

    $array = [];

    foreach ($configs as $key => $value) {
        $array[$key] = sprintf('\'%s\'=>\\%s::class', $key, $value[2]);
    }

    $contents
        = '<?php

namespace PHPSTORM_META {

    override(\Phpfox::findById(0), map([
    ' . implode(',' . PHP_EOL, $array) . ']));
}';

    file_put_contents('.models.phpstorm.meta.php', $contents);

    _println('Done {0} routes', [count($array)]);
}


if (true) {

    _println('Generate services map...');

    $configs = Phpfox::mvcConfig()->get('services');

    $array = [];

    ksort($configs);

    foreach ($configs as $key => $value) {
        if (is_string($value)) {
            $array[$key] = sprintf('\'%s\'=>\\%s::class', $key, $value);
        } else {
            if (is_array($value) and !empty($value[1])) {
                $array[$key] = sprintf('\'%s\'=>\\%s::class', $key, $value[1]);
            }
        }
    }
    $contents
        = '<?php

namespace PHPSTORM_META {

    override(\Phpfox::get(0), map([
    ' . implode(',' . PHP_EOL, $array) . ']));
    
    override(\Phpfox::build(0), map([
    ' . implode(',' . PHP_EOL, $array) . ']));
}';

    file_put_contents('.services.phpstorm.meta.php', $contents);

    _println('Done {0} services', [count($array)]);
}

if (true) {

    _println('Generate events map...');

    $configs = Phpfox::get('mvc.events.loader')->load();

    $events = array_keys($configs);

    ksort($events);

    $array = [];

    foreach ($events as $value) {
        $array[$key] = sprintf('\'%s\'=>\\Phpfox\\Event\\Response::class',
            $value);
    }

    $contents
        = '<?php

namespace PHPSTORM_META {

    override(\Phpfox::emit(0), map([
    ' . implode(',' . PHP_EOL, $array) . ']));
}';

    file_put_contents('.events.phpstorm.meta.php', $contents);

    _println('Done {0} events', [count($array)]);
}