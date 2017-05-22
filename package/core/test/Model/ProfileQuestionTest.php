<?php
namespace Neutron\Core\Model;

class ProfileQuestionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ProfileQuestion(array (  'question_id' => 1,  'internal_id' => 1,  'item_type' => 'user',  'question_name' => 'username',  'factory_id' => 'text',  'question_label' => 'Username',  'placeholder' => '',  'info' => '',  'note' => '',  'is_active' => 1,  'is_require' => 1,  'ordering' => 3,  'options' => '',));

        $this->assertSame('profile_question', $obj->getModelId());
        $this->assertSame(1, $obj->getQuestionId());
        $this->assertSame(1, $obj->getInternalId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame('username', $obj->getQuestionName());
        $this->assertSame('text', $obj->getFactoryId());
        $this->assertSame('Username', $obj->getQuestionLabel());
        $this->assertSame('', $obj->getPlaceholder());
        $this->assertSame('', $obj->getInfo());
        $this->assertSame('', $obj->getNote());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequire());
        $this->assertSame(3, $obj->getOrdering());
        $this->assertSame('', $obj->getOptions());    }

    public function testParameters()
    {
        $obj = new ProfileQuestion();

        // set data
        $obj->setQuestionId(1);
        $obj->setInternalId(1);
        $obj->setItemType('user');
        $obj->setQuestionName('username');
        $obj->setFactoryId('text');
        $obj->setQuestionLabel('Username');
        $obj->setPlaceholder('');
        $obj->setInfo('');
        $obj->setNote('');
        $obj->setActive(1);
        $obj->setRequire(1);
        $obj->setOrdering(3);
        $obj->setOptions('');
        // assert same data
        $this->assertSame('profile_question', $obj->getModelId());
        $this->assertSame(1, $obj->getQuestionId());
        $this->assertSame(1, $obj->getInternalId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame('username', $obj->getQuestionName());
        $this->assertSame('text', $obj->getFactoryId());
        $this->assertSame('Username', $obj->getQuestionLabel());
        $this->assertSame('', $obj->getPlaceholder());
        $this->assertSame('', $obj->getInfo());
        $this->assertSame('', $obj->getNote());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequire());
        $this->assertSame(3, $obj->getOrdering());
        $this->assertSame('', $obj->getOptions());    }

    public function testSave()
    {
        $obj = new ProfileQuestion(array (  'question_id' => 1,  'internal_id' => 1,  'item_type' => 'user',  'question_name' => 'username',  'factory_id' => 'text',  'question_label' => 'Username',  'placeholder' => '',  'info' => '',  'note' => '',  'is_active' => 1,  'is_require' => 1,  'ordering' => 3,  'options' => '',));

        $obj->save();

        /** @var ProfileQuestion $obj */
        $obj = _model('profile_question')
            ->select()->where('question_id=?',1)->first();

        $this->assertSame('profile_question', $obj->getModelId());
        $this->assertSame(1, $obj->getQuestionId());
        $this->assertSame(1, $obj->getInternalId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame('username', $obj->getQuestionName());
        $this->assertSame('text', $obj->getFactoryId());
        $this->assertSame('Username', $obj->getQuestionLabel());
        $this->assertSame('', $obj->getPlaceholder());
        $this->assertSame('', $obj->getInfo());
        $this->assertSame('', $obj->getNote());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequire());
        $this->assertSame(3, $obj->getOrdering());
        $this->assertSame('', $obj->getOptions());    }

    public static function setUpBeforeClass()
    {
        _model('profile_question')
            ->delete()->where('question_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('profile_question')
            ->delete()->where('question_id=?',1)->execute();
    }
}