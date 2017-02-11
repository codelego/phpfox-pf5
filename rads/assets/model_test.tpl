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
        $obj = \Phpfox::with('{model_id}')
            ->select()
            ->where('{id_key}=?', {id_value})
            ->first();

        {assert_same_method}
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('{model_id}')
            ->delete()
            ->where('{id_key}=?', {id_value})
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('{model_id}')
            ->delete()
            ->where('{id_key}=?', {id_value})
            ->execute();
    }
}