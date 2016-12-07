<?php
namespace Phpfox\Mailer;

class MailFacades
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param mixed $name Message Identity etc, User
     * @param array $data Data container
     *
     * @return Message
     * @throws \Exception
     */
    public function createMessage($name, $data)
    {
        $info = $this->load($name);

        if (!$info) {
            throw new InvalidMessageException("Oops! Could not find mail info '{$name}'.");
        }
        $replace = [];

        $data = array_merge($this->data, $data);

        foreach ($data as $k => $v) {
            if (is_string($v)) {
                $replace['{' . $k . '}'] = $v;
            }

        }


        $text = strtr($info['body_text'], $replace);
        $html = strtr($info['body_html'], $replace);
        $subject = strtr($info['subject'], $replace);

        $message = Message::factory()->setSubject($subject)->setBody($html)
            ->setAltBody($text);

        \Phpfox::get('main.log')->info(json_encode($message->toArray()));

        return $message;
    }

    /**
     * @param string $name
     *
     * @return array
     * Result is associate array contain
     * - subject
     * - body_html
     * - body_text
     * - layout
     * - prefer_transport_id
     */
    public function load($name)
    {
        if (!$name) {
            return null;
        }

        return [
            'subject'   => 'welcome, {name}!',
            'body_html' => 'welcome {name}, you are registered using email {email}.',
            'body_text' => 'welcome {name}, you are registered using email {email}. kind regard, Nam Nguyen',
        ];
    }

    public function send($id, Message $message)
    {
        try {

            \Phpfox::get('mailer.factory')->factory($id)->send($message);

        } catch (TransportException $exception) {

            \Phpfox::get('main.log')
                ->info('Oops! Could not send email use transport "{0}", retry to use configured fallback!',
                    [$id]);

            \Phpfox::get('mailer.factory')->factory('fallback')->send($message);
        }
    }
}