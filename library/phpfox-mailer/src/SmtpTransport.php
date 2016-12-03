<?php

namespace Phpfox\Mailer;

class SmtpTransport implements TransportInterface
{
    /**
     * @var \PHPMailer
     */
    private $phpMailer;

    /**
     * @var array
     */
    private $configs = [];

    public function __construct($configs)
    {
        $this->configs = $configs;
    }

    /**
     * @ignore
     */
    public function __destruct()
    {
        $this->release();
    }

    public function release()
    {
        if ($this->phpMailer) {
            $this->phpMailer->smtpClose();
            $this->phpMailer = null;
        }
    }

    public function send(Message $msg)
    {
        if (!$msg->isValid()) {
            throw new \InvalidArgumentException('Message does not contain all required data.');
        }

        $this->connect();
        $this->phpMailer->Subject = $msg->getSubject();
        $this->phpMailer->Body = $msg->getBody();
        $this->phpMailer->AltBody = $msg->getAltBody();


        $this->phpMailer->setFrom($msg->getFromAddress(), $msg->getFromName());

        foreach ($msg->getReplyTo() as $item) {
            $this->phpMailer->addReplyTo($item[0], $item[1]);
        }
        foreach ($msg->getTo() as $item) {
            $this->phpMailer->addAddress($item[0], $item[1]);
        }

        foreach ($msg->getCc() as $item) {
            $this->phpMailer->addCC($item[0], $item[1]);
        }

        foreach ($msg->getBcc() as $item) {
            $this->phpMailer->addBCC($item[0], $item[1]);
        }

        if (PHPFOX_ENV == 'development') {
            ob_start();
        }

        $sendResult = $this->phpMailer->send();
        $debugOutput = null;

        if (PHPFOX_ENV == 'development') {
            $debugOutput = ob_get_clean();
        }


        if (!$sendResult and PHPFOX_ENV != 'production') {
            throw new MessageException('Can not send mail using smtp '
                . PHP_EOL . $debugOutput);
        } elseif (!$sendResult) {
            return false;
        }

        return true;
    }

    private function connect()
    {
        if ($this->phpMailer) {
            return;
        }

        $mail = new \PHPMailer();

        $mail->isSMTP();

        if (PHPFOX_ENV == 'development') {
            $mail->SMTPDebug = 3;
            $mail->Debugoutput = 'echo';
        }

        $mail->Host = $this->configs['host'];
        $mail->Port = (int)$this->configs['port'];
        $mail->SMTPSecure = $this->configs['secure'];

        if ($this->configs['auth']) {
            $mail->SMTPAuth = true;
            $mail->Username = $this->configs['username'];
            $mail->Password = $this->configs['password'];

        }
        $this->phpMailer = $mail;
    }

    public function __sleep()
    {
        return ['config'];
    }
}