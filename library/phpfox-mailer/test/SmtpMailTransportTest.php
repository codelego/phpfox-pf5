<?php
namespace Phpfox\Mailer;


class SmtpMailTransportTest extends \PHPUnit_Framework_TestCase
{
    public function provideConfigs()
    {
        return [
            [
                [
                    'host'     => 'smtp.sendgrid.net',
                    'port'     => 587,
                    'username' => 'phpfoxdemo',
                    'password' => 'Demo@Fox16',
                    'auth'     => true,
                    'secure'   => 'tls',
                ],
            ],
            [
                [
                    'host'     => 'smtp.sendgrid.net',
                    'port'     => 25,
                    'username' => 'phpfoxdemo',
                    'password' => 'Demo@Fox16',
                    'auth'     => true,
                    'secure'   => 'tls',
                ],
            ],
            [
                [
                    'host'     => 'smtp.sendgrid.net',
                    'port'     => 465,
                    'username' => 'phpfoxdemo',
                    'password' => 'Demo@Fox16',
                    'auth'     => true,
                    'secure'   => 'ssl',
                ],
            ],
            [
                [
                    'host'     => 'smtp.sendgrid.net',
                    'port'     => 25,
                    'username' => 'phpfoxdemo',
                    'password' => 'Demo@Fox16',
                    'auth'     => true,
                    'secure'   => '',
                ],
            ],
        ];
    }

    /**
     * @param $configs
     *
     * @dataProvider provideConfigs
     */
    public function testSendMail($configs)
    {
        $transport = new SmtpMailTransport($configs);

        $msg = new Message();
        $msg->exchangeArray([
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
