<?php
namespace Phpfox\Mailer;


class SystemMailTransport implements MailTransportInterface
{
    public function send(Message $msg)
    {
        if (!$msg->isValid()) {
            throw new InvalidMessageException('Message does not contain all required data.');
        }

        $mailer = new \PHPMailer();
        $mailer->isSendmail();

        $mailer->Subject = $msg->getSubject();
        $mailer->Body = $msg->getBody();
        $mailer->AltBody = $msg->getAltBody();


        $mailer->setFrom($msg->getFromAddress(), $msg->getFromName());

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

        if (PHPFOX_ENV == 'development') {
            ob_start();
        }

        $sendResult = $mailer->send();
        $debugOutput = null;

        if (PHPFOX_ENV == 'development') {
            $debugOutput = ob_get_clean();
        }


        if (!$sendResult and PHPFOX_ENV != 'production') {
            throw new TransportException('Can not send mail using smtp '
                . PHP_EOL . $debugOutput);
        } elseif (!$sendResult) {
            return false;
        }

        return true;
    }

    public function release()
    {

    }
}