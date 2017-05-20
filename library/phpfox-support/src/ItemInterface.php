<?php

namespace Phpfox\Support;


use Phpfox\Model\ModelInterface;


interface ItemInterface extends ModelInterface
{
    /**
     * @return UserInterface
     */
    public function getOwner();

    /**
     * @param UserInterface $user
     *
     * @return array
     */
    public function getRelationships($user);

    /**
     * @param string $action
     *
     * @return int
     */
    public function getPrivacy($action);
}