<?php

namespace Phpfox\Mailer;

class SmtpMailAdapter implements MailAdapterInterface
{
    /**
     * @var \PHPMailer
     */
    private $phpMailer;

    /**
     * @var array
     */
    private $params = [];

    /**
     * @var bool
     */
    private $debug = false;

    /**
     * @var bool
     */
    private $test = false;

    /**
     * SmtpMailAdapter constructor.
     *
     * @param array $params
     */
    public function __construct($params = [])
    {
        $this->debug = PHPFOX_ENV != 'development';
        
        foreach ($params as $key => $value) {
            if (method_exists($this, $method = 'set' . ucfirst($key))) {
                $this->{$method}($value);
            } else {
                $this->params[$key] = $value;
            }
        }
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
            throw new InvalidMessageException('Message does not contain all required data.');
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


        if ($this->debug or $this->test) {
            $debugOutput = ob_get_clean();
        }

        if (!$sendResult) {
            $msg = 'Can not send mail using smtp ' . PHP_EOL . $debugOutput;
            if ($this->debug) {
                throw new MailException($msg);
            } else {
                _service('mail.log')->error($msg);
            }
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

        if ($this->debug or $this->test) {
            $mail->SMTPDebug = 3;
            $mail->Debugoutput = 'echo';
        }

        $mail->Host = $this->params['host'];
        $mail->Port = (int)$this->params['port'];
        $mail->SMTPSecure = $this->params['secure'];

        if ($this->params['auth']) {
            $mail->SMTPAuth = true;
            $mail->Username = $this->params['username'];
            $mail->Password = $this->params['password'];

        }
        $this->phpMailer = $mail;
    }

    public function __sleep()
    {
        return ['config'];
    }

    /**
     * @return bool
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * @param bool $debug
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    /**
     * @return bool
     */
    public function isTest()
    {
        return $this->test;
    }

    /**
     * @param bool $test
     */
    public function setTest($test)
    {
        $this->test = $test;
    }
}