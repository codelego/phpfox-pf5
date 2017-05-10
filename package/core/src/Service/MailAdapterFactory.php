<?php

namespace Neutron\Core\Service;

use Neutron\Core\Model\MailAdapter;
use Phpfox\Mailer\MailAdapterFactoryInterface;

class MailAdapterFactory implements MailAdapterFactoryInterface
{
    /**
     * @var mixed
     */
    protected $default;

    /**
     * @var array
     */
    protected $map = [];

    /**
     * @var bool
     */
    protected $initialized = false;

    public function factory($id)
    {
        if (!$this->initialized) {
            $this->initialize();
        }

        if (!$id or $id == 'default' or $id == 'fallback') {
            $id = $this->default;
        }

        if (!isset($this->map[$id])) {
            throw new \InvalidArgumentException("Can not initialize mail transport '{$id}'");
        }

        $driver = $this->map[$id]['driver'];
        $class = _param('mail.drivers', $driver);

        return new $class($this->map[$id]['configs']);
    }

    private function initialize()
    {
        $this->initialized = true;

        /** @var MailAdapter[] $entries */
        $entries = _model('mail_adapter')
            ->select()
            ->all();

        $this->default = _param('core_mail', 'adapter_id');

        foreach ($entries as $entry) {
            $params = $entry->getParams();

            $id = $entry->getId();

            if (!empty($params)) {
                $params = json_decode($params, true);
            }

            $this->map[$id] = [
                'driver'  => $id,
                'configs' => $params,
            ];
        }
    }
}