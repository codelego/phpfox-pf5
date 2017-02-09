<?php

namespace Neutron\Video\Model;


class VideoProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testParameters()
    {
        $obj = new VideoProvider();

        $this->assertEquals('video_provider', $obj->getModelId());

        $obj->setName('[example provider name]');
        $this->assertEquals('[example provider name]', $obj->getName());
        $this->assertEquals('[example provider name]', $obj->getTitle());

        $obj->setName(null);
        $this->assertEquals('', $obj->getName());
        $this->assertEquals('', $obj->getTitle());

        $obj->setTitle('[example provider name]');
        $this->assertEquals('[example provider name]', $obj->getName());
        $this->assertEquals('[example provider name]', $obj->getTitle());

        $obj->setDescription('[example provider description]');
        $this->assertEquals('[example provider description]',
            $obj->getDescription());
        $this->assertEquals('[example provider description]',
            $obj->getDescription());

        $obj->setDescription(null);
        $this->assertEquals('', $obj->getDescription());

        $obj->setTitle(null);
        $this->assertEquals('', $obj->getName());
        $this->assertEquals('', $obj->getTitle());

        $obj->setActive(true);
        $this->assertEquals('1', $obj->isActive());
        $obj->setActive(false);
        $this->assertEquals(0, $obj->isActive());
        $obj->setActive(null);
        $this->assertEquals(0, $obj->isActive());

        $obj->setFormName('abc\def');
        $this->assertEquals('abc\def', $obj->getFormName());
        $obj->setFormName(null);
        $this->assertEquals('', $obj->getFormName());

        $obj->setProviderClass('[provider class name]');
        $this->assertEquals('[provider class name]', $obj->getProviderClass());
        $obj->setProviderClass(null);
        $this->assertEquals('', $obj->getProviderClass());
    }

    public function testSave()
    {
        $obj = new VideoProvider([
            'provider_id' => 'test',
            'name'        => '[example provider name]',
            'description' => '[example description]',
            'is_active'   => 1,
            'params'      => '[]',
        ]);

        $obj->save();

        /** @var VideoProvider $entry */
        $entry = \Phpfox::with('video_provider')
            ->select()
            ->where('provider_id=?', $obj->getId())
            ->setPrototype(VideoProvider::class)
            ->first();

        $this->assertEquals('[example provider name]', $entry->getTitle());
        $this->assertEquals('[example provider name]', $entry->getName());
        $this->assertEquals('1', $entry->isActive());
        $this->assertEquals('[example description]', $entry->getDescription());

        $entry->delete();

        /** @var VideoProvider $entry */
        $entry = \Phpfox::with('video_provider')
            ->select()
            ->where('provider_id=?', $obj->getId())
            ->setPrototype(VideoProvider::class)
            ->first();

        $this->assertEmpty($entry);
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::get('db')
            ->delete(':video_provider')
            ->where('provider_id=?', 'test')
            ->execute();
    }
}
