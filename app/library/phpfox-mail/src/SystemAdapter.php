<?php

namespace Phpfox\Mailer;


class SystemAdapter extends AbstractAdapter
{
    public function send(Message $msg)
    {
        $this->clearErrors();
        if (!$msg->isValid()) {
            if ($this->isDebug()) {
                throw new InvalidMessageException('Message does not contain all required data.');
            }
            return false;
        }

        $mailer = new \PHPMailer();
        $mailer->isSendmail();

        if ($this->isDebug()) {
            $mailer->Debugoutput = function ($str) {
                $this->addError($str);
            };
        }

        $mailer->Subject = $msg->getSubject();
        $mailer->Body = $msg->getBody();
        $mailer->AltBody = $msg->getAltBody();

        if ($msg->getFromAddress()) {
            $mailer->setFrom($msg->getFromAddress(), $msg->getFromName());
        } else {
            $mailer->setFrom($this->get('fromAddress'), $this->get('fromName'));
        }

        foreach ($msg->getReplyTo() as $item) {
            $mailer->addReplyTo($item[0], $item[1]);
        }
        foreach ($msg->getTo() as $item) {
            $mailer->addAddress($item[0], $item[1]);
        }

        foreach ($msg->getCc() as $item) {
            $mailer->addCC($item[0], $item[1]);
        }

        foreach ($msg->getBcc() as $item) {
            $mailer->addBCC($item[0], $item[1]);
        }

        if (!$mailer->send()) {
            $msg = _sprintf('System mail send failed \\n{0} \\n{1}', [
                $this->getErrors(),
            ]);
            _get('main.log')->error($msg);
            if ($this->isDebug()) {
                throw new MailException($msg);
            }
            return false;
        }
        return true;
    }

    public function release()
    {

    }
}