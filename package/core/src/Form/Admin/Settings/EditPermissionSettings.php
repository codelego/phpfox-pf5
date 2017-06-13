<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditPermissionSettings extends Form
{
    /**
     * @var int
     */
    protected $levelId;

    /**
     * @var string
     */
    protected $domainId;

    /**
     * @var string
     */
    protected $itemType;

    /**
     * @param int $levelId
     */
    public function setLevelId($levelId)
    {
        $this->levelId = $levelId;
    }

    /**
     * @param string $domainId
     */
    public function setDomainId($domainId)
    {
        $this->domainId = $domainId;
    }

    /**
     * @param string $itemType
     */
    public function setItemType($itemType)
    {
        $this->itemType = $itemType;
    }
}