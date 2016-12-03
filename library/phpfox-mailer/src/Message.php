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
     * @var string
     */
    protected $fromName;

    /**
     * @var string
     */
    protected $fromAddress;

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
     * Message constructor.
     *
     * @see Message::exchangeArray()
     *
     * @param array $data
     */
    public function __construct($data = null)
    {
        if (is_array($data)) {
            $this->exchangeArray($data);
        }
    }

    public function exchangeArray($data)
    {
        $keys = [
            'fromAddress',
            'fromName',
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
    }

    public function setFrom($address, $name)
    {
        $this->fromAddress = $address;
        $this->fromName = $name;
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
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getAltBody()
    {
        return $this->altBody;
    }

    /**
     * @param string $altBody
     */
    public function setAltBody($altBody)
    {
        $this->altBody = $altBody;
    }

    /**
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * @param string $fromName
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;
    }

    /**
     * @return string
     */
    public function getFromAddress()
    {
        return $this->fromAddress;
    }

    /**
     * @param string $fromAddress
     */
    public function setFromAddress($fromAddress)
    {
        $this->fromAddress = $fromAddress;
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
     */
    public function addTo($address, $name)
    {
        $this->to[] = [$address, $name];
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
     */
    public function addCc($address, $name)
    {
        $this->cc[] = [$address, $name];
    }

    public function addBcc($address, $name)
    {
        $this->bcc[] = [$address, $name];
    }

    public function toArray()
    {
        return [
            'fromAddress' => $this->fromAddress,
            'fromName'    => $this->fromName,
            'subject'     => $this->subject,
            'body'        => $this->body,
            'altBody'     => $this->altBody,
            'to'          => $this->to,
            'cc'          => $this->cc,
            'bcc'         => $this->bcc,
            'replyTo'     => $this->replyTo,
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
        if (!$this->fromAddress) {
            return false;
        }

        if (!$this->to) {
            return false;
        }

        if (empty($this->subject) || empty($this->body)) {
            return false;
        }

        if (empty($this->altBody)) {
            $this->altBody = strip_tags($this->body);
        }

        return true;
    }
}