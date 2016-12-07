<?php

namespace Phpfox\Payments;


interface RequestInterface extends MessageInterface
{
    /**
     * Initialize request with parameters
     *
     * @param array $parameters
     *
     * @return
     */
    public function initialize($parameters = []);

    /**
     * Get all request parameters
     *
     * @return array
     */
    public function getParameters();

    /**
     * Get the response to this request (if the request has been sent)
     *
     * @return ResponseInterface
     */
    public function getResponse();

    /**
     * Send the request
     *
     * @return ResponseInterface
     */
    public function send();

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data);
}
