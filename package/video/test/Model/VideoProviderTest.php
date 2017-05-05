<?php

namespace Neutron\Video\Model;

class VideoProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new VideoProvider([
            'provider_id'    => 'vimeo',
            'name'           => 'Vimeo',
            'form_name'      => '',
            'description'    => '',
            'is_active'      => 1,
            'params'         => '',
            'provider_class' => 'Neutron\\Video\\Provider\\VimeoProvider',
        ]);

        $this->assertSame('video_provider', $obj->getModelId());
        $this->assertSame('vimeo', $obj->getId());
        $this->assertSame('Vimeo', $obj->getName());
        $this->assertSame('', $obj->getFormName());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getParams());
        $this->assertSame('Neutron\Video\Provider\VimeoProvider',
            $obj->getProviderClass());
    }

    public function testParameters()
    {
        $obj = new VideoProvider();

        // set data
        $obj->setId('vimeo');
        $obj->setName('Vimeo');
        $obj->setFormName('');
        $obj->setDescription('');
        $obj->setActive(1);
        $obj->setParams('');
        $obj->setProviderClass('Neutron\Video\Provider\VimeoProvider');

        // assert same data
        $this->assertSame('video_provider', $obj->getModelId());
        $this->assertSame('vimeo', $obj->getId());
        $this->assertSame('Vimeo', $obj->getName());
        $this->assertSame('', $obj->getFormName());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getParams());
        $this->assertSame('Neutron\Video\Provider\VimeoProvider',
            $obj->getProviderClass());
    }

    public function testSave()
    {
        $obj = new VideoProvider([
            'provider_id'    => 'vimeo',
            'name'           => 'Vimeo',
            'form_name'      => '',
            'description'    => '',
            'is_active'      => 1,
            'params'         => '',
            'provider_class' => 'Neutron\\Video\\Provider\\VimeoProvider',
        ]);

        $obj->save();

        /** @var VideoProvider $obj */
        $obj = _with('video_provider')
            ->select()->where('provider_id=?', 'vimeo')->first();

        $this->assertSame('video_provider', $obj->getModelId());
        $this->assertSame('vimeo', $obj->getId());
        $this->assertSame('Vimeo', $obj->getName());
        $this->assertSame('', $obj->getFormName());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getParams());
        $this->assertSame('Neutron\Video\Provider\VimeoProvider',
            $obj->getProviderClass());
    }

    public static function setUpBeforeClass()
    {
        _with('video_provider')
            ->delete()->where('provider_id=?', 'vimeo')->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('video_provider')
            ->delete()->where('provider_id=?', 'vimeo')->execute();
    }
}