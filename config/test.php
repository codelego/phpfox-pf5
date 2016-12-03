<?php

/**
 * For to development mode.
 */
define('PHPFOX_ENV', 'development');

/**
 * Running PhpUnit
 */
define('PHPFOX_UNIT_TEST', true);

include __DIR__ . '/bootstrap.php';


\Phpfox::get('commands')->execute('update-package-info', [
    'id'        => 'neutron-theme-galaxy',
    'type'      => 'theme',
    'prefix'    => 'galaxy@',
    'namespace' => 'Neutron\ThemeGalaxy',
]);

\Phpfox::get('commands')->execute('update-package-info', [
    'id'        => 'neutron-core',
    'type'      => 'app',
    'prefix'    => 'core',
    'namespace' => 'Neutron\Core',
]);