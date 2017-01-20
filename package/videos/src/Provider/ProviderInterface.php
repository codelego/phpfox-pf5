<?php

namespace Neutron\Video\Provider;

interface ProviderInterface
{
    /**
     * @param string $url
     *
     * @return ParseResult
     * @throws \Exception
     */
    public function parseFromUrl($url);

    /**
     * @param string $code
     * @param array  $context
     *
     * @return string
     */
    public function getEmbedCode($code, $context = []);

    /**
     * @return string
     */
    public function getProviderName();

    /**
     * @return string
     */
    public function getProviderId();

}