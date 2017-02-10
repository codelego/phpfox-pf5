<?php

namespace Neutron\Video\Provider;


use Phpfox\Support\CurlRequest;

class VimeoProvider implements ProviderInterface
{

    public function isVideoLink($url)
    {
        return $this->extractCode($url) != false;
    }

    public function getEmbedCode($code, $context = [])
    {
        $id = uniqid('_vimeo');

        $props = array_merge([
            'src'                   => sprintf('//player.vimeo.com/video/%s',
                $code),
            'id'                    => $id,
            'width'                 => 600,
            'height'                => 337,
            'frameborder'           => 0,
            'webkitallowfullscreen' => true,
            'mozallowfullscreen'    => true,
            'allowfullscreen'       => true,
        ], $context);


        return \Phpfox::getTemplate()
            ->render('video/partial/embed', [
                'iframe' => '<iframe ' . _attrize($props) . '></iframe>',
                'id'     => $id,
            ]);
    }

    public function parseFromUrl($url)
    {
        $code = $this->extractCode($url);

        if (!$code) {
            throw new \InvalidArgumentException("Invalid video url");
        }

        $url = "http://vimeo.com/api/oembed.json?url=" . rawurlencode($url)
            . '&with=640';

        $info = \Phpfox::get('curl')->factory($url)->getJSON();

        if (empty($info) or empty($info['title'])) {
            throw new ParseException("Invalid video url");
        }

        $result = new ParseResult();
        $result->setProviderId($this->getProviderId());
        $result->setProviderName($this->getProviderName());
        $result->setVideoCode($info['video_id']);
        $result->setTitle($info['title']);
        $result->setDescription($info['description']);
        $result->setVideoDuration($info['duration']);
        $result->setThumbnailUrl($info['thumbnail_url']);
        $result->setThumbnailSmallUrl($info['thumbnail_url']);
        $result->setThumbMode('large');
        $result->setOriginUrl($url);

        return $result;
    }

    public function getProviderName()
    {
        return 'vimeo.com';
    }

    public function getProviderId()
    {
        return 'vimeo';
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public function extractCode($url)
    {
        $info = parse_url($url);

        $code = trim($info['path'], '/');

        if (preg_match('#^\d+$#', $code, $maches)) {
            return $code;
        }

        return false;
    }
}