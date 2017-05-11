<?php

namespace Phpfox\Mailer;

class SmtpAdapter extends AbstractAdapter
{
    /**
     * @var \PHPMailer
     */
    protected $phpMailer;

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
        $this->clearErrors();

        if (!$msg->isValid()) {
            if ($this->isDebug()) {
                throw new InvalidMessageException('Message does not contain all required data.');
            }
            return false;
        }


        $this->connect();

        $this->phpMailer->Subject = $msg->getSubject();
        $this->phpMailer->Body = $msg->getBody();
        $this->phpMailer->AltBody = $msg->getAltBody();

        if (empty($msg->getFromAddress())) {
            $this->phpMailer->setFrom($this->get('fromAddress'), $this->get('fromName'));
        } else {
            $this->phpMailer->setFrom($msg->getFromAddress(), $msg->getFromName());
        }

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

        if (!$this->phpMailer->send()) {
            $msg = _sprintf('SMTP Send failed {3} \\n{0} \\n{1}', [
                $this->getErrors(),
                $this->get('host'),
            ]);
            _service('main.log')->error($msg);
            if ($this->isDebug()) {
                throw new MailException($msg);
            }
            return false;
        }
        return true;
    }

    protected function connect()
    {
        if ($this->phpMailer) {
            return;
        }

        $mail = new \PHPMailer();

        $mail->isSMTP();

        if ($this->isDebug()) {
            $mail->SMTPDebug = 3;
            $mail->Debugoutput = function ($str) {
                $this->addError($str);
            };
        }

        $mail->Host = $this->get('host');
        $mail->Port = (int)$this->get('port');

        $secure = strtolower($this->get('secure'));
        if ($secure == 'ssl') {
            $mail->SMTPSecure = 'ssl';
        } elseif ($secure == 'tls') {
            $mail->SMTPSecure = 'tls';
        }

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
}