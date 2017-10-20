<?php

namespace Phpfox\Kernel;


class CurlFactory
{
    /**
     * @var int
     */
    private $timeout = 30;

    /**
     * @param string $url
     * @param int    $timeout
     * @param array  $options
     *
     * @return CurlRequest
     */
    public function factory($url, $timeout = null, $options = [])
    {
        $options['url'] = $url;
        $options['timeout'] = $timeout ? $timeout : $this->timeout;

        return new CurlRequest($options);
    }
}