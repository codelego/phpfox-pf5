<?php

namespace Phpfox\Support;

interface UserInterface extends ItemInterface
{
    public function getId();

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
     * @return string
     */
    public function getLevelId();

    /**
     * @return string
     */
    public function getLevelType();

}