<?php

namespace Phpfox\Package;


class PackageLoaderTest extends \PHPUnit_Framework_TestCase
{

    public function testMethodGetLogParameters()
    {
        $parameter = _get('package.loader')
            ->getLogParameter('main.log');

        $this->assertNotEmpty($parameter->get('loggers'));

    }

    public function testMethodGetCacheParameters()
    {
        $parameter = _get('package.loader')
            ->getCacheParameter('shared.cache');

        $this->assertNotEmpty($parameter->all());
    }

    public function testMethodGetSessionParameters()
    {
        $parameter = _get('package.loader')
            ->getSessionParameter('session');

        $this->assertNotEmpty($parameter->all());
    }

    public function testMethodGetMailerParameters()
    {
        $parameter = _get('package.loader')
            ->getMailParameter('shared.mailer');

        $this->assertNotEmpty($parameter->all());
    }


}
