<?php

namespace Neutron\Video\Provider;


class ParseResult
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param array $data
     */
    public function fromArray($data)
    {
        foreach ($data as $k => $v) {
            if (method_exists($this, $method = 'set' . ucfirst($k))) {
                $this->{$method}($v);
            } else {
                $this->data[$k] = $v;
            }
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    public function get($name, $default = null)
    {
        return isset($this->data[$name]) ? $this->data[$name] : $default;
    }

    public function set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @return string
     */
    public function getVideoCode()
    {
        return $this->get('video_code');
    }

    /**
     * @param string $value
     */
    public function setVideoCode($value)
    {
        $this->set('video_code', $value);
    }

    /**
     * @return int
     */
    public function getVideoDuration()
    {
        return $this->get('video_duration');
    }

    /**
     * @param int $value
     */
    public function setVideoDuration($value)
    {
        $this->set('video_duration', $value);
    }

    /**
     * @return string
     */
    public function getProviderId()
    {
        return $this->get('provider_id');
    }

    /**
     * @param string $value
     */
    public function setProviderId($value)
    {
        $this->set('provider_id', $value);
    }

    /**
     * @return string
     */
    public function getProviderName()
    {
        return $this->get('provider_name');
    }

    /**
     * @param string $value
     */
    public function setProviderName($value)
    {
        $this->set('provider_name', $value);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->get('title');
    }

    /**
     * @param string $value
     */
    public function setTitle($value)
    {
        $this->set('title', $this->escape($value));
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->get('description');
    }

    /**
     * @param string $value
     */
    public function setDescription($value)
    {
        $this->set('description', $this->escape($value));
    }

    /**
     * @return string
     */
    public function getDefinition()
    {
        return $this->get('definition');
    }

    /**
     * @param string $value
     */
    public function setDefinition($value)
    {
        $this->set('definition', $value);
    }

    /**
     * @return string
     */
    public function getDimension()
    {
        return $this->get('dimension');
    }

    /**
     * @param string $value
     */
    public function setDimension($value)
    {
        $this->set('dimension', $value);
    }

    /**
     * @return string
     */
    public function getThumbnailUrl()
    {
        return $this->get('thumbnail_url');
    }

    /**
     * @param string $value
     */
    public function setThumbnailUrl($value)
    {
        $this->set('thumbnail_url', $value);
    }

    /**
     * @return string
     */
    public function getThumbnailSmallUrl()
    {
        return $this->get('thumbnail_small_url');
    }

    /**
     * @param string $value
     */
    public function setThumbnailSmallUrl($value)
    {
        $this->set('thumbnail_small_url', $value);
    }

    /**
     * @return string
     */
    public function getOriginUrl()
    {
        return $this->get('origin_url');
    }

    /**
     * @param string $value
     */
    public function setOriginUrl($value)
    {
        $this->set('origin_url', $value);
    }

    /**
     * @return string
     */
    public function getThumbMode()
    {
        return $this->get('thumb_mode');
    }

    /**
     * @param string $value
     */
    public function setThumbMode($value)
    {
        $this->set('thumb_mode', $value);
    }

    /**
     * @param $value
     *
     * @return string
     */
    private function escape($value)
    {
        return strip_tags(mb_convert_encoding(html_entity_decode(urldecode($value)),
            'UTF-8'));
    }

}