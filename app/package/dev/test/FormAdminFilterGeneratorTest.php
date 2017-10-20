<?php

namespace Neutron\Dev;

class FormAdminFilterGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testFormFilter()
    {
        $meta = _model('dev_action')->findById(10);

        $generator = new FormAdminFilterGenerator($meta, []);

        $generator->process();
    }

    public function testFormAdd()
    {
        $meta = _model('dev_action')->findById(10);

        $generator = new FormAdminAddGenerator($meta, []);

        $generator->process();
    }

    public function testFormEdit()
    {
        $meta = _model('dev_action')->findById(10);

        $generator = new FormAdminEditGenerator($meta, []);

        $generator->process();
    }
}
