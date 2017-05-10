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
                'value'  => _yesno($value = version_compare(PHP_VERSION, '5.6', '>='), true, true),
                'status' => $value ? '' : 'error',
                'note'   => 'require php 5.6+',
            ],
            [
                'label'  => 'Allow Url Open',
                'value'  => _yesno($value = ini_get('allow_url_fopen'), true, true),
                'status' => $value ? '' : 'error',
                'note'   => 'allow fetch url url content',
            ],
            [
                'label'  => 'Exif',
                'value'  => _yesno(function_exists('exif_read_data'), true, true),
                'status' => $value ? '' : 'error',
                'note'   => 'require php 5.6+',
            ],
            [
                'label'  => 'Memory Limit',
                'value'  => ini_get('memory_limit'),
                'status' => $value ? '' : 'error',
                'note'   => 'require 64MB+',
            ],
            [
                'label'  => 'Disable magic_gpc_quotes',
                'value'  => _yesno(!($value = ini_get('magic_gpc_quotes')), true, true),
                'status' => $value ? 'error' : '',
                'note'   => '',
            ],
            [
                'label'  => 'Disable session auto start',
                'value'  => _yesno(!($value = ini_get('session.auto_start')), true, true),
                'status' => $value ? 'error' : '',
                'note'   => '',
            ],
            [
                'label'  => 'Support CURL extension',
                'value'  => _yesno($value = extension_loaded('curl'), true, true),
                'status' => $value ? '' : 'error',
                'note'   => '',
            ],
            [
                'label'  => 'Support XML extension',
                'value'  => _yesno($value = extension_loaded('libxml'), true, true),
                'status' => !$value ? 'error' : '',
                'note'   => '',
            ],
            [
                'label'  => 'Support ImageClick',
                'value'  => _yesno($value = extension_loaded('imagick'), true, true),
                'status' => $value ? '' : 'warning',
                'note'   => 'php imagick is better than gd library',
            ],
            [
                'label'  => 'Support Apcu',
                'value'  => _yesno($value = extension_loaded('apcu'), true, true),
                'status' => $value ? '' : 'warning',
                'note'   => '',
            ],
            [
                'label'  => 'Support MultiByte Strings',
                'value'  => _yesno($value = extension_loaded('mbstring'), true, true),
                'status' => $value ? '' : 'warning',
                'note'   => 'require mbstring extension',
            ],
            [
                'label'  => 'Support ZipArchive',
                'value'  => _yesno($value = class_exists('ZipArchive'), true, true),
                'status' => $value ? '' : 'warning',
                'note'   => 'require ZipArchive extension',
            ],
            [
                'label'  => 'Runtime Configuration',
                'value'  => _yesno($value = function_exists('ini_set'), true, true),
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