<?php

namespace Neutron\Core\Model;

class ProfileQuestionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ProfileQuestion();

        $this->assertSame('profile_question', $obj->getModelId());
        $this->assertSame('', $obj->getQuestionId());
        $this->assertSame('', $obj->getSectionId());
        $this->assertSame('', $obj->getAttributeId());
        $this->assertSame('', $obj->getFactoryId());
        $this->assertSame('', $obj->getQuestionLabel());
        $this->assertSame('', $obj->getPlaceholder());
        $this->assertSame('', $obj->getInfo());
        $this->assertSame('', $obj->getNote());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isRequire());
        $this->assertSame('', $obj->getOrdering());
        $this->assertSame('', $obj->getOptions());
        $this->assertSame('', $obj->getDependencies());
    }

    public function testParameters()
    {
        $obj = new ProfileQuestion();

        // set data
        $obj->setQuestionId('');
        $obj->setSectionId('');
        $obj->setAttributeId('');
        $obj->setFactoryId('');
        $obj->setQuestionLabel('');
        $obj->setPlaceholder('');
        $obj->setInfo('');
        $obj->setNote('');
        $obj->setActive('');
        $obj->setRequire('');
        $obj->setOrdering('');
        $obj->setOptions('');
        $obj->setDependencies('');
        // assert same data
        $this->assertSame('profile_question', $obj->getModelId());
        $this->assertSame('', $obj->getQuestionId());
        $this->assertSame('', $obj->getSectionId());
        $this->assertSame('', $obj->getAttributeId());
        $this->assertSame('', $obj->getFactoryId());
        $this->assertSame('', $obj->getQuestionLabel());
        $this->assertSame('', $obj->getPlaceholder());
        $this->assertSame('', $obj->getInfo());
        $this->assertSame('', $obj->getNote());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isRequire());
        $this->assertSame('', $obj->getOrdering());
        $this->assertSame('', $obj->getOptions());
        $this->assertSame('', $obj->getDependencies());
    }

    public function testSave()
    {
        $obj = new ProfileQuestion();

        $obj->save();

        /** @var ProfileQuestion $obj */
        $obj = \Phpfox::model('profile_question')
            ->select()->where('question_id=?', '')->first();

        $this->assertSame('profile_question', $obj->getModelId());
        $this->assertSame('', $obj->getQuestionId());
        $this->assertSame('', $obj->getSectionId());
        $this->assertSame('', $obj->getAttributeId());
        $this->assertSame('', $obj->getFactoryId());
        $this->assertSame('', $obj->getQuestionLabel());
        $this->assertSame('', $obj->getPlaceholder());
        $this->assertSame('', $obj->getInfo());
        $this->assertSame('', $obj->getNote());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isRequire());
        $this->assertSame('', $obj->getOrdering());
        $this->assertSame('', $obj->getOptions());
        $this->assertSame('', $obj->getDependencies());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('profile_question')
            ->delete()->where('question_id=?', '')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('profile_question')
            ->delete()->where('question_id=?', '')->execute();
    }
}