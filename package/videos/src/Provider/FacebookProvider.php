<?php

namespace Neutron\Video\Provider;

use Phpfox\Support\CurlRequest;

class FacebookProvider implements ProviderInterface
{
    public function parseFromUrl($url)
    {
        $code = $this->extractCode($url);
        $token
            = 'EAACEdEose0cBAGr88OheXeR9eIn9aOslUkXKw7EfjjMQVre4vVyAxuMPy8AfBctAZBxpCQuZAftpZAw5NgrpLVSBZCUVqZAGnIEA1UcZCOGgzlzgFYItdhk9ZAQS0FiZCK4fWjEqH90LVi5RW3iH7DAhEuNZAMOGNBLsZCCCKeGfSV20D5CA6QcYWSdJbxAZCxdL70ZD';

        $endpoint = _http_build_url('https://graph.facebook.com/v2.8/{0}',
            [$code], [
                'access_token' => $token,
                'fields'       => 'id,title,description,thumbnails,picture,length,captions,embed_html,embeddable',
            ]);

        $info = (new CurlRequest([
            'format' => 'json',
            'url'    => $endpoint,
        ]))->get();

        if (empty($info['id'])) {
            throw new ParseException("Invalid video url");
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

    public function getEmbedCode($code, $context = [])
    {
        // TODO: Implement getEmbedCode() method.
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
            = "/http(?:s?):\/\/(?:www\.|web\.|m\.)?facebook\.com\/([A-z0-9\.]+)\/videos(?:\/[0-9A-z].+)?\/(\d+)(?:.+)?$/";
        if (preg_match($regex, $video_url, $matches)) {
            return $matches[2];
        }
        return null;
    }

    public function getVideoDuration()
    {
        return "";
    }

    public function getVideoTitle()
    {
        return "";
    }

    public function getVideoDescription()
    {
        return "";
    }

    public function getEmbededCode($code = null)
    {
    }

    public function compileVideo($params)
    {
        $video_id = $params['video_id'];
        $code = $params['code'];
        $view = $params['view'];
        $mobile = empty($params['mobile']) ? false : $params['mobile'];
        $autoplay = !$mobile && $view;
        $videoFrame = $video_id . "_" . $params['count_video'];
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
            </iframe>
            <script type="text/javascript">
              en4.core.runonce.add(function() {
                var doResize = function() {
                  var aspect = 16 / 9;
                  var el = document.id("videoFrame' . $videoFrame . '");
                  var parent = el.getParent();
                  var parentSize = parent.getSize();
                  el.set("width", parentSize.x);
                  el.set("height", parentSize.x / aspect);
                }
                window.addEvent("resize", doResize);
                doResize();
              });
            </script>';
        return $embedded;
    }

    public function extractVideo($params)
    {
        $video_id = $params['video_id'];
        $code = $params['code'];
        $view = $params['view'];
        $mobile = empty($params['mobile']) ? false : $params['mobile'];
        $embedded
            = '
            <video id="player_' . $video_id . '" class="ynultimatevideo-player" data-type="1" width="764" height="426">
                <source type="video/facebook" src="www.facebook.com/video/embed?video_id='
            . $code . '" />
            </video>';
        return $embedded;
    }

}