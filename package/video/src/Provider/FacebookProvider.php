<?php

namespace Neutron\Video\Provider;


class FacebookProvider implements ProviderInterface
{
    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function isVideoLink($url)
    {
        return $this->extractCode($url) != false;
    }

    public function parseFromUrl($url)
    {
        $code = $this->extractCode($url);

        $endpoint = _http_build_url('https://graph.facebook.com/v2.8/{0}',
            [$code], [
                'access_token' => $this->getAccessToken(),
                'fields'       => 'id,title,description,thumbnails,picture,length,captions,embed_html,embeddable',
            ]);

        $info = _service('curl')->factory($endpoint)->getJSON();

        if (empty($info['id'])) {
            throw new ParseException($info['error']['message']);
        }

        $result = new ParseResult();
        $result->setProviderId($this->getProviderId());
        $result->setProviderName($this->getProviderName());
        $result->setThumbnailUrl($info['picture']);
        $result->setThumbnailSmallUrl($info['thumbnails']['data'][0]['uri']);
        $result->setVideoCode($info['id']);
        $result->setTitle('Facebook video');
        $result->setDescription($info['description']);
        $result->setVideoDuration(intval($info['length']));
        $result->setOriginUrl($url);
        $result->setThumbMode('large');
        $result->setDefinition('2d');

        return $result;
    }

    public function getProviderName()
    {
        return 'facebook.com';
    }

    public function getProviderId()
    {
        return 'facebook';
    }

    /**
     * @param string $video_url
     *
     * @return string|null
     */
    public function extractCode($video_url)
    {
        $regex
            = "/http(?:s?):\/\/(?:www\.|web\.|m\.)?facebook\.com\/([A-z0-9\.]+)\/video(?:\/[0-9A-z].+)?\/(\d+)(?:.+)?$/";
        if (preg_match($regex, $video_url, $matches)) {
            return $matches[2];
        }
        return null;
    }

    public function getEmbedCode($code, $context = [])
    {
        $videoFrame = '_' . $code;
        $embedded
            = '
            <iframe
            title="Facebook video player"
            id="videoFrame' . $videoFrame . '"
            class=""' . '
            src="//www.facebook.com/video/embed?video_id=' . $code . '"
            frameborder="0"
            allowfullscreen=""
            scrolling="no">
            </iframe>';
        return $embedded;
    }

    public function extractVideo($params)
    {
        $video_id = isset($params['video_id']) ? $params['video_id'] : '';
        $code = isset($params['code']) ? $params['code'] : '';
        $autoplay = !empty($params['autoplay']) ? $params['autoplay'] : 'false';
        $embedded
            = '<video id="player_' . $video_id . '" ' . $autoplay . ' class="video-player" data-type="1" width="764" height="426">
                <source type="video/facebook" src="www.facebook.com/video/embed?video_id='
            . $code . '" />
            </video>';
        return $embedded;
    }

}