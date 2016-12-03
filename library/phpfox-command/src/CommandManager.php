<?php

namespace Phpfox\Command;

class CommandManager
{
    /**
     * @param string $id
     * @param string $params
     *
     * @return mixed
     */
    public function execute($id, $params)
    {

        return $this->factory($id)->execute($params);
    }

    /**
     * does not cache anymore.
     *
     * @param string $id
     *
     * @return CommandInterface
     */
    public function factory($id)
    {
        return _factory(\Phpfox::getConfig('commands', $id));
    }
}