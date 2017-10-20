<?php

namespace Neutron\Video\Model;

class VideoProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new VideoProvider(['provider_id'         => 'facebook',
                                  'form_settings_class' => 'Neutron\\Video\\Form\\Admin\\EditFacebookSettings',
                                  'is_active'           => 1,
                                  'ordering'            => 4,
                                  'package_id'          => 'core',
                                  'title'               => 'Facebook',
                                  'description'         => 'Fetch video from facebook.com',
                                  'dependency'          => '[]',
        ]);

        $this->assertSame('video_provider', $obj->getModelId());
        $this->assertSame('facebook', $obj->getProviderId());
        $this->assertSame('Neutron\Video\Form\Admin\EditFacebookSettings', $obj->getFormSettingsClass());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(4, $obj->getOrdering());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Facebook', $obj->getTitle());
        $this->assertSame('Fetch video from facebook.com', $obj->getDescription());
        $this->assertSame('[]', $obj->getDependency());
    }

    public function testParameters()
    {
        $obj = new VideoProvider();

        // set data
        $obj->setProviderId('facebook');
        $obj->setFormSettingsClass('Neutron\Video\Form\Admin\EditFacebookSettings');
        $obj->setActive(1);
        $obj->setOrdering(4);
        $obj->setPackageId('core');
        $obj->setTitle('Facebook');
        $obj->setDescription('Fetch video from facebook.com');
        $obj->setDependency('[]');
        // assert same data
        $this->assertSame('video_provider', $obj->getModelId());
        $this->assertSame('facebook', $obj->getProviderId());
        $this->assertSame('Neutron\Video\Form\Admin\EditFacebookSettings', $obj->getFormSettingsClass());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(4, $obj->getOrdering());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Facebook', $obj->getTitle());
        $this->assertSame('Fetch video from facebook.com', $obj->getDescription());
        $this->assertSame('[]', $obj->getDependency());
    }

    public function testSave()
    {
        $obj = new VideoProvider(['provider_id'         => 'facebook',
                                  'form_settings_class' => 'Neutron\\Video\\Form\\Admin\\EditFacebookSettings',
                                  'is_active'           => 1,
                                  'ordering'            => 4,
                                  'package_id'          => 'core',
                                  'title'               => 'Facebook',
                                  'description'         => 'Fetch video from facebook.com',
                                  'dependency'          => '[]',
        ]);

        $obj->save();

        /** @var VideoProvider $obj */
        $obj = \Phpfox::model('video_provider')
            ->select()->where('provider_id=?', 'facebook')->first();

        $this->assertSame('video_provider', $obj->getModelId());
        $this->assertSame('facebook', $obj->getProviderId());
        $this->assertSame('Neutron\Video\Form\Admin\EditFacebookSettings', $obj->getFormSettingsClass());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(4, $obj->getOrdering());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Facebook', $obj->getTitle());
        $this->assertSame('Fetch video from facebook.com', $obj->getDescription());
        $this->assertSame('[]', $obj->getDependency());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('video_provider')
            ->delete()->where('provider_id=?', 'facebook')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('video_provider')
            ->delete()->where('provider_id=?', 'facebook')->execute();
    }
}