<?php

namespace Neutron\User\Service;


use Phpfox\Event\Event;
use Phpfox\Support\UserInterface;

class AuthHistory
{
    public function cleanup()
    {
        $day = 30;

        return \Phpfox::get('db')
            ->delete(':user_auth_history')
            ->where('created<?', date('Y-m-d H:i:s', time() - $day * 86400))
            ->execute();
    }

    /**
     * @param $id
     *
     * @return \Neutron\User\Model\AuthHistory
     */
    public function findById($id)
    {
        return \Phpfox::getModel('user_auth_history')
            ->findById((int)$id);
    }

    public function log($data)
    {
        \Phpfox::getModel('user_auth_history')
            ->insert($data);
    }

    /**
     * @param int $userId
     *
     * @return \Neutron\User\Model\AuthHistory[]
     */
    public function getByUserId($userId)
    {
        return \Phpfox::getModel('user_auth_history')
            ->select()
            ->where('user_id=?', (int)$userId)
            ->order('created', -1)
            ->limit(25)
            ->execute()
            ->all();
    }

    public function onUserLogin(Event $event)
    {
        $target = $event->getTarget();

        if (!$target instanceof UserInterface) {
            return;
        }

        $this->log([
            'user_id'        => $target->getId(),
            'remote_address' => isset($_SERVER['REMOTE_ADDR'])
                ? $_SERVER['REMOTE_ADDR'] : 'n/a',
            'device_name'    => $_SERVER['HTTP_USER_AGENT'],
            'created'        => date('Y-m-d H:i:s'),
        ]);
    }
}