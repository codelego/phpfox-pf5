<?php
namespace Neutron\Core\Model;

class ProfileProcessTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ProfileProcess(array (  'process_id' => 'event:create',  'title' => 'Event Creation',  'description' => 'Visistors register new account',  'package_id' => '',  'ordering' => 5,));

        $this->assertSame('profile_process', $obj->getModelId());
        $this->assertSame('event:create', $obj->getProcessId());
        $this->assertSame('Event Creation', $obj->getTitle());
        $this->assertSame('Visistors register new account', $obj->getDescription());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame(5, $obj->getOrdering());    }

    public function testParameters()
    {
        $obj = new ProfileProcess();

        // set data
        $obj->setProcessId('event:create');
        $obj->setTitle('Event Creation');
        $obj->setDescription('Visistors register new account');
        $obj->setPackageId('');
        $obj->setOrdering(5);
        // assert same data
        $this->assertSame('profile_process', $obj->getModelId());
        $this->assertSame('event:create', $obj->getProcessId());
        $this->assertSame('Event Creation', $obj->getTitle());
        $this->assertSame('Visistors register new account', $obj->getDescription());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame(5, $obj->getOrdering());    }

    public function testSave()
    {
        $obj = new ProfileProcess(array (  'process_id' => 'event:create',  'title' => 'Event Creation',  'description' => 'Visistors register new account',  'package_id' => '',  'ordering' => 5,));

        $obj->save();

        /** @var ProfileProcess $obj */
        $obj = _model('profile_process')
            ->select()->where('process_id=?','event:create')->first();

        $this->assertSame('profile_process', $obj->getModelId());
        $this->assertSame('event:create', $obj->getProcessId());
        $this->assertSame('Event Creation', $obj->getTitle());
        $this->assertSame('Visistors register new account', $obj->getDescription());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame(5, $obj->getOrdering());    }

    public static function setUpBeforeClass()
    {
        _model('profile_process')
            ->delete()->where('process_id=?','event:create')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('profile_process')
            ->delete()->where('process_id=?','event:create')->execute();
    }
}