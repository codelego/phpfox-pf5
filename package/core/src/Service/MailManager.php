<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\MailAdapter;
use Neutron\Core\Model\MailDriver;

class MailManager
{
    /**
     * @return array
     */
    public function getDriverIdOptions()
    {
        $select = _model('mail_driver')
            ->select();

        return array_map(function (MailDriver $item) {
            return [
                'value' => $item->getId(),
                'label' => $item->getDriverName(),
                'note'  => $item->getDescription(),
            ];
        }, $select->all());
    }

    /**
     * @return array
     */
    public function getAdapterIdOptions()
    {
        $select = _model('mail_adapter')
            ->select();

        return array_map(function (MailAdapter $item) {
            return [
                'value' => $item->getId(),
                'label' => $item->getAdapterName(),
                'note'  => $item->getDescription(),
            ];
        }, $select->all());
    }
}