<?php

namespace Neutron\Video\Service;

use Neutron\Video\Model\Video;

class VideoManager
{
    /**
     * Find video entry by id
     *
     * @param mixed $id
     *
     * @return Video
     */
    public function findVideoById($id)
    {
        return \Phpfox::model('video')
            ->findById((int)$id);
    }
}