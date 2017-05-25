<?php
namespace Neutron\Core\Model;

class ProfileStepTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ProfileStep(array (  'step_id' => 1,  'process_id' => 'user:create',  'form_name' => 'Neutron\\User\\Registration\\EditPaymentInformation',  'step_name' => 'payment',  'form_step_name' => 'Neutron\\User\\Registration\\PaymentInformation',  'ordering' => 10,  'package_id' => 'user',  'is_active' => 1,  'is_require' => 1,  'title' => 'Payment Information',  'description' => 'Fill user payment',));

        $this->assertSame('profile_step', $obj->getModelId());
        $this->assertSame(1, $obj->getStepId());
        $this->assertSame('user:create', $obj->getProcessId());
        $this->assertSame('Neutron\User\Registration\EditPaymentInformation', $obj->getFormName());
        $this->assertSame('payment', $obj->getStepName());
        $this->assertSame('Neutron\User\Registration\PaymentInformation', $obj->getFormStepName());
        $this->assertSame(10, $obj->getOrdering());
        $this->assertSame('user', $obj->getPackageId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequire());
        $this->assertSame('Payment Information', $obj->getTitle());
        $this->assertSame('Fill user payment', $obj->getDescription());    }

    public function testParameters()
    {
        $obj = new ProfileStep();

        // set data
        $obj->setStepId(1);
        $obj->setProcessId('user:create');
        $obj->setFormName('Neutron\User\Registration\EditPaymentInformation');
        $obj->setStepName('payment');
        $obj->setFormStepName('Neutron\User\Registration\PaymentInformation');
        $obj->setOrdering(10);
        $obj->setPackageId('user');
        $obj->setActive(1);
        $obj->setRequire(1);
        $obj->setTitle('Payment Information');
        $obj->setDescription('Fill user payment');
        // assert same data
        $this->assertSame('profile_step', $obj->getModelId());
        $this->assertSame(1, $obj->getStepId());
        $this->assertSame('user:create', $obj->getProcessId());
        $this->assertSame('Neutron\User\Registration\EditPaymentInformation', $obj->getFormName());
        $this->assertSame('payment', $obj->getStepName());
        $this->assertSame('Neutron\User\Registration\PaymentInformation', $obj->getFormStepName());
        $this->assertSame(10, $obj->getOrdering());
        $this->assertSame('user', $obj->getPackageId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequire());
        $this->assertSame('Payment Information', $obj->getTitle());
        $this->assertSame('Fill user payment', $obj->getDescription());    }

    public function testSave()
    {
        $obj = new ProfileStep(array (  'step_id' => 1,  'process_id' => 'user:create',  'form_name' => 'Neutron\\User\\Registration\\EditPaymentInformation',  'step_name' => 'payment',  'form_step_name' => 'Neutron\\User\\Registration\\PaymentInformation',  'ordering' => 10,  'package_id' => 'user',  'is_active' => 1,  'is_require' => 1,  'title' => 'Payment Information',  'description' => 'Fill user payment',));

        $obj->save();

        /** @var ProfileStep $obj */
        $obj = _model('profile_step')
            ->select()->where('step_id=?',1)->first();

        $this->assertSame('profile_step', $obj->getModelId());
        $this->assertSame(1, $obj->getStepId());
        $this->assertSame('user:create', $obj->getProcessId());
        $this->assertSame('Neutron\User\Registration\EditPaymentInformation', $obj->getFormName());
        $this->assertSame('payment', $obj->getStepName());
        $this->assertSame('Neutron\User\Registration\PaymentInformation', $obj->getFormStepName());
        $this->assertSame(10, $obj->getOrdering());
        $this->assertSame('user', $obj->getPackageId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequire());
        $this->assertSame('Payment Information', $obj->getTitle());
        $this->assertSame('Fill user payment', $obj->getDescription());    }

    public static function setUpBeforeClass()
    {
        _model('profile_step')
            ->delete()->where('step_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('profile_step')
            ->delete()->where('step_id=?',1)->execute();
    }
}