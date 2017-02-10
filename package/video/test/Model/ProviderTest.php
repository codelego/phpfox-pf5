<?php

namespace Neutron\Video\Model;


class ProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Provider([
            'provider_id'    => '[youtube]',
            'name'           => '[example name]',
            'form_name'      => '[Example Form Name]',
            'description'    => '[Example Description]',
            'is_active'      => 1,
            'params'         => '[]',
            'provider_class' => '[Neutron\Video\Provider\YoutubeProvider]',
        ]);

        $this->assertSame('video_provider', $obj->getModelId());
        $this->assertSame('[youtube]', $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[Example Form Name]', $obj->getFormName());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame('[Neutron\Video\Provider\YoutubeProvider]', $obj->getProviderClass());
        $this->assertSame('[example name]', $obj->getTitle());
        $this->assertSame('[Example Description]',
            $obj->getDescription());
    }

    public function testBase2()
    {
        $obj = new Provider([
            'provider_id'    => '[youtube]',
            'name'           => '[example name]',
            'form_name'      => '[Example Form Name]',
            'description'    => '[Example Description]',
            'is_active'      => 1,
            'params'         => '[]',
            'provider_class' => '[Neutron\Video\Provider\YoutubeProvider]',
        ]);

        $obj->setId('[youtube]');
        $obj->setName('[example name]');
        $obj->setDescription('[Example Description]');
        $obj->setFormName('[Example Form Name]');
        $obj->setProviderClass('[Neutron\Video\Provider\YoutubeProvider]');
        $obj->setActive('1');
        $obj->setParams('[]');

        $this->assertSame('video_provider', $obj->getModelId());
        $this->assertSame('[youtube]', $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[Example Form Name]', $obj->getFormName());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame('[Neutron\Video\Provider\YoutubeProvider]', $obj->getProviderClass());
        $this->assertSame('[example name]', $obj->getTitle());
        $this->assertSame('[Example Description]',
            $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new Provider([
            'provider_id'    => '[youtube]',
            'name'           => '[example name]',
            'form_name'      => '[Example Form Name]',
            'description'    => '[Example Description]',
            'is_active'      => 1,
            'params'         => '[]',
            'provider_class' => '[Neutron\Video\Provider\YoutubeProvider]',
        ]);

        $obj->save();

        /** @var Provider $obj */
        $obj = \Phpfox::with('video_provider')
            ->select()
            ->where('provider_id=?', '[youtube]')
            ->first();

        $this->assertNotNull($obj);

        $this->assertSame('video_provider', $obj->getModelId());
        $this->assertSame('[youtube]', $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[Example Form Name]', $obj->getFormName());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame('[Neutron\Video\Provider\YoutubeProvider]', $obj->getProviderClass());
        $this->assertSame('[example name]', $obj->getTitle());
        $this->assertSame('[Example Description]',
            $obj->getDescription());

    }

    public static function tearDownAfterClass()
    {
        \Phpfox::get('db')->delete(':video_provider')
            ->where('provider_id=?', '[youtube]')
            ->execute();
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::get('db')->delete(':video_provider')
            ->where('provider_id=?', '[youtube]')
            ->execute();
    }
}
