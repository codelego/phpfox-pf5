<?php

namespace Phpfox\Mailer;

class MailFacades
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var AdapterInterface[]
     */
    protected $adapters = [];

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

    /**
     * @param string $driver options system, smtp
     * @param array  $params array
     * @param array  $testEmail
     *
     * @return array  [result, message]
     */
    public function test($driver, $params, $testEmail)
    {
        try {
            $class = \Phpfox::param('mail_drivers', $driver);

            /** @var AdapterInterface $adapter */
            $adapter = new $class($params);

            $result = $adapter->send(new Message($testEmail));

            return [$result, null];

        } catch (\Exception $ex) {
            return [false, $ex->getMessage()];
        }
    }

    /**
     * @param string $adapterId
     *
     * @return AdapterInterface
     *
     * @throws MailException
     */
    private function make($adapterId)
    {
        $parameter = \Phpfox::get('package.loader')->getMailParameter($adapterId);
        $class = \Phpfox::param('mail_drivers', $parameter->get('driver'));

        if (!$class or !class_exists($class)) {
            throw new MailException("Can not create mail " . $adapterId);
        }
        return $this->adapters[$adapterId] = new $class($parameter->get('params'));
    }

    /**
     * @param string|mixed $adapterId
     *
     * @return AdapterInterface
     */
    public function get($adapterId)
    {
        if (!$adapterId) {
            $adapterId = 'default';
        }

        return $this->adapters[$adapterId] ? $this->adapters[$adapterId] : $this->make($adapterId);
    }

    /**
     * @param string  $adapterId
     * @param Message $message
     *
     * @return bool
     */
    public function send($adapterId, Message $message)
    {
        if (!$adapterId) {
            $adapterId = 'default';
        }
        try {
            return $this->get($adapterId)->send($message);
        } catch (MailException $exception) {
            if ($adapterId != 'default') {
                \Phpfox::get('main.log')
                    ->error('Oops! Could not send email use mailer "{0}", retry to use configured default mailer to retry!',
                        [$adapterId]);
            }
        }

        if ($adapterId != 'default') {
            try {
                return $this->get('default')->send($message);
            } catch (MailException $exception) {
                \Phpfox::get('main.log')->error('Oops! Could not send email use mailer "{0}"!', [$adapterId]);
            }
        }
        return false;
    }
}