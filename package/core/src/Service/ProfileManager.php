<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\ProfileAttribute;
use Neutron\Core\Model\ProfileQuestion;
use Neutron\Core\Model\ProfileSection;
use Neutron\Core\Model\ProfileType;

class ProfileManager
{
    /**
     * @param string $itemType
     * @param string $catalogId
     *
     * @return ProfileType
     */
    public function getProfileType($itemType, $catalogId)
    {
        /** @var ProfileType $profileType */
        $profileType = _model('profile_type')
            ->select()
            ->where('item_type=?', $itemType)
            ->where('catalog_id=?', intval($catalogId))
            ->first();

        return $profileType;
    }

    /**
     * @param string $itemType
     * @param mixed  $catalogId
     *
     * @return ProfileQuestion[]
     */
    public function getProfileQuestions($itemType, $catalogId)
    {
        $profileType = $this->getProfileType($itemType, $catalogId);

        return _model('profile_question')
            ->select()
            ->where('internal_id=?', $profileType->getInternalId())
            ->order('ordering', 1)
            ->all();
    }

    /**
     * @param string $itemType
     *
     * @return ProfileSection[]
     */
    public function getProfileSections($itemType)
    {
        return _model('profile_section')
            ->select()
            ->where('item_type=?', $itemType)
            ->order('ordering', 1)
            ->all();
    }

    /**
     * @param string $itemType
     *
     * @return ProfileSection[]
     */
    public function getProfileAttributes($itemType)
    {
        return _model('profile_attribute')
            ->select()
            ->where('item_type=?', $itemType)
            ->order('ordering', 1)
            ->all();
    }

    /**
     * @param string $itemType
     *
     * @return ProfileType[]
     */
    public function getProfileTypes($itemType)
    {
        return _model('profile_type')
            ->select()
            ->where('item_type=?', $itemType)
            ->order('ordering', 1)
            ->all();
    }
}