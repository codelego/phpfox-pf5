<?php

namespace Phpfox\Mailer;


class SystemMailTransportTest extends \PHPUnit_Framework_TestCase
{

    public function testSendMail()
    {
        $transport = new SystemTransport();

        $msg = new Message();
        $msg->exchangeArray([
            'fromAddress' => 'nam.ngvan@gmail.com',
            'fromName'    => 'nam nguyen',
            'subject'     => 'test subject',
            'body'        => 'test body',
            'altBody'     => 'test alt body',
        ]);
        $msg->addTo('namnv@younetco.com', 'Nam Nguyen');
        $transport->send($msg);
    }
}
