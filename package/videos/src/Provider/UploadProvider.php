<?php

namespace Neutron\Video\Provider;


class UploadProvider implements ProviderInterface
{
    public function getProviderName()
    {
        return '';
    }

    public function getProviderId()
    {
        return 'upload';
    }

    public function parseFromUrl($url)
    {
        throw new \RuntimeException("Does not support this method");
    }

    public function getEmbedCode($code, $context = [])
    {
        // TODO: Implement getEmbedCode() method.
    }
}