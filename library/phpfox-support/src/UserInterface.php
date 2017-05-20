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
     * @return string
     */
    public function getProfileName();

    /**
     * @return bool
     */
    public function isUser();

    /**
     * @return mixed
     */
    public function getLevelId();

    public function getUrl();
}