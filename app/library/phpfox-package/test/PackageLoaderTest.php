<?php

namespace Phpfox\Package;


class PackageLoaderTest extends \PHPUnit_Framework_TestCase
{

    public function testMethodGetLogParameters()
    {
        $parameter = \Phpfox::get('package.loader')
            ->getLogParameter('main.log');

        $this->assertNotEmpty($parameter->get('loggers'));

    }

    public function testMethodGetCacheParameters()
    {
        $parameter = \Phpfox::get('package.loader')
            ->getCacheParameter('shared.cache');

        $this->assertNotEmpty($parameter->all());
    }

    public function testMethodGetSessionParameters()
    {
        $parameter = \Phpfox::get('package.loader')
            ->getSessionParameter('session');

        $this->assertNotEmpty($parameter->all());
    }

    public function testMethodGetMailerParameters()
    {
        $parameter = \Phpfox::get('package.loader')
            ->getMailParameter('shared.mailer');

        $this->assertNotEmpty($parameter->all());
    }


}
