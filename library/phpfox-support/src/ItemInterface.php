<?php

namespace Phpfox\Support;


use Phpfox\Model\ModelInterface;


interface ItemInterface extends ModelInterface
{
    /**
     * @return string
     */
    public function getUniqueId();

    /**
     * @return UserInterface
     */
    public function getOwner();

    /**
     * @return UserInterface
     */
    public function getPoster();

    /**
     * @return UserInterface
     */
    public function getParent();

    /**
     * @return array
     */
    public function getRelationships();

    /**
     * @param string $action
     *
     * @return int
     */
    public function getPrivacy($action);

    /**
     * @return string
     */
    public function getUrl();
}