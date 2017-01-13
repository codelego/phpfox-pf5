<?php

namespace Phpfox\Model;


class GatewayManagerTest extends \PHPUnit_Framework_TestCase
{
    function testModelProvider(){
        $provider = \Phpfox::get('models.provider');
        $manager = new GatewayManager();
        foreach($provider->all() as $id=>$config){
            $this->assertTrue($manager->get($id) instanceof GatewayInterface);
        }
    }
}
