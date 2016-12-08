<?php
namespace Phpfox\Support;

interface UserInterface extends ResourceInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @return bool
     */
    public function isUser();

    public function getUrl();
}