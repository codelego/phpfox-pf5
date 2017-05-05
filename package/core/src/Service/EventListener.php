<?php

namespace Neutron\Core\Service;

use Phpfox\Event\EventListenerInterface;

class EventListener implements EventListenerInterface
{
    public function onBootstrap()
    {
        _service('template')
            ->preferThemes(_service('core.themes')->preferThemes());

        return [];
    }

    public function onRebuildFiles()
    {
        return [
            PHPFOX_STATIC_DIR
            . 'packages/core/sass/test.scss' => 'core-test.css',
        ];
    }

    public function onSystemHealthCheck()
    {
        return [
            [
                'label'  => 'PHP Version 5.6+',
                'value'  => _yesno(
                    $value = version_compare(PHP_VERSION, '5.6', '>=')),
                'status' => $value ? '' : 'error',
                'note'   => 'require php 5.6+',
            ],
            [
                'label'  => 'Allow Url Open',
                'value'  => _yesno($value = ini_get('allow_url_fopen')),
                'status' => $value ? '' : 'error',
                'note'   => 'allow fetch url url content',
            ],
            [
                'label'  => 'Memory Limit',
                'value'  => _yesno(ini_get('memory_limit') >= '64M'),
                'status' => $value ? '' : 'error',
                'note'   => ini_get('memory_limit'),
            ],
            [
                'label'  => 'Disable magic_gpc_quotes',
                'value'  => _yesno(($value = ini_get('magic_gpc_quotes'))
                    == false),
                'status' => $value ? 'error' : '',
                'note'   => '',
            ],
            [
                'label'  => 'Disable session auto start',
                'value'  => _yesno(($value = ini_get('session.auto_start'))
                    == false),
                'status' => $value ? 'error' : '',
                'note'   => '',
            ],
            [
                'label'  => 'Support CURL extension',
                'value'  => _yesno(extension_loaded('curl')),
                'status' => $value ? '' : 'error',
                'note'   => '',
            ],
            [
                'label'  => 'Support XML extension',
                'value'  => _yesno(($value = extension_loaded('libxml'))
                    == false),
                'status' => $value ? 'error' : '',
                'note'   => '',
            ],
            [
                'label'  => 'Support ImageClick',
                'value'  => _yesno($value = extension_loaded('imagick')),
                'status' => $value ? '' : 'warning',
                'note'   => 'php imagick is better than gd library',
            ],
            [
                'label'  => 'Support Apcu',
                'value'  => _yesno($value = extension_loaded('apcu')),
                'status' => $value ? '' : 'warning',
                'note'   => '',
            ],
            [
                'label'  => 'Support MultiByte Strings',
                'value'  => _yesno($value = extension_loaded('mbstring')),
                'status' => $value ? '' : 'warning',
                'note'   => 'require mbstring extension',
            ],
            [
                'label'  => 'Support ZipArchive',
                'value'  => _yesno($value = class_exists('ZipArchive')),
                'status' => $value ? '' : 'warning',
                'note'   => 'require ZipArchive extension',
            ],
            [
                'label'  => 'Runtime Configuration',
                'value'  => _yesno($value = function_exists('ini_set')),
                'status' => $value ? '' : 'warning',
                'note'   => '',
            ],

        ];
    }

    public function __call($name, $arguments)
    {
        // do nothing
    }
}