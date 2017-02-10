<?php

namespace Neutron\User\Service;


use Phpfox\Event\Event;
use Phpfox\Support\UserInterface;

class AuthHistoryManager
{
    public function cleanup()
    {
        $day = \Phpfox::getParam('auth', 'history_limit');

        return \Phpfox::with('auth_history')
            ->delete()
            ->where('created_at<?', date('Y-m-d H:i:s', time() - (int)$day * 86400))
            ->execute();
    }

    /**
     * @param $id
     *
     * @return \Neutron\User\Model\AuthHistory
     */
    public function findById($id)
    {
        return \Phpfox::with('auth_history')
            ->findById((int)$id);
    }

    public function log($data)
    {
        \Phpfox::with('auth_history')
            ->insert($data);
    }

    /**
     * @param int $userId
     *
     * @return \Neutron\User\Model\AuthHistory[]
     */
    public function getByUserId($userId)
    {
        return \Phpfox::with('auth_history')
            ->select()
            ->where('user_id=?', (int)$userId)
            ->order('created_at', -1)
            ->limit(25)
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