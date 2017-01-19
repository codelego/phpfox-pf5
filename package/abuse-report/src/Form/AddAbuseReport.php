<?php

namespace Neutron\AbuseReport\Form;

use Phpfox\Form\Form;

/**
 * Class AddAbuseReport
 *
 * <code>
 * $form = new AddAbuseReport(['itemId'=>'', 'itemType'=>'']);
 * </code>
 *
 * @package Neutron\AbuseReport\Form
 */
class AddAbuseReport extends Form
{
    /**
     * @var mixed
     */
    protected $itemId;

    /**
     * @var mixed
     */
    protected $itemType;

    /**
     * @param mixed $itemId
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     * @param mixed $itemType
     */
    public function setItemType($itemType)
    {
        $this->itemType = $itemType;
    }

    protected function initialize()
    {
        $this->addElements([
            [
                'name'     => 'category_id',
                'label'    => _text('What\'s going on?', 'abuse report'),
                'required' => true,
                'factory'  => 'choice',
                'render'   => 'radio',
                'options'  => \Phpfox::get('abuse_report')
                    ->getActiveCategoryOptions(),
            ],
        ]);
    }
}