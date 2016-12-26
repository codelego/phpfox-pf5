<?php

namespace Phpfox\Mailer;

class Message
{
    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var string
     */
    protected $altBody;

    /**
     * @var array
     */
    protected $from = [null, null];

    /**
     * @var array
     */
    protected $replyTo = [];

    /**
     * @var array
     */
    protected $to = [];

    /**
     * @var array
     */
    protected $cc = [];

    /**
     * @var array
     */
    protected $bcc = [];

    /**
     * @return Message
     */
    public static function factory()
    {
        return new static();
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function exchangeArray($data)
    {
        $keys = [
            'from',
            'subject',
            'body',
            'altBody',
            'to',
            'cc',
            'bcc',
            'replyTo',
        ];
        foreach ($keys as $key) {
            if (!empty($data[$key])) {
                $this->{$key} = $data[$key];
            }
        }
        return $this;
    }

    /**
     * @param $address
     * @param $name
     *
     * @return $this
     */
    public function setFrom($address, $name)
    {
        $this->from = [$address, $name];
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     *
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $html
     *
     * @return $this
     */
    public function setBody($html)
    {
        $this->body = $html;
        return $this;
    }

    /**
     * @return string
     */
    public function getAltBody()
    {
        return $this->altBody;
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function setAltBody($text)
    {
        $this->altBody = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getFromName()
    {
        return $this->from[1];
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setFromName($name)
    {
        $this->from[1] = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getFromAddress()
    {
        return $this->from[0];
    }

    /**
     * @param string $address
     *
     * @return $this
     */
    public function setFromAddress($address)
    {
        $this->from[0] = $address;
        return $this;
    }

    /**
     * @return array
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return array
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @return array
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @param string $address
     * @param string $name
     *
     * @return $this
     */
    public function addTo($address, $name)
    {
        $this->to[] = [$address, $name];
        return $this;
    }

    public function addReplyTo($address, $name)
    {
        $this->replyTo[] = [$address, $name];
    }

    /**
     * @return array
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * @param string $address
     * @param string $name
     *
     * @return $this
     */
    public function addCc($address, $name)
    {
        $this->cc[] = [$address, $name];
        return $this;
    }

    /**
     * @param string $address
     * @param string $name
     *
     * @return $this
     */
    public function addBcc($address, $name)
    {
        $this->bcc[] = [$address, $name];
        return $this;
    }

    public function toArray()
    {
        return [
            'from'    => $this->from,
            'subject' => $this->subject,
            'body'    => $this->body,
            'altBody' => $this->altBody,
            'to'      => $this->to,
            'cc'      => $this->cc,
            'bcc'     => $this->bcc,
            'replyTo' => $this->replyTo,
        ];
    }

    /**
     * Message is valid whenever
     * - `fromAddress` must be email
     * - `to` can not be empty
     * - `subject` can not be empty
     * - `body` can not be empty
     *
     * If `altBody` is empty, it will be updated from `body`.
     *
     * @return bool
     */
    public function isValid()
    {
        if (!$this->from[0]) {
            return false;
        }

        if (empty($this->to)) {
            return false;
        }

        if (empty($this->subject) or empty($this->body)) {
            return false;
        }

        if (empty($this->altBody)) {
            $this->altBody = strip_tags($this->body);
        }

        return true;
    }
}