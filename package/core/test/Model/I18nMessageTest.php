<?php
namespace Neutron\Core\Model;

class I18nMessageTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new I18nMessage(array (  'message_id' => 1,  'package_id' => 'core',  'locale_id' => '',  'domain_id' => 'admin',  'message_name' => '[storage quota note]',  'message_value' => 'How much content (photos, songs, videos, etc.) do you want each member to be able to upload? This limit only applies to uploaded content, not things that are linked or embedded from other websites.',  'is_json' => 0,  'is_updated' => 0,));

        $this->assertSame('i18n_message', $obj->getModelId());
        $this->assertSame(1, $obj->getMessageId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('', $obj->getLocaleId());
        $this->assertSame('admin', $obj->getDomainId());
        $this->assertSame('[storage quota note]', $obj->getMessageName());
        $this->assertSame('How much content (photos, songs, videos, etc.) do you want each member to be able to upload? This limit only applies to uploaded content, not things that are linked or embedded from other websites.', $obj->getMessageValue());
        $this->assertSame(0, $obj->isJson());
        $this->assertSame(0, $obj->isUpdated());    }

    public function testParameters()
    {
        $obj = new I18nMessage();

        // set data
        $obj->setMessageId(1);
        $obj->setPackageId('core');
        $obj->setLocaleId('');
        $obj->setDomainId('admin');
        $obj->setMessageName('[storage quota note]');
        $obj->setMessageValue('How much content (photos, songs, videos, etc.) do you want each member to be able to upload? This limit only applies to uploaded content, not things that are linked or embedded from other websites.');
        $obj->setJson(0);
        $obj->setUpdated(0);
        // assert same data
        $this->assertSame('i18n_message', $obj->getModelId());
        $this->assertSame(1, $obj->getMessageId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('', $obj->getLocaleId());
        $this->assertSame('admin', $obj->getDomainId());
        $this->assertSame('[storage quota note]', $obj->getMessageName());
        $this->assertSame('How much content (photos, songs, videos, etc.) do you want each member to be able to upload? This limit only applies to uploaded content, not things that are linked or embedded from other websites.', $obj->getMessageValue());
        $this->assertSame(0, $obj->isJson());
        $this->assertSame(0, $obj->isUpdated());    }

    public function testSave()
    {
        $obj = new I18nMessage(array (  'message_id' => 1,  'package_id' => 'core',  'locale_id' => '',  'domain_id' => 'admin',  'message_name' => '[storage quota note]',  'message_value' => 'How much content (photos, songs, videos, etc.) do you want each member to be able to upload? This limit only applies to uploaded content, not things that are linked or embedded from other websites.',  'is_json' => 0,  'is_updated' => 0,));

        $obj->save();

        /** @var I18nMessage $obj */
        $obj = _model('i18n_message')
            ->select()->where('message_id=?',1)->first();

        $this->assertSame('i18n_message', $obj->getModelId());
        $this->assertSame(1, $obj->getMessageId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('', $obj->getLocaleId());
        $this->assertSame('admin', $obj->getDomainId());
        $this->assertSame('[storage quota note]', $obj->getMessageName());
        $this->assertSame('How much content (photos, songs, videos, etc.) do you want each member to be able to upload? This limit only applies to uploaded content, not things that are linked or embedded from other websites.', $obj->getMessageValue());
        $this->assertSame(0, $obj->isJson());
        $this->assertSame(0, $obj->isUpdated());    }

    public static function setUpBeforeClass()
    {
        _model('i18n_message')
            ->delete()->where('message_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('i18n_message')
            ->delete()->where('message_id=?',1)->execute();
    }
}