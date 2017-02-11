<?php

namespace Neutron\Core\Service;


use Phpfox\Db\SqlLiteral;
use Phpfox\Session\SessionInterface;

class DatabaseSession implements SessionInterface, \SessionHandlerInterface
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $path = '';

    public function close()
    {
        return true;
    }

    public function destroy($session_id)
    {
        \Phpfox::get('db')
            ->delete(':core_session', ['id=?' => (string)$session_id])
            ->execute();
        return true;
    }


    public function gc($maxlifetime)
    {
        \Phpfox::get('db')->delete(':core_session',
            new SqlLiteral('lifetime + modified < ' . $maxlifetime));

        return true;
    }

    public function open($save_path, $name)
    {
        $this->name = $name;
        $this->path = $save_path;

        return true;
    }

    public function read($session_id)
    {
        $row = \Phpfox::get('db')->select('*')->from(':core_session')
            ->where('id=?', $session_id)->first();

        if (!$row) {
            return '';
        }

        if ((int)$row['modified'] + (int)$row['lifetime'] < time()) {
            return '';
        }

        return $row['data'];
    }

    public function write($session_id, $session_data)
    {
        $db = \Phpfox::get('db');
        $exists = $db->select('id')->from(':core_session')
                ->where('id=?', $session_id)
                ->execute()
                ->first()
            != null;

        if ($exists) {
            $db->update(':core_session', [
                'data'     => $session_data,
                'modified' => time(),
            ], [
                'id=?' => (string)$session_id,
            ])->execute();
        } else {
            $db->insert(':core_session', [
                'id'       => $session_id,
                'modified' => time(),
                'lifetime' => 86400,
                'data'     => $session_data,
                'name'     => $this->name,
            ])->execute();

        }
        return true;
    }

    public function register()
    {
        session_set_save_handler($this);
        return true;
    }
}