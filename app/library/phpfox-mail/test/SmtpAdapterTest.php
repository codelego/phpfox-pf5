<?php

namespace Phpfox\Mailer;


class SmtpAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function provideConfigs()
    {
        return [
            [
                [
                    'host'     => 'smtp.mailgun.org',
                    'port'     => 25,
                    'username' => 'postmaster@sandbox76a7ebc0010146f3a78ba3b69fb1fa55.mailgun.org',
                    'password' => '6c3241b4093e7dd382b3c4bad08c0248',
                    'auth'     => true,
                    'secure'   => 'none',
                    'test'     => true,
                ],
            ],
        ];
    }

    /**
     * @dataProvider  provideConfigs
     *
     * @param array $params
     */
    public function testTestMailMethod($params)
    {
        $result = _get('mailer')
            ->test('smtp', $params, [
                'to'      => [['namnv@younetco.com', 'Nam Nguyen']],
                'from'    => ['nam.ngvan@gmail.com', 'nam nguyen'],
                'subject' => 'test subject',
                'body'    => 'test body',
                'altBody' => 'test alt body',
            ]);

        $this->assertSame(true, $result);
    }

    /**
     * @param $params
     *
     * @dataProvider provideConfigs
     */
    public function testSendMail($params)
    {
        $transport = new SmtpAdapter($params);

        $msg = new Message();
        $msg->fromArray([
            'from'    => ['nam.ngvan@gmail.com', 'nam nguyen'],
            'subject' => 'test subject',
            'body'    => 'test body',
            'altBody' => 'test alt body',
        ]);

        $msg->addTo('namnv@younetco.com', 'Nam Nguyen');
        $result = $transport->send($msg);

        $this->assertTrue($result);
    }
}
