<?php

namespace Phpfox\I18n;

class MessageDomainTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $md = new MessageDomain('', '');

        $md->setMessages([
            'key1'                 => 'message 1',
            'key2'                 => 'message 2',
            'there are {0} photos' => [
                'no photos',
                'there is one photo',
                'there are {0} photos',
            ],
        ]);

        $this->assertEquals('message 1', $md->get('key1'));
        $this->assertEquals('message 2', $md->get('key2'));
        $this->assertEquals(null, $md->get('key3'));
        $this->assertEquals('no photos',
            $md->choice('there are {0} photos', 0));
        $this->assertEquals('there is one photo',
            $md->choice('there are {0} photos', 1));
        $this->assertEquals('there are {0} photos',
            $md->choice('there are {0} photos', 2));
        $this->assertEquals('no photos',
            $md->choice('there are {0} photos', 3));

        $this->assertEquals(null,
            $md->choice('there are {0} photos __', 3));
    }
}
