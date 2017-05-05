<?php

namespace {namespace};

class {model_name}Test extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new {model_name}({initial_data});

        {assert_same_method}
    }

    public function testParameters()
    {
        $obj = new {model_name}();

        // set data
        {set_data_methods}

        // assert same data
        {assert_same_method}
    }

    public function testSave()
    {
        $obj = new {model_name}({initial_data});

        $obj->save();

        /** @var {model_name} $obj */
        $obj = _with('{model_id}')
            ->select(){where_condition}->first();

        {assert_same_method}
    }

    public static function setUpBeforeClass()
    {
        _with('{model_id}')
            ->delete(){where_condition}->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('{model_id}')
            ->delete(){where_condition}->execute();
    }
}