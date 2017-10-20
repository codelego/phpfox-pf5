<?php

namespace Neutron\User\Service;


use Neutron\User\Model\AuthHistory;
use Phpfox\Kernel\Event;
use Phpfox\Kernel\UserInterface;

class AuthHistoryManager
{
    public function cleanup()
    {
        $day = \Phpfox::param('auth', 'history_limit');

        return \Phpfox::model('auth_history')
            ->delete()
            ->where('created_at<?',
                date('Y-m-d H:i:s', time() - (int)$day * 86400))
            ->execute();
    }

    /**
     * @param $id
     *
     * @return \Neutron\User\Model\AuthHistory
     */
    public function findById($id)
    {
        return \Phpfox::model('auth_history')
            ->findById((int)$id);
    }

    /**
     * @param array $data
     *
     * @return AuthHistory
     */
    public function log($data)
    {
        $obj = new AuthHistory(array_merge([
            'created_at'     => date('Y-m-d H:i:s'),
            'device_name'    => '',
            'remote_address' => '::0',
        ], $data));

        $obj->save();

        return $obj;
    }

    /**
     * @param int $userId
     *
     * @return \Neutron\User\Model\AuthHistory[]
     */
    public function getByUserId($userId)
    {
        return \Phpfox::model('auth_history')
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

        $address = isset($_SERVER['REMOTE_ADDR'])
            ? $_SERVER['REMOTE_ADDR'] : 'n/a';
        $agent = isset($_SERVER['HTTP_USER_AGENT'])
            ? $_SERVER['HTTP_USER_AGENT'] : 'n/a';

        $this->log([
            'user_id'        => $target->getId(),
            'remote_address' => $address,
            'device_name'    => $agent,
            'created_at'     => date('Y-m-d H:i:s'),
        ]);
    }
}