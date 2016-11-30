<?php
namespace Phpfox\Model;

interface GatewayManagerInterface
{
    /**
     * Get a table gateway is associated with key name.
     *
     * @param  string $id
     *
     * @return GatewayInterface
     * @throws GatewayException
     */
    public function get($id);

    /**
     * @param  string $id
     *
     * @return GatewayInterface
     * @throws GatewayException
     */
    public function build($id);

    /**
     * @param string                 $id
     * @param mixed|GatewayInterface $gateway
     *
     * @return $this
     */
    public function set($id, $gateway);

    /**
     * @param string $id
     * @param mixed  $value
     *
     * @return mixed|ModelInterface
     * @throws GatewayException
     */
    public function findById($id, $value);
}