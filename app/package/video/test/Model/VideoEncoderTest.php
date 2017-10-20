<?php
namespace Neutron\Video\Model;

class VideoEncoderTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new VideoEncoder(array (  'encoder_id' => 'ffmpeg',  'form_settings_class' => 'Neutron\\Core\\Admin\\EditMpegSettings',  'is_active' => 1,  'ordering' => 1,  'package_id' => 'video',  'title' => 'FFMPEG',  'description' => 'Encode video using ffmpeg',  'dependency' => '[]',));

        $this->assertSame('video_encoder', $obj->getModelId());
        $this->assertSame('ffmpeg', $obj->getEncoderId());
        $this->assertSame('Neutron\Core\Admin\EditMpegSettings', $obj->getFormSettingsClass());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame('video', $obj->getPackageId());
        $this->assertSame('FFMPEG', $obj->getTitle());
        $this->assertSame('Encode video using ffmpeg', $obj->getDescription());
        $this->assertSame('[]', $obj->getDependency());    }

    public function testParameters()
    {
        $obj = new VideoEncoder();

        // set data
        $obj->setEncoderId('ffmpeg');
        $obj->setFormSettingsClass('Neutron\Core\Admin\EditMpegSettings');
        $obj->setActive(1);
        $obj->setOrdering(1);
        $obj->setPackageId('video');
        $obj->setTitle('FFMPEG');
        $obj->setDescription('Encode video using ffmpeg');
        $obj->setDependency('[]');
        // assert same data
        $this->assertSame('video_encoder', $obj->getModelId());
        $this->assertSame('ffmpeg', $obj->getEncoderId());
        $this->assertSame('Neutron\Core\Admin\EditMpegSettings', $obj->getFormSettingsClass());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame('video', $obj->getPackageId());
        $this->assertSame('FFMPEG', $obj->getTitle());
        $this->assertSame('Encode video using ffmpeg', $obj->getDescription());
        $this->assertSame('[]', $obj->getDependency());    }

    public function testSave()
    {
        $obj = new VideoEncoder(array (  'encoder_id' => 'ffmpeg',  'form_settings_class' => 'Neutron\\Core\\Admin\\EditMpegSettings',  'is_active' => 1,  'ordering' => 1,  'package_id' => 'video',  'title' => 'FFMPEG',  'description' => 'Encode video using ffmpeg',  'dependency' => '[]',));

        $obj->save();

        /** @var VideoEncoder $obj */
        $obj = _model('video_encoder')
            ->select()->where('encoder_id=?','ffmpeg')->first();

        $this->assertSame('video_encoder', $obj->getModelId());
        $this->assertSame('ffmpeg', $obj->getEncoderId());
        $this->assertSame('Neutron\Core\Admin\EditMpegSettings', $obj->getFormSettingsClass());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame('video', $obj->getPackageId());
        $this->assertSame('FFMPEG', $obj->getTitle());
        $this->assertSame('Encode video using ffmpeg', $obj->getDescription());
        $this->assertSame('[]', $obj->getDependency());    }

    public static function setUpBeforeClass()
    {
        _model('video_encoder')
            ->delete()->where('encoder_id=?','ffmpeg')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('video_encoder')
            ->delete()->where('encoder_id=?','ffmpeg')->execute();
    }
}