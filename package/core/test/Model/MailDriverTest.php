<?php
namespace Neutron\Core\Model;

class MailDriverTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new MailDriver(array (  'driver_id' => 'smtp',  'driver_name' => 'SMTP Mail',  'form_name' => 'Neutron\\Core\\Form\\Admin\\MailDriver\\SmtpDriverSettings',  'description' => 'Alternatively you can have emails sent out using SMTP, usually requiring a username and password, and optionally using an external mail server.',  'is_active' => 0,));

        $this->assertSame('mail_driver', $obj->getModelId());
        $this->assertSame('smtp', $obj->getDriverId());
        $this->assertSame('SMTP Mail', $obj->getDriverName());
        $this->assertSame('Neutron\Core\Form\Admin\MailDriver\SmtpDriverSettings', $obj->getFormName());
        $this->assertSame('Alternatively you can have emails sent out using SMTP, usually requiring a username and password, and optionally using an external mail server.', $obj->getDescription());
        $this->assertSame(0, $obj->isActive());    }

    public function testParameters()
    {
        $obj = new MailDriver();

        // set data
        $obj->setDriverId('smtp');
        $obj->setDriverName('SMTP Mail');
        $obj->setFormName('Neutron\Core\Form\Admin\MailDriver\SmtpDriverSettings');
        $obj->setDescription('Alternatively you can have emails sent out using SMTP, usually requiring a username and password, and optionally using an external mail server.');
        $obj->setActive(0);
        // assert same data
        $this->assertSame('mail_driver', $obj->getModelId());
        $this->assertSame('smtp', $obj->getDriverId());
        $this->assertSame('SMTP Mail', $obj->getDriverName());
        $this->assertSame('Neutron\Core\Form\Admin\MailDriver\SmtpDriverSettings', $obj->getFormName());
        $this->assertSame('Alternatively you can have emails sent out using SMTP, usually requiring a username and password, and optionally using an external mail server.', $obj->getDescription());
        $this->assertSame(0, $obj->isActive());    }

    public function testSave()
    {
        $obj = new MailDriver(array (  'driver_id' => 'smtp',  'driver_name' => 'SMTP Mail',  'form_name' => 'Neutron\\Core\\Form\\Admin\\MailDriver\\SmtpDriverSettings',  'description' => 'Alternatively you can have emails sent out using SMTP, usually requiring a username and password, and optionally using an external mail server.',  'is_active' => 0,));

        $obj->save();

        /** @var MailDriver $obj */
        $obj = _model('mail_driver')
            ->select()->where('driver_id=?','smtp')->first();

        $this->assertSame('mail_driver', $obj->getModelId());
        $this->assertSame('smtp', $obj->getDriverId());
        $this->assertSame('SMTP Mail', $obj->getDriverName());
        $this->assertSame('Neutron\Core\Form\Admin\MailDriver\SmtpDriverSettings', $obj->getFormName());
        $this->assertSame('Alternatively you can have emails sent out using SMTP, usually requiring a username and password, and optionally using an external mail server.', $obj->getDescription());
        $this->assertSame(0, $obj->isActive());    }

    public static function setUpBeforeClass()
    {
        _model('mail_driver')
            ->delete()->where('driver_id=?','smtp')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('mail_driver')
            ->delete()->where('driver_id=?','smtp')->execute();
    }
}