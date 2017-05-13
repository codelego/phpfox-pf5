<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 5/13/17
 * Time: 8:18 AM
 */

namespace Neutron\Core\Service;


use Phpfox\Form\Form;

class AdapterManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetDriverIdOptions()
    {
        $contents = _service('core.adapter')
            ->getDriverIdOptions('cache');

        $this->assertNotEmpty($contents);
    }

    public function testFindFormObject()
    {
        $form = _service('core.adapter')
            ->getEditingForm('files', 'cache');

        $this->assertTrue($form instanceof Form);
    }


}
