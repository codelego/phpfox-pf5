<?php

namespace Neutron\Video\Provider;

class YoutubeProvider implements ProviderInterface
{
    /**
     * @var string
     */
    private $apiKey;

    public function isVideoLink($url)
    {
        return $this->extractCode($url) != false;
    }

    public function getEmbedCode($code, $context = [])
    {
        $id = uniqid('_youtube');

        $props = array_merge([
            'id'              => $id,
            'width'           => 600,
            'height'          => 337,
            'frameborder'     => 0,
            'allowfullscreen' => 'true',
            'src'             => sprintf('//www.youtube.com/embed/%s',
                $code),
        ], $context);


        return \Phpfox::getTemplate()
            ->render('video/partial/embed', [
                'iframe' => '<iframe ' . _attrize($props) . '></iframe>',
                'id'     => $id,
            ]);
    }

    public function parseFromUrl($url)
    {
        if (empty($this->getApiKey())) {
            throw new ParseException("Missing youtube api key");
        }

        $code = $this->extractCode($url);

        if (!$code) {
            throw new \InvalidArgumentException("Invalid YouTube video url");
        }

        $url = 'https://www.googleapis.com/youtube/v3/video?'
            . http_build_query([
                'id'   => $code,
                'key'  => $this->getApiKey(),
                'part' => 'snippet,contentDetails',
            ], '&');

        $info = \Phpfox::get('curl')->factory($url)->getJSON();

        // validate result
        if (empty($info)) {
            throw new \InvalidArgumentException("Invalid YouTube video");
        }

        if (empty($info['items']) or empty($info['items'][0])
            or empty($info['items'][0]['snippet'])
        ) {
            throw new ParseException("Can not parse youtube video");
        }

        $result = new ParseResult();

        $result->setProviderId($this->getProviderId());
        $result->setProviderName($this->getProviderName());
        $result->setVideoCode($code);
        $snippet = $info['items'][0]['snippet'];
        $contentDetail = $info['items'][0]['contentDetails'];
        $result->setTitle($snippet['title']);
        $result->setDescription($snippet['description']);
        $result->setThumbnailUrl($snippet['thumbnails']['high']['url']);
        $result->setThumbnailUrl('http://img.youtube.com/vi/' . $code
            . '/sddefault.jpg');
        $result->setThumbnailSmallUrl($snippet['thumbnails']['medium']['url']);
        $result->setVideoDuration($this->extractDuration($contentDetail['duration']));
        $result->setDimension($contentDetail['dimension']);
        $result->setDefinition($contentDetail['definition']);
        $result->setThumbMode('large');
        $result->setOriginUrl($url);

        return $result;
    }

    /**
     * @param  $url
     *
     * @return string
     */
    public function extractCode($url)
    {
        $code = false;
        $url = parse_url($url);
        if (strcasecmp($url['host'], 'youtu.be') === 0) {
            #### (dontcare)://youtu.be/<video id>
            $code = substr($url['path'], 1);
        } elseif (strcasecmp($url['host'], 'www.youtube.com') === 0) {
            if (isset($url['query'])) {
                parse_str($url['query'], $url['query']);
                if (isset($url['query']['v'])) {
                    #### (dontcare)://www.youtube.com/(dontcare)?v=<video id>
                    $code = $url['query']['v'];
                }
            }
            if ($code == false) {
                $url['path'] = explode('/', substr($url['path'], 1));
                if (in_array($url['path'][0], ['e', 'embed', 'v'])) {
                    #### (dontcare)://www.youtube.com/(whitelist)/<video id>
                    $code = $url['path'][1];
                }
            }
        }

        return $code;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        if (null == $this->apiKey) {
            $this->apiKey = \Phpfox::getParam('video', 'google_public_key');
        }
        return $this->apiKey;
    }

    /**
     * @param string $duration
     *
     * @return int
     */
    public function extractDuration($duration)
    {
        $result = 0;
        if (preg_match_all("#(\\d+\\w)#", $duration, $matches)) {
            foreach ($matches[1] as $match) {
                $unit = preg_replace("#\\d+#", "", $match);
                $value = (int)str_replace($unit, "", $match);
                switch (strtolower($unit)) {
                    case 'h':
                        $result += $value * 3600; // hour
                        break;
                    case 'm':
                        $result += $value * 60; // hour
                        break;
                    case 's':
                    default:
                        $result += $value;
                }
            }
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getProviderName()
    {
        return 'youtube.com';
    }

    public function getProviderId()
    {
        return 'youtube';
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }
}