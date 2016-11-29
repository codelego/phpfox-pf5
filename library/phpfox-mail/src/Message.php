<?php

namespace Phpfox\Mail;

/**
 * Class Message
 *
 * @package Phpfox\Mail
 */
class Message
{
    /**
     * @var string
     */
    protected $subject = '';

    /**
     * Send from Name
     *
     * @var string
     */
    protected $fromName;

    /**
     * Send from email address
     *
     * @var string
     */
    protected $fromAddress;

    /**
     * @var string
     */
    protected $replyName;

    /**
     * @var string
     */
    protected $replyAddress;

    /**
     * @var string
     */
    protected $bodyHtml;

    /**
     * @var string
     */
    protected $bodyText;

    /**
     * Message constructor.
     *
     * @param string $subject
     * @param string $fromName
     * @param string $fromAddress
     * @param string $replyName
     * @param string $replyAddress
     * @param string $bodyHtml
     * @param string $bodyText
     */
    public function __construct(
        $subject,
        $fromName,
        $fromAddress,
        $replyName,
        $replyAddress,
        $bodyHtml,
        $bodyText
    ) {
        $this->subject = $subject;
        $this->fromName = $fromName;
        $this->fromAddress = $fromAddress;
        $this->replyName = $replyName;
        $this->replyAddress = $replyAddress;
        $this->bodyHtml = $bodyHtml;
        $this->bodyText = $bodyText;
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
     * @return string
     */
    public function getReplyName()
    {
        return $this->replyName;
    }

    /**
     * @param string $replyName
     */
    public function setReplyName($replyName)
    {
        $this->replyName = $replyName;
    }

    /**
     * @return string
     */
    public function getReplyAddress()
    {
        return $this->replyAddress;
    }

    /**
     * @param string $replyAddress
     */
    public function setReplyAddress($replyAddress)
    {
        $this->replyAddress = $replyAddress;
    }

    /**
     * @return string
     */
    public function getBodyHtml()
    {
        return $this->bodyHtml;
    }

    /**
     * @param string $bodyHtml
     */
    public function setBodyHtml($bodyHtml)
    {
        $this->bodyHtml = $bodyHtml;
    }

    /**
     * @return string
     */
    public function getBodyText()
    {
        return $this->bodyText;
    }

    /**
     * @param string $bodyText
     */
    public function setBodyText($bodyText)
    {
        $this->bodyText = $bodyText;
    }
}