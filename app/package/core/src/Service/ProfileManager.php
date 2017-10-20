<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\ProfileAttribute;
use Neutron\Core\Model\ProfileProcess;
use Neutron\Core\Model\ProfileQuestion;
use Neutron\Core\Model\ProfileSection;
use Phpfox\Db\SqlLiteral;

class ProfileManager
{
    /**
     * @param string $processId
     *
     * @return ProfileProcess
     */
    public function findProfileProcess($processId)
    {
        return \Phpfox::model('profile_process')
            ->findById($processId);
    }

    /**
     * @param string $sectionId
     *
     * @return ProfileProcess
     */
    public function findProfileSection($sectionId)
    {
        return \Phpfox::model('profile_section')
            ->findById($sectionId);
    }

    /**
     * @param string $itemType
     * @param mixed  $processId
     *
     * @return array
     */
    public function getSuggestProfileAttributeOptions($itemType, $processId)
    {

        $subQuery = new SqlLiteral(\Phpfox::model('profile_question')
            ->select('attribute_id')
            ->where('section_id IN (?)', new SqlLiteral(\Phpfox::model('profile_section')
                ->select('section_id')
                ->where('process_id=?', (int)$processId)
                ->prepare()))->prepare());

        return array_map(function (ProfileAttribute $attribute) {
            return [
                'value' => $attribute->getId(),
                'label' => $attribute->getAttributeLabel(),
            ];
        }, \Phpfox::model('profile_attribute')
            ->select()
            ->where('item_type=?', $itemType)
            ->where('attribute_id NOT IN (?)', $subQuery)
            ->all());
    }

    /**
     * @param string $itemType
     * @param string $processType
     * @param string $catalogId
     *
     * @return ProfileProcess
     */
    public function getProfileProcess($itemType, $processType, $catalogId)
    {
        return \Phpfox::model('profile_process')
            ->select()
            ->where('item_type=?', $itemType)
            ->where('process_type=?', $processType)
            ->where('catalog_id=?', $catalogId)
            ->first();
    }

    /**
     * @param mixed $processId
     * @param bool  $activeOnly
     *
     * @return ProfileSection[]
     */
    public function getProfileSections($processId, $activeOnly = false)
    {
        return \Phpfox::model('profile_section')
            ->select()
            ->where('process_id=?', $processId)
            ->whereIf($activeOnly, 'is_active=?', 1)
            ->order('ordering', 1)
            ->all();
    }

    /**
     * @param string $sectionId
     * @param bool   $activeOnly
     *
     * @return ProfileQuestion
     */
    public function getProfileQuestions($sectionId, $activeOnly = false)
    {
        return \Phpfox::model('profile_question')
            ->select()
            ->where('section_id=?', $sectionId)
            ->whereIf($activeOnly, 'is_active=?', 1)
            ->order('ordering', 1)
            ->all();
    }

    /**
     * @param ProfileSection $profileSection
     * @param array          $attributeIds
     */
    public function addProfileQuestions($profileSection, $attributeIds = [])
    {
        if (empty($attributeIds)) {
            return;
        }

        $profileProcess = $this->findProfileProcess($profileSection->getProcessId());

        /** @var ProfileAttribute[] $profileAttributes */
        $profileAttributes = \Phpfox::model('profile_attribute')
            ->select()
            ->where('item_type=?', $profileProcess->getItemType())
            ->where('attribute_id in ?', $attributeIds)
            ->order('ordering', 1)
            ->all();

        foreach ($profileAttributes as $attribute) {
            $question = new ProfileQuestion([
                'section_id'     => (int)$profileSection->getId(),
                'attribute_id'   => (int)$attribute->getId(),
                'factory_id'     => (string)$attribute->getFactoryId(),
                'question_label' => (string)$attribute->getAttributeLabel(),
                'placeholder'    => (string)$attribute->getPlaceholder(),
                'info'           => (string)$attribute->getInfo(),
                'note'           => (string)$attribute->getNote(),
                'options'        => (string)$attribute->getOptions(),
                'ordering'       => (int)$attribute->getOrdering(),
                'is_system'      => (int)$attribute->isSystem(),
                'is_active'      => (int)$attribute->isActive(),
            ]);
            $question->save();
        }
    }
}