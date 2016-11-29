<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 11/22/16
 * Time: 1:33 PM
 */

namespace Phpfox\Session;


class SessionManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testSaveHandler()
    {
        service('session')->start();

        var_dump(session_id());
    }
}
