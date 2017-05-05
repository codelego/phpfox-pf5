<?php

namespace Neutron\Core\Service;


use Phpfox\Model\ModelInterface;

class MailManager
{
    /**
     * @return array
     */
    public function getDriverIdOptions()
    {
        $select = _with('mail_driver')
            ->select();

        return array_map(function (ModelInterface $v) {
            return [
                'label' => $v->__get('name'),
                'value' => $v->__get('driver_id'),
                'note'  => $v->__get('description'),
            ];
        }, $select->all());
    }
}