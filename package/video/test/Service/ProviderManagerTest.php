<?php

namespace Neutron\Video\Service;

use Neutron\Video\Model\VideoProvider;
use Neutron\Video\Provider\FacebookProvider;
use Neutron\Video\Provider\UploadProvider;
use Neutron\Video\Provider\VimeoProvider;
use Neutron\Video\Provider\YoutubeProvider;

class ProviderManagerTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        \Phpfox::db()->delete(':video_provider')->execute();

        \Phpfox::db()->insert(':video_provider', [
            'provider_id'    => 'facebook',
            'name'           => 'Facebook',
            'form_name'      => '[example form name]',
            'description'    => '[example description]',
            'is_active'      => 1,
            'params'         => '',
            'provider_class' => FacebookProvider::class,
        ])->execute();
        \Phpfox::db()->insert(':video_provider', [
            'provider_id'    => 'vimeo',
            'name'           => 'Vimeo',
            'form_name'      => '[example form name]',
            'description'    => '[example description]',
            'is_active'      => 1,
            'params'         => '',
            'provider_class' => VimeoProvider::class,
        ])->execute();
        \Phpfox::db()->insert(':video_provider', [
            'provider_id'    => 'upload',
            'name'           => 'Upload',
            'form_name'      => '[example form name]',
            'description'    => '[example description]',
            'is_active'      => 1,
            'params'         => '',
            'provider_class' => UploadProvider::class,
        ])->execute();
        \Phpfox::db()->insert(':video_provider', [
            'provider_id'    => 'youtube',
            'name'           => 'YouTube',
            'form_name'      => '[example form name]',
            'description'    => '[example description]',
            'is_active'      => 1,
            'params'         => '',
            'provider_class' => YoutubeProvider::class,
        ])->execute();
    }

    public function testAll()
    {
        $mn = new ProviderManager();
        $all = $mn->getClasses();

        $this->assertArrayHasKey('youtube', $all);
        $this->assertArrayHasKey('facebook', $all);
        $this->assertArrayHasKey('vimeo', $all);
        $this->assertArrayHasKey('upload', $all);
        $this->assertArrayNotHasKey('no-key', $all);

        $this->assertTrue($mn->has('youtube'));
        $this->assertTrue($mn->has('facebook'));
        $this->assertTrue($mn->has('vimeo'));
        $this->assertTrue($mn->has('upload'));
        $this->assertFalse($mn->has('none'));

    }

    /**
     * @expectedException  \InvalidArgumentException
     */
    public function testBuildFailure()
    {
        $mn = new ProviderManager();

        $mn->build('none');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBuildFailureClassNotFound()
    {
        $obj = new VideoProvider([
            'provider_id'    => 'example',
            'name'           => 'Example',
            'form_name'      => '[example form name]',
            'description'    => '[example description]',
            'is_active'      => 1,
            'params'         => '',
            'provider_class' => 'Neutron\Video\ExampleVideoProvider',
        ]);
        $obj->save();

        $mn = new ProviderManager();

        $obj->delete();

        $mn->build('example');

    }

    public function testSet()
    {
        $mn = new ProviderManager();
        $mn->set('none', new FacebookProvider());
        $this->assertTrue($mn->has('none'));
    }

    public function testGet()
    {
        $mn = new ProviderManager();

        $this->assertTrue($mn->get('youtube') instanceof YoutubeProvider);
        $this->assertTrue($mn->get('facebook') instanceof FacebookProvider);
        $this->assertTrue($mn->get('vimeo') instanceof VimeoProvider);
        $this->assertTrue($mn->get('upload') instanceof UploadProvider);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Oops! video provider
     */
    public function testGetException()
    {
        $mn = new ProviderManager();

        $mn->get('no-key');
    }
}
