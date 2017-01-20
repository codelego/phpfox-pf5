<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class MailTransport extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'mail_transport';
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->__get('id');
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->__get('name');
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        $title = $this->__get('name');

        if (!$title) {
            $title = $this->getDriver() . ' #' . $this->getId();
        }

        return $title;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return (bool)$this->__get('is_active');
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return (bool)$this->__get('is_default');
    }

    /**
     * @return mixed
     */
    public function getDriver()
    {
        return $this->__get('driver');
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->__get('params');
    }
}