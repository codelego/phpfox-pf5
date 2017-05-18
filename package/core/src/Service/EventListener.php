<?php

namespace Neutron\Core\Service;

use Phpfox\Support\Event;
use Phpfox\Support\EventResponse;

class EventListener
{
    public function onBootstrap()
    {
        _get('template')
            ->preferThemes(_get('core.themes')
                ->preferThemes());
    }

    /**
     * @param Event         $event
     * @param EventResponse $response
     */
    public function onRebuildFiles(Event $event, EventResponse $response)
    {
        $response->push([
            PHPFOX_STATIC_DIR . 'packages/core/sass/test.scss' => 'core-test.css',
        ]);
    }

    /**
     * flush all cache settings
     */
    public function onSettingsChanged()
    {
        _get('core.setting')->updateSettingRevision();
        _get('super.cache')->flush();
        _get('shared.cache')->flush();
    }

    public function onSystemHealthCheck(Event $event, EventResponse $response)
    {
        $response->push([
            'label'  => 'PHP Version 5.6+',
            'value'  => _yesno($value = version_compare(PHP_VERSION, '5.6', '>='), true, true),
            'status' => $value ? '' : 'error',
            'note'   => 'require php 5.6+',
        ]);

        $response->push([
            'label'  => 'Allow Url Open',
            'value'  => _yesno($value = ini_get('allow_url_fopen'), true, true),
            'status' => $value ? '' : 'error',
            'note'   => 'allow fetch url url content',
        ]);
        $response->push([
            'label'  => 'Exif',
            'value'  => _yesno(function_exists('exif_read_data'), true, true),
            'status' => $value ? '' : 'error',
            'note'   => 'require php 5.6+',
        ]);
        $response->push([
            'label'  => 'Memory Limit',
            'value'  => ini_get('memory_limit'),
            'status' => $value ? '' : 'error',
            'note'   => 'require 64MB+',
        ]);
        $response->push([
            'label'  => 'Disable magic_gpc_quotes',
            'value'  => _yesno(!($value = ini_get('magic_gpc_quotes')), true, true),
            'status' => $value ? 'error' : '',
            'note'   => '',
        ]);
        $response->push([
            'label'  => 'Disable session auto start',
            'value'  => _yesno(!($value = ini_get('session.auto_start')), true, true),
            'status' => $value ? 'error' : '',
            'note'   => '',
        ]);
        $response->push([
            'label'  => 'Support CURL extension',
            'value'  => _yesno($value = extension_loaded('curl'), true, true),
            'status' => $value ? '' : 'error',
            'note'   => '',
        ]);
        $response->push([
            'label'  => 'Support XML extension',
            'value'  => _yesno($value = extension_loaded('libxml'), true, true),
            'status' => !$value ? 'error' : '',
            'note'   => '',
        ]);
        $response->push([
            'label'  => 'Support ImageClick',
            'value'  => _yesno($value = extension_loaded('imagick'), true, true),
            'status' => $value ? '' : 'warning',
            'note'   => 'php imagick is better than gd library',
        ]);
        $response->push([
            'label'  => 'Support Apcu',
            'value'  => _yesno($value = extension_loaded('apcu'), true, true),
            'status' => $value ? '' : 'warning',
            'note'   => '',
        ]);
        $response->push([
            'label'  => 'Support MultiByte Strings',
            'value'  => _yesno($value = extension_loaded('mbstring'), true, true),
            'status' => $value ? '' : 'warning',
            'note'   => 'require mbstring extension',
        ]);
        $response->push([
            'label'  => 'Support ZipArchive',
            'value'  => _yesno($value = class_exists('ZipArchive'), true, true),
            'status' => $value ? '' : 'warning',
            'note'   => 'require ZipArchive extension',
        ]);
        $response->push([
            'label'  => 'Runtime Configuration',
            'value'  => _yesno($value = function_exists('ini_set'), true, true),
            'status' => $value ? '' : 'warning',
            'note'   => '',
        ]);
    }

    public function __call($name, $arguments)
    {
        // do nothing
    }
}